<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/13
 * Time: 下午4:16
 */
//创建服务器
$host = '0.0.0.0';
$port = 9502;
//可以不写 默认
$mode = SWOOLE_PROCESS;//多进程方式
$sock_type = SWOOLE_SOCK_UDP;

$serv = new swoole_server($host, $port, $mode, $sock_type);

/**
 *
 * bool $server->on(string $event, mixed $callback);
 * $event:
 *          connect :当建立连接的时候
 *          receive :当接收到数据
 *          close: 当关闭连接
 *
 */
//UDP服务器与TCP服务器不同，UDP没有连接的概念。启动Server后，客户端无需Connect，直接可以向Server监听的9502端口发送数据包。对应的事件为onPacket。
//监听数据接收事件
/**
 * $serv 服务器信息
 * $data 接收到的数据
 * $clientInfo 客户端信息
 */
$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
});

$serv->start();

/**
 * ➜  Swoole_Learning git:(master) ✗ /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
 * 
 * ➜  ~ git:(master) ✗ pstree  | grep udp | grep -v grep | grep -v cloudpaird
|       \-+= 34228 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
|         \-+- 34229 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
|           |--- 34230 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
|           |--- 34231 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
|           |--- 34232 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
|           \--- 34233 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php udp.php
 */