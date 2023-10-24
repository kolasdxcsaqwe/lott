<?php

$url = 'http://api.b6api.com/api?token=b00a2b2827074171&t=pcdd&limit=5&p=json';
$data = file_get_contents($url);
$json = json_decode($data);
$term = $json->issue;
$time = date('Y-m-d H:i:s',strtotime($json->openTime)+21600);
$cd = $json->number;
preg_match_all("#<div>(.*?)<\/div>#is",$cd,$code);
foreach($code[1] as $val){
  $codes1 .= $val.',';
}
$haoma = substr($codes1,0,strlen($codes1)-1);
$codes = explode(',',$haoma);
    $number1 = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5];
    $number2 = (int)$codes[6] + (int)$codes[7] + (int)$codes[8] + (int)$codes[9] + (int)$codes[10] + (int)$codes[11];
    $number3 = (int)$codes[12] + (int)$codes[13] + (int)$codes[14] + (int)$codes[15] + (int)$codes[16] + (int)$codes[17];

    $number1 = substr($number1,-1);
    $number2 = substr($number2,-1);
    $number3 = substr($number3,-1);
    $minicode = $number1.','.$number2.','.$number3;
$array['expect'] = $term;
$array['opencode'] = $haoma;
$array['opentime'] = $time;
$array['dm28'] = $minicode;
$html['rows'] = 1;
$html['code'] = 'dm28';
$html['remain'] = 'QQ1878336950';
$html['data'] = $array;
header("Content-type:text/json;charset=utf-8");
echo json_encode($html);
