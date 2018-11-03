<?php

namespace \Drupal\endrukk\Contorller;

use Drupal\Core\Block\BlockBase;
use Drupal\block_content\BlockContentInterface;

class BlockController extends BlockBase implements BlockContentInterface{

  public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['hello_endrukk'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Intro text'),
      '#description' => $this->t('The text, you want people to payy for your meeting rooms.'),
      '#default_value' => isset($config['hello_block_name']) ? $config['hello_block_name'] : '',
    ];

    return $form;
  }

}