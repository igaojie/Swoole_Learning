<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 上午11:56
 */

echo "1...".PHP_EOL;
/*
 *
 * swoole_async_readfile会将文件内容全部复制到内存，所以不能用于大文件的读取
 * 如果要读取超大文件，请使用swoole_async_read函数
 * swoole_async_readfile最大可读取4M的文件，受限于SW_AIO_MAX_FILESIZE宏
 *
 * */
//PHP Warning:  swoole_async_readfile(): file_size[size=1219196158|max_size=4194304] is too big. Please use swoole_async_read. in /Users/ShaoGaoJie/Works/git/Swoole_Learning/asyncIO.php on line 20
//swoole_async_readfile('/Downloads/dbt3_s1_fk.sql',function ($filename,$content){
//    echo "filename:{$filename}".PHP_EOL;
//    echo "content:{$content}".PHP_EOL;
//});

/**
 * 异步读文件，使用此函数读取文件是非阻塞的，当读操作完成时会自动回调指定的函数。
 *
 * 此函数与swoole_async_readfile不同，它是分段读取，可以用于读取超大文件。每次只读$size个字节，不会占用太多内存。
 * bool swoole_async_read(string $filename, mixed $callback, int $size = 8192, int $offset = 0);
 *
 */
swoole_async_read('/Users/ShaoGaoJie/Downloads/dbt3_s1_fk.sql',function ($filename,$content){
    sleep(2);
    echo "filename:{$filename}".PHP_EOL;
    echo "content:{$content}".PHP_EOL;
},8192);

swoole_async_readfile(__DIR__.'/lock.php',function ($filename,$content){
    echo "filename:{$filename}".PHP_EOL;
    echo "content:{$content}".PHP_EOL;

    return true;
});

echo "3...".PHP_EOL;