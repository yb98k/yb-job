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

    public function __construct()
    {
        $config = require ( __DIR__ . '/../../config/srvConfig.php' );

        $this->server = new Swoole\Server($config['host'], $config['port'], SWOOLE_BASE, SWOOLE_SOCK_TCP);

        if(isset($config['setting'])) {
            $this->server->set($config['setting']);
        }

        $this->server->on('workerStart', [$this, 'workerStart']);
        $this->server->on('receive', [$this, 'receive']);
        $this->server->on('close', [$this, 'close']);
    }

    public function workerStart(Swoole\Server $server, int $workerId)
    {
        swoole_timer_tick(1000, function () {
            echo '111'.PHP_EOL;
        });
    }

    public function receive(Swoole\Server $server, int $fd, int $reactorId, $data)
    {

    }

    public function close(Swoole\Server $server, int $fd, int $reactorId)
    {

    }

    public function run()
    {
        $this->server->start();
    }
}

$server = new ybServer();
$server->run();