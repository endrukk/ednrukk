<?php

namespace Drupal\endrukk\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Leo Settings Config form.
 */
class EndrukkSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'leo_settings_forms_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $defaults = [
      'value' => '',
      'format' => filter_default_format(),
    ];

    $my_richtext_field = \Drupal::state()->get('my_richtext_field', $defaults);

    $form['endrukk'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['general'] = [
      '#type' => 'details',
      '#title' => t('General'),
      '#collapsible' => TRUE,
      '#group'       => 'endrukk',
    ];

    // Send to email.
    $form['general']['endrukk_email_from'] = [
      '#type' => 'textfield',
      '#title' => t('From email'),
      '#default_value' => (\Drupal::state()->get('endrukk_email_from')) ? \Drupal::state()->get('endrukk_email_from') : '',
    ];

    // No reply email address.
    $form['general']['endrukk_customer_email_intro_text'] = [
      '#type' => 'text_format',
      '#title' => t('Customer email intro text'),
      '#default_value' => (\Drupal::state()->get('no_reply_email')['value']) ? \Drupal::state()->get('endrukk_customer_email_intro_text')['value'] : '',
      '#format' => $my_richtext_field['format'],
    ];

    // Email sender phone number.
    $form['general']['endrukk_customer_phone_number'] = [
      '#type' => 'tel',
      '#title' => t('Enquiries phone number'),
      '#default_value' => (\Drupal::state()->get('endrukk_customer_phone_number')) ? \Drupal::state()->get('endrukk_customer_phone_number') : '',
    ];

    // Standard VAT rate.
    $form['general']['endrukk_vat'] = [
      '#type' => 'number',
      '#title' => t('Standard VAT rate'),
      '#description' => t('Used on the extras selection page'),
      '#default_value' => (\Drupal::state()->get('endrukk_vat')) ? \Drupal::state()->get('endrukk_vat') : '',
      '#field_suffix' => ' %',
    ];

    // No reply email address.
    $form['general']['endrukk_untag_error_email'] = [
      '#type' => 'textfield',
      '#title' => t('Untagging error email address'),
      '#default_value' => (\Drupal::state()->get('endrukk_untag_error_email')) ? \Drupal::state()->get('endrukk_untag_error_email') : '',
    ];

    // Social links.
    $form['social'] = [
      '#type' => 'details',
      '#title' => 'Social links',
      '#collapsible' => TRUE,
      '#group'       => 'endrukk',
    ];

    // Facebook.
    $form['social']['endrukk_facebook_link'] = [
      '#type' => 'textfield',
      '#title' => t('Facebook URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_facebook_link')) ? \Drupal::state()->get('endrukk_facebook_link') : '',
    ];

    // Twitter.
    $form['social']['endrukk_twitter_link'] = [
      '#type' => 'textfield',
      '#title' => t('Twitter URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_twitter_link')) ? \Drupal::state()->get('endrukk_twitter_link') : '',
    ];

    // Vimeo.
    $form['social']['endrukk_vimeo_link'] = [
      '#type' => 'textfield',
      '#title' => t('Vimeo URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_vimeo_link')) ? \Drupal::state()->get('endrukk_vimeo_link') : '',
    ];

    // LinkedIn.
    $form['social']['endrukk_linkedin_link'] = [
      '#type' => 'textfield',
      '#title' => t('LinkedIn URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_linkedin_link')) ? \Drupal::state()->get('endrukk_linkedin_link') : '',
    ];

    // Instagram.
    $form['social']['endrukk_instagram_link'] = [
      '#type' => 'textfield',
      '#title' => t('Instagram URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_instagram_link')) ? \Drupal::state()->get('endrukk_instagram_link') : '',
    ];

    // YouTube.
    $form['social']['endrukk_youtube_link'] = [
      '#type' => 'textfield',
      '#title' => t('YouTube URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_youtube_link')) ? \Drupal::state()->get('endrukk_youtube_link') : '',
    ];

    // Google+.
    $form['social']['endrukk_google_plus_link'] = [
      '#type' => 'textfield',
      '#title' => t('Google+ URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_google_plus_link')) ? \Drupal::state()->get('endrukk_google_plus_link') : '',
    ];


    // ERP.
    $form['erp'] = [
      '#type' => 'details',
      '#title' => 'ERP connection',
      '#collapsible' => TRUE,
      '#group'       => 'endrukk',
    ];

    // ERP Username.
    $form['erp']['endrukk_erp_username'] = [
      '#type' => 'textfield',
      '#title' => t('Username'),
      '#default_value' => (\Drupal::state()->get('endrukk_erp_username')) ? \Drupal::state()->get('endrukk_erp_username') : '',
    ];

    // ERP Password.
    $form['erp']['endrukk_erp_password'] = [
      '#type' => 'textfield',
      '#title' => t('Password'),
      '#default_value' => (\Drupal::state()->get('endrukk_erp_password')) ? \Drupal::state()->get('endrukk_erp_password') : '',
    ];

    // ERP URL.
    $form['erp']['endrukk_erp_url'] = [
      '#type' => 'textfield',
      '#title' => t('URL'),
      '#default_value' => (\Drupal::state()->get('endrukk_erp_url')) ? \Drupal::state()->get('endrukk_erp_url') : '',
    ];

    // API key.
    $form['erp']['endrukk_erp_api_key'] = [
      '#type' => 'textfield',
      '#title' => t('API key'),
      '#default_value' => (\Drupal::state()->get('endrukk_erp_api_key')) ? \Drupal::state()->get('endrukk_erp_api_key') : '',
    ];

    $form['erp']['endrukk_erp_get_setup_title'] = [
      '#markup' => t('<h2 style="margin-top: 20px">Sync Centres, Rooms, Extras and Delegate packages from Centre Vision</h2>'),
    ];

    // ERP run GetSetup end point.
    $form['erp']['endrukk_erp_sync'] = [
      '#title' => $this->t('Sync data from ERP'),
      '#type' => 'link',
      '#prefix' => '<div class="se-pre-con"><span>Syncing data from CentreVision</span></div>',
      '#attributes' => ['class' => ['button'], 'style' => ['margin: 15px 0 0 0;']],
      '#url' => Url::fromRoute('endrukk.configure'),
    ];

    // Submit button.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_values = $form_state->getValues();
    foreach ($form_values as $key => $value) {
      \Drupal::state()->set($key, $value);
    }
  }

}
