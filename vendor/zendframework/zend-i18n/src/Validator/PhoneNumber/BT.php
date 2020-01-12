<?php
/**
 * @see       https://github.com/zendframework/zend-i18n for the canonical source repository
 * @copyright Copyright (c) 2005-2019 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-i18n/blob/master/LICENSE.md New BSD License
 */

return [
    'code' => '975',
    'patterns' => [
        'national' => [
            'general' => '/^[1-8]\\d{6,7}$/',
            'fixed' => '/^(?:2[3-6]|[34][5-7]|5[236]|6[2-46]|7[246]|8[2-4])\\d{5}$/',
            'mobile' => '/^[17]7\\d{6}$/',
            'emergency' => '/^11[023]$/',
        ],
        'possible' => [
            'general' => '/^\\d{6,8}$/',
            'fixed' => '/^\\d{6,7}$/',
            'mobile' => '/^\\d{8}$/',
            'emergency' => '/^\\d{3}$/',
        ],
    ],
];