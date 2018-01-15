<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午10:57
 */

$workers = [];
$worker_num = 3;

for ($i = 0; $i < $worker_num; $i++) {
    //$function，子进程创建成功后要执行的函数，底层会自动将函数保存到对象的callback属性上。如果希望更改执行的函数，可赋值新的函数到对象的callback属性
    //$redirect_stdin_stdout，重定向子进程的标准输入和输出。启用此选项后，在子进程内输出内容将不是打印屏幕，而是写入到主进程管道。读取键盘输入将变为从管道中读取数据。默认为阻塞读取。
    //$create_pipe，是否创建管道，启用$redirect_stdin_stdout后，此选项将忽略用户参数，强制为true。如果子进程内没有进程间通信，可以设置为 false
    $process = new swoole_process('doProcess', false, false);

    //开启队列 类似于全局函数
    $process->useQueue();

    $pid = $process->start();

    $workers[$pid] = $process;
}


//进程执行函数
function doProcess(swoole_process $process)
{
    //$maxsize表示获取数据的最大尺寸，默认为8192
    //操作成功会返回提取到的数据内容，失败返回false
    //默认模式下，如果队列中没有数据，pop方法会阻塞等待
    //非阻塞模式下，如果队列中没有数据，pop方法会立即返回false，并设置错误码为ENOMSG

    $recv = $process->pop();//8192

    echo "从主进程获取到的数据: {$recv}";

    //sleep(5);

    $process->exit(0);
}

// 主进程向子进程添加数据
foreach ($workers as $pid => $process) {

    //投递数据到消息队列中。

    //$data要投递的数据，长度受限与操作系统内核参数的限制。默认为8192，最大不超过65536
    //操作失败会返回false，成功返回true
    //默认模式下（阻塞模式），如果队列已满，push方法会阻塞等待
    //非阻塞模式下，如果队列已满，push方法会立即返回false


    $process->push("Hello 子进程 {$pid}".PHP_EOL);
}

//等待子进程结束 回收资源
for($i=0;$i<$worker_num;$i++){
    $ret = swoole_process::wait();//等待执行完成 回收结束运行的子进程

    print_r($ret);

    $pid = $ret['pid'];

    unset($workers[$pid]);

    echo "{$pid} 子进程退出...".PHP_EOL;
}



/*
 *
 *
 *
 *
 *
 * ➜  Swoole_Learning git:(master) ✗ /usr/local/Cellar/php72/7.2.1_12/bin/php worker_process1.php
从主进程获取到的数据: Hello 子进程 66111
从主进程获取到的数据: Hello 子进程 66112
从主进程获取到的数据: Hello 子进程 66110
Array
(
    [pid] => 66111
    [code] => 0
    [signal] => 0
)
66111 子进程退出...
Array
(
    [pid] => 66110
    [code] => 0
    [signal] => 0
)
66110 子进程退出...
Array
(
    [pid] => 66112
    [code] => 0
    [signal] => 0
)
66112 子进程退出...
➜  Swoole_Learning git:(master) ✗
 *
 *
 *
 *
 *
 * */