<?php

namespace CashRegister;

use Zend\Router\Http\Segment;
use CashRegister\Controller\CashRegisterController;
//use Zend\ServiceManager\Factory\InvokableFactory;

return [
    /* 'controllers' => [
        'factories' => [
            Controller\CashRegisterController::class => InvokableFactory::class,
        ],
    ], */
    'router' => [
        'routes' => [
            'cashregister' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/cashregister[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'CashRegister\Controller\CashRegisterController',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'cashregister' => __DIR__ . '/../view',
        ],
    ],
];