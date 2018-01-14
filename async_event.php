<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 下午12:22
 */
$fp = stream_socket_client("tcp://www.qq.com:80",$errno,$errstr,30);
fwrite($fp,"GET / HTTP/1.1 \r\n Host: www.qq.com \r\n\r\n");

swoole_event_add($fp,function ($fp){
    $resp = fread($fp,8192);

    echo $resp;

    swoole_event_del($fp);

    fclose($fp);
});


echo "这个先执行完成 \n";
