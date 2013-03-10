<?php
namespace ApplicationTest\Model;

use Application\Model\Expediteur;
use PHPUnit_Framework_TestCase;

class ExpediteurTest extends PHPUnit_Framework_TestCase
{
    public function testExpediteurInitialState()
    {
        $expediteur = new Expediteur();

        $this->assertNull($expediteur->id, '"id" should initially be null');
        $this->assertNull($expediteur->name, '"name" should initially be null');
        $this->assertNull($expediteur->adress1, '"adress1" should initially be null');
        $this->assertNull($expediteur->adress2, '"adress2" should initially be null');
        $this->assertNull($expediteur->zipcode, '"zipcode" should initially be null');
        $this->assertNull($expediteur->city, '"city" should initially be null');
        $this->assertNull($expediteur->country, '"country" should initially be null');
        $this->assertNull($expediteur->phone, '"phone" should initially be null');
        $this->assertNull($expediteur->cell, '"cell" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $expediteur = new Expediteur();
        $data  = array('id'     => 123,
                        'name' => 'Prénom NOM',
                        'adress1' => 'adresse',
                        'adress2' => 'adresse suite',
                        'zipcode' => '12345',
                        'city' => 'Ville',
                        'country' => 'Pays',
                        'phone' => '0123456789',
                        'cell' => '0123456789');

        $expediteur->exchangeArray($data);

        $this->assertSame($data['id'], $expediteur->id, '"id" was not set correctly');
        $this->assertSame($data['name'], $expediteur->name, '"name" was not set correctly');
        $this->assertSame($data['adress1'], $expediteur->adress1, '"adress1" was not set correctly');
        $this->assertSame($data['adress2'], $expediteur->adress2, '"adress2" was not set correctly');
        $this->assertSame($data['zipcode'], $expediteur->zipcode, '"zipcode" was not set correctly');
        $this->assertSame($data['city'], $expediteur->city, '"city" was not set correctly');
        $this->assertSame($data['country'], $expediteur->country, '"country" was not set correctly');
        $this->assertSame($data['phone'], $expediteur->phone, '"phone" was not set correctly');
        $this->assertSame($data['cell'], $expediteur->cell, '"cell" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $expediteur = new Expediteur();

        $expediteur->exchangeArray(array('id'     => 123,
                                            'name' => 'Prénom NOM',
                                            'adress1' => 'adresse',
                                            'adress2' => 'adresse suite',
                                            'zipcode' => '12345',
                                            'city' => 'Ville',
                                            'country' => 'Pays',
                                            'phone' => '0123456789',
                                            'cell' => '0123456789'));
        $expediteur->exchangeArray(array());

        $this->assertNull($expediteur->id, '"id" should have defaulted to null');
        $this->assertNull($expediteur->name, '"name" should have defaulted to null');
        $this->assertNull($expediteur->adress1, '"adress1" should have defaulted to null');
        $this->assertNull($expediteur->adress2, '"adress2" should have defaulted to null');
        $this->assertNull($expediteur->zipcode, '"zipcode" should have defaulted to null');
        $this->assertNull($expediteur->city, '"city" should have defaulted to null');
        $this->assertNull($expediteur->country, '"country" should have defaulted to null');
        $this->assertNull($expediteur->phone, '"phone" should have defaulted to null');
        $this->assertNull($expediteur->cell, '"cell" should have defaulted to null');
    }
}