<?php
//作者：QQ 1878336950 
//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

//include(dirname(dirname(dirname(__FILE__))).'/Public/config.php');
//include(dirname(dirname(dirname(__FILE__))).'/caiji/jiesuan.php');

$qihao = $_POST['addterm'];
$code = $_POST['addcode'];
$kaitime = $_POST['next_time'];
$opentime = strtotime($kaitime);
$roomid = $_POST['roomid'];
$type = $_POST['game'];
$jietime = $opentime - time();
//判断预设号码长度是否准确
$changdu = count(explode(",",$code));
if($type == '1' && $changdu != 10){
echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
exit;  
}
if($type == '2' && $changdu != 10){
echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
exit;  
}
if($type == '3' && $changdu != 5){
echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
exit;  
}
if($type == '6' && $changdu != 10){
echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
exit;
}
if($jietime > 10){
//判断是否是开奖时间前10秒
//放入缓存区，等待开奖
}
if($game == 'cqssc'){
$open_term = substr($qihao, 8, 3); 
$open_term1 = substr($qihao, 0, 8);  
if($open_term == '120'){
$next_term = ($open_term1+1).'001';
}else{
 $next_term = $qihao + 1;
}
}elseif($game == 'xyft'){
$open_term = substr($qihao, 8, 3); 
$open_term1 = substr($qihao, 0, 8);  
if($open_term == '180'){
 $next_term = ($open_term1+1).'001';
}else{
 $next_term = $qihao + 1;
}
}elseif($game == 'bjpk10'){
$next_term = $qihao + 1;
}elseif($game == 'jsmt'){
$next_term = $qihao + 1;
}

//视频需要多一条数据源，从房间号判断该房间游戏的视频开奖号
//判断游戏种类，和下期开奖时间加多少。
switch($type){
    case '1':
        $game = 'bjpk10'; 
        $times = pk10time($opentime);
        break;
    case '2':
        $game = 'mlaft';
        $times = xyfttime($opentime);
        break;
    case '3':
        $game = 'cqssc';
        $times = cqssctime($opentime);
        break;
    case '4':
        $game = 'bjkl8';
         $times = 5*60;
        break;
    case '5':
        $game = 'cakeno';
        $times = 5*60;
        break;
    case '6':
        $game = 'jsmt';
        $times = 5*60;
        break;
    case '7':
        $game = 'jssc'; 
       $times = 5*60;
        break;
    case '8':
        $game = 'jsssc';  
        $times = 5*60;
        break;
    case '9':
        $game = 'jsk3';   
        $times = 5*60;
        break;
}
$topcode = get_query_val('fn_buqi','term',"`type`= $type and `roomid` = $roomid order by `term` desc limit 1");
$opentime = $opentime + $times;
$next_time = date('Y-m-d H:i:s',$opentime);
if($topcode != $code){
 insert_query('fn_buqi', array('term' => $qihao, 'code' => $code, 'opentime' => $kaitime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time, 'roomid' => $roomid));
 if($game == 'bjpk10'){
   PK10_jiesuan($roomid);
 } 
  if($game == 'mlaft'){
   MLAFT_jiesuan($roomid);
 }
  if($game == 'cqssc'){
   SSC_jiesuan($roomid);
 }
  if($game == 'bjkl8'){
   PC_jiesuan($roomid);
 }
  if($game == 'cakeno'){
   PC_jiesuan($roomid);
 }
  if($game == 'jsmt'){
   MT_jiesuan($roomid);
 }
  if($game == 'jssc'){
   JSSC_jiesuan($roomid);
 }
  if($game == 'jsssc'){
  JSSSC_jiesuan($roomid);
 }
  if($game == 'jsk3'){
   K3_jiesuan($roomid);
 }
   kaichat($game,$next_term,$roomid);
echo json_encode(array('status'=>true,'msg' => '开奖成功'));
}else{
echo json_encode(array('status'=>false,'msg' => '已开奖，无法再次开奖'));
}



  
function pk10time($next_time){
$fengtime = strtotime(date('Y-m-d',$next_time).' 09:06'.':00');
$fengtime1 = strtotime(date('Y-m-d',$next_time).' 23:51'.':00');
if((time() >= $fengtime) && (time() <= $fengtime1)){
  return $times = 5*60;
}else{
  return $times = 32983;
}  
}  

function cqssctime($next_time){
 $fengtime1 = strtotime(date('Y-m-d',$next_time).' 10:00'.':00');
$fengtime2 = strtotime(date('Y-m-d',$next_time).' 23:59'.':59');
$fengtime3 = strtotime(date('Y-m-d',$next_time).' 00:00'.':00');
$fengtime4 = strtotime(date('Y-m-d',$next_time).' 01:54'.':00');  
if(((time() >= $fengtime1) && (time() <= $fengtime2)) || ((time() >= $fengtime3) && (time() <= $fengtime4))){
return $times = shijian();
}else{
return $times = 29050;
}  

}
function shijian(){
$kongzhi = date('Y-m-d', time());
$time = time();  
$time1 = strtotime($kongzhi . "22:00" . ":00"); 
$time2 = strtotime($kongzhi . "02:00" . ":00");
  $time3 = strtotime($kongzhi . "23:59" . ":59"); 
  $time4 = strtotime($kongzhi . "00:00" . ":00"); 
if($time >= $time1 && $time <= $time3){
  $kaitime = 5*60;
 return $kaitime;
}elseif($time >= $time4 && $time <= $time2){
  $kaitime = 5*60+5;
 return $kaitime;
}else{
  $kaitime = 10*60;
 return $kaitime;
}  
}

function xyfttime($next_time){
$fengtime1 = strtotime(date('Y-m-d',$next_time).' 13:08'.':00');
$fengtime2 = strtotime(date('Y-m-d',$next_time).' 23:59'.':59');
$fengtime3 = strtotime(date('Y-m-d',$next_time).' 00:00'.':00');
$fengtime4 = strtotime(date('Y-m-d',$next_time).' 04:03'.':00');  
if(((time() >= $fengtime1) && (time() <= $fengtime2)) || ((time() >= $fengtime3) && (time() <= $fengtime4))){
return $times = 5*60;
}else{
return $times = 32700;
}  
}



?>