<?php
header("Content-type: application/json");
$arr = [

'ver' => '2',
'date' => '2016-10-19 01:12:22',
'data' => [

	['begin' => 1165814226,
	'end' => 1165814226,
	'content' => '好一朵菊花',
	'pic' => '',
'video' => 'http://lipin.uogo8.com/static/video/a.mp4',
	'author' => 'xixi1',
	'datetime' => '2016-10-18 22:35:11'],

	['begin' => 2835549379,
	'end' => 2835549379,
	'content' => '大勇哥',
	'pic' => 'http://lipin.uogo8.com/static/pic/2.png',
'video' => '',
	'author' => 'xixi2',
	'datetime' => '2016-10-18 22:35:11'],

	['begin' => 1165812466,
	'end' => 1165812466,
	'content' => '陶哥的梦想',
	'pic' => '',
'video' => 'http://lipin.uogo8.com/static/video/b.mp4',
	'author' => 'xixi3',
	'datetime' => '2016-10-18 22:35:11'],

	['begin' => 1165810674,
	'end' => 1165810674,
	'content' => '浪里个浪',
	'pic' => 'http://lipin.uogo8.com/static/pic/2.png',
'video' => '',
	'author' => 'xixi4',
	'datetime' => '2016-10-18 22:35:11'],
]

];
$str = json_encode($arr);

echo $str;
