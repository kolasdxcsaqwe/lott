<?php

include_once("../../Public/config.php");
$roomid =$_SESSION['agent_room'];
function 管理员喊话($Content, $chat_term='', $chat_status='', $roomid, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $roomid));
    insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'chat_term'=>$chat_term,'chat_status'=>$chat_status,'content' => $Content, 'addtime' => date('H:i:s'), 'time'=>date('Y-m-d H:i:s'), 'type' => 'S3', 'userid' => 'system', 'game' => $game, 'roomid' => $roomid));
}
if($roomid){ 
$txffcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '16' order by `term` desc limit 1")) - time(); 

  $txffcopen = get_query_val('fn_lottery16', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;  
 
  if($txffcopen){
        $txffctime = (int)get_query_val('fn_lottery16', 'fengtime', array('roomid' => $roomid));
    }
    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));
  
    $daojishi = get_query_val('fn_setting','daojishi',"`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting','fengpanxiaoxi',"`roomid` = $roomid");

  $qishu16 = get_query_val('fn_open', 'next_term', "`type` = '16' order by `term` desc limit 1");  
  
      if($txffcopen){
       $contest1 = str_replace("[期号]",$qishu16,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu16,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='txffc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='txffc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($txffctime + 10 == $txffcdjs||$txffctime + 9 == $txffcdjs||$txffctime + 8 == $txffcdjs||$txffctime + 7 == $txffcdjs||$txffctime + 6 == $txffcdjs||$txffctime + 5 == $txffcdjs){
          if($addterm==$qishu16){
          }else{
            管理员喊话( $contests1, $qishu16, 'djs',$roomid, 'txffc');
          }
        }
        if($txffctime == $txffcdjs||$txffctime-1 == $txffcdjs||$txffctime-2 == $txffcdjs||$txffctime-3 == $txffcdjs||$txffctime-4 == $txffcdjs||$txffctime-5 == $txffcdjs){
          if($fpterm==$qishu16){
          }else{
            管理员喊话( $contests2, $qishu16, 'fp',$roomid, 'txffc');
          }
        }
        if($msg1_cont != "" && $txffcdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'txffc');
        }
        if($msg2_cont != "" && $txffcdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'txffc');
        }
        if($msg3_cont != "" && $txffcdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'txffc');
        }
    }
}else{
echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '腾讯分分彩倒计时:'.$txffcdjs;
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



