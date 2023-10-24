<?php
include_once('../Public/config.php');
$arr = get_query_vals('fn_open','*',"`type` = '4' order by `term` desc limit 1");
  $term = $arr['term'];
 $opentime = $arr['time'];
$code = $arr['code'];
$codes = explode(',', $code);
$time = strtotime($opentime);
$number1 = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5];
$number2 = (int)$codes[6] + (int)$codes[7] + (int)$codes[8] + (int)$codes[9] + (int)$codes[10] + (int)$codes[11];
$number3 = (int)$codes[12] + (int)$codes[13] + (int)$codes[14] + (int)$codes[15] + (int)$codes[16] + (int)$codes[17];
$number1 = substr($number1, -1);
$number2 = substr($number2, -1);
$number3 = substr($number3, -1);
$hz = (int)$number1.','.(int)$number2.','.(int)$number3;

$json = ['rows'=>1,'code'=>'bjkl8','remain'=>'6917hrs','data'=>[['expect'=>$term,'opencode'=>$hz,'opentime'=>$opentime,'opentimestamp'=>$time]]];
$array = json_encode($json);
header('Content-type:text/json'); 
echo $array;
?>