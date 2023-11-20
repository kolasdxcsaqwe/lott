<?php
include_once("./Public/config.php");
function Broadcast($Content, $roomid, $game){
    robotBroadcast($Content,'','',$roomid,$game,'S3','system');
}

$pkdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '1' order by `term` desc limit 1")) - time();
//var_dump($pkdjs);
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
$azxy10djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '17' order by `term` desc limit 1")) - time();
$azxy5djs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '18' order by `term` desc limit 1")) - time();
$ny28js = strtotime(get_query_val('fn_open', 'next_time', "`type` = '19' order by `term` desc limit 1")) - time();

select_query("fn_setting", '*', '');
while($con = db_fetch_array()){
    $cons[] = $con;
}
foreach($cons as $con){
    $roomid = $con['roomid'];
    $pk10open = get_query_val('fn_lottery1', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $xyftopen = get_query_val('fn_lottery2', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $cqsscopen = get_query_val('fn_lottery3', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $xy28open = get_query_val('fn_lottery4', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
    $ny28open = get_query_val('fn_lottery19', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
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
  $azxy10open = get_query_val('fn_lottery17', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  $azxy5open = get_query_val('fn_lottery18', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;
  
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
    if($ny28open){
        $ny28time = (int)get_query_val('fn_lottery19', 'fengtime', array('roomid' => $roomid));
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
        $twk3time = (int)get_query_val('fn_lottery16', 'fengtime', array('roomid' => $roomid));
    }
  if($azxy10open){
        $twk3time = (int)get_query_val('fn_lottery17', 'fengtime', array('roomid' => $roomid));
    }
  if($azxy5open){
        $twk3time = (int)get_query_val('fn_lottery18', 'fengtime', array('roomid' => $roomid));
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
  $qishu17 = get_query_val('fn_open', 'next_term', "`type` = '17' order by `term` desc limit 1");
  $qishu18 = get_query_val('fn_open', 'next_term', "`type` = '18' order by `term` desc limit 1");
  $qishu19 = get_query_val('fn_open', 'next_term', "`type` = '19' order by `term` desc limit 1");
    
    if($pk10open){
       $contest1 = str_replace("[期号]",$qishu1,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu1,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($pk10time + 30 == $pkdjs){
            Broadcast( $contests1, $roomid, 'pk10');
        }
        if($pk10time == $pkdjs){
            Broadcast( $contests2, $roomid, 'pk10');
        }
        if($msg1_cont != "" && $pkdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'pk10');
        }
        if($msg2_cont != "" && $pkdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'pk10');
        }
        if($msg3_cont != "" && $pkdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'pk10');
        }
    }
    if($xyftopen){
       $contest1 = str_replace("[期号]",$qishu2,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu2,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($xyfttime + 30 == $xyftdjs){
            Broadcast( $contests1, $roomid, 'xyft');
        }
        if($xyfttime == $xyftdjs){
            Broadcast( $contests2, $roomid, 'xyft');
        }
        if($msg1_cont != "" && $xyftdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'xyft');
        }
        if($msg2_cont != "" && $xyftdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'xyft');
        }
        if($msg3_cont != "" && $xyftdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'xyft');
        }
    }
    if($cqsscopen){
       $contest1 = str_replace("[期号]",$qishu3,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu3,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($cqssctime + 30 == $cqsscdjs){
            Broadcast( $contests1, $roomid, 'cqssc');
        }
        if($cqssctime == $cqsscdjs){
            Broadcast( $contests2, $roomid, 'cqssc');
        }
        if($msg1_cont != "" && $cqsscdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'cqssc');
        }
        if($msg2_cont != "" && $cqsscdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'cqssc');
        }
        if($msg3_cont != "" && $cqsscdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'cqssc');
        }
    }
    if($xy28open){
       $contest1 = str_replace("[期号]",$qishu4,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu4,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($pctime + 30 == $pcdjs){
            Broadcast( $contests1, $roomid, 'xy28');
        }
        if($pctime == $pcdjs){
            Broadcast( $contests2, $roomid, 'xy28');
        }
        if($msg1_cont != "" && $pcdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'xy28');
        }
        if($msg2_cont != "" && $pcdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'xy28');
        }
        if($msg3_cont != "" && $pcdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'xy28');
        }
    }
    if($ny28open){
        $contest1 = str_replace("[期号]",$qishu19,$daojishi);
        $contests1 = str_replace("[换行]","<br>",$contest1);
        $contest2 = str_replace("[期号]",$qishu19,$fengpanxiaoxi);
        $contests2 = str_replace("[换行]","<br>",$contest2);
        if($ny28time + 30 == $ny28js){
            Broadcast( $contests1, $roomid, 'ny28');
        }
        if($ny28time == $ny28js){
            Broadcast( $contests2, $roomid, 'ny28');
        }
        if($msg1_cont != "" && $ny28js == $msg1){
            Broadcast($msg1_cont, $roomid, 'ny28');
        }
        if($msg2_cont != "" && $ny28js == $msg2){
            Broadcast($msg2_cont, $roomid, 'ny28');
        }
        if($msg3_cont != "" && $ny28js == $msg3){
            Broadcast($msg3_cont, $roomid, 'ny28');
        }
    }
    if($jnd28open){
       $contest1 = str_replace("[期号]",$qishu5,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu5,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($jndtime + 30 == $jnddjs){
            Broadcast( $contests1, $roomid, 'jnd28');
        }
        if($jndtime == $jnddjs){
            Broadcast( $contests2, $roomid, 'jnd28');
        }
        if($msg1_cont != "" && $jnddjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'jnd28');
        }
        if($msg2_cont != "" && $jnddjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'jnd28');
        }
        if($msg3_cont != "" && $jnddjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'jnd28');
        }
    }
    if($jsmtopen){
      $contest1 = str_replace("[期号]",$qishu6,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu6,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($jsmttime + 30 == $jsmtdjs){
            Broadcast( $contests1, $roomid, 'jsmt');
        }
        if($jsmttime == $jsmtdjs){
            Broadcast( $contests2, $roomid, 'jsmt');
        }
        if($msg1_cont != "" && $jsmtdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'jsmt');
        }
        if($msg2_cont != "" && $jsmtdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'jsmt');
        }
        if($msg3_cont != "" && $jsmtdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'jsmt');
        }
    }
    if($jsscopen){
      $contest1 = str_replace("[期号]",$qishu7,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu7,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($jssctime + 30 == $jsscdjs){
            Broadcast( $contests1, $roomid, 'jssc');
        }
        if($jssctime == $jsscdjs){
            Broadcast( $contests2, $roomid, 'jssc');
        }
        if($msg1_cont != "" && $jsscdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'jssc');
        }
        if($msg2_cont != "" && $jsscdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'jssc');
        }
        if($msg3_cont != "" && $jsscdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'jssc');
        }
    }
    if($jssscopen){
      $contest1 = str_replace("[期号]",$qishu8,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu8,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($jsssctime + 30 == $jssscdjs){
            Broadcast( $contests1, $roomid, 'jsssc');
        }
        if($jsssctime == $jssscdjs){
            Broadcast( $contests2, $roomid, 'jsssc');
        }
        if($msg1_cont != "" && $jssscdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'jsssc');
        }
        if($msg2_cont != "" && $jssscdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'jsssc');
        }
        if($msg3_cont != "" && $jssscdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'jsssc');
        }
    }
  if($kuai3open){
       $contest1 = str_replace("[期号]",$qishu9,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu9,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($kuai3time + 30 == $kuai3djs){
            Broadcast( $contests1, $roomid, 'kuai3');
        }
        if($kuai3time == $kuai3djs){
            Broadcast( $contests2, $roomid, 'kuai3');
        }
        if($msg1_cont != "" && $kuai3djs == $msg1){
            Broadcast($msg1_cont, $roomid, 'kuai3');
        }
        if($msg2_cont != "" && $kuai3djs == $msg2){
            Broadcast($msg2_cont, $roomid, 'kuai3');
        }
        if($msg3_cont != "" && $kuai3djs == $msg3){
            Broadcast($msg3_cont, $roomid, 'kuai3');
        }
    }
  if($bjlopen){
       $contest1 = str_replace("[期号]",$qishu10,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu10,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($bjltime + 30 == $bjldjs){
            Broadcast( $contests1, $roomid, 'bjl');
        }
        if($bjltime == $bjldjs){
            Broadcast( $contests2, $roomid, 'bjl');
        }
        if($msg1_cont != "" && $bjldjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'bjl');
        }
        if($msg2_cont != "" && $bjldjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'bjl');
        }
        if($msg3_cont != "" && $bjldjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'bjl');
        }
    }
  if($gdx5open){
       $contest1 = str_replace("[期号]",$qishu11,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu11,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($gdx5time + 30 == $gdx5djs){
            Broadcast( $contests1, $roomid, 'gd11x5');
        }
        if($gdx5time == $gdx5djs){
            Broadcast( $contests2, $roomid, 'gd11x5');
        }
        if($msg1_cont != "" && $gdx5djs == $msg1){
            Broadcast($msg1_cont, $roomid, 'gd11x5');
        }
        if($msg2_cont != "" && $gdx5djs == $msg2){
            Broadcast($msg2_cont, $roomid, 'gd11x5');
        }
        if($msg3_cont != "" && $gdx5djs == $msg3){
            Broadcast($msg3_cont, $roomid, 'gd11x5');
        }
    }
   if($jssmopen){
       $contest1 = str_replace("[期号]",$qishu12,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu12,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($jssmtime + 30 == $jssmdjs){
            Broadcast( $contests1, $roomid, 'jssm');
        }
        if($jssmtime == $jssmdjs){
            Broadcast( $contests2, $roomid, 'jssm');
        }
        if($msg1_cont != "" && $jssmdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'jssm');
        }
        if($msg2_cont != "" && $jssmdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'jssm');
        }
        if($msg3_cont != "" && $jssmdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'jssm');
        }
    }
   if($lhcopen){
       $contest1 = str_replace("[期号]",$qishu13,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu13,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($lhctime + 30 == $lhcdjs){
            Broadcast( $contests1, $roomid, 'lhc');
        }
        if($lhctime == $lhcdjs){
            Broadcast( $contests2, $roomid, 'lhc');
        }
        if($msg1_cont != "" && $lhcdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'lhc');
        }
        if($msg2_cont != "" && $lhcdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'lhc');
        }
        if($msg3_cont != "" && $lhcdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'lhc');
        }
    }
   if($jslhcopen){
       $contest1 = str_replace("[期号]",$qishu14,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu14,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($jslhctime + 30 == $jslhcdjs){
            Broadcast( $contests1, $roomid, 'jslhc');
        }
        if($jslhctime == $jslhcdjs){
            Broadcast( $contests2, $roomid, 'jslhc');
        }
        if($msg1_cont != "" && $jslhcdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'jslhc');
        }
        if($msg2_cont != "" && $jslhcdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'jslhc');
        }
        if($msg3_cont != "" && $jslhcdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'jslhc');
        }
    }
     if($twk3open){
       $contest1 = str_replace("[期号]",$qishu15,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu15,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($twk3time + 30 == $twk3djs){
            Broadcast( $contests1, $roomid, 'twk3');
        }
        if($twk3time == $twk3djs){
            Broadcast( $contests2, $roomid, 'twk3');
        }
        if($msg1_cont != "" && $twk3djs == $msg1){
            Broadcast($msg1_cont, $roomid, 'twk3');
        }
        if($msg2_cont != "" && $twk3djs == $msg2){
            Broadcast($msg2_cont, $roomid, 'twk3');
        }
        if($msg3_cont != "" && $twk3djs == $msg3){
            Broadcast($msg3_cont, $roomid, 'twk3');
        }
    }
  if($txffcopen){
       $contest1 = str_replace("[期号]",$qishu16,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu16,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($txffctime + 30 == $txffcdjs){
            Broadcast( $contests1, $roomid, 'txffc');
        }
        if($txffctime == $txffcdjs){
            Broadcast( $contests2, $roomid, 'txffc');
        }
        if($msg1_cont != "" && $txffcdjs == $msg1){
            Broadcast($msg1_cont, $roomid, 'txffc');
        }
        if($msg2_cont != "" && $txffcdjs == $msg2){
            Broadcast($msg2_cont, $roomid, 'txffc');
        }
        if($msg3_cont != "" && $txffcdjs == $msg3){
            Broadcast($msg3_cont, $roomid, 'txffc');
        }
    }
  if($azxy10open){
       $contest1 = str_replace("[期号]",$qishu17,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu17,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($azxy10time + 70 == $azxy10djs){
            Broadcast( $contests1, $roomid, 'azxy10');
        }
        if($azxy10time == $azxy10djs){
            Broadcast( $contests2, $roomid, 'azxy10');
        }
        if($msg1_cont != "" && $azxy10djs == $msg1){
            Broadcast($msg1_cont, $roomid, 'azxy10');
        }
        if($msg2_cont != "" && $azxy10djs == $msg2){
            Broadcast($msg2_cont, $roomid, 'azxy10');
        }
        if($msg3_cont != "" && $azxy10djs == $msg3){
            Broadcast($msg3_cont, $roomid, 'azxy10');
        }
    }
  if($azxy5open){
       $contest1 = str_replace("[期号]",$qishu18,$daojishi);
       $contests1 = str_replace("[换行]","<br>",$contest1);
       $contest2 = str_replace("[期号]",$qishu18,$fengpanxiaoxi);
       $contests2 = str_replace("[换行]","<br>",$contest2);
        if($azxy5time + 30 == $azxy5djs){
            Broadcast( $contests1, $roomid, 'azxy5');
        }
        if($azxy5time == $azxy5djs){
            Broadcast( $contests2, $roomid, 'azxy5');
        }
        if($msg1_cont != "" && $azxy5djs == $msg1){
            Broadcast($msg1_cont, $roomid, 'azxy5');
        }
        if($msg2_cont != "" && $azxy5djs == $msg2){
            Broadcast($msg2_cont, $roomid, 'azxy5');
        }
        if($msg3_cont != "" && $azxy5djs == $msg3){
            Broadcast($msg3_cont, $roomid, 'azxy5');
        }
    }
}
usleep(456000);
echo '封 - 盤 - 播 - 报 - 中...'

//echo "腾讯分分彩倒计时:" . $txffcdjs . '<br>' ."澳洲幸运10倒计时:" . $azxy10djs . '<br>' ."河内5分彩倒计时:" . $azxy5djs . '<br>' ."PK10倒计时:" . $pkdjs . '<br>' . '幸运飞艇倒计时:' . $xyftdjs . '|' . $xyfttime . '<br>' . '重庆时时彩倒计时:' . $cqsscdjs . '<br>' . '新加坡28倒计时:' . $pcdjs . '<br>' . '加拿大28倒计时:' . $jnddjs . '<br>' . '极速摩托倒计时:' . $jsmtdjs . '<br>' . '极速赛车倒计时:' . $jsscdjs . '<br>' . '极速时时彩倒计时:' . $jssscdjs.'<br>'.'江苏快三倒计时:'.$kuai3djs.'<br>'.'百家乐倒计时:'.$bjldjs.'<br>'.'广东11选5倒计时:'.$gdx5djs.'<br>'.'极速赛马倒计时:'.$jssmdjs.'<br>'.'六合彩倒计时:'.$lhcdjs.'<br>'.'极速六合彩倒计时:'.$jslhcdjs.'<br>'.'台湾快三倒计时:'.$twk3djs.'<br>';
/*
//zepto 20171013
echo '<br>';
echo "系统当前时间戳为:";
echo "";
echo time();
//<!--JS 页面自动刷新 -->
 echo ("<script type=\"text/javascript\">");
 echo ("function fresh_page()");    
 echo ("{");
 echo ("window.location.reload();");
 echo ("}"); 
 echo ("setTimeout('fresh_page()',1000);");      
 echo ("</script>");
 */
?>