<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午9:26
 */

//进程对应的执行函数

function doProcess(swoole_process $worker){
    var_dump($worker);

    echo "PID  ",$worker->pid,"\n";

    sleep(10);

    echo "sleep over".PHP_EOL;
}

//创建进程
$process = new swoole_process('doProcess');
$pid = $process->start();

$process = new swoole_process('doProcess');
$pid = $process->start();

$process = new swoole_process('doProcess');
$pid = $process->start();

//等待结束 关闭进程
swoole_process::wait();



