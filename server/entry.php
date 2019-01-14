<?php
/**
 * User: yk
 * Date: 19-1-14
 * Time: 1:56 pm
 */

$extraCommand = getopt('p:')['p'] ?? '';

if($extraCommand == 'start') {
    $shell = __DIR__ . '/core/yb.sh';

    $res = system('nohup sh ' . $shell . ' 2>&1 &');
    var_dump($res);
    exit;
}

if($extraCommand == 'stop') {
    $startShell = __DIR__ . '/core/yb.sh';
    $shell = __DIR__ . '/core/ybStop.sh';
    $shellContent = file_get_contents($startShell);
    $res = system('sh ' . $shell);
    unlink($startShell);
    sleep(6);
    if(!$res) {
        echo 'Stop Success';
    }
    file_put_contents($startShell, $shellContent);
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
                system('sudo kill -9 ' . $pid);
            }
        }

        fclose($fh);
        unlink($filename);
    }

    $command = 'sh ' . (__DIR__ . '/core/ybRestart.sh');
    echo system($command);
    exit;
}

