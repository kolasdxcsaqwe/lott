<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>台湾快三</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
//require "jiesuan2.php";
$game = 'twk3';
$type = 15;
$fixno = date("Ymd");
$tarr = ["00:01:30", "00:03:00", "00:04:30", "00:06:00", "00:07:30", "00:09:00", "00:10:30", "00:12:00", "00:13:30", "00:15:00", "00:16:30", "00:18:00", "00:19:30", "00:21:00", "00:22:30", "00:24:00", "00:25:30", "00:27:00", "00:28:30", "00:30:00", "00:31:30", "00:33:00", "00:34:30", "00:36:00", "00:37:30", "00:39:00", "00:40:30", "00:42:00", "00:43:30", "00:45:00", "00:46:30", "00:48:00", "00:49:30", "00:51:00", "00:52:30", "00:54:00", "00:55:30", "00:57:00", "00:58:30", "01:00:00", "01:01:30", "01:03:00", "01:04:30", "01:06:00", "01:07:30", "01:09:00", "01:10:30", "01:12:00", "01:13:30", "01:15:00", "01:16:30", "01:18:00", "01:19:30", "01:21:00", "01:22:30", "01:24:00", "01:25:30", "01:27:00", "01:28:30", "01:30:00", "01:31:30", "01:33:00", "01:34:30", "01:36:00", "01:37:30", "01:39:00", "01:40:30", "01:42:00", "01:43:30", "01:45:00", "01:46:30", "01:48:00", "01:49:30", "01:51:00", "01:52:30", "01:54:00", "01:55:30", "01:57:00", "01:58:30", "02:00:00", "02:01:30", "02:03:00", "02:04:30", "02:06:00", "02:07:30", "02:09:00", "02:10:30", "02:12:00", "02:13:30", "02:15:00", "02:16:30", "02:18:00", "02:19:30", "02:21:00", "02:22:30", "02:24:00", "02:25:30", "02:27:00", "02:28:30", "02:30:00", "02:31:30", "02:33:00", "02:34:30", "02:36:00", "02:37:30", "02:39:00", "02:40:30", "02:42:00", "02:43:30", "02:45:00", "02:46:30", "02:48:00", "02:49:30", "02:51:00", "02:52:30", "02:54:00", "02:55:30", "02:57:00", "02:58:30", "03:00:00", "03:01:30", "03:03:00", "03:04:30", "03:06:00", "03:07:30", "03:09:00", "03:10:30", "03:12:00", "03:13:30", "03:15:00", "03:16:30", "03:18:00", "03:19:30", "03:21:00", "03:22:30", "03:24:00", "03:25:30", "03:27:00", "03:28:30", "03:30:00", "03:31:30", "03:33:00", "03:34:30", "03:36:00", "03:37:30", "03:39:00", "03:40:30", "03:42:00", "03:43:30", "03:45:00", "03:46:30", "03:48:00", "03:49:30", "03:51:00", "03:52:30", "03:54:00", "03:55:30", "03:57:00", "03:58:30", "04:00:00", "04:01:30", "04:03:00", "04:04:30", "04:06:00", "04:07:30", "04:09:00", "04:10:30", "04:12:00", "04:13:30", "04:15:00", "04:16:30", "04:18:00", "04:19:30", "04:21:00", "04:22:30", "04:24:00", "04:25:30", "04:27:00", "04:28:30", "04:30:00", "04:31:30", "04:33:00", "04:34:30", "04:36:00", "04:37:30", "04:39:00", "04:40:30", "04:42:00", "04:43:30", "04:45:00", "04:46:30", "04:48:00", "04:49:30", "04:51:00", "04:52:30", "04:54:00", "04:55:30", "04:57:00", "04:58:30", "05:00:00", "05:01:30", "05:03:00", "05:04:30", "05:06:00", "05:07:30", "05:09:00", "05:10:30", "05:12:00", "05:13:30", "05:15:00", "05:16:30", "05:18:00", "05:19:30", "05:21:00", "05:22:30", "05:24:00", "05:25:30", "05:27:00", "05:28:30", "05:30:00", "05:31:30", "05:33:00", "05:34:30", "05:36:00", "05:37:30", "05:39:00", "05:40:30", "05:42:00", "05:43:30", "05:45:00", "05:46:30", "05:48:00", "05:49:30", "05:51:00", "05:52:30", "05:54:00", "05:55:30", "05:57:00", "05:58:30", "06:00:00", "06:01:30", "06:03:00", "06:04:30", "06:06:00", "06:07:30", "06:09:00", "06:10:30", "06:12:00", "06:13:30", "06:15:00", "06:16:30", "06:18:00", "06:19:30", "06:21:00", "06:22:30", "06:24:00", "06:25:30", "06:27:00", "06:28:30", "06:30:00", "06:31:30", "06:33:00", "06:34:30", "06:36:00", "06:37:30", "06:39:00", "06:40:30", "06:42:00", "06:43:30", "06:45:00", "06:46:30", "06:48:00", "06:49:30", "06:51:00", "06:52:30", "06:54:00", "06:55:30", "06:57:00", "06:58:30", "07:00:00", "07:01:30", "07:03:00", "07:04:30", "07:06:00", "07:07:30", "07:09:00", "07:10:30", "07:12:00", "07:13:30", "07:15:00", "07:16:30", "07:18:00", "07:19:30", "07:21:00", "07:22:30", "07:24:00", "07:25:30", "07:27:00", "07:28:30", "07:30:00", "07:31:30", "07:33:00", "07:34:30", "07:36:00", "07:37:30", "07:39:00", "07:40:30", "07:42:00", "07:43:30", "07:45:00", "07:46:30", "07:48:00", "07:49:30", "07:51:00", "07:52:30", "07:54:00", "07:55:30", "07:57:00", "07:58:30", "08:00:00", "08:01:30", "08:03:00", "08:04:30", "08:06:00", "08:07:30", "08:09:00", "08:10:30", "08:12:00", "08:13:30", "08:15:00", "08:16:30", "08:18:00", "08:19:30", "08:21:00", "08:22:30", "08:24:00", "08:25:30", "08:27:00", "08:28:30", "08:30:00", "08:31:30", "08:33:00", "08:34:30", "08:36:00", "08:37:30", "08:39:00", "08:40:30", "08:42:00", "08:43:30", "08:45:00", "08:46:30", "08:48:00", "08:49:30", "08:51:00", "08:52:30", "08:54:00", "08:55:30", "08:57:00", "08:58:30", "09:00:00", "09:01:30", "09:03:00", "09:04:30", "09:06:00", "09:07:30", "09:09:00", "09:10:30", "09:12:00", "09:13:30", "09:15:00", "09:16:30", "09:18:00", "09:19:30", "09:21:00", "09:22:30", "09:24:00", "09:25:30", "09:27:00", "09:28:30", "09:30:00", "09:31:30", "09:33:00", "09:34:30", "09:36:00", "09:37:30", "09:39:00", "09:40:30", "09:42:00", "09:43:30", "09:45:00", "09:46:30", "09:48:00", "09:49:30", "09:51:00", "09:52:30", "09:54:00", "09:55:30", "09:57:00", "09:58:30", "10:00:00", "10:01:30", "10:03:00", "10:04:30", "10:06:00", "10:07:30", "10:09:00", "10:10:30", "10:12:00", "10:13:30", "10:15:00", "10:16:30", "10:18:00", "10:19:30", "10:21:00", "10:22:30", "10:24:00", "10:25:30", "10:27:00", "10:28:30", "10:30:00", "10:31:30", "10:33:00", "10:34:30", "10:36:00", "10:37:30", "10:39:00", "10:40:30", "10:42:00", "10:43:30", "10:45:00", "10:46:30", "10:48:00", "10:49:30", "10:51:00", "10:52:30", "10:54:00", "10:55:30", "10:57:00", "10:58:30", "11:00:00", "11:01:30", "11:03:00", "11:04:30", "11:06:00", "11:07:30", "11:09:00", "11:10:30", "11:12:00", "11:13:30", "11:15:00", "11:16:30", "11:18:00", "11:19:30", "11:21:00", "11:22:30", "11:24:00", "11:25:30", "11:27:00", "11:28:30", "11:30:00", "11:31:30", "11:33:00", "11:34:30", "11:36:00", "11:37:30", "11:39:00", "11:40:30", "11:42:00", "11:43:30", "11:45:00", "11:46:30", "11:48:00", "11:49:30", "11:51:00", "11:52:30", "11:54:00", "11:55:30", "11:57:00", "11:58:30", "12:00:00", "12:01:30", "12:03:00", "12:04:30", "12:06:00", "12:07:30", "12:09:00", "12:10:30", "12:12:00", "12:13:30", "12:15:00", "12:16:30", "12:18:00", "12:19:30", "12:21:00", "12:22:30", "12:24:00", "12:25:30", "12:27:00", "12:28:30", "12:30:00", "12:31:30", "12:33:00", "12:34:30", "12:36:00", "12:37:30", "12:39:00", "12:40:30", "12:42:00", "12:43:30", "12:45:00", "12:46:30", "12:48:00", "12:49:30", "12:51:00", "12:52:30", "12:54:00", "12:55:30", "12:57:00", "12:58:30", "13:00:00", "13:01:30", "13:03:00", "13:04:30", "13:06:00", "13:07:30", "13:09:00", "13:10:30", "13:12:00", "13:13:30", "13:15:00", "13:16:30", "13:18:00", "13:19:30", "13:21:00", "13:22:30", "13:24:00", "13:25:30", "13:27:00", "13:28:30", "13:30:00", "13:31:30", "13:33:00", "13:34:30", "13:36:00", "13:37:30", "13:39:00", "13:40:30", "13:42:00", "13:43:30", "13:45:00", "13:46:30", "13:48:00", "13:49:30", "13:51:00", "13:52:30", "13:54:00", "13:55:30", "13:57:00", "13:58:30", "14:00:00", "14:01:30", "14:03:00", "14:04:30", "14:06:00", "14:07:30", "14:09:00", "14:10:30", "14:12:00", "14:13:30", "14:15:00", "14:16:30", "14:18:00", "14:19:30", "14:21:00", "14:22:30", "14:24:00", "14:25:30", "14:27:00", "14:28:30", "14:30:00", "14:31:30", "14:33:00", "14:34:30", "14:36:00", "14:37:30", "14:39:00", "14:40:30", "14:42:00", "14:43:30", "14:45:00", "14:46:30", "14:48:00", "14:49:30", "14:51:00", "14:52:30", "14:54:00", "14:55:30", "14:57:00", "14:58:30", "15:00:00", "15:01:30", "15:03:00", "15:04:30", "15:06:00", "15:07:30", "15:09:00", "15:10:30", "15:12:00", "15:13:30", "15:15:00", "15:16:30", "15:18:00", "15:19:30", "15:21:00", "15:22:30", "15:24:00", "15:25:30", "15:27:00", "15:28:30", "15:30:00", "15:31:30", "15:33:00", "15:34:30", "15:36:00", "15:37:30", "15:39:00", "15:40:30", "15:42:00", "15:43:30", "15:45:00", "15:46:30", "15:48:00", "15:49:30", "15:51:00", "15:52:30", "15:54:00", "15:55:30", "15:57:00", "15:58:30", "16:00:00", "16:01:30", "16:03:00", "16:04:30", "16:06:00", "16:07:30", "16:09:00", "16:10:30", "16:12:00", "16:13:30", "16:15:00", "16:16:30", "16:18:00", "16:19:30", "16:21:00", "16:22:30", "16:24:00", "16:25:30", "16:27:00", "16:28:30", "16:30:00", "16:31:30", "16:33:00", "16:34:30", "16:36:00", "16:37:30", "16:39:00", "16:40:30", "16:42:00", "16:43:30", "16:45:00", "16:46:30", "16:48:00", "16:49:30", "16:51:00", "16:52:30", "16:54:00", "16:55:30", "16:57:00", "16:58:30", "17:00:00", "17:01:30", "17:03:00", "17:04:30", "17:06:00", "17:07:30", "17:09:00", "17:10:30", "17:12:00", "17:13:30", "17:15:00", "17:16:30", "17:18:00", "17:19:30", "17:21:00", "17:22:30", "17:24:00", "17:25:30", "17:27:00", "17:28:30", "17:30:00", "17:31:30", "17:33:00", "17:34:30", "17:36:00", "17:37:30", "17:39:00", "17:40:30", "17:42:00", "17:43:30", "17:45:00", "17:46:30", "17:48:00", "17:49:30", "17:51:00", "17:52:30", "17:54:00", "17:55:30", "17:57:00", "17:58:30", "18:00:00", "18:01:30", "18:03:00", "18:04:30", "18:06:00", "18:07:30", "18:09:00", "18:10:30", "18:12:00", "18:13:30", "18:15:00", "18:16:30", "18:18:00", "18:19:30", "18:21:00", "18:22:30", "18:24:00", "18:25:30", "18:27:00", "18:28:30", "18:30:00", "18:31:30", "18:33:00", "18:34:30", "18:36:00", "18:37:30", "18:39:00", "18:40:30", "18:42:00", "18:43:30", "18:45:00", "18:46:30", "18:48:00", "18:49:30", "18:51:00", "18:52:30", "18:54:00", "18:55:30", "18:57:00", "18:58:30", "19:00:00", "19:01:30", "19:03:00", "19:04:30", "19:06:00", "19:07:30", "19:09:00", "19:10:30", "19:12:00", "19:13:30", "19:15:00", "19:16:30", "19:18:00", "19:19:30", "19:21:00", "19:22:30", "19:24:00", "19:25:30", "19:27:00", "19:28:30", "19:30:00", "19:31:30", "19:33:00", "19:34:30", "19:36:00", "19:37:30", "19:39:00", "19:40:30", "19:42:00", "19:43:30", "19:45:00", "19:46:30", "19:48:00", "19:49:30", "19:51:00", "19:52:30", "19:54:00", "19:55:30", "19:57:00", "19:58:30", "20:00:00", "20:01:30", "20:03:00", "20:04:30", "20:06:00", "20:07:30", "20:09:00", "20:10:30", "20:12:00", "20:13:30", "20:15:00", "20:16:30", "20:18:00", "20:19:30", "20:21:00", "20:22:30", "20:24:00", "20:25:30", "20:27:00", "20:28:30", "20:30:00", "20:31:30", "20:33:00", "20:34:30", "20:36:00", "20:37:30", "20:39:00", "20:40:30", "20:42:00", "20:43:30", "20:45:00", "20:46:30", "20:48:00", "20:49:30", "20:51:00", "20:52:30", "20:54:00", "20:55:30", "20:57:00", "20:58:30", "21:00:00", "21:01:30", "21:03:00", "21:04:30", "21:06:00", "21:07:30", "21:09:00", "21:10:30", "21:12:00", "21:13:30", "21:15:00", "21:16:30", "21:18:00", "21:19:30", "21:21:00", "21:22:30", "21:24:00", "21:25:30", "21:27:00", "21:28:30", "21:30:00", "21:31:30", "21:33:00", "21:34:30", "21:36:00", "21:37:30", "21:39:00", "21:40:30", "21:42:00", "21:43:30", "21:45:00", "21:46:30", "21:48:00", "21:49:30", "21:51:00", "21:52:30", "21:54:00", "21:55:30", "21:57:00", "21:58:30", "22:00:00", "22:01:30", "22:03:00", "22:04:30", "22:06:00", "22:07:30", "22:09:00", "22:10:30", "22:12:00", "22:13:30", "22:15:00", "22:16:30", "22:18:00", "22:19:30", "22:21:00", "22:22:30", "22:24:00", "22:25:30", "22:27:00", "22:28:30", "22:30:00", "22:31:30", "22:33:00", "22:34:30", "22:36:00", "22:37:30", "22:39:00", "22:40:30", "22:42:00", "22:43:30", "22:45:00", "22:46:30", "22:48:00", "22:49:30", "22:51:00", "22:52:30", "22:54:00", "22:55:30", "22:57:00", "22:58:30", "23:00:00", "23:01:30", "23:03:00", "23:04:30", "23:06:00", "23:07:30", "23:09:00", "23:10:30", "23:12:00", "23:13:30", "23:15:00", "23:16:30", "23:18:00", "23:19:30", "23:21:00", "23:22:30", "23:24:00", "23:25:30", "23:27:00", "23:28:30", "23:30:00", "23:31:30", "23:33:00", "23:34:30", "23:36:00", "23:37:30", "23:39:00", "23:40:30", "23:42:00", "23:43:30", "23:45:00", "23:46:30", "23:48:00", "23:49:30", "23:51:00", "23:52:30", "23:54:00", "23:55:30", "23:57:00", "23:58:30", "00:00:00"];
$c = 0;
$t = '';
if (date('H:i:s') > '23:58:30') {
    $c = 960;
    $t = '00:00:00';
} else {
    for ($i = 0; $i < 960; $i++) {
        if ($tarr[$i] > date('H:i:s')) {
            $c = $i + 1;
            $t = $tarr[$i];
            break;
        }
    }
}
if(strlen($c) == 1){
  $qihao = '00'.$c;
}elseif(strlen($c) == 2){
  $qihao = '0'.$c;
}else{
  $qihao = $c;
}
$term = $fixno.$qihao;
$time = date('Y-m-d H:i:s', strtotime(date('Y-m-d ') . $t) - 90);
if($c==960){
$next_term = ($fixno+1).'001';
}else{
$next_term = $term+1;
}
$next_time = date('Y-m-d ') . $t;
$code_str = randK();
$topcode = get_query_val('fn_open','term',"`type`='$type' order by `term` desc limit 1");
if($topcode != $term && $term>$topcode){
  insert_query('fn_open', array("term" => $term, 'code' => $code_str, 'time' => $time, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
  TWK3_jiesuan();
//  TWK3_jiesuan1($game,$term);
  sleep(5);
  kaichat($game,$next_term);
 // kaizd($game,$term);
  echo "更新 $code_str 成功！<br>";
}else{
  echo "等待 $code_str 刷新<br>";
}


function randk($len=3){
	$str='632451';
	$rand='';
	for($x=0;$x<$len;$x++){
		$rand.=($rand!=''?',':'').substr($str,rand(0,strlen($str)-1),1);
	}
	return $rand;
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



