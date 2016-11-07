<?php

function WriteLog($msg){
    $fp = fopen("Log.txt", "a");//文件被清空后再写入 
    if($fp) 
    { 
        date_default_timezone_set('asia/chongqing');
        $time=date("H:i:s",strtotime("now"));
        $flag=fwrite($fp, $time ."   ".$msg ."  \r\n"); 
        fclose($fp); 
    }
}


foreach($_REQUEST as $k=>$v){
    //echo $k;echo "--";
    //echo $v;echo "</br>";
}

WriteLog('准备就绪 ---------');    
    
foreach($_POST as $k=>$v){    
    WriteLog( $k .'--' .$v);    
}    
foreach($_GET as $k=>$v){    
    WriteLog( $k .'--' .$v);    
} 
header("Content-type: application/json");
header("Pragma: no-cache");
$arr = [];

//手机发过来的POST字段
if($_POST){
	$getID             = $_POST['tagid']; //标签ID
	$getImei           = $_POST['imei']; //手机序号
	$getToken          = $_POST['token']; //授权码
	$getLatitude       = $_POST['latitude'];//经度
	$getLongitude      = $_POST['longitude'];//纬度

	$arr = [
	
			'result' => 'PASS(通过）',//PASS(通过） Failed to pass（不通过）  ,手机非官方指定
			"color"  => '#1290CF',//#1290CF     #C10000    
			'date'   => '2016-10-19 01:12:22',
			"tagid"  => $getID,
			"imei"   => $getImei,
			"logo"   => 'http://lipin.uogo8.com/uploads/20161023/logo.png',//不通过时的LOGO：   http://lipin.uogo8.com/no/logo.png
			"video"  => 'http://test-android.oss-cn-shenzhen.aliyuncs.com/video/111.mp4', 
			"pic"    => [
			//不通过时的图片:   http://lipin.uogo8.com/no/label.jpg   
			//手机不合法时：  http://lipin.uogo8.com/no/phone.jpg
						'http://lipin.uogo8.com/uploads/20161023/2.png',
						'http://lipin.uogo8.com/uploads/20161023/test.jpg',
						'http://lipin.uogo8.com/uploads/20161023/2.png',
						],
			"content"   => "我是文字说明我是文字说明我是文字说明我是说文字说明我是文字说明我是文字说明我是文字说明"
	
	];
}
$str = json_encode($arr);

echo $str;