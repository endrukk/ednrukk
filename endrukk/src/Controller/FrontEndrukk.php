<?php

namespace Drupal\endrukk\Controller;

use Drupal\Core\Controller\ControllerBase;


class FrontEndrukk  extends ControllerBase {

    public function content(){
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello, World!'),
          ];
    }

}