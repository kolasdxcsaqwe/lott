<?php
$load = 5;
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>百家乐</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
include_once "./Public/Bjl.php";
include_once "./Public/reopen.funcion.php";
require "jiesuan.php";

if(!isset($_GET['debug'])){
    $bjl = new Bjl();
    $codes = $bjl->newCode(false);
	//var_dump($codes);
	if(!$codes){
		$codes = $bjl->newCode();
		echo $cur=$bjl->get_period_info($bjl->getTodayCur());
		
		 select_query('fn_lottery10', '*', array('gameopen' => 'true'));
        while ($con = db_fetch_array()) {
            $cons[] = $con;
        }
        foreach ($cons as $con) {
            $Content = "第 {$cur['next_periodNumber']} 期已经开启,开始下注!";
            $cur = $bjl->get_period_info($bjl->getTodayCur());
            $myy_time = strtotime($cur['awardTime']) + 9;
            $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $con['roomid']));
            insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'content' => $Content, 'game' => 'bjl', 'addtime' => date('H:i:s', $myy_time), 'type' => 'S3', 'userid' => 'system', 'roomid' => $con['roomid']));
            BJL_jiesuan();
            
            echo "bjl喊话-" . $con['roomid'] . '..<br>';
        }
		//kaichat('bjl', $cur['next_periodNumber']);
	}
	if(isset($_GET['from_bjl'])){
		exit;
	}
    //var_dump($codes);
    //var_dump($pb=$bjl->getPB($codes));
    //var_dump($bjl->HtmlCard($codes));
    //var_dump($bjl->Result($pb['p'],$pb['b']));exit;
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


