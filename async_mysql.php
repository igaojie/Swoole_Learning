<?php
/**
 * Created by PhpStorm.
 * User: ShaoGaoJie
 * Date: 2018/1/14
 * Time: 下午12:28
 */

$db = new swoole_mysql;
$server = array(
    'host' => '127.0.0.1',
    'port' => 3307,
    'user' => 'a',
    'password' => '123456',
    'database' => 'test',
    'charset' => 'utf8', //指定字符集
    'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
);

$db->connect($server, function ($db, $r) {
    if ($r === false) {
        var_dump($db->connect_errno, $db->connect_error);
        die;
    }
    $sql = 'show tables';
    $db->query($sql, function(swoole_mysql $db, $r) {
        if ($r === false)
        {
            var_dump($db->error, $db->errno);
        }
        elseif ($r === true )
        {
            var_dump($db->affected_rows, $db->insert_id);
        }
        var_dump($r);
        $db->close();
    });
});

echo "........".PHP_EOL;


/*
 *
 *
 *
 * ➜  Swoole_Learning git:(master) ✗ /usr/local/Cellar/php72/7.2.1_12/bin/php async_mysql.php
array(7) {
  [0]=>
  array(1) {
    ["Tables_in_test"]=>
    string(1) "a"
  }
  [1]=>
  array(1) {
    ["Tables_in_test"]=>
    string(6) "orders"
  }
  [2]=>
  array(1) {
    ["Tables_in_test"]=>
    string(3) "stu"
  }
  [3]=>
  array(1) {
    ["Tables_in_test"]=>
    string(1) "t"
  }
  [4]=>
  array(1) {
    ["Tables_in_test"]=>
    string(2) "t1"
  }
  [5]=>
  array(1) {
    ["Tables_in_test"]=>
    string(2) "t2"
  }
  [6]=>
  array(1) {
    ["Tables_in_test"]=>
    string(2) "t3"
  }
}
➜  Swoole_Learning git:(master) ✗
 *
 *
 *
 * */