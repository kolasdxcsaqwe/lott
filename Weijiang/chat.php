<?php
echo "<span style='color:red;'>管理员开奖报期</span><br>"; 
include_once("../Public/config.php");
$roomid =$_SESSION['agent_room'];
function 管理员喊话($Content, $chat_term='', $chat_status='', $roomid, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $roomid));
    insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'chat_term'=>$chat_term,'chat_status'=>$chat_status,'content' => $Content, 'addtime' => date('H:i:s'),  'time'=>date('Y-m-d H:i:s',time()), 'type' => 'S3', 'userid' => 'system', 'game' => $game, 'roomid' => $roomid));
}
if($roomid){ 
$pkdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '1' order by `term` desc limit 1")) - time();
$xyftdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '2' order by `term` desc limit 1")) - time();
$cqsscdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '3' order by `term` desc limit 1")) - time();
$pcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '4' order by `term` desc limit 1")) - time();
$jnddjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '5' order by `term` desc limit 1")) - time();
$jsmtdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '6' order by `term` desc limit 1")) - time();
$jsscdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '7' order by `term` desc limit 1")) - time();
$jssscdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '8' order by `term` desc limit 1")) - time();
$kuai3djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '9' order by `term` desc limit 1")) - time();
$bjldjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '10' order by `term` desc limit 1")) - time();
$gdx5djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '11' order by `term` desc limit 1")) - time();
$jssmdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '12' order by `term` desc limit 1")) - time();
$lhcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '13' order by `term` desc limit 1")) - time();
$jslhcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '14' order by `term` desc limit 1")) - time();
$twk3djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '15' order by `term` desc limit 1")) - time();
$txffcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '16' order by `term` desc limit 1")) - time(); 
    $pk10open = get_query_val('fn_lottery1', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $xyftopen = get_query_val('fn_lottery2', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $cqsscopen = get_query_val('fn_lottery3', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $xy28open = get_query_val('fn_lottery4', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $jnd28open = get_query_val('fn_lottery5', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $jsmtopen = get_query_val('fn_lottery6', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $jsscopen = get_query_val('fn_lottery7', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $jssscopen = get_query_val('fn_lottery8', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $kuai3open = get_query_val('fn_lottery9', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $bjlopen = get_query_val('fn_lottery10', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $gdx5open = get_query_val('fn_lottery11', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $jssmopen = get_query_val('fn_lottery12', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $lhcopen = get_query_val('fn_lottery13', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $jslhcopen = get_query_val('fn_lottery14', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $twk3open = get_query_val('fn_lottery15', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $txffcopen = get_query_val('fn_lottery16', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;  
    if($pk10open){
        $pk10time = (int)get_query_val('fn_lottery1', 'fengtime', array('roomid' => $roomid));
    }
    if($xyftopen){
        $xyfttime = (int)get_query_val('fn_lottery2', 'fengtime', array('roomid' => $roomid));
    }
    if($cqsscopen){
        $cqssctime = (int)get_query_val('fn_lottery3', 'fengtime', array('roomid' => $roomid));
    }
    if($xy28open){
        $pctime = (int)get_query_val('fn_lottery4', 'fengtime', array('roomid' => $roomid));
    }
    if($jnd28open){
        $jndtime = (int)get_query_val('fn_lottery5', 'fengtime', array('roomid' => $roomid));
    }
    if($jsmtopen){
        $jsmttime = (int)get_query_val('fn_lottery6', 'fengtime', array('roomid' => $roomid));
    }
    if($jsscopen){
        $jssctime = (int)get_query_val('fn_lottery7', 'fengtime', array('roomid' => $roomid));
    }
    if($jssscopen){
        $jsssctime = (int)get_query_val('fn_lottery8', 'fengtime', array('roomid' => $roomid));
    }
  if($kuai3open){
        $kuai3time = (int)get_query_val('fn_lottery9', 'fengtime', array('roomid' => $roomid));
    }
  if($bjlopen){
        $bjltime = (int)get_query_val('fn_lottery10', 'fengtime', array('roomid' => $roomid));
    }
  if($gdx5open){
        $gdx5time = (int)get_query_val('fn_lottery11', 'fengtime', array('roomid' => $roomid));
    }
   if($jssmopen){
        $jssmtime = (int)get_query_val('fn_lottery12', 'fengtime', array('roomid' => $roomid));
    }
   if($lhcopen){
        $lhctime = (int)get_query_val('fn_lottery13', 'fengtime', array('roomid' => $roomid));
    }
  if($jslhcopen){
        $jslhctime = (int)get_query_val('fn_lottery14', 'fengtime', array('roomid' => $roomid));
    }
  if($twk3open){
        $twk3time = (int)get_query_val('fn_lottery15', 'fengtime', array('roomid' => $roomid));
    }
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
    $qishu1 = get_query_val('fn_open', 'next_term', "`type` = '1' order by `term` desc limit 1");
    $qishu2 = get_query_val('fn_open', 'next_term', "`type` = '2' order by `term` desc limit 1");
    $qishu3 = get_query_val('fn_open', 'next_term', "`type` = '3' order by `term` desc limit 1");
    $qishu4 = get_query_val('fn_open', 'next_term', "`type` = '4' order by `term` desc limit 1");
    $qishu5 = get_query_val('fn_open', 'next_term', "`type` = '5' order by `term` desc limit 1");
    $qishu6 = get_query_val('fn_open', 'next_term', "`type` = '6' order by `term` desc limit 1");
    $qishu7 = get_query_val('fn_open', 'next_term', "`type` = '7' order by `term` desc limit 1");
    $qishu8 = get_query_val('fn_open', 'next_term', "`type` = '8' order by `term` desc limit 1");
  $qishu9 = get_query_val('fn_open', 'next_term', "`type` = '9' order by `term` desc limit 1");
  $qishu10 = get_query_val('fn_open', 'next_term', "`type` = '10' order by `term` desc limit 1");
  $qishu11 = get_query_val('fn_open', 'next_term', "`type` = '11' order by `term` desc limit 1");
  $qishu12 = get_query_val('fn_open', 'next_term', "`type` = '12' order by `term` desc limit 1");
  $qishu13 = get_query_val('fn_open', 'next_term', "`type` = '13' order by `term` desc limit 1"); 
  $qishu14 = get_query_val('fn_open', 'next_term', "`type` = '14' order by `term` desc limit 1");
  $qishu15 = get_query_val('fn_open', 'next_term', "`type` = '15' order by `term` desc limit 1");
  $qishu16 = get_query_val('fn_open', 'next_term', "`type` = '16' order by `term` desc limit 1");  
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
    if($xyftopen){
       $contest1 = str_replace("[期号]",$qishu2,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu2,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='xyft' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='xyft' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($xyfttime + 30 == $xyftdjs||$xyfttime + 29 == $xyftdjs||$xyfttime + 28 == $xyftdjs||$xyfttime + 27 == $xyftdjs||$xyfttime + 26 == $xyftdjs||$xyfttime + 25 == $xyftdjs){
          if($addterm==$qishu2){
          }else{
            管理员喊话( $contests1, $qishu2, 'djs', $roomid, 'xyft');
          }
        }
        if($xyfttime == $xyftdjs||$xyfttime-1 == $xyftdjs||$xyfttime-2 == $xyftdjs||$xyfttime-3 == $xyftdjs||$xyfttime-4 == $xyftdjs||$xyfttime-5 == $xyftdjs){
          if($fpterm==$qishu2){
          }else{
            管理员喊话( $contests2, $qishu2, 'fp', $roomid, 'xyft');
          }
        }
        if($msg1_cont != "" && $xyftdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'xyft');
        }
        if($msg2_cont != "" && $xyftdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'xyft');
        }
        if($msg3_cont != "" && $xyftdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'xyft');
        }
    }
    if($cqsscopen){
       $contest1 = str_replace("[期号]",$qishu3,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu3,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='cqssc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='cqssc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($cqssctime + 30 == $cqsscdjs||$cqssctime + 29 == $cqsscdjs||$cqssctime + 28 == $cqsscdjs||$cqssctime + 27 == $cqsscdjs||$cqssctime + 26 == $cqsscdjs||$cqssctime + 25 == $cqsscdjs){
            if($addterm==$qishu3){
            }else{
          管理员喊话( $contests1, $qishu3, 'djs',$roomid, 'cqssc');
        }
        }
          
        if($cqssctime == $cqsscdjs||$cqssctime-1 == $cqsscdjs||$cqssctime-2 == $cqsscdjs||$cqssctime-3 == $cqsscdjs||$cqssctime-4 == $cqsscdjs||$cqssctime-5 == $cqsscdjs){
          if($fpterm==$qishu3){
          }else{
            管理员喊话( $contests2, $qishu3, 'fp', $roomid, 'cqssc');
        
          }
          }
        if($msg1_cont != "" && $cqsscdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'cqssc');
        }
        if($msg2_cont != "" && $cqsscdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'cqssc');
        }
        if($msg3_cont != "" && $cqsscdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'cqssc');
        }
    }
    if($xy28open){
       $contest1 = str_replace("[期号]",$qishu4,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu4,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='xy28' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='xy28' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($pctime + 30 == $pcdjs||$pctime + 29 == $pcdjs||$pctime + 28 == $pcdjs||$pctime + 27 == $pcdjs||$pctime + 26 == $pcdjs||$pctime + 25 == $pcdjs){
          if($addterm==$qishu4){
          }else{  
          管理员喊话( $contests1,  $qishu4, 'djs',$roomid, 'xy28');
          }
          
        }
        if($pctime == $pcdjs||$pctime-1 == $pcdjs||$pctime-2 == $pcdjs||$pctime-3 == $pcdjs||$pctime-4 == $pcdjs||$pctime-5 == $pcdjs){
          if($fpterm==$qishu4){
          }else{
            管理员喊话( $contests2,  $qishu4, 'fp',$roomid, 'xy28');
          }
        }
        if($msg1_cont != "" && $pcdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'xy28');
        }
        if($msg2_cont != "" && $pcdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'xy28');
        }
        if($msg3_cont != "" && $pcdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'xy28');
        }
    }
    if($jnd28open){
       $contest1 = str_replace("[期号]",$qishu5,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu5,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jnd28' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jnd28' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($jndtime + 30 == $jnddjs||$jndtime + 29 == $jnddjs||$jndtime + 28 == $jnddjs||$jndtime + 27 == $jnddjs||$jndtime + 26 == $jnddjs||$jndtime + 25 == $jnddjs){
          if($addterm==$qishu5){
          }else{
            管理员喊话( $contests1, $qishu5, 'djs',$roomid, 'jnd28');
          }
        }
        if($jndtime == $jnddjs||$jndtime-1 == $jnddjs||$jndtime-2 == $jnddjs||$jndtime-3 == $jnddjs||$jndtime-4 == $jnddjs||$jndtime-5 == $jnddjs){
          if($fpterm==$qishu5){
          }else{
            管理员喊话( $contests2, $qishu5, 'fp',$roomid, 'jnd28');
          }
        }
        if($msg1_cont != "" && $jnddjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'jnd28');
        }
        if($msg2_cont != "" && $jnddjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'jnd28');
        }
        if($msg3_cont != "" && $jnddjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'jnd28');
        }
    }
    if($jsmtopen){
      $contest1 = str_replace("[期号]",$qishu6,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu6,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jsmt' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jsmt' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($jsmttime + 30 == $jsmtdjs||$jsmttime + 29 == $jsmtdjs||$jsmttime + 28 == $jsmtdjs||$jsmttime + 27 == $jsmtdjs||$jsmttime + 26 == $jsmtdjs||$jsmttime + 25 == $jsmtdjs){
          if($addterm==$qishu6){
          }else{
            管理员喊话( $contests1, $qishu6, 'djs',$roomid, 'jsmt');
          }
        }
        if($jsmttime == $jsmtdjs||$jsmttime-1 == $jsmtdjs||$jsmttime-2 == $jsmtdjs||$jsmttime-3 == $jsmtdjs||$jsmttime-4 == $jsmtdjs||$jsmttime-5 == $jsmtdjs){
          if($fpterm==$qishu6){
          }else{
            管理员喊话( $contests2, $qishu6, 'fp',$roomid, 'jsmt');
          }
        }
        if($msg1_cont != "" && $jsmtdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'jsmt');
        }
        if($msg2_cont != "" && $jsmtdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'jsmt');
        }
        if($msg3_cont != "" && $jsmtdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'jsmt');
        }
    }
    if($jsscopen){
      $contest1 = str_replace("[期号]",$qishu7,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu7,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
       $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jssc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jssc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($msg1_cont != "" && $jsscdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'jssc');
        }
        if($msg2_cont != "" && $jsscdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'jssc');
        }
        if($msg3_cont != "" && $jsscdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'jssc');
        }
        if($jssctime + 10 == $jsscdjs || $jssctime + 9 == $jsscdjs||$jssctime + 8 == $jsscdjs||$jssctime + 7 == $jsscdjs||$jssctime + 6 == $jsscdjs||$jssctime + 5 == $jsscdjs){
       if($addterm==$qishu7){
       }else{
          管理员喊话( $contests1, $qishu7, 'djs',$roomid, 'jssc');
       }
        }
      if($jssctime == $jsscdjs||$jssctime-1 == $jsscdjs||$jssctime-2 == $jsscdjs||$jssctime-3 == $jsscdjs||$jssctime-4 == $jsscdjs||$jssctime-5 == $jsscdjs||$jssctime-6 == $jsscdjs){
        if($fpterm == $qishu7){
        }else{
            管理员喊话( $contests2, $qishu7, 'fp',$roomid, 'jssc');
        }
      }
    }
    if($jssscopen){
      $contest1 = str_replace("[期号]",$qishu8,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu8,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
      $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jsssc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jsssc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($jsssctime + 10 == $jssscdjs||$jsssctime + 9 == $jssscdjs||$jsssctime + 8 == $jssscdjs||$jsssctime + 7 == $jssscdjs||$jsssctime + 6 == $jssscdjs||$jsssctime + 5 == $jssscdjs){
          if($addterm==$qishu8){
          }else{
            管理员喊话( $contests1, $qishu8, 'djs',$roomid, 'jsssc');
          }
        }
        if($jsssctime == $jssscdjs||$jsssctime-1 == $jssscdjs||$jsssctime-2 == $jssscdjs||$jsssctime-3 == $jssscdjs||$jsssctime-4 == $jssscdjs||$jsssctime-5 == $jssscdjs){
          if($fpterm==$qishu8){
          }else{
            管理员喊话( $contests2, $qishu8, 'fp',$roomid, 'jsssc');
          }
        }
        if($msg1_cont != "" && $jssscdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'jsssc');
        }
        if($msg2_cont != "" && $jssscdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'jsssc');
        }
        if($msg3_cont != "" && $jssscdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'jsssc');
        }
    }
  if($kuai3open){
       $contest1 = str_replace("[期号]",$qishu9,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu9,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
    $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='kuai3' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='kuai3' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($kuai3time + 30 == $kuai3djs||$kuai3time + 29 == $kuai3djs||$kuai3time + 28 == $kuai3djs||$kuai3time + 27 == $kuai3djs||$kuai3time + 26 == $kuai3djs||$kuai3time + 25 == $kuai3djs){
          if($addterm==$qishu9){
          }else{
            管理员喊话( $contests1, $qishu9, 'djs',$roomid, 'kuai3');
          }
        }
        if($kuai3time == $kuai3djs||$kuai3time-1== $kuai3djs||$kuai3time-2 == $kuai3djs||$kuai3time-3 == $kuai3djs||$kuai3time-4 == $kuai3djs||$kuai3time-5 == $kuai3djs){
          if($fpterm==$qishu9){
          }else{
            管理员喊话( $contests2, $qishu9, 'fp',$roomid, 'kuai3');
          }
        }
        if($msg1_cont != "" && $kuai3djs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'kuai3');
        }
        if($msg2_cont != "" && $kuai3djs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'kuai3');
        }
        if($msg3_cont != "" && $kuai3djs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'kuai3');
        }
    }
  if($bjlopen){
       $contest1 = str_replace("[期号]",$qishu10,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu10,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
    $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='bjl' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='bjl' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($bjltime + 30 == $bjldjs||$bjltime + 29 == $bjldjs||$bjltime + 28 == $bjldjs||$bjltime + 27 == $bjldjs||$bjltime + 26 == $bjldjs||$bjltime + 25 == $bjldjs){
          if($addterm==$qishu10){
          }else{
            管理员喊话( $contests1, $qishu10, 'djs',$roomid, 'bjl');
          }
        }
        if($bjltime == $bjldjs||$bjltime-1 == $bjldjs||$bjltime-2 == $bjldjs||$bjltime-3 == $bjldjs||$bjltime-4 == $bjldjs||$bjltime-5 == $bjldjs){
          if($fpterm==$qishu10){
          }else{
            管理员喊话( $contests2, $qishu10, 'fp',$roomid, 'bjl');
          }
        }
        if($msg1_cont != "" && $bjldjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'bjl');
        }
        if($msg2_cont != "" && $bjldjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'bjl');
        }
        if($msg3_cont != "" && $bjldjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'bjl');
        }
    }
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
            管理员喊话( $contests1, $qishu11, 'djs',$roomid, 'gd11x5');
          }
        }
        if($gdx5time == $gdx5djs||$gdx5time-1 == $gdx5djs||$gdx5time-2 == $gdx5djs||$gdx5time-3 == $gdx5djs||$gdx5time-4 == $gdx5djs||$gdx5time-5 == $gdx5djs){
          if($fpterm==$qishu11){
          }else{
            管理员喊话( $contests2, $qishu11, 'fp',$roomid, 'gd11x5');
          }
        }
        if($msg1_cont != "" && $gdx5djs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'gd11x5');
        }
        if($msg2_cont != "" && $gdx5djs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'gd11x5');
        }
        if($msg3_cont != "" && $gdx5djs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'gd11x5');
        }
    }
   if($jssmopen){
       $contest1 = str_replace("[期号]",$qishu12,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu12,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
     $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jssm' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='jssm' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($jssmtime + 10 == $jssmdjs||$jssmtime + 9 == $jssmdjs||$jssmtime + 8 == $jssmdjs||$jssmtime + 7 == $jssmdjs||$jssmtime + 6 == $jssmdjs||$jssmtime + 5 == $jssmdjs){
          if($addterm==$qishu12){
          }else{
            管理员喊话( $contests1, $qishu12, 'djs',$roomid, 'jssm');
          }
        }
        if($jssmtime == $jssmdjs||$jssmtime-1 == $jssmdjs||$jssmtime-2 == $jssmdjs||$jssmtime-3 == $jssmdjs||$jssmtime-4 == $jssmdjs||$jssmtime-5 == $jssmdjs){
          if($fpterm==$qishu12){
          }else{
            管理员喊话( $contests2, $qishu12, 'fp',$roomid, 'jssm');
          }
        }
        if($msg1_cont != "" && $jssmdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'jssm');
        }
        if($msg2_cont != "" && $jssmdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'jssm');
        }
        if($msg3_cont != "" && $jssmdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'jssm');
        }
    }
   if($lhcopen){
       $contest1 = str_replace("[期号]",$qishu13,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu13,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
     $addterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='lhc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
       $fpterm = get_query_val('fn_chat','chat_term',"`roomid`='{$roomid}' and `game`='lhc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if($lhctime + 30 == $lhcdjs||$lhctime + 29 == $lhcdjs||$lhctime + 28 == $lhcdjs||$lhctime + 27 == $lhcdjs||$lhctime + 26 == $lhcdjs||$lhctime + 25 == $lhcdjs){
          if($addterm==$qishu13){
          }else{
            管理员喊话( $contests1, $qishu13, 'djs',$roomid, 'lhc');
          }
        }
        if($lhctime == $lhcdjs||$lhctime-1 == $lhcdjs||$lhctime-2 == $lhcdjs||$lhctime-3 == $lhcdjs||$lhctime-4 == $lhcdjs||$lhctime-5 == $lhcdjs){
          if($fpterm==$qishu13){
          }else{
            管理员喊话( $contests2, $qishu13, 'fp',$roomid, 'lhc');
          }
        }
        if($msg1_cont != "" && $lhcdjs == $msg1){
            管理员喊话($msg1_cont, $chatterm='',$chatstatus='',$roomid, 'lhc');
        }
        if($msg2_cont != "" && $lhcdjs == $msg2){
            管理员喊话($msg2_cont, $chatterm='',$chatstatus='', $roomid, 'lhc');
        }
        if($msg3_cont != "" && $lhcdjs == $msg3){
            管理员喊话($msg3_cont, $chatterm='',$chatstatus='',  $roomid, 'lhc');
        }
    }
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
echo "PK10倒计时:" . $pkdjs . '<br>' . '幸运飞艇倒计时:' . $xyftdjs . '|' . $xyfttime . '<br>' . '重庆时时彩倒计时:' . $cqsscdjs . '<br>' . '幸运28倒计时:' . $pcdjs . '<br>' . '加拿大28倒计时:' . $jnddjs . '<br>' . '极速摩托倒计时:' . $jsmtdjs . '<br>' . '极速赛车倒计时:' . $jsscdjs . '<br>' . '极速时时彩倒计时:' . $jssscdjs.'<br>'.'江苏快三倒计时:'.$kuai3djs.'<br>'.'百家乐倒计时:'.$bjldjs.'<br>'.'广东11选5倒计时:'.$gdx5djs.'<br>'.'极速赛马倒计时:'.$jssmdjs.'<br>'.'六合彩倒计时:'.$lhcdjs.'<br>'.'极速六合彩倒计时:'.$jslhcdjs.'<br>'.'腾讯分分彩倒计时:'.$txffcdjs.'<br>'.'台湾快三倒计时:'.$twk3djs.'<br>';
echo "系统当前时间 ";
echo ":";
echo date('Y-m-d H:i:s',time());
//<!--JS 页面自动刷新 -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',1000);");      
echo ("</script>");
?>



