<?php
include_once('../Public/config.php');
$arr = get_query_vals('fn_sopen','*',"`type` = '7' order by `term` desc limit 1");
$term = $arr['term'];
$opentime = $arr['opentime'];
$code = $arr['code'];
$next_time = $arr['next_time'];
$next_term = $arr['next_term'];
$time = strtotime($opentime);
$json = ['rows'=>1,'code'=>'jssc','remain'=>'6917hrs','data'=>[['expect'=>$term,'opencode'=>$code,'opentime'=>$opentime,'opentimestamp'=>$time,'next_term'=>$next_term,'next_time'=>$next_time]]];
$array = json_encode($json);
header('Content-type:text/json'); 
echo $array;
?>