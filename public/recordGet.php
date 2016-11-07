<?php
header("Content-type: application/json");
$arr = [

'ver' => '2',
'date' => '2016-10-19 01:12:22',
'data' => [

	['tagid' => 1165814226,
	'content' => '视频的文字介绍',
	'pic' => '',
'video' => 'http://lipin.uogo8.com/uploads/20161023/a.mp4',
	'datetime' => '2016-10-18 22:35:11'],


]

];
$str = json_encode($arr);

echo $str;
