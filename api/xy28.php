<?php
$url = '';
$json = file_get_contents($url);
$jsondata = json_decode($json);
$data = $jsondata->data;
$code = $data[0]->opencode;
$term = $data[0]->expect;
$opentime = $data[0]->opentime;
$time = strtotime($opentime);
$json = ['rows'=>1,'code'=>'bjkl8','remain'=>'6917hrs','data'=>[['expect'=>$term,'opencode'=>$code,'opentime'=>$opentime,'opentimestamp'=>$time]]];
$array = json_encode($json);
header('Content-type:text/json'); 
echo $array;
?>
