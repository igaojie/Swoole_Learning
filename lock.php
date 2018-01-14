<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午11:30
 */
//创建锁对象
/**
 *
文件锁 SWOOLE_FILELOCK
读写锁 SWOOLE_RWLOCK
信号量 SWOOLE_SEM
互斥锁 SWOOLE_MUTEX
自旋锁 SWOOLE_SPINLOCK
 *
 *
 */
$lock = new swoole_lock(SWOOLE_MUTEX);
echo "创建互斥锁..".PHP_EOL;


//开始锁定
$lock->lock();

if(pcntl_fork() > 0){
    sleep(3);
    //解锁
    $lock->unlock();
}else{
    echo "------子进程 等待锁".PHP_EOL;

    //上锁
    $lock->lock();
    echo  "------子进程获取锁 ...".PHP_EOL;

    //释放锁
    $lock->unlock();

    exit("-------子进程退出".PHP_EOL);
}

echo "主进程释放锁...".PHP_EOL;
unset($lock);

sleep(1);
echo "子进程退出".PHP_EOL;



