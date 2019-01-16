<?php
/**
 * User: yk
 * Date: 19-1-11
 * Time: 下午3:57 pm
 */

/*
 * var $capsule Illuminate\Database\Capsule\Manager
 * can config multiple configure
 */

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'port'      => 3306,
    'database'  => 'test',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => ''
], 'mssql_01');