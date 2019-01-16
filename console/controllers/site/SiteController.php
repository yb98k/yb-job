<?php
/**
 * User: yk
 * Date: 19-1-10
 * Time: 3:21 pm
 */

namespace app\controllers\site;

use app\controllers\BaseController;

class SiteController extends BaseController
{
    protected static $name = 'site';

    protected static $description = 'this is site example';

    /**
     * this is test command
     * example php ybTask site:test --param='hello,this param'
     * use getOpt() / boolOpt() /
     */
    public function testCommand()
    {
        var_dump(self::annotationVars());

        $this->write('hello,this is site!');
        //get param
        print_r($this->getInput()->getOpts());
        $this->write($this->getOpt('param'));
    }
}