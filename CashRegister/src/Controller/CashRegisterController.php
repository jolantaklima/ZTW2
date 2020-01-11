<?php

namespace CashRegister\Controller;

use CashRegister\Model\CashRegisterTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CashRegisterController extends AbstractActionController {

    private $table;

    public function __construct(CashRegisterTable $table) {
        $this->table = $table;
    }

    public function indexAction() {
        /*return new ViewModel([
            'cashregister' => $this->table->fetchAll(),
        ]);*/

        $view = new ViewModel(array('cashregister' => $this->getCashRegisterTable()->fetchAll(),));
        $view->setTemplate("cashregister/cashregister/index.phtml");
        return $view;
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}