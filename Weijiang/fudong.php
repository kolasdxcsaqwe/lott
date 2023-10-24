<?php
include_once("../Public/config.php");
date_default_timezone_set("Asia/Shanghai");
//计算时间
session_start();
function get_curr_time_section(){  
$checkDayStr = date('Y-m-d', time());  
$time1 = strtotime($checkDayStr . "00:00" . ":00"); 
$time2 = strtotime($checkDayStr . "01:00" . ":00");
$time3 = strtotime($checkDayStr . "02:00" . ":00");
$time4 = strtotime($checkDayStr . "03:00" . ":00");
$time5 = strtotime($checkDayStr . "04:00" . ":00");
$time6 = strtotime($checkDayStr . "05:00" . ":00");
$time7 = strtotime($checkDayStr . "06:00" . ":00");
$time8 = strtotime($checkDayStr . "07:00" . ":00");
$time9 = strtotime($checkDayStr . "08:00" . ":00");
$time10 = strtotime($checkDayStr . "09:00" . ":00");
$time11 = strtotime($checkDayStr . "10:00" . ":00");
$time12 = strtotime($checkDayStr . "11:00" . ":00");
$time13 = strtotime($checkDayStr . "12:00" . ":00");
$time14 = strtotime($checkDayStr . "13:00" . ":00");
$time15 = strtotime($checkDayStr . "14:00" . ":00");
$time16 = strtotime($checkDayStr . "15:00" . ":00");
$time17 = strtotime($checkDayStr . "16:00" . ":00");
$time18 = strtotime($checkDayStr . "17:00" . ":00");
$time19 = strtotime($checkDayStr . "18:00" . ":00");
$time20 = strtotime($checkDayStr . "19:00" . ":00");
$time21 = strtotime($checkDayStr . "20:00" . ":00");
$time22 = strtotime($checkDayStr . "21:00" . ":00");
$time23 = strtotime($checkDayStr . "22:00" . ":00");
$time24 = strtotime($checkDayStr . "23:00" . ":00");
$time25 = strtotime($checkDayStr . "23:59" . ":00");
$curr_time = time();  
 if ($curr_time >= $time1 && $curr_time < $time2) {  
 return 1;  
 }else if($curr_time >= $time2 && $curr_time < $time3){
 return 2; 
 } else if($curr_time >= $time3 && $curr_time < $time4){
 return 3; 
 } else if($curr_time >= $time4 && $curr_time < $time5){
 return 4; 
 } else if($curr_time >= $time5 && $curr_time < $time6){
 return 5; 
 } else if($curr_time >= $time6 && $curr_time < $time7){
 return 6; 
 } else if($curr_time >= $time7 && $curr_time < $time8){
 return 7; 
 } else if($curr_time >= $time8 && $curr_time < $time9){
 return 8; 
 } else if($curr_time >= $time9 && $curr_time < $time10){
 return 9; 
 } else if($curr_time >= $time10 && $curr_time < $time11){
 return 10; 
 } else if($curr_time >= $time11 && $curr_time < $time12){
 return 11; 
 } else if($curr_time >= $time12 && $curr_time < $time13){
 return 12; 
 } else if($curr_time >= $time13 && $curr_time < $time14){
 return 13; 
 } else if($curr_time >= $time14 && $curr_time < $time15){
 return 14; 
 } else if($curr_time >= $time15 && $curr_time < $time16){
 return 15; 
 } else if($curr_time >= $time16 && $curr_time < $time17){
 return 16; 
 } else if($curr_time >= $time17 && $curr_time < $time18){
 return 17; 
 } else if($curr_time >= $time18 && $curr_time < $time19){
 return 18; 
 } else if($curr_time >= $time19 && $curr_time < $time20){
 return 19; 
 } else if($curr_time >= $time20 && $curr_time < $time21){
 return 20; 
 } else if($curr_time >= $time21 && $curr_time < $time22){
 return 21; 
 } else if($curr_time >= $time22 && $curr_time < $time23){
 return 22; 
 } else if($curr_time >= $time23 && $curr_time < $time24){
 return 23; 
 } else if($curr_time >= $time24 && $curr_time <= $time25){
 return 24; 
 }  
return -1;  
}   
$result = get_curr_time_section();
//假设当前时间，将设定机器人下注速度，机器在线数量，启动时间段在线游戏
if($result =="1"){
$gxtime = rand(982,1087);
$f = 30;
$b = 40;
  $stgame = 'cqssc';
}else if($result =="2"){
$gxtime = rand(765,891);
$f = 30;
$b = 40;
  $stgame = 'cqssc';
}else if($result =="3"){
$gxtime = rand(624,733);
$f = 40;
$b = 50;
  $stgame = 'xyft';
}else if($result =="4"){
$gxtime = rand(587,647);
$f = 15;
$b = 20;
  $stgame = 'xyft';
}else if($result =="5"){
$gxtime = rand(381,466);
$f = 20;
$b = 25;
  $stgame = 'jsmt';
}else if($result =="6"){
$gxtime = rand(271,332);
$f = 20;
$b = 55;
  $stgame = 'jsmt';
}else if($result =="7"){
$gxtime = rand(187,235);
$f = 20;
$b = 25;
  $stgame = 'jsmt';
}else if($result =="8"){
$gxtime = rand(85,116);
$f = 10;
$b = 15;
  $stgame = 'jsmt';
}else if($result =="9"){
$gxtime = rand(395,495);
$f = 10;
$b = 15;
  $stgame = 'jsmt';
}else if($result =="10"){
$gxtime = rand(675,792);
$f = 10;
$b = 15;
  $stgame = 'pk10';
}else if($result =="11"){
$gxtime = rand(989,1085);
$f = 30;
$b = 40;
  $stgame = 'pk10';
}else if($result =="12"){
$gxtime = rand(1173,1265);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="13"){
$gxtime = rand(1321,1415);
$f = 10;
$b = 20;
  $stgame = 'pk10';
}else if($result =="14"){
$gxtime = rand(1210,1361);
$f = 10;
$b = 20;
  $stgame = 'pk10';
}else if($result =="15"){
$gxtime = rand(1165,1261);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="16"){
$gxtime = rand(1016,1113);
$f = 30;
$b = 50;
  $stgame = 'pk10';
}else if($result =="17"){
$gxtime = rand(1198,1268);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="18"){
$gxtime = rand(1098,1198);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="19"){
$gxtime = rand(975,1087);
$f = 30;
$b = 40;
  $stgame = 'pk10';
}else if($result =="20"){
$gxtime = rand(1021,1121);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="21"){
$gxtime = rand(1095,1197);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="22"){
$gxtime = rand(1265,1326);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}else if($result =="23"){
$gxtime = rand(1341,1469);
$f = 10;
$b = 20;
  $stgame = 'pk10';
}else if($result =="24"){
$gxtime = rand(1272,1295);
$f = 20;
$b = 30;
  $stgame = 'pk10';
}                      
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>时间段随机在线人数浮动</title>
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    </head>
    <body>
