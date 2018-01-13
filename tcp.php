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
$sock_type = SWOOLE_SOCK_TCP;

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
/**
 * $server 服务器信息
 * $fd 客户端信息
 */
$server->on('connect', function ($server, $fd) {
    echo "connection open: {$fd}\n";
});

/**
 * $reactor_id
 * $data 数据
 */
$server->on('receive', function ($server, $fd, $reactor_id, $data) {
    echo "receive data:{$data}";
    $server->send($fd, "Swoole: {$data}");
    $server->close($fd);
});

$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();


/*
 *
 * 启动tcp服务
 * ➜  Swoole_Learning git:(master) ✗ /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php
 *
 * ➜  ~ git:(master) ✗ pstree  | grep tcp | grep -v grep
 | |     \-+= 29592 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php
 | |       \-+- 29593 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php
 | |         |--- 29594 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php
 | |         |--- 29595 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php
 | |         |--- 29596 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php
 | |         \--- 29597 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php tcp.php



➜  ~ git:(master) ✗ telnet 127.0.0.1 9501
Trying 127.0.0.1...
Connected to localhost.
Escape character is '^]'.
swoole test
Swoole: swoole test
Connection closed by foreign host.
*/