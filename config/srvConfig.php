<?php
/**
 * User: yk
 * Date: 19-1-10
 * Time: 5:39 pm
 */

return [
    'host' => '127.0.0.0',
    'port' => 9501,
    'setting' => [
        'worker_num' => 4,
        'daemonize' => false, //是否以后台进程运行
        'backlog' => 128,
    ]
];