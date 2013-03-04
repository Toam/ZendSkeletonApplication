<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\User;
use Application\Form\UserForm;

class UserController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new UserForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);

                return $this->redirect()->toRoute('application/default', array('controller' => 'user'));
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $user_id = (int) $this->params()->fromRoute('id', 0);
        if (!$user_id) {
            return $this->redirect()->toRoute('application/default', array('controller' => 'user'), array(
                'action' => 'add'
            ));
        }
        $user = $this->getUserTable()->getUser($user_id);

        $form  = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Editer');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getUserTable()->saveUser($form->getData());

                return $this->redirect()->toRoute('application/default', array('controller' => 'user'));
            }
        }

        return array(
            'user_id' => $user_id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $user_id = (int) $this->params()->fromRoute('id', 0);
        if (!$user_id) {
            return $this->redirect()->toRoute('application/default', array('controller' => 'user'));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $user_id = (int) $request->getPost('user_id');
                $this->getUserTable()->deleteUser($user_id);
            }
            return $this->redirect()->toRoute('application/default', array('controller' => 'user'));
        }

        return array(
            'id'    => $user_id,
            'user' => $this->getUserTable()->getUser($user_id)
        );
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Application\Model\UserTable');
        }
        return $this->userTable;
    }
}