<?php
include_once('../Public/config.php');
$arr = get_query_vals('fn_open','*',"`type` = '2' order by `term` desc limit 1");
  $term = $arr['term'];
 $opentime = $arr['time'];
$code = $arr['code'];
$time = strtotime($opentime);
$nextterm = $arr['next_term'];
$nexttime = $arr['next_time'];  

$json = ['rows'=>1,'code'=>'mlaft','remain'=>'6917hrs','data'=>[['expect'=>$term,'opencode'=>$code,'opentime'=>$opentime,'opentimestamp'=>$time, 'nexttime'=>$nexttime, 'nextterm'=>$nextterm]]];
$array = json_encode($json);
header('Content-type:text/json'); 
echo $array;
?>