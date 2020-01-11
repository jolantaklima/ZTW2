<?php

namespace CashRegister;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\CashRegisterTable::class => function($container) {
                    $tableGateway = $container->get('Model\CashRegisterTableGateway');
                    return new Model\CashRegisterTable($tableGateway);
                },
                'Model\CashRegisterTableGateway' => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\CashRegister());
                    return new TableGateway('cashregister', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];

        /* return [
            'factories' => [
                Model\CashRegisterTable::class        => function ($container) {
                    $tableGateway = $container->get('Model\CashRegisterTableGateway');
                    return new Model\CashRegisterTable($tableGateway);
                },
                'Model\CashRegisterTableGateway' => function ($container) {
                    $dbAdapter          = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];*/
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CashRegisterController::class => function($container) {
                    return new Controller\CashRegisterController(
                        $container->get(Model\CashRegisterTable::class)
                    );
                },
            ],
        ];
    }
}