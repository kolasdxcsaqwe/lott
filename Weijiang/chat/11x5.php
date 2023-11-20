<?php

include_once("../../Public/config.php");
$roomid =$_SESSION['agent_room'];
function Broadcast($Content, $chat_term = '', $chat_status = '', $roomid, $game)
{
    robotBroadcast($Content,$chat_term,$chat_status,$roomid,$game,'S3','system');
}

if($roomid){ 

$gdx5djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '11' order by `term` desc limit 1")) - time();

  $gdx5open = get_query_val('fn_lottery11', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
 
  if($gdx5open){
        $gdx5time = (int)get_query_val('fn_lottery11', 'fengtime', array('roomid' => $roomid));
    }
   
    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));
  
    $daojishi = get_query_val('fn_setting','daojishi',"`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting','fengpanxiaoxi',"`roomid` = $roomid");

  
  $qishu11 = get_query_val('fn_open', 'next_term', "`type` = '11' order by `term` desc limit 1");
  
  if($gdx5open){
       $contest1 = str_replace("[期号]",$qishu11,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu11,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
       $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='gd11x5' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='gd11x5' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($gdx5time + 30 == $gdx5djs||$gdx5time + 29 == $gdx5djs||$gdx5time + 28 == $gdx5djs||$gdx5time + 27 == $gdx5djs||$gdx5time + 26 == $gdx5djs||$gdx5time + 25 == $gdx5djs){
          if($addterm==$qishu11){
          }else{
            Broadcast( $contests1, $qishu11, 'djs',$roomid, 'gd11x5');
          }
        }
        if($gdx5time == $gdx5djs||$gdx5time-1 == $gdx5djs||$gdx5time-2 == $gdx5djs||$gdx5time-3 == $gdx5djs||$gdx5time-4 == $gdx5djs||$gdx5time-5 == $gdx5djs){
          if($fpterm==$qishu11){
          }else{
            Broadcast( $contests2, $qishu11, 'fp',$roomid, 'gd11x5');
          }
        }
        if($msg1_cont != "" && $gdx5djs == $msg1){
            Broadcast($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'gd11x5');
        }
        if($msg2_cont != "" && $gdx5djs == $msg2){
            Broadcast($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'gd11x5');
        }
        if($msg3_cont != "" && $gdx5djs == $msg3){
            Broadcast($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'gd11x5');
        }
    }
  
}else{
echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '广东11选5倒计时:'.$gdx5djs;
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



