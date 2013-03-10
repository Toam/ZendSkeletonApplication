<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class BonTable
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

    public function getBon($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveBon(Bon $bon)
    {
        $data = array(
            'id_expediteur' => $bon->id_expediteur,
            'number' => $bon->number,
            'date' => $bon->date,
            'mode' => $bon->mode,
            'destinataire_name' => $bon->name,
            'destinataire_adress1' => $bon->adress1,
            'destinataire_adress2' => $bon->adress2,
            'destinataire_zipcode' => $bon->zipcode,
            'destinataire_city' => $bon->city,
            'destinataire_country' => $bon->country,
            'destinataire_phone' => $bon->phone,
            'ligne1_quantity' => $bon->phone,
            'ligne1_label' => $bon->phone,
            'ligne1_size' => $bon->phone,
            'ligne1_price' => $bon->phone,
        );

        $id = (int)$bon->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBon($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteBon($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}