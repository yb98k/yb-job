<?php
/**
 * User: yk
 * Date: 19-1-11
 * Time: 5:33 pm
 */

/*
 * var $capsule Illuminate\Database\Capsule\Manager
 * can config multiple configure
 */

$capsule->addConnection([
    'driver' => 'sqlsrv',
    'host' => '127.0.0.1',
    'port' => 1433,
    'database' => 'dbName',
    'username' => 'admin',
    'password' => '',
    'prefix' => '',
], 'mssql_01');