<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Expediteur;
use Application\Form\ExpediteurForm;

class ExpediteurController extends AbstractActionController
{
    protected $expediteurTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'expediteurs' => $this->getExpediteurTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ExpediteurForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $expediteur = new Expediteur();
            $form->setInputFilter($expediteur->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $expediteur->exchangeArray($form->getData());
                $this->getExpediteurTable()->saveExpediteur($expediteur);

                return $this->redirect()->toRoute('application/default', array('controller' => 'expediteur'));
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('application/default', array('controller' => 'expediteur'), array(
                'action' => 'add'
            ));
        }
        $expediteur = $this->getExpediteurTable()->getExpediteur($id);

        $form  = new ExpediteurForm();
        $form->bind($expediteur);
        $form->get('submit')->setAttribute('value', 'Editer');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($expediteur->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getExpediteurTable()->saveExpediteur($form->getData());

                return $this->redirect()->toRoute('application/default', array('controller' => 'expediteur'));
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
            return $this->redirect()->toRoute('application/default', array('controller' => 'expediteur'));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->getExpediteurTable()->deleteExpediteur($id);
            }

            return $this->redirect()->toRoute('application/default', array('controller' => 'expediteur'));
        }

        return array(
            'id'    => $id,
            'expediteur' => $this->getExpediteurTable()->getExpediteur($id)
        );
    }

    public function getExpediteurTable()
    {
        if (!$this->expediteurTable) {
            $sm = $this->getServiceLocator();
            $this->expediteurTable = $sm->get('Application\Model\ExpediteurTable');
        }
        return $this->expediteurTable;
    }
}