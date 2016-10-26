<?php
header("Content-type: application/json");
$arr = [

'ver' => '2',
'date' => '2016-10-19 01:12:22',
'data' => [

	['begin' => 1165814226,
	'end' => 1165814226,
	'content' => '视频的文字介绍',
	'pic' => '',
'video' => 'http://lipin.uogo8.com/uploads/20161023/a.mp4',
	'author' => 'xixi1',
	'datetime' => '2016-10-18 22:35:11'],

	['begin' => 2835549379,
	'end' => 2835549379,
	'content' => '中国女排，再铸辉煌',
	'pic' => 'http://lipin.uogo8.com/uploads/20161023/2.png',
'video' => '',
	'author' => 'xixi2',
	'datetime' => '2016-10-18 22:35:11'],

	['begin' => 1165812466,
	'end' => 1165812466,
	'content' => '视频的文字介绍',
	'pic' => '',
'video' => 'http://lipin.uogo8.com/uploads/20161023/b.mp4',
	'author' => 'xixi3',
	'datetime' => '2016-10-18 22:35:11'],

	['begin' => 1165810674,
	'end' => 1165810674,
	'content' => '图片的文字介绍',
	'pic' => 'http://lipin.uogo8.com/uploads/20161023/2.png',
'video' => '',
	'author' => 'xixi4',
	'datetime' => '2016-10-18 22:35:11'],
]

];
$str = json_encode($arr);

echo $str;
