<?php

namespace Cashregister;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'cashregister' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/cashregister[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\CashregisterController::class,
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