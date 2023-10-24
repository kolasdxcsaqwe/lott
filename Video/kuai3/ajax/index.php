<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");
$url = "http://".$_SERVER['SERVER_NAME']."/api/kuai3.php";
$text = file_get_contents($url);
$json = json_decode($text);
$json = $json -> data;
foreach($json as $i){
$aa = $i -> opencode;
$term = $i -> expect;
$next_term = $i -> next_term;
$next_time = $i -> next_time;
$code = explode(",",$aa);
$codes = $code[0].$code[1].$code[2];  
$count = strtotime($next_time) - time();
$sumNum = (int)$code[0] + (int)$code[1] + (int)$code[2];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 10 ? '大':'小';
echo json_encode(array('code'=>$codes,'term'=>$term,'nexttime'=>$next_time,'next_term'=>$next_term,'count'=>$count,'sumNum'=>$sumNum, 'dx'=>$dx,'ds'=>$ds));
exit;
}
?>