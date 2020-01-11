<?php

namespace CashRegister\Model;

class CashRegister{
    public $id;
    public $place;
    public $brand;
    public $model;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->place = !empty($data['place']) ? $data['place'] : null;
        $this->brand  = !empty($data['brand']) ? $data['brand'] : null;
        $this->model  = !empty($data['model']) ? $data['model'] : null;
    }
}