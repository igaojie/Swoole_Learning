<?php
//创建内存表。
//$size参数指定表格的最大行数，如果$size不是为2的N次方，如1024、8192,65536等，底层会自动调整为接近的一个数字.


$swoole_table = new swoole_table(2);
$swoole_table->column('id',swoole_table::TYPE_INT,4);

$table->column('str_value', swoole_table::TYPE_STRING, 5);


$swoole_table->create();


for ($i=0; $i < 100; $i++) { 
	# code...
	$swoole_table->set('a'.$i,['id'=>$i]);
}


print_r($swoole_table->get('a88'));


print_r($swoole_table->get('a99'));


?>