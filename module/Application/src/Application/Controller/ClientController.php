<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Client;
use Application\Form\ClientForm;

class ClientController extends AbstractActionController
{
    protected $clientTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'clients' => $this->getClientTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ClientForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $client = new Client();
            $form->setInputFilter($client->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $client->exchangeArray($form->getData());
                $this->getClientTable()->saveClient($client);

                return $this->redirect()->toRoute('client');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('client', array(
                'action' => 'add'
            ));
        }
        $client = $this->getClientTable()->getClient($id);

        $form  = new ClientForm();
        $form->bind($client);
        $form->get('submit')->setAttribute('value', 'Editer');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($client->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getClientTable()->saveClient($form->getData());

                return $this->redirect()->toRoute('client');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('client');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->getClientTable()->deleteClient($id);
            }

            return $this->redirect()->toRoute('client');
        }

        return array(
            'id'    => $id,
            'client' => $this->getClientTable()->getClient($id)
        );
    }

    public function getClientTable()
    {
        if (!$this->clientTable) {
            $sm = $this->getServiceLocator();
            $this->clientTable = $sm->get('Application\Model\ClientTable');
        }
        return $this->clientTable;
    }
}