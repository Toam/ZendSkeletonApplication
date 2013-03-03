<?php
namespace ApplicationTest\Model;

use Application\Model\User;
use PHPUnit_Framework_TestCase;

class UserTest extends PHPUnit_Framework_TestCase
{
    public function testUserInitialState()
    {
        $user = new User();

        $this->assertNull($user->id, '"id" should initially be null');
        $this->assertNull($user->username, '"username" should initially be null');
        $this->assertNull($user->email, '"email" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $user = new User();
        $data  = array('id'     => 123,
                       'username' => 'NomUtilisateur',
                       'email'  => 'email@adresse.com');

        $user->exchangeArray($data);

        $this->assertSame($data['id'], $user->id, '"id" was not set correctly');
        $this->assertSame($data['username'], $user->username, '"username" was not set correctly');
        $this->assertSame($data['email'], $user->email, '"email" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $user = new User();

        $user->exchangeArray(array('id'     => 123,
                                   'username' => 'NomUtilisateur',
                                   'email'  => 'email@adresse.com'));
        $user->exchangeArray(array());

        $this->assertNull($user->id, '"id" should have defaulted to null');
        $this->assertNull($user->username, '"username" should have defaulted to null');
        $this->assertNull($user->email, '"email" should have defaulted to null');
    }
}