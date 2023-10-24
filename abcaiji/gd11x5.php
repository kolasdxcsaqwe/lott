<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>广东11选5</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
//$game=$_COOKIE['game'];
//$lotcode='';
$url = "http://api.api68.com/ElevenFive/getElevenFiveInfo.do?lotCode=10006";
$game = 'gd11x5';
//if($game=="gd11x5")$lotcode='10006';
//if($game=="sd11x5")$lotcode='10008';
//if($game=="js11x5")$lotcode='10016';
//if($game=="jx11x5")$lotcode='10015';
//$url=$url.$lotcode;
$type = 11;
$text = file_get_contents($url);
$json = json_decode($text,true);
$data = $json['result']['data'];
$code =  $data['preDrawCode'];//开奖号码
$term = $data['preDrawIssue'];//当前期号
$nexttime = $data['drawTime'];
$time = date('H:i:s',strtotime($data['drawTime']));//下期时间
$next_term = $data['drawIssue'];//下一期号
$open_time = $data['preDrawTime'];//当前开奖时间
$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");
if($topcode < $term && strlen($term)>8){
   insert_query('fn_open', array('term' => $term, 'code' => $code, 'time' => date('Y-m-d H:i:s',time()), 'type' => $type, 'next_term' => $next_term, 'next_time' => $nexttime));
   X5_jiesuan();
  X5_jiesuan1('gd11x5',$term);
  sleep(4);
   kaichat($game, $next_term);
  select_query('fn_room','*');
while($x = db_fetch_array()){
 $xx[] = $x;
}
foreach($xx as $x1){
  if(strtotime($x1['roomtime']) < time())continue;
 kaizd($game,$term,$x1['roomid']);
}
    echo "更新 $codes 成功！<br>";
}else{
    echo "等待 $game 刷新<br>";
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
var limit=4
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


