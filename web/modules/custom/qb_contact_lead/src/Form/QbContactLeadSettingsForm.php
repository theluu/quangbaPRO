<?php

namespace Drupal\qb_contact_lead\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class QbContactLeadSettingsForm extends ConfigFormBase {

  public function getFormId(): string {
    return 'qb_contact_lead_settings_form';
  }

  protected function getEditableConfigNames(): array {
    return ['qb_contact_lead.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('qb_contact_lead.settings');

    $form['recaptcha_v3_site_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Google reCAPTCHA v3 site key'),
      '#default_value' => $config->get('recaptcha_v3_site_key') ?? '',
      '#maxlength' => 255,
    ];

    $form['recaptcha_v3_secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Google reCAPTCHA v3 secret key'),
      '#default_value' => $config->get('recaptcha_v3_secret_key') ?? '',
      '#maxlength' => 255,
    ];

    $form['help'] = [
      '#type' => 'item',
      '#markup' => $this->t('The contact lead form will verify reCAPTCHA only when both keys are configured.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->configFactory()
      ->getEditable('qb_contact_lead.settings')
      ->set('recaptcha_v3_site_key', trim((string) $form_state->getValue('recaptcha_v3_site_key')))
      ->set('recaptcha_v3_secret_key', trim((string) $form_state->getValue('recaptcha_v3_secret_key')))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
