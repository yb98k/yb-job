# yb-job
a php script framework.

This framework support MC(model and controller)/Command/Closure.

You can register yourself component in "/bootstrap/app.php".Next,you can use $app mount component to coding;  

[1] Installation tutorial : 

1、clone this project:
```
$ git clone xxxxxxxxxxxxxxxxxxxx
```

2、cd root path:
```
$ cd yb-job
```

3、init project:
```
$ php init
```

Go here, this project is init.

[2] Here are some usages:

(1)、View all existing scripts:
```
$ php ybTask list
```
or
```
$ php ybTask
```
(2)、Script service operation:

start:
```
$ php ybTask -p start
```  
stop:
```
$ php ybTask -p stop
```
flash:
```
$ php ybTask -p flash
```
Tips:
 
The flash operation is very important! 

When you add the script configuration,You need to perform it;

[3] Simple example:

1、use closure(/console/closureFiles/closure/example.php):
```
$console->command('demo', function (\Inhere\Console\IO\Input $in, \Inhere\Console\IO\Output $out) {
    $cmd = $in->getCommand();

    $out->info('hello, this is a test command: ' . $cmd);
}, 'this is message for the command');
```
2、use Command(/console/commands/test/ExampleCommand.php):
```
class ExampleCommand extends Command
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
```
3、use controller(/console/controllers/site/SiteController.php):
```
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
```
[4] Configuring a new script:

add a new script to "/config/task/handle.php";

you can choose the mode of swoole/crontab/nohup;

the mode of swoole can support millisecond; 


[5] deep study:

console: https://github.com/inhere/php-console

swoole:www.swoole.com