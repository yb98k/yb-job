<?php
/**
 * User: yk
 * Date: 19-1-11
 * Time: 5:11 pm
 */

/*
 * var $capsule Illuminate\Database\Capsule\Manager
 * can config multiple configure
 */

$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => ':memory:',
    'prefix' => '',
], 'sqlite_01');