<?php 
      $tkaishi = strtotime(date('Y-m-d').' 00:00:01');
      $tjiesu  = strtotime(date('Y-m-d').' 16:00:01');
      $timedel = date('Y-m-d H:i:s',time()-12000);
      $timedel1 = date('Y-m-d H:i:s',time()-3600);
      $roomid = $_SESSION['agent_room'];
      if($stgame1=get_query_val("fn_setting", "setting_game",array('roomid' => $roomid))){
       update_query("fn_setting", array("setting_people" => $gxtime,'setting_robot_min' => $f,'setting_robot_max' => $b) , array('roomid' => $roomid));
     
      echo "虚拟人数：".$gxtime."人";
      echo "<br>";
      echo "最短投注时间：".$f."秒";
      echo "<br>";
      echo "最久投注时间：".$b."秒";
      echo "<br>";
      echo "当前游戏：".$stgame1;
      echo "<br>";
   // echo "当前ID：".$roomid;
      echo "<br>";
      echo "<br>";
        
    //  if(get_curr_time_section() == 6){ 
    //    db_query("TRUNCATE fn_chat");
    //    echo '已清空昨天机器人记录';
         echo "<br>";
       
    // }else{
        if(time()< $tjiesu && time() >$tkaishi){}else{
        delete_query('fn_open',"`time` < '$timedel' and type != '13' and type != '1'");
        }
        delete_query('fn_chat',"`time` < '$timedel1'");
        delete_query('fn_sopen',"`opentime` < '$timedel1'");
        echo '已清理一小时前播报记录';
         echo "<br>";
        echo '已清理4小时前开奖结果';
      //}
        
      }
      
      
      
select_query('fn_roomlog','*',"roomid = '{$roomid}' and city = '' order by id desc limit 0,3");
while($con = db_fetch_array()){
 $cons[] = $con;
}

foreach($cons as $co){

update_query('fn_roomlog',array('city'=>city($co['ip'])),array('ip'=>$co['ip']));

}
select_query('fn_userlog','*',"roomid = '{$roomid}' and city = '' order by id desc limit 0,3");
while($con1 = db_fetch_array()){
 $cons1[] = $con1;
}

foreach($cons1 as $co1){

update_query('fn_userlog',array('city'=>city($co1['ip'])),array('ip'=>$co1['ip']));

}


function city($ip){
$json=file_get_contents('https://api.map.baidu.com/location/ip?ip='.$ip.'&ak=aK7EAvNzFVunIQYpm3vb0GvfqsDDCN2W&coor=gcj02');
$arr=json_decode($json,1);
  $sheng = $arr['content']['address'];
return $sheng;
}
       
      ?>
      <style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
#timeinfo{color:#C60}
-->
</style>
<script> 
var limit=11
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取!" 
	else 
		curtime=cursec+"秒后自动获取!" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>
<input type=button name=button value="刷新" onClick="window.location.reload()">
<span id="timeinfo"></span>


    </body>
  
      
</html>