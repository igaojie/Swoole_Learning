<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午11:50
 */
/*
 * 将域名解析为IP地址。调用此函数是非阻塞的，调用会立即返回。将向下执行后面的代码。
 * 当DNS查询完成时，自动回调指定的callback函数。
 * 当DNS查询失败时，比如域名不存在，回调函数传入的$ip为空
 * */
swoole_async_dns_lookup("www.baidu.com", function($host, $ip){
    echo "{$host} : {$ip}\n";
});