<?php
/**
 * User: yk
 * Date: 19-1-15
 * Time: 1:57 pm
 */

return [
    'component' => [
        'redis' => [
            'class' => '\Atzcl\Redis',
            'config' => [
                'host' => '127.0.0.1',
                'port' => 6379,
                'prefix' => 'yb_'
            ]
        ],
        'fileCache' => [
            'class' => 'Symfony\Component\Cache\Adapter\FilesystemAdapter'
        ],
    ],
];

