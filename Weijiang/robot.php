<?php
include_once("../Public/config.php");
function get_curr_time_section(){  
$checkDayStr = date('Y-m-d', time());  
$timeBegin1 = strtotime($checkDayStr . "09:07" . ":00"); 
$timeEnd1 = strtotime($checkDayStr . "23:57" . ":00");  
$curr_time = time();  
 if ($curr_time >= $timeBegin1 && $curr_time <= $timeEnd1) {  
 return 0;  
 }  
return -1;  
}   
$result = get_curr_time_section();

function get_time1(){  
$time1 = date('Y-m-d', time());
$time2 = strtotime($time1 . "00:00" . ":00");  
$time2_1 = strtotime($time1 . "04:04" . ":00"); 
$time3 = strtotime($time1 . "13:09" . ":00");  
$time3_1 = strtotime($time1 . "23:59" . ":00"); 
$time4 = time();  
 if (($time4 >= $time2 && $time4 <= $time2_1) || ($time4 >= $time3 && $time4 <= $time3_1)) {  
 return 0;  
 }  
return -1;  
}   
$result1 = get_time1();

function get_time2(){  
$time_1 = date('Y-m-d', time());
$time_2 = strtotime($time_1 . "10:00" . ":00"); 
$time_2_1 = strtotime($time_1 . "23:59" . ":00"); 
$time_3 = strtotime($time_1 . "00:00" . ":00"); 
$time_3_1 = strtotime($time_1 . "02:00" . ":00"); 
$time_4 = time();  
 if (($time_4 >= $time_2 && $time_4 <= $time_2_1) || ($time_4 >= $time_3 && $time_4 <= $time_3_1)) {  
 return 0;  
 }  
return -1;  
}   
$result_1 = get_time2();

function get_time3(){  
$time_11 = date('Y-m-d', time());
$time_21 = strtotime($time_11 . "09:00" . ":00");  
$time_21_1 = strtotime($time_11 . "23:59" . ":00");  
$time_31 = strtotime($time_11 . "00:00" . ":00");
$time_31_1 = strtotime($time_11 . "04:00" . ":00");  
$time_41 = time();  
 if (($time_41 >= $time_21 && $time_41 <= $time_21_1) || ($time_41 >= $time_31 && $time_41 <= $time_31_1)) {  
 return 0;  
 }  
return -1;  
}   
$result_2 = get_time3();


?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>聊天下注机器人</title>
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    </head>
    <body>
     <!--p>当前id:<? echo  $_SESSION['agent_room'];?></p-->
        <?php if(get_query_val("fn_lottery1", "gameopen", array("roomid" => $_SESSION['agent_room'])) == 'true' && $result == "0"){
    ?>
		<div id="pk10">
			<iframe src="Application/robot_bet.php?g=pk10" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=pk10" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(1);">北京赛车封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery2', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true' && $result1 == "0"){
    ?>
		<div id="xyft">
			<iframe src="Application/robot_bet.php?g=xyft" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=xyft" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(2);">幸运飞艇封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery3', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true' && $result_1 == "0"){
    ?>
		<div id="cqssc">
			<iframe src="Application/robot_bet.php?g=cqssc" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=cqssc" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(3);">重庆时时彩封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery4', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="xy28">
			<iframe src="Application/robot_bet.php?g=xy28" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=xy28" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(4);">北京28封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery5', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="jnd28">
			<iframe src="Application/robot_bet.php?g=jnd28" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=jnd28" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(5);">加拿大28封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery6', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true' && $result_2 == "0"){
    ?>
		<div id="jsmt">
			<iframe src="Application/robot_bet.php?g=jsmt" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=jsmt" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(6);">极速摩托封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery7', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="jssc">
			<iframe src="Application/robot_bet.php?g=jssc" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=jssc" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(7);">极速赛车封盘</button>
		</div>
        <?php }
if(get_query_val('fn_lottery8', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="jsssc">
			<iframe src="Application/robot_bet.php?g=jsssc" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=jsssc" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(8);">极速时时彩封盘</button>
		</div>
		<?php }
if(get_query_val('fn_lottery9', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="kuai3">
			<iframe src="Application/robot_bet.php?g=kuai3" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(9);">江苏快三封盘</button>
		</div>
        <?php }
      if(get_query_val('fn_lottery10', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="bjl">
			<iframe src="Application/robot_bet.php?g=bjl" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(10);">百家乐</button>
		</div>
        <?php }
      if(get_query_val('fn_lottery11', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="gd11x5">
			<iframe src="Application/robot_bet.php?g=gd11x5" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(11);">十一选五</button>
		</div>
        <?php }if(get_query_val('fn_lottery12', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="jssm">
			<iframe src="Application/robot_bet.php?g=jssm" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(12);">极速赛马</button>
		</div>
        <?php }if(get_query_val('fn_lottery13', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="lhc">
			<iframe src="Application/robot_bet.php?g=lhc" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(13);">六合彩</button>
		</div>
        <?php }if(get_query_val('fn_lottery14', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="jslhc">
			<iframe src="Application/robot_bet.php?g=jslhc" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(14);">极速六合彩</button>
		</div>
        <?php }if(get_query_val('fn_lottery15', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="twk3">
			<iframe src="Application/robot_bet.php?g=twk3" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(15);">台湾快三</button>
		</div>
        <?php }if(get_query_val('fn_lottery16', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="txffc">
			<iframe src="Application/robot_bet.php?g=txffc" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(16);">腾讯分分彩</button>
		</div>
        <?php }if(get_query_val('fn_lottery17', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="azxy10">
			<iframe src="Application/robot_bet.php?g=azxy10" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(17);">澳洲幸运10</button>
		</div>
        <?php }if(get_query_val('fn_lottery18', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'true'){
    ?>
		<div id="azxy5">
			<iframe src="Application/robot_bet.php?g=azxy5" frameBorder=0 scrolling=no ></iframe>
			<!--iframe src="Application/robot_point.php?g=kuai3" frameBorder=0 scrolling=no ></iframe-->
			<button onclick="stop(18);">河内5分彩</button>
		</div>
        <?php }
?>
    </body>
	<script>
		function stop(type){
			switch(type){
				case 1:
					$('#pk10').remove();
					break;
				case 2:
					$('#xyft').remove();
					break;
				case 3:
					$('#cqssc').remove();
					break;
				case 4:
					$('#xy28').remove();
					break;
				case 5:
					$('#jnd28').remove();
					break;
				case 6:
					$('#jsmt').remove();
					break;
				case 7:
					$('#jssc').remove();
					break;
				case 8:
					$('#jsssc').remove();
					break;
				case 9:
					$('#kuai3').remove();
					break;
                case 10:
					$('#bjl').remove();
					break;
                case 11:
					$('#gd11x5').remove();
					break;
                case 12:
					$('#jssm').remove();
					break;
                case 13:
					$('#lhc').remove();
					break;
                case 14:
					$('#jslhc').remove();
					break;
               case 15:
					$('#twk3').remove();
					break;
               case 16:
					$('#txffc').remove();
					break;
                case 17:
					$('#azxy10').remove();
					break;
                case 18:
					$('#azxy5').remove();
					break;
					
			}
		}
	</script>
</html>