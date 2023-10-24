<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$type = $_GET['t'];

if($type == 'getuser2'){
	$time = $_GET['time'];
    $time = explode(' - ', $time);
    $arr = array();
   
    select_query("fn_marklog", '*', "roomid = '{$_SESSION['agent_room']}' and content = '系统退水' and (addtime between '{$time[0]}' and '{$time[1]}')");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
      
      //$username=get_query_val('fn_user','id,username',"userid = '{$con['userid']}'");
      select_query('fn_user','id,username,bzname',"userid = '{$con['userid']}'");
		$con2 = db_fetch_array();
        switch($con['tuishui']){
		case 'liushui': $tuishui = '流水';
			break;
		case "kuisun": $tuishui = '亏损';
			break;
		case "yingli": $tuishui = '盈利';
			break;
		case "shangfen": $tuishui = '上分';
			break;
		case "xiafen": $tuishui = '下分';
			break;
		}
		$arr['data'][] = array($con2['id'], $con2['username'], $con2['bzname'], $tuishui, $con['money'], $con['addtime']);
    }
    echo json_encode($arr);
	
}

if($type == 'getuser'){
    $time = $_GET['time'];
    $time = explode(' - ', $time);
    $arr = array();
    select_query("fn_user", '*', "roomid = '{$_SESSION['agent_room']}' and jia = 'false'");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
      
      $sf = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and type = '上分' and status = '已处理' and (time between '{$time[0]}' and '{$time[1]}')");
      $xf = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and type = '下分' and status = '已处理' and (time between '{$time[0]}' and '{$time[1]}')");
      //北京赛车
	  if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $allm = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $allz =      get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$allm = (int)0;$allz = '0.00';}
	  //幸运飞艇
      if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
		$allm1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $allz1 =      get_query_val('fn_flyorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$allm1 = (int)0;$allz1 = '0.00';}  
	  //重庆时时彩
      if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $sscm = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $sscz =      get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$sscm = (int)0;$sscz = '0.00';}  
	  //极速赛车
      if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $jsscm = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $jsscz =      get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$jsscm = (int)0;$jsscz = '0.00';}  
      //香港六合彩
      if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $lhcm = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $lhcz =      get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$lhcm = (int)0;$lhcz = '0.00';}
      //极速六合彩
      if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $jslhcm = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $jslhcz =      get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$jslhcm = (int)0;$jslhcz = '0.00';}
	  //腾讯分分彩
      if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $txffcm = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $txffcz =      get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$txffccm = (int)0;$txffcz = '0.00';}  
	  //澳洲幸运十
      if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $azxy10m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $azxy10z =      get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$azxy10m = (int)0;$azxy10z = '0.00';}  
	  //澳洲幸运五
      if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $azxy5m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $azxy5z =      get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$azxy5m = (int)0;$azxy5z = '0.00';}  
      //百家乐
      if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $bjlm = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $bjlz =      get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$bjlm = (int)0;$bjlz = '0.00';}
	  //北京28
      /*if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $pcm = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $pcz =      get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$pcm = (int)0;$pcz = '0.00';}  */
	  //极速摩托
      /*if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $mtm = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $mtz =      get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$mtm = (int)0;$mtz = '0.00';}  */
	  //极速时时彩
      /*if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $jssscm = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $jssscz =      get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$jssscm = (int)0;$jssscz = '0.00';}*/
      //江苏快3
      /*if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $kuai3m = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $kuai3z =      get_query_val('fn_k3order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$kuai3m = (int)0;$kuai3z = '0.00';}*/
      //广东11选5
      /*if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $gdx5m = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $gdx5z =      get_query_val('fn_11x5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$gdx5m = (int)0;$gdx5z = '0.00';}*/
      //极速赛马
      /*if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
        $jssmm = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
        $jssmz =      get_query_val('fn_smorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
      }else{$jssmm = (int)0;$jssmz = '0.00';}*/

        $sscyk = $sscz - $sscm;
        $jssscyk = $jssscz - $jssscm;
        $jsscyk = $jsscz - $jsscm;
        $mtyk = $mtz - $mtm;
        $pcyk = $pcz - $pcm;
        $yk = $allz - $allm;
		$yk1 = $allz1 - $allm1;
      
        $kuai3yk = $kuai3z - $kuai3m;
        $bjlyk = $bjlz - $bjlm;  
        $gdx5yk = $gdx5z - $gdx5m;
        $jssmyk = $jssmz - $jssmm;
        $lhcyk = $lhcz - $lhcm;
        $jslhcyk = $jslhcz - $jslhcm;  
		
		
		$txffck = $txffcz-$txffcm;
		$azxy10k = $azxy10z-$azxy10m;
		$azxy5k = $azxy5z-$azxy5m;
      
        $yk += $yk1 + $pcyk + $mtyk + $sscyk + $jsscyk + $jssscyk + $kuai3yk + $bjlyk + $gdx5yk + $jssmyk + $lhcyk + $jslhcyk + $txffck + $azxy10k + $azxy5k;
        $allm += $allm1 + $pcm + $mtm + $sscm + $jsscm + $jssscm  + $kuai3m + $bjlm + $gdx5m + $jssmm + $lhcm + $jslhcm+$txffcm+$azxy10m+$azxy5m;
      
        $yk = sprintf("%.2f", substr(sprintf("%.3f", $yk), 0, -2));
        $arr['data'][] = array($con['id'], $con['username'], $con['bzname'], $sf, $xf, $yk, $allm);
    }
    echo json_encode($arr);
}elseif($type == 'onetui'){
    $time = $_POST['time'];
    $mode = $_POST['mode'];
    $plan1 = $_POST['plan1'];
    $plan1s = $_POST['plan1s'];
    $plan2 = $_POST['plan2'] == '-' ? '': $_POST['plan2'];
    $plan2s = $_POST['plan2s'];
    $plan3 = $_POST['plan3'] == '-' ? '': $_POST['plan3'];
    $plan3s = $_POST['plan3s'];
    if($plan1 != '' && $plan1s != ''){
        $plan1 = explode('-', $plan1);
        $plan1s = $plan1s / 100;
        if($plan2 != '' && $plan2s != ''){
            $plan2 = explode('-', $plan2);
            $plan2s = $plan2s / 100;
        }
        if($plan3 != '' && $plan3s != ''){
            $plan3 = explode('-', $plan3);
            $plan3s = $plan3s / 100;
        }
    }else{
        echo json_encode(array("success" => false, "msg" => "方案没有填写!!"));
        exit();
    }
    $arr = array();
    switch($mode){
    case 'liushui': $arr['mode'] = '流水';
        break;
    case "kuisun": $arr['mode'] = '亏损';
        break;
    case "yingli": $arr['mode'] = '盈利';
        break;
    case "shangfen": $arr['mode'] = '上分';
        break;
    case "xiafen": $arr['mode'] = '下分';
        break;
    }
    select_query("fn_user", '*', "roomid = '{$_SESSION['agent_room']}' and jia = 'false'");
    while($con = db_fetch_array()){
    $cons[] = $con;
}
foreach($cons as $con){
    switch($mode){
    case 'liushui': 
        if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'pk10,';
        $liushui = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui = (int)0;}
        if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'xyft,';
	    $liushui += (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'cqssc,';
        $liushui += (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'pc28,';
        $liushui += (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jsmt,';
        $liushui += (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jssc,';
        $liushui += (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jsssc,';
        $liushui += (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'kuai3,';
        $liushui += (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'bjl,';
        $liushui += (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'gdx5,';
        $liushui += (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jssm,';
        $liushui += (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'lhc,';
        $liushui += (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jslhc,';
        $liushui += (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
		if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'txffc,';
        $liushui += (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'azxy10,';
        $liushui += (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
        if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'azxy5,';
        $liushui += (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        }else{$liushui += (int)0;}
		
        if(($liushui > $plan1[0] && $liushui < $plan1[1]) && $plan1s != ''){
            $tui = $liushui * $plan1s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'liushui');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }elseif(($liushui > $plan2[0] && $liushui < $plan2[1]) && $plan2s != ''){
            $tui = $liushui * $plan2s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'liushui');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }elseif(($liushui > $plan3[0] && $liushui < $plan3[1]) && $plan3s != ''){
            $tui = $liushui * $plan3s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'liushui');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }else{
            continue;
        }
        break;
    case "kuisun":
        if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'pk10,';
	    $m = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}  
        $yk = $z - $m;
        if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'xyft,';
		$m = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}   
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
          $game .= 'cqssc,';
        $m = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}   
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
          $game .= 'pc28,';
        $m = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}   
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
          $game .= 'jsmt,';
        $m = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}   
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
          $game .= 'jssc,';
        $m = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}   
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'jsssc';
        $m = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'kuai3';
        $m = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'bjl';
        $m = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'gdx5';
        $m = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'jssm';
        $m = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_smorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'lhc';
        $m = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'jslhc';
        $m = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
		
        if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'txffc';
        $m = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'azxy10';
        $m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'azxy5';
        $m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if($yk < 0){
            $yk = abs($yk);
            if(($yk > $plan1[0] && $yk < $plan1[1]) && $plan1s != ''){
                $tui = $yk * $plan1s;
                用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'kuisun');
                $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
                continue;
            }elseif(($yk > $plan2[0] && $yk < $plan2[1]) && $plan2s != ''){
                $tui = $yk * $plan2s;
                用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'kuisun');
                $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
                continue;
            }elseif(($yk > $plan3[0] && $yk < $plan3[1]) && $plan3s != ''){
                $tui = $yk * $plan3s;
                用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'kuisun');
                $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
                continue;
            }else{
                continue;
            }
        }
        break;
    case "yingli": 
        if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'pk10,';
	    $m = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $z - $m;
        if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'xyft,';
		$m = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'cqssc,';
        $m = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'pc28,';
        $m = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jsmt,';
        $m = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jssc,';
        $m = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jsssc';
        $m = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        
        if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'kuai3';
        $m = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'bjl';
        $m = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'gdx5';
        $m = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jssm';
        $m = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_smorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'lhc';
        $m = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
          $game .= 'jslhc';
        $m = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';} 
        $yk = $yk + ($z - $m);
		
        if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'txffc';
        $m = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'azxy10';
        $m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
          $game .= 'azxy5';
        $m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')  and (status > 0 or status < 0)");
        $z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59') and status > 0 and userid = '{$con['userid']}'");
        }else{$m=(int)0;$z = '0.00';}
        $yk = $yk + ($z - $m);
        if($yk > 0){
            if(($yk > $plan1[0] && $yk < $plan1[1]) && $plan1s != ''){
                $tui = $yk * $plan1s;
                用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'yingli');
                $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
                continue;
            }elseif(($yk > $plan2[0] && $yk < $plan2[1]) && $plan2s != ''){
                $tui = $yk * $plan2s;
                用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'yingli');
                $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
                continue;
            }elseif(($yk > $plan3[0] && $yk < $plan3[1]) && $plan3s != ''){
                $tui = $yk * $plan3s;
                用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time,$game,'yingli');
                $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
                continue;
            }else{
                continue;
            }
        }
        break;
    case "shangfen": $liushui = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and type = '上分' and status = '已处理' and (`time` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        $game = '';
        if(($liushui > $plan1[0] && $liushui < $plan1[1]) && $plan1s != ''){
            $tui = $liushui * $plan1s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time, $game,'shangfen');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }elseif(($liushui > $plan2[0] && $liushui < $plan2[1]) && $plan2s != ''){
            $tui = $liushui * $plan2s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time, $game,'shangfen');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }elseif(($liushui > $plan3[0] && $liushui < $plan3[1]) && $plan3s != ''){
            $tui = $liushui * $plan3s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time, $game,'shangfen');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }else{
            continue;
        }
        break;
    case "xiafen": $liushui = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and type = '下分' and status = '已处理' and (`time` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        $game = '';
        if(($liushui > $plan1[0] && $liushui < $plan1[1]) && $plan1s != ''){
            $tui = $liushui * $plan1s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time, $game,'xiafen');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }elseif(($liushui > $plan2[0] && $liushui < $plan2[1]) && $plan2s != ''){
            $tui = $liushui * $plan2s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time, $game,'xiafen');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }elseif(($liushui > $plan3[0] && $liushui < $plan3[1]) && $plan3s != ''){
            $tui = $liushui * $plan3s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time, $game,'xiafen');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
            continue;
        }else{
            continue;
        }
        break;
    }
}
$arr['success'] = true;
echo json_encode($arr);
exit();
}elseif($type == 'twotui'){
$time = $_POST['time'];
$time = explode(' - ', $time);
$mode = $_POST['mode'];
$plan1 = $_POST['plan1'];
$plan1s = $_POST['plan1s'];
$plan2 = $_POST['plan2'] == '-' ? '': $_POST['plan2'];
$plan2s = $_POST['plan2s'];
$plan3 = $_POST['plan3'] == '-' ? '': $_POST['plan3'];
$plan3s = $_POST['plan3s'];
if($plan1 != '' && $plan1s != ''){
    $plan1 = explode('-', $plan1);
    $plan1s = $plan1s / 100;
    if($plan2 != '' && $plan2s != ''){
        $plan2 = explode('-', $plan2);
        $plan2s = $plan2s / 100;
    }
    if($plan3 != '' && $plan3s != ''){
        $plan3 = explode('-', $plan3);
        $plan3s = $plan3s / 100;
    }
}else{
    echo json_encode(array("success" => false, "msg" => "方案没有填写!!"));
    exit();
}
$arr = array();
switch($mode){
case 'liushui': $arr['mode'] = '流水';
    break;
case "kuisun": $arr['mode'] = '亏损';
    break;
case "yingli": $arr['mode'] = '盈利';
    break;
case "shangfen": $arr['mode'] = '上分';
    break;
case "xiafen": $arr['mode'] = '下分';
    break;
}
select_query("fn_user", '*', "roomid = '{$_SESSION['agent_room']}' and jia = 'false'");
while($con = db_fetch_array()){
$cons[] = $con;
}
foreach($cons as $con){
switch($mode){
case 'liushui': 
    if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'pk10,';
    $liushui = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui = (int)0;}
    if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'xyft,';
    $liushui += (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){ 
      $game .= 'pc28,';
    $liushui += (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'jsmt,';
    $liushui += (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'cqssc,';
    $liushui += (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jssc,';
    $liushui += (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jsssc';
    $liushui += (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    
    if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'kuai3';
    $liushui += (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'bjl';
    $liushui += (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'gdx5';
    $liushui += (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jssm';
    $liushui += (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}    
    if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'lhc';
    $liushui += (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jslhc';
    $liushui += (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'txffc';
    $liushui += (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'azxy10';
    $liushui += (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
    if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'azxy5';
    $liushui += (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    }else{$liushui += (int)0;}
	
    if(($liushui > $plan1[0] && $liushui < $plan1[1]) && $plan1s != ''){
        $tui = $liushui * $plan1s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'liushui');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }elseif(($liushui > $plan2[0] && $liushui < $plan2[1]) && $plan2s != ''){
        $tui = $liushui * $plan2s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'liushui');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }elseif(($liushui > $plan3[0] && $liushui < $plan3[1]) && $plan3s != ''){
        $tui = $liushui * $plan3s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'liushui');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }else{
        continue;
    }
    break;
case "kuisun": 
    if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'pk10,';
    $m = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}     
    $yk = $z - $m;
    if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'xyft,';
	$m = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'pc28,';
    $m = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'jsmt,';
    $m = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'cqssc,';
    $m = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'jssc,';
    $m = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'jsssc';
    $m = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    
        if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'kuai3';
    $m = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'bjl';
    $m = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'gdx5';
    $m = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'jssm';
    $m = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_smorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'lhc';
    $m = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'jslhc';
    $m = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'ffc';
    $m = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'azxy10';
    $m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'azxy5';
    $m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);

    if($yk < 0){
        $yk = abs($yk);
        if(($yk > $plan1[0] && $yk < $plan1[1]) && $plan1s != ''){
            $tui = $yk * $plan1s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'kuisun');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
            continue;
        }elseif(($yk > $plan2[0] && $yk < $plan2[1]) && $plan2s != ''){
            $tui = $yk * $plan2s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'kuisun');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
            continue;
        }elseif(($yk > $plan3[0] && $yk < $plan3[1]) && $plan3s != ''){
            $tui = $yk * $plan3s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'kuisun');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
            continue;
        }else{
            continue;
        }
    }
    break;
case "yingli": 
    if(get_query_val('fn_lottery1','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'pk10,';
    $m = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $z - $m;
    if(get_query_val('fn_lottery2','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'xyft,';
	$m = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery4','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'pc28,';
    $m = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery6','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jsmt,';
    $m = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery3','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'cqssc,';
    $m = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery7','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jssc,';
    $m = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery8','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jsssc';
    $m = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    
    if(get_query_val('fn_lottery9','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'kuai3';
    $m = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery10','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'bjl';
    $m = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery11','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'gdx5';
    $m = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery12','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jssm';
    $m = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_smorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery13','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'lhc';
    $m = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery14','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){
      $game .= 'jslhc';
    $m = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery16','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'ffc';
    $m = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery17','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'azxy10';
    $m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    if(get_query_val('fn_lottery18','fanshui',"roomid = '{$_SESSION['agent_room']}'") == 'true'){  
      $game .= 'azxy5';
    $m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['agent_room']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$con['userid']}'");
    }else{$m=(int)0;$z = '0.00';}  
    $yk = $yk + ($z - $m);
    
    if($yk > 0){
        if(($yk > $plan1[0] && $yk < $plan1[1]) && $plan1s != ''){
            $tui = $yk * $plan1s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'yingli');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
            continue;
        }elseif(($yk > $plan2[0] && $yk < $plan2[1]) && $plan2s != ''){
            $tui = $yk * $plan2s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'yingli');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
            continue;
        }elseif(($yk > $plan3[0] && $yk < $plan3[1]) && $plan3s != ''){
            $tui = $yk * $plan3s;
            用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'yingli');
            $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $yk, 'money' => $tui);
            continue;
        }else{
            continue;
        }
    }
    break;
case "shangfen": $liushui = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and type = '上分' and status = '已处理' and (`time` between '{$time[0]}' and '{$time[1]}')");
    $game = '';
    if(($liushui > $plan1[0] && $liushui < $plan1[1]) && $plan1s != ''){
        $tui = $liushui * $plan1s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'shangfen');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }elseif(($liushui > $plan2[0] && $liushui < $plan2[1]) && $plan2s != ''){
        $tui = $liushui * $plan2s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'shangfen');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }elseif(($liushui > $plan3[0] && $liushui < $plan3[1]) && $plan3s != ''){
        $tui = $liushui * $plan3s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'shangfen');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }else{
        continue;
    }
    break;
case "xiafen": $liushui = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['agent_room']}' and userid = '{$con['userid']}' and type = '下分' and status = '已处理' and (`time` between '{$time[1]}' and '{$time[0]}')");
    $game = '';
    if(($liushui > $plan1[0] && $liushui < $plan1[1]) && $plan1s != ''){
        $tui = $liushui * $plan1s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'xiafen');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }elseif(($liushui > $plan2[0] && $liushui < $plan2[1]) && $plan2s != ''){
        $tui = $liushui * $plan2s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'xiafen');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }elseif(($liushui > $plan3[0] && $liushui < $plan3[1]) && $plan3s != ''){
        $tui = $liushui * $plan3s;
        用户_上分($con['userid'], $tui, $_SESSION['agent_room'], $time[0] . ' - ' . $time[1], $game, 'xiafen');
        $arr['tuidata'][] = array('username' => $con['username'], 'bzname' => $con['bzname'], 'id' => $con['id'], 'mode' => $liushui, 'money' => $tui);
        continue;
    }else{
        continue;
    }
    break;
}
}
$arr['success'] = true;
echo json_encode($arr);
exit();
}
function 用户_上分($Userid, $Money, $room, $time,$game,$leixing){
update_query('fn_user', array('money' => '+=' . $Money), array('userid' => $Userid, 'roomid' => $room));
insert_query("fn_marklog", array("roomid" => $room, 'userid' => $Userid, 'type' => '上分', 'content' => '系统退水', 'money' => $Money, 'addtime' => 'now()','tuitime' => $time, 'game' => $game, 'tuishui' => $leixing));
}
?>