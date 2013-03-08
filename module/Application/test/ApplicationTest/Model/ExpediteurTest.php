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
        $this->assertNull($expediteur->first_name, '"first_name" should initially be null');
        $this->assertNull($expediteur->last_name, '"last_name" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $expediteur = new Expediteur();
        $data  = array('first_name' => 'Prenom',
                       'id'     => 123,
                       'last_name'  => 'Nom');

        $expediteur->exchangeArray($data);

        $this->assertSame($data['id'], $expediteur->id, '"id" was not set correctly');
        $this->assertSame($data['first_name'], $expediteur->first_name, '"first_name" was not set correctly');
        $this->assertSame($data['last_name'], $expediteur->last_name, '"last_name" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $expediteur = new Expediteur();

        $expediteur->exchangeArray(array('first_name' => 'Prenom',
                                    'id'     => 123,
                                    'last_name'  => 'Nom'));
        $expediteur->exchangeArray(array());

        $this->assertNull($expediteur->id, '"id" should have defaulted to null');
        $this->assertNull($expediteur->first_name, '"first_name" should have defaulted to null');
        $this->assertNull($expediteur->last_name, '"last_name" should have defaulted to null');
    }
}