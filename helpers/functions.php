<?php
/**
 * User: yk
 * Date: 19-1-10
 * Time: 5:07 pm
 */

if(!function_exists('outError')) {
    function outError(\Exception $ex)
    {
//        $errorMsg = '[code] ' . $ex->getCode() . PHP_EOL;
        $errorMsg = '[error] ' . $ex->getMessage() . PHP_EOL;
        $errorMsg .= '[pos] ' . $ex->getFile() . ' on line ' . $ex->getLine() . PHP_EOL;
//        $errorMsg .= '[previous] ' . var_export($ex->getPrevious(), true) . PHP_EOL;
        $errorMsg .= '[Trace] ' . $ex->getTraceAsString() . PHP_EOL;

        return $errorMsg;
    }
}