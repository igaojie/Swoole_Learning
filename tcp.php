<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/13
 * Time: 下午3:06
 */
//创建服务器
$host = '0.0.0.0';
$port = 9501;
//可以不写 默认
$mode = SWOOLE_PROCESS;//多进程方式
$host = SWOOLE_SOCK_TCP;

$server = new swoole_server($host, $port, $mode, $sock_type);

/**
 *
 * bool $server->on(string $event, mixed $callback);
 * $event:
 *          connect :当建立连接的时候
 *          receive :当接收到数据
 *          close: 当关闭连接
 *
 */
$server->on('connect', function ($server, $fd) {
    echo "connection open: {$fd}\n";
});
$server->on('receive', function ($server, $fd, $reactor_id, $data) {
    $server->send($fd, "Swoole: {$data}");
    $server->close($fd);
});
$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd}\n";
});
$server->start();