<?php

namespace Cashregister\Controller;

use Cashregister\Form\CashregisterForm;
use Cashregister\Model\Cashregister;
use Cashregister\Model\CashregisterTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CashregisterController extends AbstractActionController
{
    private $table;

    public function __construct(CashregisterTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        // Grab the paginator from the CashregisterTable:
        $paginator = $this->table->fetchAll(true);

        // Set the current page to what has been passed in query string,
        // or to 1 if none is set, or the page is invalid:
        $page = (int) $this->params()->fromQuery('page', 1);
        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);

        // Set the number of items per page to 10:
        $paginator->setItemCountPerPage(10);

        return new ViewModel(['paginator' => $paginator]);
    }

    public function addAction()
    {
        $form = new CashregisterForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $cashregister = new Cashregister();
        $form->setInputFilter($cashregister->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $cashregister->exchangeArray($form->getData());
        $this->table->saveCashregister($cashregister);

        return $this->redirect()->toRoute('cashregister');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('cashregister', ['action' => 'add']);
        }

        // Retrieve the cashregister with the specified id. Doing so raises
        // an exception if the cashregister is not found, which should result
        // in redirecting to the landing page.
        try {
            $cashregister = $this->table->getCashregister($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('cashregister', ['action' => 'index']);
        }

        $form = new CashregisterForm();
        $form->bind($cashregister);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request  = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($cashregister->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        $this->table->saveCashregister($cashregister);

        // Redirect to cashregister list
        return $this->redirect()->toRoute('cashregister', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cashregister');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteCashregister($id);
            }

            // Redirect to list of cashregisters
            return $this->redirect()->toRoute('cashregister');
        }

        return [
            'id'    => $id,
            'cashregister' => $this->table->getCashregister($id),
        ];
    }
}
