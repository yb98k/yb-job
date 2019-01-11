<?php
/**
 * User: yk
 * Date: 19-1-10
 * Time: 6:10 pm
 */

return [
    'swoole' => [
        //format: --support [
        //      'ms', -- 按照毫秒执行
        //      's',  -- 按照秒执行
        //      'm',  -- 按照分钟执行
        //      'H',  -- 按照小时执行
        //      'D',  -- 按照天执行
        //      'M',  -- 按照月执行
        //      'Y'   -- 按照年执行
        //      'F'   -- 按照固定时间执行
        // ]
        //timespan: -- support [
        //      -- 固定大于零的数字 1、2、3...
        //      -- 固定的时间字符串 '2019-01-01'、'2019-01-01 08:00:00'
        //]
        //taskWay: --support [ 'crontab', 'swoole' ]
        'site:test' => ['format' => '', 'timespan' => '', 'taskWay' => 'crontab']
    ],
    'crontab' => [
        'demo' => '*/1 * * * *'
    ],
    'nohup' => [
        // stdout: -- 输出重定向文件名称 ！！！注意：只需要给出名称，文件都会默认存放在路径logs/stdout中
        'demo' => ['stdout' => '']
    ]
];
