<?php 
header("Content-type: application/json");
$arr  = [
  'ver' => 1,
  'apk' => 'http://lipin.uogo8.com/NfcCrad.apk'
];

$str = json_encode($arr);

echo $str;