<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");
$url = 'http://'.$_SERVER['SERVER_NAME'].'/api/cqssc.php';
$text = file_get_contents($url);
$json = json_decode($text);
$json = $json -> data;
foreach($json as $i){
 $code = $i -> opencode;
 $term = $i -> expect;
 $opentime = $i -> opentimestamp;
 $nextterm = $i -> next_term;
 $nexttime = $i -> next_time; 
 $next_time = strtotime($nexttime);  
$codess = [0,0,0,0,0];
$terms = "00000000000";
$times = "000000";
$counts = "000000";
$sumNums = "00";
$dxs = "请";
$dss = "刷";
$lhs ="新";
$code = explode(',',$code);
$codes = $code[0].$code[1].$code[2].$code[3].$code[4];
$time = date('H:i:s',$next_time);
$count = $next_time - time()-30;
$sumNum = (int)$code[0] + (int)$code[1] + (int)$code[2] + (int)$code[3] + (int)$code[4];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 22 ? '大':'小';
if($code[0] > $code[4]){
	$lh = '龙';
}elseif($code[0] < $code[4]){
	$lh = '虎';
}elseif($code[0] == $code[4]){
	$lh = '和';
}
if(strlen($term) == 11){
echo json_encode(array('code'=>$codes,'term'=>$term,'nexttime'=>$time,'count'=>$count,'sumNum'=>$sumNum,'hedx'=>$dx,'heds'=>$ds,'lh'=>$lh));
exit;
}else{
  echo json_encode(array('code'=>$codess,'term'=>$terms,'nexttime'=>$times,'count'=>$counts,'sumNum'=>$sumNums,'hedx'=>$dxs,'heds'=>$dss,'lh'=>$lhs));
}
}
?>