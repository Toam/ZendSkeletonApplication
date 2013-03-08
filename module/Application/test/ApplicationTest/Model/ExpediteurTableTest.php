<?php
namespace ApplicationTest\Model;

use Application\Model\ExpediteurTable;
use Application\Model\Expediteur;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class ExpediteurTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllExpediteurs()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with()
        ->will($this->returnValue($resultSet));

        $expediteurTable = new ExpediteurTable($mockTableGateway);

        $this->assertSame($resultSet, $expediteurTable->fetchAll());
    }

    public function testCanRetrieveAnExpediteurByItsId()
    {
        $expediteur = new Expediteur();
        $expediteur->exchangeArray(array('id'     => 123,
            'first_name' => 'Prenom',
            'last_name'  => 'Nom'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Expediteur());
        $resultSet->initialize(array($expediteur));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with(array('id' => 123))
        ->will($this->returnValue($resultSet));

        $expediteurTable = new ExpediteurTable($mockTableGateway);

        $this->assertSame($expediteur, $expediteurTable->getExpediteur(123));
    }

    public function testCanDeleteAnExpediteurByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('delete')
        ->with(array('id' => 123));

        $expediteurTable = new ExpediteurTable($mockTableGateway);
        $expediteurTable->deleteExpediteur(123);
    }

    public function testSaveExpediteurWillInsertNewExpediteursIfTheyDontAlreadyHaveAnId()
    {
        $expediteurData = array('first_name' => 'Prenom', 'last_name' => 'Nom');
        $expediteur     = new Expediteur();
        $expediteur->exchangeArray($expediteurData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('insert')
        ->with($expediteurData);

        $expediteurTable = new ExpediteurTable($mockTableGateway);
        $expediteurTable->saveExpediteur($expediteur);
    }

    public function testSaveExpediteurWillUpdateExistingExpediteursIfTheyAlreadyHaveAnId()
    {
        $expediteurData = array('id' => 123, 'first_name' => 'Prenom', 'last_name' => 'Nom');
        $expediteur     = new Expediteur();
        $expediteur->exchangeArray($expediteurData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Expediteur());
        $resultSet->initialize(array($expediteur));

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

        $expediteurTable = new ExpediteurTable($mockTableGateway);
        $expediteurTable->saveExpediteur($expediteur);
    }

    public function testExceptionIsThrownWhenGettingNonexistentExpediteur()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Expediteur());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
        ->method('select')
        ->with(array('id' => 123))
        ->will($this->returnValue($resultSet));

        $expediteurTable = new ExpediteurTable($mockTableGateway);

        try
        {
            $expediteurTable->getExpediteur(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}