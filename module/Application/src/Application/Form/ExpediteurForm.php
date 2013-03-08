<?php
namespace Application\Form;

use Zend\Form\Form;

class ExpediteurForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('expediteur');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'first_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Prénom',
            ),
        ));
        $this->add(array(
            'name' => 'last_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Valider',
                'id' => 'submitbutton',
            ),
        ));
    }
}