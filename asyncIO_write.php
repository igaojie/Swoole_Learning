<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 下午12:12
 */

/*
 * 参数1为文件的名称，必须有可写权限，文件不存在会自动创建。打开文件失败会立即返回false
 * 参数2为要写入到文件的内容，最大可写入4M
 * 参数3为写入成功后的回调函数，可选
 * 参数4为写入的选项，可以使用FILE_APPEND表示追加到文件末尾
 *
 * */
$file_content = file_get_contents('http://baidu.com');
swoole_async_writefile(__DIR__.'/test.log', $file_content, function($filename) {
    echo "wirte ok.\n";
}, $flags = FILE_APPEND);