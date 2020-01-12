<?php

namespace Cashregister;

//use Zend\Db\Adapter\Adapter;
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
                Model\CashregisterTable::class        => function ($container) {
                    $tableGateway = $container->get('Model\CashregisterTableGateway');

                    return new Model\CashregisterTable($tableGateway);
                },
                'Model\CashregisterTableGateway' => function ($container) {
                    $dbAdapter          = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Cashregister());

                    return new TableGateway('cashregister', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CashregisterController::class => function ($container) {
                    return new Controller\CashregisterController(
                        $container->get(Model\CashregisterTable::class)
                    );
                },
            ],
        ];
    }
}
