<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-1-10
 * Time: 下午5:38
 */

class ybServer
{
    protected $server;

    protected $allSwTask;

    protected static $root;

    const TIME_FORMAT = [
        'ms' => 1,
        's' => 1000,
        'm' => 60000,
        'H' => 3600000,
        'D' => 86400000
    ];

    const CRON_HEADER = '# * * * * * command' . PHP_EOL .
                        '# | | | | |    |' . PHP_EOL .
                        '# | | | | |    |' . PHP_EOL .
                        '# | | | | |    |_ _ _ _ 命令' . PHP_EOL .
                        '# | | | | |_ _ _ _ _ _ _  周' . PHP_EOL .
                        '# | | | |_ _ _ _ _ _ _ _  月' . PHP_EOL .
                        '# | | |_ _ _ _ _ _ _ _ _  日' . PHP_EOL .
                        '# | |_ _ _ _ _ _ _ _ _ _  时' . PHP_EOL .
                        '# |_ _ _ _ _ _ _ _ _ _ _  分' . PHP_EOL . PHP_EOL;

    public function __construct()
    {
        $config = require ( __DIR__ . '/../../config/srvConfig.php' );

        $this->server = new Swoole\Server($config['host'], $config['port'], SWOOLE_BASE, SWOOLE_SOCK_TCP);

        if(isset($config['setting'])) {
            $this->server->set($config['setting']);
        }

        self::$root = $config['root'] ?? '';

        $this->server->on('start', [$this, 'start']);
        $this->server->on('workerStart', [$this, 'workerStart']);
        $this->server->on('receive', [$this, 'receive']);
        $this->server->on('close', [$this, 'close']);

        $this->server->start();
    }

    public function start()
    {
        //send name to process, easy to make shell restart
        swoole_set_process_name('php_yb_job_server');
    }

    public function workerStart(Swoole\Server $server, int $workerId)
    {
        $coreCommand = rtrim(self::$root, '/') . '/ybTask';
        $tasks = include ( __DIR__ . '/../../config/task/handle.php' );

        if(isset($tasks['swoole'])) {
            foreach ($tasks['swoole'] as $task => $timeInfo) {
                $shellCommand = 'php ' . $coreCommand . ' '. $task;

                if($timeInfo['format'] == 'F') {
                    $timespan = (strtotime($timeInfo['timespan']) - time()) * 1000;

                    swoole_timer_after($timespan, function () use ($shellCommand) {
                        system($shellCommand);
                    });
                } elseif(isset(self::TIME_FORMAT[$timeInfo['format']])) {
                    $timespan = self::TIME_FORMAT[$timeInfo['format']] * $timeInfo['timespan'];

                    swoole_timer_tick($timespan, function(int $timerId) use ($shellCommand) {
                        system($shellCommand);
                    });
                }
            }
        }

        if(isset($tasks['crontab'])) {
            $ybCronFile = __DIR__ . '/../crontab/ybCrontab';
            system('crontab -l > ' . $ybCronFile);
            $allCron = file_get_contents($ybCronFile);

            $shellCommand = PHP_EOL;
            foreach ($tasks['crontab'] as $task => $command) {
                $tempCommand = $command . ' php ' . $coreCommand . ' '. $task;
                if(strpos($allCron, $tempCommand) === false) {
                    $shellCommand .= $tempCommand . PHP_EOL;
                }
            }

            file_put_contents($ybCronFile, $allCron . $shellCommand);
            system('crontab ' . $ybCronFile);
        }

        if(isset($tasks['nohup'])) {
            system('echo \'\' > '. __DIR__ . '/nohup.pid');
            foreach ($tasks['nohup'] as $task => $setting) {
                $shellCommand = 'nohup php ' . $coreCommand . ' '. $task;
                $shellCommand .= empty($setting['stdout']) ? ' 2>&1 & echo $! >> '. __DIR__ . '/nohup.pid' :
                    ' >> ' . (__DIR__  . '/../../logs/stdout/' . $setting['stdout']) .
                    ' 2>&1 & echo $! >> '. __DIR__ . '/nohup.pid';

                system($shellCommand);
            }
        }
    }

    public function receive(Swoole\Server $server, int $fd, int $reactorId, $data)
    {
        //todo link command
    }

    public function close(Swoole\Server $server, int $fd, int $reactorId)
    {
        echo 'client ' . $fd . ' closed' . PHP_EOL;
    }
}

$server = new ybServer();