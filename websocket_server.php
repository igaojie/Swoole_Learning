<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/13
 * Time: 下午4:40
 */


//创建websocket服务器对象，监听0.0.0.0:9502端口
// swoole_websocket_server 继承 swoole_http_server 继承 swoole_server
$ws = new swoole_websocket_server("0.0.0.0", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();


/*
 *
 * ➜  ~ git:(master) ✗ pstree | grep websocket_server.php | grep -v grep
 | |     \-+= 35982 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php websocket_server.php
 | |       \-+- 35983 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php websocket_server.php
 | |         |--- 35984 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php websocket_server.php
 | |         |--- 35985 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php websocket_server.php
 | |         |--- 35986 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php websocket_server.php
 | |         \--- 35987 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php websocket_server.php
 *
 *
 *
 *
 *
 *

```javascript
var wsServer = 'ws://127.0.0.1:9502';
var websocket = new WebSocket(wsServer);
websocket.onopen = function (evt) {
    console.log("Connected to WebSocket server.");
};

websocket.onclose = function (evt) {
    console.log("Disconnected");
};

websocket.onmessage = function (evt) {
    console.log('Retrieved data from server: ' + evt.data);
};

websocket.onerror = function (evt, e) {
    console.log('Error occured: ' + evt.data);
};

```
 *
 * */