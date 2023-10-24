<?php

include_once("../../Public/config.php");
$roomid =$_SESSION['agent_room'];
function 管理员喊话($Content, $chat_term='', $chat_status='', $roomid, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $roomid));
    insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'chat_term'=>$chat_term,'chat_status'=>$chat_status,'content' => $Content, 'addtime' => date('H:i:s'), 'time'=>date('Y-m-d H:i:s'), 'type' => 'S3', 'userid' => 'system', 'game' => $game, 'roomid' => $roomid));
}
if($roomid){ 

$twk3djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '15' order by `term` desc limit 1")) - time();

  $twk3open = get_query_val('fn_lottery15', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
 
  if($twk3open){
        $twk3time = (int)get_query_val('fn_lottery15', 'fengtime', array('roomid' => $roomid));
    }
  
    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));
  
    $daojishi = get_query_val('fn_setting','daojishi',"`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting','fengpanxiaoxi',"`roomid` = $roomid");
   
  $qishu13 = get_query_val('fn_open', 'next_term', "`type` = '13' order by `term` desc limit 1"); 
  
    if($twk3open){
       $contest1 = str_replace("[期号]",$qishu15,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu15,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='twk3' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='twk3' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($twk3time + 10 == $twk3djs||$twk3time + 9 == $twk3djs||$twk3time + 8 == $twk3djs||$twk3time + 7 == $twk3djs||$twk3time + 6 == $twk3djs||$twk3time + 5 == $twk3djs){
          if($addterm==$qishu15){
          }else{
            管理员喊话( $contests1, $qishu15, 'djs',$roomid, 'twk3');
          }
        }
        if($twk3time == $twk3djs||$twk3time-1 == $twk3djs||$twk3time-2 == $twk3djs||$twk3time-3 == $twk3djs||$twk3time-4 == $twk3djs||$twk3time-5 == $twk3djs){
          if($fpterm==$qishu15){
          }else{
            管理员喊话( $contests2, $qishu15, 'fp',$roomid, 'twk3');
          }
        }
        if($msg1_cont != "" && $twk3djs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'twk3');
        }
        if($msg2_cont != "" && $twk3djs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'twk3');
        }
        if($msg3_cont != "" && $twk3djs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'twk3');
        }
    }
     
}else{
echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '台湾快三倒计时:'.$twk3djs;
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



