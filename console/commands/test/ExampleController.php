<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-1-10
 * Time: 下午4:52
 */
namespace app\commands\test;

use Inhere\Console\Command;
use Inhere\Console\IO\Input;
use Inhere\Console\IO\Output;

class ExampleController extends Command
{
    protected static $name = 'example';

    protected static $description = 'this is test example';

    /**
     * do execute command
     * example php ybTask example --param='hello,this param'
     * @param  Input $input
     * @param  Output $output
     * @return int|mixed
     */
    protected function execute($input, $output)
    {
        // TODO: Implement execute() method.

        $output->write('hello, this in example command');
        //get param
        print_r($input->getOpts());
        $this->write($input->getOpt('param'));
    }
}