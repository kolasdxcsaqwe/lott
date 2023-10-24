<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>重庆时时彩</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 3;
$game = 'cqssc';
$kaitime = get_query_val('fn_open','next_time',"`type`=$type order by `term` desc limit 1");
if(strtotime($kaitime)>time()){
echo '重庆时时彩未到开奖时间';
echo '<br>';
}else{
  $url = 'http://stitej.com/ap1/cqssc.php?id=123A3S56Q1GGSGACSADGASDGAQLBQIA';
  $json = file_get_contents($url);
  /*{"code":"www.nengli.co","data":{"term":"20190810052","code":"4,0,1,9,6","time":1565443845,"next_term":"20190810053","next_time":"2019-08-10 21:50:45"}}*/
  $data = json_decode($json,1);
  $qihao = $data['data']['term'];
  $haoma = $data['data']['code'];
  $time = date("Y-m-d H:i:s",$data['data']['time']);
  $next_term = $data['data']['next_term'];
  $next_time = $data['data']['next_time'];

$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");
if($topcode != $qihao && $topcode<$qihao){
   insert_query('fn_open', array('term' => $qihao, 'code' => $haoma, 'time' => $time, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
   SSC_jiesuan();
   SSC_jiesuan1('cqssc',$qihao);
   sleep(4);
   kaichat($game, $next_term);
    select_query('fn_room','*');
while($x = db_fetch_array()){
 $xx[] = $x;
}
foreach($xx as $x1){
  if(strtotime($x1['roomtime']) < time())continue;
 kaizd($game,$qihao,$x1['roomid']);
}
    echo "更新 $code 成功！<br>";
}else{
    echo "等待 $game 刷新<br>";
    
  }
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
var limit=5
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
