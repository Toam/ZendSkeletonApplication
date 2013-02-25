<?php
namespace ApplicationTest\Model;

use Application\Model\Client;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    public function testClientInitialState()
    {
        $client = new Client();

        $this->assertNull($client->id, '"id" should initially be null');
        $this->assertNull($client->first_name, '"first_name" should initially be null');
        $this->assertNull($client->last_name, '"last_name" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $client = new Client();
        $data  = array('first_name' => 'Prenom',
                       'id'     => 123,
                       'last_name'  => 'Nom');

        $client->exchangeArray($data);

        $this->assertSame($data['id'], $client->id, '"id" was not set correctly');
        $this->assertSame($data['first_name'], $client->first_name, '"first_name" was not set correctly');
        $this->assertSame($data['last_name'], $client->last_name, '"last_name" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $client = new Client();

        $client->exchangeArray(array('first_name' => 'Prenom',
                                    'id'     => 123,
                                    'last_name'  => 'Nom'));
        $client->exchangeArray(array());

        $this->assertNull($client->id, '"id" should have defaulted to null');
        $this->assertNull($client->first_name, '"first_name" should have defaulted to null');
        $this->assertNull($client->last_name, '"last_name" should have defaulted to null');
    }
}