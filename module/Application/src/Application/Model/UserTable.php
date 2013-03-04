<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
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

    public function getUser($user_id)
    {
        $user_id  = (int) $user_id;
        $rowset = $this->tableGateway->select(array('user_id' => $user_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $user_id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'username' => $user->username,
            'email'  => $user->email,
        );

        $user_id = (int)$user->user_id;
        if ($user_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($user_id)) {
                $this->tableGateway->update($data, array('user_id' => $user_id));
            } else {
                throw new \Exception('Form user_id does not exist');
            }
        }
    }

    public function deleteUser($user_id)
    {
        $this->tableGateway->delete(array('user_id' => $user_id));
    }
}