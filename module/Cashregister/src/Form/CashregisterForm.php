<?php

namespace Cashregister\Form;

use Zend\Form\Form;

class CashregisterForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('cashregister');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name'    => 'place',
            'type'    => 'text',
            'options' => [
                'label' => 'Place',
            ],
        ]);
        $this->add([
            'name'    => 'brand',
            'type'    => 'text',
            'options' => [
                'label' => 'Brand',
            ],
        ]);
        $this->add([
            'name'    => 'model',
            'type'    => 'text',
            'options' => [
                'label' => 'Model',
            ],
        ]);
        $this->add([
            'name'       => 'submit',
            'type'       => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}