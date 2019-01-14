<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-1-14
 * Time: 下午1:45
 */

class ybAddClient
{
    protected $client;

    public function __construct($extraCommand)
    {
        $sendData = [];
        //get op info
        if($extraCommand == 'flash') {
            $sendData = [
                'op' => 'ybTaskFlash',
            ];
        }

        $config = require ( __DIR__ . '/../../config/srvConfig.php' );

        $this->client = new Swoole\Client(SWOOLE_SOCK_TCP);

        if(!$this->client->connect($config['host'], $config['port'], -1)) {
            throw new Exception('connect server failed, Error:' . $this->client->errCode);
        } else {
            $this->client->send(json_encode($sendData));

            echo $this->client->recv() . PHP_EOL;

            $this->client->close();
        }
    }

    protected static function getType()
    {
        echo 'please select script type:' . PHP_EOL;
        echo '     1、swoole；' . PHP_EOL;
        echo '     2、crontab；' . PHP_EOL;
        echo '     3、nohup；' . PHP_EOL;
        echo 'please select in 1/2/3: ';
        $type = (int)trim(fgets(STDIN));

        while(!in_array($type, [1,2,3])) {
            echo 'error type selected.' . PHP_EOL;
            echo 'please reselect script type:' . PHP_EOL;
            echo '*********1、swoole；*********' . PHP_EOL;
            echo '*********2、crontab；*********' . PHP_EOL;
            echo '*********3、nohup；*********' . PHP_EOL;
            echo 'please select in 1/2/3: ';
            $type = (int)trim(fgets(STDIN));
        }

        return $type;
    }

    protected static function getScript()
    {
        echo 'please select script type:' . PHP_EOL;
        echo '*********1、swoole；*********' . PHP_EOL;
        echo '*********2、crontab；*********' . PHP_EOL;
        echo '*********3、nohup；*********' . PHP_EOL;
        echo 'please select in 1/2/3: ';
        $type = (int)trim(fgets(STDIN));

        while(!in_array($type, [1,2,3])) {
            echo 'error type selected.' . PHP_EOL;
            echo 'please reselect script type:' . PHP_EOL;
            echo '*********1、swoole；*********' . PHP_EOL;
            echo '*********2、crontab；*********' . PHP_EOL;
            echo '*********3、nohup；*********' . PHP_EOL;
            echo 'please select in 1/2/3: ';
            $type = (int)trim(fgets(STDIN));
        }
    }
}