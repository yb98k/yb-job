<?php

/*
 * var $app  \Inhere\Console\Application
 * can config multiple configure
 */

//register namespace:site
$console->registerGroups('app\\controllers\\site', __DIR__ . '/../console/controllers/site');
