<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午10:30
 */

// 进程池数组
$workers = [];
//进程总数
$worker_num = 3;

for ($i = 0; $i < $worker_num; $i++) {
    //创建单独进程
    $process = new swoole_process("doProcess");

    //启动进程 并获取进程ID
    $pid = $process->start();

    // 存入 进程数组
    $workers[$pid] = $process;


}

// 进程处理函数
function doProcess(swoole_process $process){
    //子进程 写入信息
    $process->write("PID: {$process->pid}".PHP_EOL);

    echo "写入信息: {$process->pid} {$process->callback}".PHP_EOL;
}


//添加进程事件 向每个子进程添加需要执行的动作
foreach($workers as $process){
    //
    swoole_event_add($process->pipe,function ($pipe) use($process){
        $data = $process->read();

        echo "接收到 data:{$data}".PHP_EOL;

        sleep(10);
    });
}

echo " end ....".PHP_EOL;