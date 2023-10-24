<?php
include_once('../Public/config.php');
$arr = get_query_vals('fn_open','*',"`type` = '12' order by `term` desc limit 1");
$term = $arr['term'];
$opentime = $arr['time'];
$code = $arr['code'];
$next_time = $arr['next_time'];
$time = strtotime($opentime);
$json = ['rows'=>1,'code'=>'jssm','remain'=>'6917hrs','data'=>[['expect'=>$term,'opencode'=>$code,'opentime'=>$opentime,'opentimestamp'=>$time,'next_time'=>$next_time]]];
$array = json_encode($json);
header('Content-type:text/json'); 
echo $array;
?>