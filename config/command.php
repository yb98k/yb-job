<?php

/*
 * var $app  \Inhere\Console\Application
 * can config multiple configure
 */

//register namespace:test
$console->registerCommands('app\\commands\\test', __DIR__ . '/../console/commands/test');