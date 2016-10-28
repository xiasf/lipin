<?php
header("Content-type: application/json");
$arr = [

'ver' => '6',
'date' => '2016-10-19 01:12:22',
'data' => [

	['begin' => 12513922,
	'end' => 12513922,
	'content' => '广东尚正堂集团业务涉及种植、园林绿化、文化、科研、展示展览、企业咨询、销售等领域，其中以发展莞香文化产业为主要业务，致力于打造一个集莞香生态种植、旅游观光、生产加工、科研开发、鉴定检测、交易展览的文化产业平台，塑造莞香国际品牌。',
	'pic' => '',
'video' => 'http://lipin.uogo8.com/uploads/20161023/12513922.jpg',
	'author' => 'xixi1',
	'datetime' => '2016-10-18 22:35:11'],


]

];
$str = json_encode($arr);

echo $str;
