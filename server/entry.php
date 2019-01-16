<?php
/**
 * User: yk
 * Date: 19-1-14
 * Time: 1:56 pm
 */

$extraCommand = getopt('p:')['p'] ?? '';

if($extraCommand == 'start') {
    $shell = __DIR__ . '/core/yb.sh';
    $stdout = __DIR__ . '/../logs/stdout/yb.log';

    $res = system('nohup sh ' . $shell . ' >> ' . $stdout . ' 2>&1 &');
    exit;
}

if($extraCommand == 'stop') {
    $shell = __DIR__ . '/core/ybStop.sh';
    $res = system('sh ' . $shell);
    exit;
}

//make flash
if($extraCommand == 'flash') {
    $filename = __DIR__ . '/core/nohup.pid';
    if(file_exists($filename)) {
        $fh = fopen($filename, 'r');

        while (!feof($fh)) {
            $pid = str_replace(PHP_EOL, '', fgets($fh));
            if(is_numeric($pid)) {
                system('kill -9 ' . $pid);
            }
        }

        fclose($fh);
        unlink($filename);
    }

    $command = 'sh ' . (__DIR__ . '/core/ybRestart.sh');
    echo system($command);
    exit;
}

