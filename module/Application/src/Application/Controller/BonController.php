<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Bon;
use Application\Form\BonForm;

class BonController extends AbstractActionController
{
    protected $bonTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'bons' => $this->getBonTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new BonForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $bon = new Bon();
            $form->setInputFilter($bon->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $bon->exchangeArray($form->getData());
                $this->getBonTable()->saveBon($bon);

                return $this->redirect()->toRoute('application/default', array('controller' => 'bon'));
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('application/default', array('controller' => 'bon'), array(
                'action' => 'add'
            ));
        }
        $bon = $this->getBonTable()->getBon($id);

        $form  = new BonForm();
        $form->bind($bon);
        $form->get('submit')->setAttribute('value', 'Editer');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($bon->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBonTable()->saveBon($form->getData());

                return $this->redirect()->toRoute('application/default', array('controller' => 'bon'));
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
            return $this->redirect()->toRoute('application/default', array('controller' => 'bon'));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->getBonTable()->deleteBon($id);
            }

            return $this->redirect()->toRoute('application/default', array('controller' => 'bon'));
        }

        return array(
            'id'    => $id,
            'bon' => $this->getBonTable()->getBon($id)
        );
    }

    public function getBonTable()
    {
        if (!$this->bonTable) {
            $sm = $this->getServiceLocator();
            $this->bonTable = $sm->get('Application\Model\BonTable');
        }
        return $this->bonTable;
    }
}