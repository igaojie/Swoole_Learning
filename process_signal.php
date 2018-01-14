<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午11:19
 */

//高精度定时器，是操作系统setitimer系统调用的封装，可以设置微秒级别的定时器。定时器会触发信号，需要与swoole_process::signal或pcntl_signal配合使用。

// function swoole_process::alarm(int $interval_usec, int $type = ITIMER_REAL) : bool

// bool swoole_process::signal(int $signo, callable $callback);

//出发函数
swoole_process::signal(SIGALRM,function (){
    static $i = 0;
    echo $i.PHP_EOL;

    $i++;

    if($i > 10){
        //清除定时器
        swoole_process::alarm(-1);
    }
});

//$interval_usec 定时器间隔时间，单位为微秒。如果为负数表示清除定时器
//$type 定时器类型，0 表示为真实时间,触发SIGALAM信号，1 表示用户态CPU时间，触发SIGVTALAM信号，2 表示用户态+内核态时间，触发SIGPROF信号
//设置成功返回true，失败返回false，可以使用swoole_errno得到错误码

// 100毫秒执行一次
swoole_process::alarm(100 * 1000);