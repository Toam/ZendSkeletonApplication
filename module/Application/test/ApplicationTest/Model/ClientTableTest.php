<?php
namespace ApplicationTest\Model;

use Application\Model\ClientTable;
use Application\Model\Client;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class ClientTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllClients()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with()
        ->will($this->returnValue($resultSet));

        $clientTable = new ClientTable($mockTableGateway);

        $this->assertSame($resultSet, $clientTable->fetchAll());
    }

    public function testCanRetrieveAnClientByItsId()
    {
        $client = new Client();
        $client->exchangeArray(array('id'     => 123,
            'first_name' => 'Prenom',
            'last_name'  => 'Nom'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Client());
        $resultSet->initialize(array($client));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with(array('id' => 123))
        ->will($this->returnValue($resultSet));

        $clientTable = new ClientTable($mockTableGateway);

        $this->assertSame($client, $clientTable->getClient(123));
    }

    public function testCanDeleteAnClientByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('delete')
        ->with(array('id' => 123));

        $clientTable = new ClientTable($mockTableGateway);
        $clientTable->deleteClient(123);
    }

    public function testSaveClientWillInsertNewClientsIfTheyDontAlreadyHaveAnId()
    {
        $clientData = array('first_name' => 'Prenom', 'last_name' => 'Nom');
        $client     = new Client();
        $client->exchangeArray($clientData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('insert')
        ->with($clientData);

        $clientTable = new ClientTable($mockTableGateway);
        $clientTable->saveClient($client);
    }

    public function testSaveClientWillUpdateExistingClientsIfTheyAlreadyHaveAnId()
    {
        $clientData = array('id' => 123, 'first_name' => 'Prenom', 'last_name' => 'Nom');
        $client     = new Client();
        $client->exchangeArray($clientData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Client());
        $resultSet->initialize(array($client));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
           array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with(array('id' => 123))
        ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
        ->method('update')
        ->with(array('first_name' => 'Prenom', 'last_name' => 'Nom'),
            array('id' => 123));

        $clientTable = new ClientTable($mockTableGateway);
        $clientTable->saveClient($client);
    }

    public function testExceptionIsThrownWhenGettingNonexistentClient()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Client());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with(array('id' => 123))
        ->will($this->returnValue($resultSet));

        $clientTable = new ClientTable($mockTableGateway);

        try
        {
            $clientTable->getClient(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}