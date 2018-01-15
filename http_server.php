<?php
//swoole_http_server继承自swoole_server，是一个完整的http服务器实现
$http = new swoole_http_server("127.0.0.1", 9501);

$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});

//处理接收到的完整的HTTP请求 回调方法
$http->on("request", function ($request, $response) {
    print_r($request->get);
    $response->header("Content-Type", "text/plain");

    $response->write('get:'.var_export($request->get,true));
    $response->end("Hello World\n");
});

$http->start();