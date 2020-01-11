<?php

namespace CashRegister\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class CashRegisterTable{

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(){
        return $this->tableGateway->select();
    }

    public function getCashRegister($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveCashRegister(CashRegister $cashregister){
        $data = [
            'place' => $cashregister->place,
            'brand' => $cashregister->brand,
            'model' => $cashregister->model,
        ];

        $id = (int) $cashregister->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getCashRegister($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update cashregister with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteCashRegister($id){
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}