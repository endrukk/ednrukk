<?php

namespace Drupal\endrukk\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;


/**
 * Provides a 'Hello' Block for endrukk module.
 *
 * @Block(
 *   id = "hello_endrukk"
 * )
 */
class HelloEndrukk extends BlockBase implements BlockPluginInterface {

  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['endrukk_front_block_text'])) {
      $text = $config['endrukk_front_block_text'];
    }
    else {
      $text = $this->t('to no one');
    }

    if (!empty($config['endrukk_front_block_image'])) {
      $image = $config['endrukk_front_block_image'];
    }
    else {
        $image = false;
    }

    return [
      '#theme' => 'index',
      '#endrukk_front_block_text' => $text,
      '#endrukk_front_block_image' => $image
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['endrukk_front_block_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Intro text'),
      '#description' => $this->t('Intro text of the block'),
      '#default_value' => isset($config['endrukk_front_block_text']) ? $config['endrukk_front_block_text'] : '',
    ];

    $form['endrukk_front_block_image'] = [
      '#type' => 'managed_file',
      '#title' => t('Image with preview'),
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_size' => [25600000],
      ],
      '#theme' => 'image_widget',
      '#preview_image_style' => 'large',
      '#upload_location' => 'public://uploads/endrukk',
      '#required' => TRUE,
    ];

    $form['endrukk_image_preview'] = [
      '#markup' => isset($config['endrukk_front_block_image']) ? '<img src="' . $config['endrukk_front_block_image'] . '" />' : '<p>No uploaded image.</p>',
    ];

    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();

    if ($values['endrukk_front_block_image']) {
    
      $oNewFile = File::load(reset($values['endrukk_front_block_image']));
      $oNewFile->setPermanent();
      $this->configuration['endrukk_front_block_image'] = $oNewFile->url();
    
    }
    $this->configuration['endrukk_front_block_text'] = $values['endrukk_front_block_text'];
  }

}