<?php

include_once("../../Public/config.php");
$roomid =$_SESSION['agent_room'];
function 管理员喊话($Content, $chat_term='', $chat_status='', $roomid, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $roomid));
    insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'chat_term'=>$chat_term,'chat_status'=>$chat_status,'content' => $Content, 'addtime' => date('H:i:s'), 'time'=>date('Y-m-d H:i:s'), 'type' => 'S3', 'userid' => 'system', 'game' => $game, 'roomid' => $roomid));
}
if($roomid){ 

$jslhcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '14' order by `term` desc limit 1")) - time();

  $jslhcopen = get_query_val('fn_lottery14', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;

  if($jslhcopen){
        $jslhctime = (int)get_query_val('fn_lottery14', 'fengtime', array('roomid' => $roomid));
    }
  
    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));
  
    $daojishi = get_query_val('fn_setting','daojishi',"`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting','fengpanxiaoxi',"`roomid` = $roomid");

  $qishu14 = get_query_val('fn_open', 'next_term', "`type` = '14' order by `term` desc limit 1");
 
   if($jslhcopen){
       $contest1 = str_replace("[期号]",$qishu14,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu14,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
     $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jslhc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jslhc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($jslhctime + 10 == $jslhcdjs||$jslhctime + 9 == $jslhcdjs||$jslhctime + 8 == $jslhcdjs||$jslhctime + 7 == $jslhcdjs||$jslhctime + 6 == $jslhcdjs||$jslhctime + 5 == $jslhcdjs){
          if($addterm==$qishu14){
          }else{
            管理员喊话( $contests1, $qishu14, 'djs',$roomid, 'jslhc');
          }
        }
        if($jslhctime == $jslhcdjs||$jslhctime-1 == $jslhcdjs||$jslhctime-2 == $jslhcdjs||$jslhctime-3 == $jslhcdjs||$jslhctime-4 == $jslhcdjs||$jslhctime-5 == $jslhcdjs){
          if($fpterm==$qishu14){
          }else{
            管理员喊话( $contests2, $qishu14, 'fp',$roomid, 'jslhc');
          }
        }
        if($msg1_cont != "" && $jslhcdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'jslhc');
        }
        if($msg2_cont != "" && $jslhcdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'jslhc');
        }
        if($msg3_cont != "" && $jslhcdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'jslhc');
        }
    }
  
}else{
echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '六合彩倒计时:'.$lhcdjs;
echo '<br>';
//<!--JS 页面自动刷新 -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',1000);");      
echo ("</script>");
?>



