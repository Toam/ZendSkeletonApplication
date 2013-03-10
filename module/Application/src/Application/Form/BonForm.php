<?php
namespace Application\Form;

use Zend\Form\Form;

class BonForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('bon');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'id_expediteur',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));
        $this->add(array(
            'name' => 'number',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Bon N°',
            ),
        ));
        $this->add(array(
            'name' => 'date',
            'attributes' => array(
                'type'  => 'date',
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'mode',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Mode',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_adress1',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_adress2',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_zipcode',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Code Postal',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_city',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'City',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_country',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Pays',
            ),
        ));
        $this->add(array(
            'name' => 'destinataire_phone',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Téléphone',
            ),
        ));
        $this->add(array(
            'name' => 'ligne1_quantity',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));
        $this->add(array(
            'name' => 'ligne1_label',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));
        $this->add(array(
            'name' => 'ligne1_size',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));
        $this->add(array(
            'name' => 'ligne1_price',
            'attributes' => array(
                'type'  => 'text',
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