<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/13
 * Time: 下午4:28
 */
$http = new swoole_http_server("0.0.0.0", 9501);

/**
 * $request 请求的相关信息，如GET/POST请求的数据。
 * $response 对request的响应可以通过操作response对象来完成
 */


$http->on('request', function ($request, $response) {
    var_dump($request->get, $request->post);

    // 设置返回头信息
    $response->header("Content-Type", "text/html; charset=utf-8");


    //$response->end()方法表示输出一段HTML内容，并结束此请求。
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});

$http->start();


/*
 *
 * ➜  ~ git:(master) ✗ /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php
 *
 *
 * ➜  ~ git:(master) ✗ pstree  | grep http_server | grep -v grep | grep -v cloudpaird
 |       \-+= 35031 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php
 |         \-+- 35032 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php
 |           |--- 35033 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php
 |           |--- 35034 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php
 |           |--- 35035 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php
 |           \--- 35036 ShaoGaoJie /usr/local/Cellar/php72/7.2.1_12/bin/php http_server.php


//http://127.0.0.1:9501/?a=aa&v=bbb
 *
 *
 * */