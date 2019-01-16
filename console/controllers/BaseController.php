<?php
/**
 * User: yk
 * Date: 19-1-10
 * Time: 4:32 pm
 */

namespace app\controllers;

use Inhere\Console\Controller;

class BaseController extends Controller
{
    /**
     * write log info
     * @param string $category
     * @param null $content
     */
    protected function info($category = 'app', $content = null)
    {
        $logTxt = '[Title]:' . $category . '\r\n';
        $logTxt .= '[content]:' . (string)$content . '\r\n';

        $filename = date('Ymd') . '.log';
        $path = __DIR__ . '/../logs/' . date('Ym') . '/' ;

        swoole_async_writefile($path . $filename, $logTxt, function () {
            //todo yourself something
            //...
        }, FILE_APPEND);
    }
}