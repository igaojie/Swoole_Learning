<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/13
 * Time: 下午5:09
 */

//swoole_timer_tick函数就相当于setInterval，是持续触发的
//swoole_timer_after函数相当于setTimeout，仅在约定的时间触发一次
//swoole_timer_tick和swoole_timer_after函数会返回一个整数，表示定时器的ID
//可以使用 swoole_timer_clear 清除此定时器，参数为定时器ID

// 循环执行 定时器
swoole_timer_tick(2000,function ($timer_id){
   echo "执行 {$timer_id} \n";
});


swoole_timer_after(3000,function (){
    echo "3000 后执行  \n";
});

/*
 *
 *
 * ➜  Swoole_Learning git:(master) ✗ /usr/local/Cellar/php72/7.2.1_12/bin/php timer.php
执行 1
3000 后执行
执行 1
执行 1
执行 1
执行 1
执行 1
执行 1
执行 1
执行 1
执行 1
执行 1
执行 1
^C
 *
 *
 *
 * */