<?php header("Content-type: application/json");
//GET imei 判断
$arr = [
	['tagid' => "认证ID：11658142263847562537485",
	'result' => '验证的结果',
	'date' => '8月12',
	'time' => '12:05',
	'color' => '#ff0000'],
['tagid' => "认证ID：1165814226",
	'result' => '验证的结果',
	'date' => '8月12',
	'time' => '12:05',
	'color' => '#ff0000'],
	['tagid' => "认证ID：1165814226",
	'result' => '验证的结果',
	'date' => '8月12',
	'time' => '12:05',
	'color' => '#ff0000'],
	['tagid' => "认证ID：1165814226",
	'result' => '验证的结果',
	'date' => '8月12',
	'time' => '12:05',
	'color' => '#ff0000'],
	['tagid' => "认证ID：1165814226",
	'result' => '验证的结果',
	'date' => '8月12',
	'time' => '12:05',
	'color' => '#ff0000'],
	['tagid' => "认证ID：1165814226",
	'result' => '验证的结果',
	'date' => '8月12',
	'time' => '12:05',
	'color' => '#ff0000'],

];
$str = json_encode($arr);
echo $str;