<?php

namespace Drupal\qb_contact_lead\Controller;

use Drupal\Component\Utility\EmailValidatorInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactLeadController extends ControllerBase {

  protected EntityTypeManagerInterface $entityTypeManagerService;

  protected EmailValidatorInterface $emailValidator;

  public function __construct(
    EntityTypeManagerInterface $entity_type_manager,
    EmailValidatorInterface $email_validator
  ) {
    $this->entityTypeManagerService = $entity_type_manager;
    $this->emailValidator = $email_validator;
  }

  public static function create(ContainerInterface $container): static {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('email.validator')
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

}
