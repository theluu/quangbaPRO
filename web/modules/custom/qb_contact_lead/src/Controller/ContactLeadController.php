<?php

namespace Drupal\qb_contact_lead\Controller;

use Drupal\Component\Utility\EmailValidatorInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactLeadController extends ControllerBase {

  protected EntityTypeManagerInterface $entityTypeManagerService;

  protected EmailValidatorInterface $emailValidator;

  protected ClientInterface $httpClient;

  protected ConfigFactoryInterface $configFactoryService;

  public function __construct(
    EntityTypeManagerInterface $entity_type_manager,
    EmailValidatorInterface $email_validator,
    ClientInterface $http_client,
    ConfigFactoryInterface $config_factory
  ) {
    $this->entityTypeManagerService = $entity_type_manager;
    $this->emailValidator = $email_validator;
    $this->httpClient = $http_client;
    $this->configFactoryService = $config_factory;
  }

  public static function create(ContainerInterface $container): static {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('email.validator'),
      $container->get('http_client'),
      $container->get('config.factory')
    );
  }

  public function submit(Request $request): JsonResponse {
    $data = json_decode($request->getContent(), TRUE);

    if (!is_array($data)) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Invalid JSON payload.',
      ], 400);
    }

    $name = trim((string) ($data['name'] ?? ''));
    $phone = trim((string) ($data['phone'] ?? ''));
    $email = trim((string) ($data['email'] ?? ''));
    $note = trim((string) ($data['note'] ?? ''));
    $recaptcha_token = trim((string) ($data['recaptchaToken'] ?? ''));
    $recaptcha_action = trim((string) ($data['recaptchaAction'] ?? 'contact_lead_submit'));

    if ($name === '' || $phone === '' || $email === '') {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Name, phone, and email are required.',
      ], 422);
    }

    if (!$this->emailValidator->isValid($email)) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Email is invalid.',
      ], 422);
    }

    $recaptcha_settings = $this->configFactoryService->get('qb_contact_lead.settings');
    $site_key = trim((string) ($recaptcha_settings->get('recaptcha_v3_site_key') ?? ''));
    $secret_key = trim((string) ($recaptcha_settings->get('recaptcha_v3_secret_key') ?? ''));

    if ($site_key !== '' && $secret_key !== '') {
      if ($recaptcha_token === '') {
        return new JsonResponse([
          'status' => 'error',
          'message' => 'Missing reCAPTCHA token.',
        ], 422);
      }

      $recaptcha_result = $this->verifyRecaptchaToken(
        $recaptcha_token,
        $secret_key,
        $request->getClientIp(),
        $recaptcha_action
      );

      if (!$recaptcha_result['success']) {
        return new JsonResponse([
          'status' => 'error',
          'message' => $recaptcha_result['message'],
        ], 422);
      }
    }

    try {
      $title = sprintf(
        'Lead %s - %s',
        $name,
        date('Y-m-d H:i:s')
      );

      $lead = $this->entityTypeManagerService
        ->getStorage('node')
        ->create([
          'type' => 'qb_contact',
          'title' => $title,
          'status' => 0,
          'field_qb_contact_name' => $name,
          'field_qb_contact_phone' => $phone,
          'field_qb_contact_email' => $email,
          'field_qb_contact_note' => [
            'value' => $note,
            'format' => 'plain_text',
          ],
        ]);

      $violations = $lead->validate();
      if ($violations->count() > 0) {
        return new JsonResponse([
          'status' => 'error',
          'message' => $violations->get(0)->getMessage(),
        ], 422);
      }

      $lead->save();

      return new JsonResponse([
        'status' => 'success',
        'message' => 'Lead saved successfully.',
        'id' => $lead->id(),
      ], 201);
    }
    catch (\Throwable $e) {
      $this->getLogger('qb_contact_lead')->error(
        'Failed to save contact lead: @message',
        ['@message' => $e->getMessage()]
      );

      return new JsonResponse([
        'status' => 'error',
        'message' => 'Unable to save the lead right now.',
      ], 500);
    }
  }

  protected function verifyRecaptchaToken(
    string $token,
    string $secret_key,
    ?string $client_ip,
    string $expected_action
  ): array {
    try {
      $response = $this->httpClient->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
          'secret' => $secret_key,
          'response' => $token,
          'remoteip' => $client_ip,
        ],
        'timeout' => 10,
      ]);

      $data = json_decode((string) $response->getBody(), TRUE);
      $success = (bool) ($data['success'] ?? FALSE);
      $score = (float) ($data['score'] ?? 0);
      $action = (string) ($data['action'] ?? '');

      if (!$success) {
        return [
          'success' => FALSE,
          'message' => 'reCAPTCHA verification failed.',
        ];
      }

      if ($action !== '' && $action !== $expected_action) {
        return [
          'success' => FALSE,
          'message' => 'reCAPTCHA action mismatch.',
        ];
      }

      if ($score < 0.5) {
        return [
          'success' => FALSE,
          'message' => 'reCAPTCHA score is too low.',
        ];
      }

      return ['success' => TRUE];
    }
    catch (\Throwable $e) {
      $this->getLogger('qb_contact_lead')->error(
        'reCAPTCHA verification error: @message',
        ['@message' => $e->getMessage()]
      );

      return [
        'success' => FALSE,
        'message' => 'Unable to verify reCAPTCHA right now.',
      ];
    }
  }

}
