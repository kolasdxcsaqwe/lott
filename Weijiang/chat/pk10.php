<?php

include_once("../../Public/config.php");
$roomid =$_SESSION['agent_room'];
function 管理员喊话($Content, $chat_term='', $chat_status='', $roomid, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $roomid));
    insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'chat_term'=>$chat_term,'chat_status'=>$chat_status,'content' => $Content, 'addtime' => date('H:i:s'), 'time'=>date('Y-m-d H:i:s'), 'type' => 'S3', 'userid' => 'system', 'game' => $game, 'roomid' => $roomid));
}
if($roomid){ 
    $pkdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '1' order by `term` desc limit 1")) - time();
    $pk10open = get_query_val('fn_lottery1', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;

    if($pk10open){
        $pk10time = (int)get_query_val('fn_lottery1', 'fengtime', array('roomid' => $roomid));
    }
    
    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));
  
    $daojishi = get_query_val('fn_setting','daojishi',"`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting','fengpanxiaoxi',"`roomid` = $roomid");
    $qishu1 = get_query_val('fn_open', 'next_term', "`type` = '1' order by `term` desc limit 1"); 
    if($pk10open){
       $contest1 = str_replace("[期号]",$qishu1,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu1,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
       $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='pk10' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='pk10' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       //  封盘时间+30 ==   下期时间-现在时间

        if($msg1_cont != "" && $pkdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'pk10');
        }
        if($msg2_cont != "" && $pkdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'pk10');
        }
        if($msg3_cont != "" && $pkdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'pk10');
        }
        if($pk10time + 30 == $pkdjs||$pk10time + 29 == $pkdjs||$pk10time + 28 == $pkdjs||$pk10time + 27 == $pkdjs||$pk10time + 26 == $pkdjs||$pk10time + 24 == $pkdjs||$pk10time + 23 == $pkdjs||$pk10time + 22 == $pkdjs||$pk10time + 21 == $pkdjs){
          if($addterm == $qishu1){
          }else{
            管理员喊话( $contests1, $qishu1, 'djs', $roomid, 'pk10');
          }
        }
        if($pk10time == $pkdjs||$pk10time-1 == $pkdjs||$pk10time-2 == $pkdjs||$pk10time-3 == $pkdjs||$pk10time-4 == $pkdjs||$pk10time-5 == $pkdjs){
          if($fpterm==$qishu1){
          }else{
            管理员喊话( $contests2, $qishu1, 'fp', $roomid, 'pk10');
          }
        }
    }
    
}else{
echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo "PK10倒计时:" . $pkdjs .'|'.$pk10time;
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',1000);");      
echo ("</script>");

?>

