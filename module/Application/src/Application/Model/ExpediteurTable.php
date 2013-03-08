<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class ExpediteurTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getExpediteur($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveExpediteur(Expediteur $expediteur)
    {
        $data = array(
            'first_name' => $expediteur->first_name,
            'last_name'  => $expediteur->last_name,
        );

        $id = (int)$expediteur->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getExpediteur($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteExpediteur($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}