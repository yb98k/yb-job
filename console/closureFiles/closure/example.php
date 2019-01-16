<?php
/**
 * User: yk
 * Date: 19-1-10
 * Time: 2:58 pm
 */

$console->command('demo', function (\Inhere\Console\IO\Input $in, \Inhere\Console\IO\Output $out) {
    $cmd = $in->getCommand();

    $out->info('hello, this is a test command: ' . $cmd);
}, 'this is message for the command');