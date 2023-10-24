<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>极速赛车</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
//ini_set("mssql.datetimeconvert","0");
include_once('../../../Public/config.php');
require_once('./jsschs.php'); //改--------------
require "sjiesuan.php";
require "sjiesuan2.php";
$game = 'jssc';//改--------------
$type = 7;//改--------------
$roomid=$_SESSION['agent_room']; 
$kongquan = get_query_val('fn_room','vip',array('roomid'=>$roomid));
if($kongquan != '1'){
echo '不是VIP权限，请联系红尘升级QQ：153493221！';
exit;  
}
$kongzhi = get_query_val('fn_lottery7', 'kongzhi', array('roomid'=>$roomid));//改--------------
if($kongzhi == '1'){
$jssmdjs = strtotime(get_query_val('fn_sopen','next_time',"`type`='$type' and `roomid`= '$roomid' order by `term` desc limit 1")) - time();   
$topcode = get_query_val('fn_sopen','term',"`type`='$type' and `roomid`= '$roomid'order by `term` desc limit 1"); 
if($jssmdjs < 0){ 
$data = json_decode(jspk($roomid),1);  
$openterm = $data['data'][0]['expect'];
$code = $data['data'][0]['opencode'];
$time = $data['data'][0]['opentime'];  
$next_time = $data['data'][0]['next_time'];
$next_term = $data['data'][0]['next_term'];
if($code != '' &&  $next_time != '' && $next_term != '' && $time != ''){
insert_query('fn_sopen', array("term" => $openterm, 'code' => $code, 'opentime' => $time, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time,'roomid'=>$roomid));
  JSSC_jiesuan($roomid);
  JSSC_jiesuan1($roomid,$game,$openterm);
  sleep(4);
  kaichat($game,$next_term,$roomid);
  kaizd($game,$openterm,$roomid);
  echo "更新 $openterm 成功！<br>";
}else{
  echo "等待 $next_term 刷新<br>";
}
}else{
      echo '房间ID:'.$roomid;
	echo '<br>';
    echo '等待计算生成';	
	echo '<br>';
}



}else{
    echo '房间ID:'.$roomid;
	echo '<br>';
    echo '该游戏未开启杀赢控制或后台已掉线';	
	echo '<br>'; 	
}


//------------------------------------------------------计算函数

function jspk($roomid){
//$moshi=0;
$moshi=get_query_val('fn_lottery7','shenglv',array('roomid'=>$roomid));                     //模式0赢最多1赢随机2赢最少3随机4输最多5输最少
$jingque=500;                 //精确程度0-500   数值越大越精确建议300-400
$type=7;                     //极速赛车游戏ID
$qishua=explode('|',chaqishu());
if(strtotime($qishua[1])<time()){
	$qishu=$qishua[0];
	$opentime=$qishua[1];
    $nextterm=$qishua[2];
    $nexttime=$qishua[3];
}else{
exit;
}
$zhudan=chazhudan($roomid,$qishu);
$zzhaoma="";//最终号码
$sjmoney=0;//对比数  随机赢开出
$jieguo=0;//最终赢多少
$zsmoney=99999999;//对比数赢最少开出
$szdmoney=0;//输最多开出
$szsmoney=-99999999;//输最少开出
$qianzui="{\"ID\":7,\"code\":\"qq1878336950\",\"lottery\":\"jssc\",\"data\":[{\"expect\":";//改--------------
$zhudan1=explode('|',$zhudan);
if($zhudan1[0]=="" || $moshi=="3"){
	//没有注单或随机开出
$zzhaoma=randK();
if($zzhaoma){
	$zzhaoma=jialing($zzhaoma);
return $qianzui.$qishu.",\"opencode\":\"".$zzhaoma."\",\"opentime\":\"".$opentime."\",\"next_term\":\"".$nextterm."\",\"next_time\":\"".$nexttime."\"}]}";
exit;
}
}else{
	//有注单

		for($i=0;$i<$jingque;$i++){
			$haoma=randK();
			 if($moshi=="0"){   //赢最多
			    $money=jsshuying($haoma,$zhudan);
				if($jieguo<$money){
					$jieguo=$money;
					$zzhaoma=$haoma;
				}	
			}else if($moshi=="1"){//随机赢
				$money=jsshuying($haoma,$zhudan);
				if($sjmoney<$money){
					$jieguo=$money;
					$zzhaoma=$haoma;
					break;
				}	
			}else if($moshi=="2"){//赢最少
				$money=jsshuying($haoma,$zhudan);
				if($zsmoney>$money && $money>0){
					$zsmoney=$money;
					$jieguo=$zsmoney;
					$zzhaoma=$haoma;
				}
				
			}else if($moshi=='4'){//输最多
				$money=jsshuying($haoma,$zhudan);
					if($money<$szdmoney){
						$szdmoney=$money;
						$jieguo=$szdmoney;
						$zzhaoma=$haoma;
						}
			}else if($moshi=='5'){//输最少
				$money=jsshuying($haoma,$zhudan);
					if($money>$szsmoney && $money<0){
						$szsmoney=$money;
						$jieguo=$szsmoney;
						$zzhaoma=$haoma;
						}
			}
		}		
		if($zzhaoma==""){
			for($i=0;$i<$jingque;$i++){
			$money=jsshuying($haoma,$zhudan);
				if($zsmoney>$money && $money>0){
					$zsmoney=$money;
					$jieguo=$zsmoney;
					$zzhaoma=$haoma;
				}
			}
		}		
		if($zzhaoma){
		$zzhaoma=jialing($zzhaoma);
		return $qianzui.$qishu.",\"opencode\":\"".$zzhaoma."\",\"opentime\":\"".$opentime."\",\"next_term\":\"".$nextterm."\",\"next_time\":\"".$nexttime."\"}]}";
		exit;
		}
}
}
function jialing($haoma){
	$hh=explode(",",$haoma);
	for($i=0;$i<count($hh);$i++){
		if($hh[$i]<10){
			$hao .="0".$hh[$i].",";
		}else{
			$hao .=$hh[$i].",";
		}
	}
	$haomaa=substr($hao,0,29);
	return $haomaa;
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

