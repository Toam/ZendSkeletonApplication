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
        $this->setAttribute('class', 'form-horizontal');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));
        $this->add(array(
            'name' => 'adress1',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'adress2',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'zipcode',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Code Postal',
            ),
        ));
        $this->add(array(
            'name' => 'city',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'City',
            ),
        ));
        $this->add(array(
            'name' => 'country',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Pays',
            ),
        ));
        $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Téléphone',
            ),
        ));
        $this->add(array(
            'name' => 'cell',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Portable',
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