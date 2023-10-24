<?php
 function getSign_status($sing_time='')
{
    global $mydb;
    if (!$sing_time) {
       return false;
    } 
    $s_userid = $_SESSION['userid'];
  
    if (empty($s_userid)) {
       
        return false;
        
    }   
    if (intval($sing_time) <10) {
        $sing_time=sprintf ( "%02d",intval($sing_time));
    } 
    $sing_time =date("Ym" . $sing_time . ""); 
    $r = $mydb->table('fn_sign')->field('*')->where(array('userid' => $s_userid,'sing_time'=>$sing_time))->find();
    //return $sing_time;
    //get_query_vals('fn_sign', '*', array('userid' => $s_userid,'sing_time'=>$sing_time));//
    //$r =  select_query("fn_sign", '*', "`userid` = '{$s_userid}' and `sing_time` = '{$sing_time}' ");

    if ($r) {
        return $r;
    }

    return false;
}

/**
 * 
 */
function get_weeks($time = '', $format='Ymd'){
    global $mydb;
    $s_userid = $_SESSION['userid'];
   if (empty($s_userid)) {
        return array();
    }
  $time = $time != '' ? $time : time();
  //组合数据
  $date = [];
  for ($i=1; $i<=7; $i++){
    $date[$i] = date($format ,strtotime( '+' . $i-7 .' days', $time));
  }
 // $lx_day = date('Ymd');
  $day_ok =array();
    arsort($date);
    unset($date[count($date)]);
  foreach ($date as $key => $value) {

   $r =$mydb->table('fn_sign')->field('*')->where(array('userid' => $s_userid,'sing_time'=>$date[$key]))->find();// get_query_vals('fn_sign', '*', array('userid' => $s_userid,'sing_time'=>$date[$key]));//
    // $r =  select_query("fn_sign", '*', "`userid` = '{$s_userid}' and `sing_time` = '{$date[$key]}' ");
      if (empty($r)) {
       
      // $lx_day=$date[$key]; 
       return $day_ok;
       
    }else{
        $day_ok[$key]=$date[$key];
    }
  } 
 return $day_ok;
}
function getSign($row,$userid) {
    $t = $row + 1;
    if ($t > date('d')) {
        $td = "<td style='background-color:lemonchiffon' valign='top'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span>
</div><div align='left'> </div><div align='left'> </div></td>";
    } else {
        if (strlen($t) == 1) {
            $day = "0" . $t;
        } else {
            $day = $t;
        }
        $t2 = strtotime(date("Y-m-" . $day . ""));
        //$info = M("sign")->field("id")->where("addtime = " . $t2 . " AND status = 0 AND uid = " . session('userid') . "")->find();
$info = get_query_val('fn_sign', 'id', "addtime = '{$t2}' AND status = 0 AND uid ='{$userid}'");

        if ($info) {
            $td = "<td style='background-color:navajowhite;navajowhite ;'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span>
</div><div align='left'>
<img width='35px' height='35px' src='images/other/cart_3.gif' style='position:relative;left:10px;'> 已签到
</div></td>";
        } else {
            if ($t == date('d')) {
                $td = "<td  class='today' onclick='signDay($(this))'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span></div>
<div align='center'><a style='cursor:pointer;color:#ffffff;' >签到</a></div></td>";
            } else {
                $td = "<td style='background-color:#DCDCDC;'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span>
</div><div align='left'style='height:47px'>
</div></td>";
            }
        }
    }
    return $td;
}



function getinfo($userid) {
    $time = array();
    $time[0] = date('Y-m-d') . " 00:00:00";
    $time[1] = date('Y-m-d') . " 23:59:59";
    $sf = (int) get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and type = '上分' and status = '已处理' and (time between '{$time[0]}' and '{$time[1]}')");
    $xf = (int) get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and type = '下分' and status = '已处理' and (time between '{$time[0]}' and '{$time[1]}')");
    $allm = (int) get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $allz = get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $sscm = (int) get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $pcm = (int) get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $mtm = (int) get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $jsscm = (int) get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $jssscm = (int) get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
     $bjlm = (int) get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}' and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    
    $bjlyk = $bjlz - $bjlm;
    $sscyk = $sscz - $sscm;
    
    
    $sscyk = $sscz - $sscm;
    $jssscyk = $jssscz - $jssscm;
    $jsscyk = $jsscz - $jsscm;
    $mtyk = $mtz - $mtm;
    $pcyk = $pcz - $pcm;
    $yk = $allz - $allm;
    $yk += $pcyk + $mtyk + $sscyk + $jsscyk + $jssscyk+$bjlyk;
    $allm += $pcm + $mtm + $sscm + $jsscm + $jssscm+ $bjlm;
    $yk = round($yk, 2);
    return array("yk" => $yk, 'liu' => $allm);
}

?>