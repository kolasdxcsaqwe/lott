<?php
 function 用户_上分($Userid, $Money, $room, $game, $term, $content){
    update_query('fn_user', array('money' => '+=' . $Money), array('userid' => $Userid, 'roomid' => $room));
    insert_query("fn_marklog", array("userid" => $Userid, 'type' => '上分', 'content' => $term . '期' . $game . '中奖派彩' . $content, 'money' => $Money, 'roomid' => $room, 'addtime' => 'now()'));
}



function JSLHC_jiesuan($roomid){
    select_query("fn_jslhcorder", '*', array("status" => "未结算",'roomid' => $roomid));
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
		// term期号 zym_1上面 zym_8下面 zym_7金额 zym_11中奖后的金额 peilv赔率
				$shengxiao = array(
			1=>'兔', 13=>'兔', 25=>'兔', 37=>'兔', 49=>'兔', 
			12=>'龙', 24=>'龙', 36=>'龙', 48=>'龙', 
			11=>'蛇', 23=>'蛇', 35=>'蛇', 47=>'蛇', 
			10=>'马', 22=>'马', 34=>'马', 46=>'马', 
			9=>'羊', 21=>'羊', 33=>'羊', 45=>'羊',
			8=>'猴', 20=>'猴', 32=>'猴', 44=>'猴',
			7=>'鸡', 19=>'鸡', 31=>'鸡', 43=>'鸡',
			6=>'狗', 18=>'狗', 30=>'狗', 42=>'狗',
			5=>'猪', 17=>'猪', 29=>'猪', 41=>'猪',
			4=>'鼠', 16=>'鼠', 28=>'鼠', 40=>'鼠',
			3=>'牛', 15=>'牛', 27=>'牛', 39=>'牛',
			2=>'虎', 14=>'虎', 26=>'虎', 38=>'虎',
		);
		$sebo = array(
			'1'=>'红波','2'=>'红波','7'=>'红波','8'=>'红波','12'=>'红波','13'=>'红波','18'=>'红波','19'=>'红波','23'=>'红波','24'=>'红波','29'=>'红波','30'=>'红波','34'=>'红波','35'=>'红波','40'=>'红波','45'=>'红波','46'=>'红波',
			'3'=>'蓝波','4'=>'蓝波','9'=>'蓝波','10'=>'蓝波','14'=>'蓝波','15'=>'蓝波','20'=>'蓝波','25'=>'蓝波','26'=>'蓝波','31'=>'蓝波','36'=>'蓝波','37'=>'蓝波','41'=>'蓝波','42'=>'蓝波','47'=>'蓝波','48'=>'蓝波',
			'5'=>'绿波','6'=>'绿波','11'=>'绿波','16'=>'绿波','17'=>'绿波','21'=>'绿波','22'=>'绿波','27'=>'绿波','28'=>'绿波','32'=>'绿波','33'=>'绿波','38'=>'绿波','39'=>'绿波','43'=>'绿波','44'=>'绿波','49'=>'绿波'
		);
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_1 = $con['mingci'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];
        $table = 'fn_lottery14';
        $game = '极速六合彩';
        $gametype = '14';
        $opencode = get_query_val('fn_sopen', 'code', "`term` = '$term' and `type` = '$gametype' and `roomid` = '$roomid'");
        if($opencode == "")continue;
        $code = explode(',', $opencode);
		if($zym_8 == '大'){
			if($code[$zym_1-1] >= 25 && $code[$zym_1-1] <= 48){
				$peilv = get_query_val($table, 'da', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		if($zym_8 == '小'){
			if($code[$zym_1-1] <= 24){
				$peilv = get_query_val($table, 'xiao', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		if($zym_8 == '单'){
			if($code[$zym_1-1] % 2 != 0){
				$peilv = get_query_val($table, 'dan', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		if($zym_8 == '双'){
			if($code[$zym_1-1] % 2 == 0){
				$peilv = get_query_val($table, 'shuang', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		//正特码定位竞赛
		if (is_numeric($zym_8)&&is_numeric($zym_1) && $zym_1>=1 && $zym_1<=7){
			if($code[(int)$zym_1-1] == $zym_8){
				$peilv = get_query_val($table, 'haoma', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;	
			}
		}
		//正码竞猜
		if (is_numeric($zym_8)&&$zym_1 == ''){
			if(in_array($zym_8, $code)){
				$peilv = get_query_val($table, 'haoma', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		//正特生肖定位竞猜
		if (($zym_8=='鼠'||$zym_8=='牛'||$zym_8=='虎'||$zym_8=='兔'||$zym_8=='龙'||$zym_8=='蛇'||$zym_8=='马'||$zym_8=='羊'||$zym_8=='猴'||$zym_8=='鸡'||$zym_8=='狗') && $zym_1>=1 && $zym_1<=7){
			if($shengxiao[$code[(int)$zym_1-1]] == $zym_8){
				$peilv = get_query_val($table, 'shengxiao', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif(($zym_8=='猪') && $zym_1>=1 && $zym_1<=7){
          //生肖年  定位竞猜
			if($shengxiao[$code[(int)$zym_1-1]] == $zym_8){
				$peilv = get_query_val($table, 'shengxiaonian', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		//正特生肖(单肖)竞猜
		if((strpos($zym_8,'鼠')!==false||strpos($zym_8,'牛')!==false||strpos($zym_8,'虎')!==false||strpos($zym_8,'兔')!==false||strpos($zym_8,'龙')!==false||strpos($zym_8,'蛇')!==false||strpos($zym_8,'马')!==false||strpos($zym_8,'羊')!==false||strpos($zym_8,'猴')!==false||strpos($zym_8,'鸡')!==false||strpos($zym_8,'狗')!==false) && $zym_1 == ''){
			$_shengxiao = array();
			foreach($code as $v){
				$_shengxiao = $shengxiao[(int)$v];
			}
			if(in_array($zym_8, $_shengxiao)){
				$peilv = get_query_val($table, 'shengxiao', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;	
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif((strpos($zym_8,'猪')!==false) && $zym_1 == ''){
          //生肖年  单肖竞猜
			$_shengxiao = array();
			foreach($code as $v){
				$_shengxiao = $shengxiao[(int)$v];
			}
			if(in_array($zym_8, $_shengxiao)){
				$peilv = get_query_val($table, 'shengxiaonian', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;	
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		//正特码色波竞猜
		if(($zym_8=='红波') && $zym_1>=1 && $zym_1<=7){
			if($sebo[$code[(int)$zym_1-1]] == $zym_8){
				$peilv = get_query_val($table, 'hongbo', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif(($zym_8=='蓝波') && $zym_1>=1 && $zym_1<=7){
			if($sebo[$code[(int)$zym_1-1]] == $zym_8){
				$peilv = get_query_val($table, 'lanbo', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif(($zym_8=='绿波') && $zym_1>=1 && $zym_1<=7){
			if($sebo[$code[(int)$zym_1-1]] == $zym_8){
				$peilv = get_query_val($table, 'lvbo', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		//连肖------------------------------------------------
				if($zym_1=='2肖'){
			foreach($code as $v){
			$_shengxiao[] .= $shengxiao[(int)$v];    
			}
			$zym_8_分割 = 文本_逐字分割($zym_8);
              if(in_array($zym_8_分割[0],$_shengxiao) && in_array($zym_8_分割[1],$_shengxiao)){
              $zhong = true;
              }else{
              $zhong = false;
              }
			if($zhong){
				$peilv = get_query_val($table, 'xiao2', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
              
		}elseif($zym_1=='3肖'){
			foreach($code as $v){
			$_shengxiao[] .= $shengxiao[(int)$v];    
			}
			$zym_8_分割 = 文本_逐字分割($zym_8);
              if(in_array($zym_8_分割[0],$_shengxiao) && in_array($zym_8_分割[1],$_shengxiao) && in_array($zym_8_分割[2],$_shengxiao)){
              $zhong = true;
              }else{
              $zhong = false;
              }
			if($zhong){
				$peilv = get_query_val($table, 'xiao3', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif($zym_1=='4肖'){
			foreach($code as $v){
			$_shengxiao[] .= $shengxiao[(int)$v];    
			}
			$zym_8_分割 = 文本_逐字分割($zym_8);
              if(in_array($zym_8_分割[0],$_shengxiao) && in_array($zym_8_分割[1],$_shengxiao) && in_array($zym_8_分割[2],$_shengxiao) && in_array($zym_8_分割[3],$_shengxiao)){
              $zhong = true;
              }else{
              $zhong = false;
              }
			if($zhong){
				$peilv = get_query_val($table, 'xiao4', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif($zym_1=='5肖'){
			foreach($code as $v){
			$_shengxiao[] .= $shengxiao[(int)$v];    
			}
			$zym_8_分割 = 文本_逐字分割($zym_8);
              if(in_array($zym_8_分割[0],$_shengxiao) && in_array($zym_8_分割[1],$_shengxiao) && in_array($zym_8_分割[2],$_shengxiao) && in_array($zym_8_分割[3],$_shengxiao) && in_array($zym_8_分割[4],$_shengxiao)){
              $zhong = true;
              }else{
              $zhong = false;
              }
			if($zhong){
				$peilv = get_query_val($table, 'xiao5', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
		
		//连码
		if($zym_1=='2中'){
  foreach($code as $v){
			$code1[] .= (int)$v;    
			}
          $zym_8_分割 = explode('.', $zym_8);
				if(in_array($zym_8_分割[0], $code1) && in_array($zym_8_分割[1], $code1)){
			   $zhong = true;	
				}else{
               $zhong = false;
               
                }
			if($zhong){
				$peilv = get_query_val($table, 'zheng2', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif($zym_1=='3中'){
  foreach($code as $v){
			$code1[] .= (int)$v;    
			}
          $zym_8_分割 = explode('.', $zym_8);
			if(in_array($zym_8_分割[0], $code1) && in_array($zym_8_分割[1], $code1) && in_array($zym_8_分割[2], $code1)){
			   $zhong = true;	
				}else{
               $zhong = false;
               
                }
			if($zhong){
				$peilv = get_query_val($table, 'zheng3', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}elseif($zym_1=='4中'){
          
        foreach($code as $v){
			$code1[] .= (int)$v;    
			}
          $zym_8_分割 = explode('.', $zym_8);
			if(in_array($zym_8_分割[0], $code1) && in_array($zym_8_分割[1], $code1) && in_array($zym_8_分割[2], $code1) && in_array($zym_8_分割[3], $code1)){
			   $zhong = true;	
				}else{
               $zhong = false;
           
                }
			if($zhong){
				$peilv = get_query_val($table, 'zheng4', "`roomid` = '$roomid'");
				$zym_11 = $peilv * (int)$zym_7;
				用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}else{
				$zym_11 = '-' . $zym_7;
				update_query("fn_jslhcorder", array("status" => $zym_11), array('id' => $id));
				continue;
			}
		}
        
    }
}




function SM_jiesuan($roomid){
    select_query("fn_smorder", '*', array("status" => "未结算",'roomid' => $roomid));
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_1 = $con['mingci'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];
        $opencode = get_query_val('fn_sopen', 'code', "`term` = '$term' and `type` = '12' and `roomid` = '$roomid'");
        $opencode = str_replace('10', '0', $opencode);
        if($opencode == "")continue;
        $code = explode(',', $opencode);
        if($zym_1 == '1'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[0] > 5 || $code[0] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[0] < 6 && $code[0] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0 && (int)$code[0] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0 && ((int)$code[0] == 6 || (int)$code[0] == 8|| (int)$code[0] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0 && ((int)$code[0] == 2 || (int)$code[0] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0 && (int)$code[0] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery12', '`long`', "`roomid` = '$roomid'");
                if((int)$code[0] > (int)$code[9] && $code[9] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[0] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery12', 'hu', "`roomid` = '$roomid'");
                if((int)$code[0] < (int)$code[9] && $code[0] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[9] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[0]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '2'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[1] > 5 || $code[1] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[1] < 6 && $code[1] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0 && (int)$code[1] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0 && ((int)$code[1] == 6 || (int)$code[1] == 8|| (int)$code[1] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0 && ((int)$code[1] == 4 || (int)$code[1] == 2)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0 && (int)$code[1] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery12', '`long`', "`roomid` = '$roomid'");
                if((int)$code[1] > (int)$code[8] && $code[8] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[1] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery12', 'hu', "`roomid` = '$roomid'");
                if((int)$code[1] < (int)$code[8] && $code[1] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[8] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[1]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '3'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[2] > 5 || $code[2] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[2] < 6 && $code[2] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0 && (int)$code[2] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0 && ((int)$code[2] == 6 || (int)$code[2] == 8|| (int)$code[2] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0 && ((int)$code[2] == 2 || (int)$code[2] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0 && (int)$code[2] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery12', '`long`', "`roomid` = '$roomid'");
                if((int)$code[2] > (int)$code[7] && $code[7] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[2] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery12', 'hu', "`roomid` = '$roomid'");
                if((int)$code[2] < (int)$code[7] && $code[2] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[7] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[2]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '4'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[3] > 5 || $code[3] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[3] < 6 && $code[3] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0 && (int)$code[3] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0 && ((int)$code[3] == 6 || (int)$code[3] == 8|| (int)$code[3] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0 && ((int)$code[3] == 2 || (int)$code[3] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0 && (int)$code[3] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery12', '`long`', "`roomid` = '$roomid'");
                if((int)$code[3] > (int)$code[6] && $code[6] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[3] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery12', 'hu', "`roomid` = '$roomid'");
                if((int)$code[3] < (int)$code[6] && $code[3] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[6] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[3]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '5'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[4] > 5 || $code[4] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[4] < 6 && $code[4] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0 && (int)$code[4] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0 && ((int)$code[4] == 6 || (int)$code[4] == 8|| (int)$code[4] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0 && ((int)$code[4] == 2 || (int)$code[4] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0 && (int)$code[4] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery12', '`long`', "`roomid` = '$roomid'");
                if((int)$code[4] > (int)$code[5] && $code[5] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[4] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery12', 'hu', "`roomid` = '$roomid'");
                if((int)$code[4] < (int)$code[5] && $code[4] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[5] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[4]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '6'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[5] > 5 || $code[5] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[5] < 6 && $code[5] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0 && (int)$code[5] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0 && ((int)$code[5] == 6 || (int)$code[5] == 8|| (int)$code[5] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0 && ((int)$code[5] == 2 || (int)$code[5] ==4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0 && (int)$code[5] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[5]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '7'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[6] > 5 || $code[6] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[6] < 6 && $code[6] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0 && (int)$code[6] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0 && ((int)$code[6] == 6 || (int)$code[6] == 8|| (int)$code[6] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0 && ((int)$code[6] == 2 || (int)$code[6] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0 && (int)$code[6] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[6]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '8'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[7] > 5 || $code[7] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[7] < 6 && $code[7] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0 && (int)$code[7] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0 && ((int)$code[7] == 6 || (int)$code[7] == 8|| (int)$code[7] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0 && ((int)$code[7] == 2 || (int)$code[7] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0 && (int)$code[7] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[7]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '9'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[8] > 5 || $code[8] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[8] < 6 && $code[8] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0 && (int)$code[8] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0 && ((int)$code[8] == 6 || (int)$code[8] == 8|| (int)$code[8] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0 && ((int)$code[8] == 2 || (int)$code[8] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0 && (int)$code[8] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[8]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '0'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'da', "`roomid` = '$roomid'");
                if((int)$code[9] > 5 || $code[9] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[9] < 6 && $code[9] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'dan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery12', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0 && (int)$code[9] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery12', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0 && ((int)$code[9] == 6 || (int)$code[9] == 8|| (int)$code[9] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery12', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0 && ((int)$code[9] == 2 || (int)$code[9] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery12', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0 && (int)$code[9] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[9]){
                $peilv = get_query_val('fn_lottery12', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '和'){
            if((int)$code[0] == 0 || (int)$code[1] == 0){
                $hz = (int)$code[0] + (int)$code[1] + 10;
            }else{
                $hz = (int)$code[0] + (int)$code[1];
            }
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery12', 'heda', "`roomid` = '$roomid'");
                if($hz > 11){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery12', 'hexiao', "`roomid` = '$roomid'");
                if($hz < 12){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery12', 'hedan', "`roomid` = '$roomid'");
                if($hz % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery12', 'heshuang', "`roomid` = '$roomid'");
                if($hz % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif((int)$zym_8 == $hz){
                if($hz == 3 || $hz == 4 || $hz == 18 || $hz == 19){
                    $peilv = get_query_val('fn_lottery12', 'he341819', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 5 || $hz == 6 || $hz == 16 || $hz == 17){
                    $peilv = get_query_val('fn_lottery12', 'he561617', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 7 || $hz == 8 || $hz == 14 || $hz == 15){
                    $peilv = get_query_val('fn_lottery12', 'he781415', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 9 || $hz == 10 || $hz == 12 || $hz == 13){
                    $peilv = get_query_val('fn_lottery12', 'he9101213', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 11){
                    $peilv = get_query_val('fn_lottery12', 'he11', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '香港赛马', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_smorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
    }
}





function BJL_jiesuan($roomid){
	include_once "../../../Public/Bjl_1.php";
	select_query("fn_bjlorder", '*', array("status" => "未结算",'roomid'=>$roomid));
	while ($con = db_fetch_array()) {
		$cons[] = $con;
	}
	$bjl = new Bjl();
	foreach ($cons as $con) {
		$id = $con['id'];
		$roomid = $con['roomid'];
		$user = $con['userid'];
		$term = $con['term'];
		$zym_8 = $con['content'];
		$zym_7 = $con['money'];
		$openType = 10;
		$game = '百家乐';
		$opencode = get_query_val('fn_sopen', 'code', "`term` = '$term' and `type` = '$openType' and `roomid` = '$roomid'");
		$zhuang = get_query_val('fn_lottery10', 'zhuang', array('roomid' => $roomid));
		$xian = get_query_val('fn_lottery10', 'xian', array('roomid' => $roomid));
		$he = get_query_val('fn_lottery10', 'he', array('roomid' => $roomid));
		$zhuang_dui = get_query_val('fn_lottery10', 'zhuangdui', array('roomid' => $roomid));
		$xian_dui = get_query_val('fn_lottery10', 'xiandui', array('roomid' => $roomid));
		$anydui = get_query_val('fn_lottery10', 'anydui', array('roomid' => $roomid));
		$pb = $bjl->getPB($opencode);
		$res = $bjl->Result($pb['p'], $pb['b']);
		if ($zym_8 == '庄' && in_array('BankerWin', $res)) {
			$zym_11 = $zhuang * (int) $zym_7;
			用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
			update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			continue;
		} elseif ($zym_8 == '闲' && in_array('PlayerWin', $res)) {
			$zym_11 = $xian * (int) $zym_7;
			用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
			update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			continue;
		} elseif ($zym_8 == '和' && in_array('Draw', $res)) {
			$zym_11 = $he * (int) $zym_7;
			用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
			update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			continue;
		} elseif ($zym_8 == '庄对' && in_array('BankerPair', $res)) {
			$zym_11 = $zhuang_dui * (int) $zym_7;
			用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
			update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			continue;
		} elseif ($zym_8 == '闲对' && in_array('PlayerPair', $res)) {
			$zym_11 = $xian_dui * (int) $zym_7;
			用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
			update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			continue;
		} elseif ($zym_8 == '任意对' && in_array('AnyPair', $res)) {
			$zym_11 = $anydui * (int) $zym_7;
			用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
			update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			continue;
		} else {
			if (in_array('Draw', $res) && ($zym_8 == '庄' || $zym_8 == '闲')) {
				用户_上分($user, $zym_7, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_bjlorder", array("status" => $zym_7), array('id' => $id));
				//delete_query("fn_bjlorder", array('id' => $id));
			} else {
				$zym_11 = '-' . $zym_7;
				update_query("fn_bjlorder", array("status" => $zym_11), array('id' => $id));
			}
		}
	}
}
  
function JSSSC_jiesuan($roomid){
    select_query("fn_jssscorder", '*', array("status" => "未结算",'roomid'=>$roomid));
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_1 = $con['mingci'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];
        $game = '极速时时彩';
        $opencode = get_query_val('fn_sopen', 'code', "`term` = '$term' and `type` = '8' and `roomid` = '$roomid'");
        if($opencode == "")continue;
        $codes = explode(',', $opencode);
        if(count($codes) != 5){
            echo 'ERROR!';
            exit();
        }else{
            $zym_2 = array('豹子' => false, '半顺' => false, '顺子' => false, '对子' => false, '杂六' => false);
            $q3 = array((int)$codes[0], (int)$codes[1], (int)$codes[2]);
            sort($q3);
            $zym_3 = array('豹子' => false, '半顺' => false, '顺子' => false, '对子' => false, '杂六' => false);
            $z3 = array((int)$codes[1], (int)$codes[2], (int)$codes[3]);
            sort($z3);
            $zym_4 = array('豹子' => false, '半顺' => false, '顺子' => false, '对子' => false, '杂六' => false);
            $h3 = array((int)$codes[2], (int)$codes[3], (int)$codes[4]);
            sort($h3);
            if($codes[0] == $codes[1] && $codes[1] == $codes[2]){
                $zym_2['豹子'] = true;
            }elseif($codes[0] == $codes[1] || $codes[0] == $codes[2] || $codes[1] == $codes[2]){
                $zym_2['对子'] = true;
            }elseif(($q3[0] + 1 == $q3[1] && $q3[1] + 1 == $q3[2]) || ($q3[0] == '0' && $q3[1] == '8' && $q3[2] == '9') || ($q3[0] == '0' && $q3[1] == '1' && $q3[2] == '9')){
                $zym_2['顺子'] = true;
            }elseif(($q3[0] + 1 == $q3[1] || $q3[1] + 1 == $q3[2]) || ($q3[0] == '0' && $q3[2] == '9')){
                $zym_2['半顺'] = true;
            }else{
                $zym_2['杂六'] = true;
            }
            if($codes[1] == $codes[2] && $codes[2] == $codes[3]){
                $zym_3['豹子'] = true;
            }elseif($codes[1] == $codes[2] || $codes[1] == $codes[3] || $codes[2] == $codes[3]){
                $zym_3['对子'] = true;
            }elseif(($z3[0] + 1 == $z3[1] && $z3[1] + 1 == $z3[2]) || ($z3[0] == '0' && $z3[1] == '8' && $z3[2] == '9') || ($z3[0] == '0' && $z3[1] == '1' && $z3[2] == '9')){
                $zym_3['顺子'] = true;
            }elseif(($z3[0] + 1 == $z3[1] || $z3[1] + 1 == $z3[2]) || ($z3[0] == '0' && $z3[2] == '9')){
                $zym_3['半顺'] = true;
            }else{
                $zym_3['杂六'] = true;
            }
            if($codes[2] == $codes[3] && $codes[3] == $codes[4]){
                $zym_4['豹子'] = true;
            }elseif($codes[2] == $codes[3] || $codes[2] == $codes[4] || $codes[3] == $codes[4]){
                $zym_4['对子'] = true;
            }elseif(($h3[0] + 1 == $h3[1] && $h3[1] + 1 == $h3[2]) || ($h3[0] == '0' && $h3[1] == '8' && $h3[2] == '9') || ($h3[0] == '0' && $h3[1] == '1' && $h3[2] == '9')){
                $zym_4['顺子'] = true;
            }elseif(($h3[0] + 1 == $h3[1] || $h3[1] + 1 == $h3[2]) || ($h3[0] == '0' && $h3[2] == '9')){
                $zym_4['半顺'] = true;
            }else{
                $zym_4['杂六'] = true;
            }
            $zong = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4];
        }
        if($zym_1 == '总'){
            if($zym_8 == '大' && $zong > 22){
                $peilv = get_query_val('fn_lottery8', 'zongda', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '小' && $zong < 23){
                $peilv = get_query_val('fn_lottery8', 'zongxiao', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '单' && $zong % 2 != 0){
                $peilv = get_query_val('fn_lottery8', 'zongdan', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '双' && $zong % 2 == 0){
                $peilv = get_query_val('fn_lottery8', 'zongshuang', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '龙' && $codes[0] > $codes[4]){
                $peilv = get_query_val('fn_lottery8', '`long`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '虎' && $codes[0] < $codes[4]){
                $peilv = get_query_val('fn_lottery8', '`hu`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '和' && $codes[0] == $codes[4]){
                $peilv = get_query_val('fn_lottery8', '`he`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
            continue;
        }
        if($zym_1 == '前三'){
            if($zym_8 == '豹子' && $zym_2['豹子'] == true){
                $peilv = get_query_val('fn_lottery8', 'q_baozi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '顺子' && $zym_2['顺子'] == true){
                $peilv = get_query_val('fn_lottery8', 'q_shunzi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '对子' && $zym_2['对子'] == true){
                $peilv = get_query_val('fn_lottery8', 'q_duizi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '半顺' && $zym_2['半顺'] == true){
                $peilv = get_query_val('fn_lottery8', 'q_banshun', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '杂六' && $zym_2['杂六'] == true){
                $peilv = get_query_val('fn_lottery8', 'q_zaliu', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
            continue;
        }
        if($zym_1 == '中三'){
            if($zym_8 == '豹子' && $zym_3['豹子'] == true){
                $peilv = get_query_val('fn_lottery8', 'z_baozi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '顺子' && $zym_3['顺子'] == true){
                $peilv = get_query_val('fn_lottery8', 'z_shunzi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '对子' && $zym_3['对子'] == true){
                $peilv = get_query_val('fn_lottery8', 'z_duizi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '半顺' && $zym_3['半顺'] == true){
                $peilv = get_query_val('fn_lottery8', 'z_banshun', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '杂六' && $zym_3['杂六'] == true){
                $peilv = get_query_val('fn_lottery8', 'z_zaliu', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
            continue;
        }
        if($zym_1 == '后三'){
            if($zym_8 == '豹子' && $zym_4['豹子'] == true){
                $peilv = get_query_val('fn_lottery8', 'h_baozi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '顺子' && $zym_4['顺子'] == true){
                $peilv = get_query_val('fn_lottery8', 'h_shunzi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '对子' && $zym_4['对子'] == true){
                $peilv = get_query_val('fn_lottery8', 'h_duizi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '半顺' && $zym_4['半顺'] == true){
                $peilv = get_query_val('fn_lottery8', 'h_banshun', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '杂六' && $zym_4['杂六'] == true){
                $peilv = get_query_val('fn_lottery8', 'h_zaliu', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
            continue;
        }
        if((int)$zym_1 > 0){
            $count = (int)$zym_1 - 1;
            if($zym_8 == '大' && (int)$codes[$count] > 4){
                $peilv = get_query_val('fn_lottery8', 'da', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '小' && (int)$codes[$count] < 5){
                $peilv = get_query_val('fn_lottery8', 'xiao', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '单' && (int)$codes[$count] % 2 != 0){
                $peilv = get_query_val('fn_lottery8', 'dan', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == '双' && (int)$codes[$count] % 2 == 0){
                $peilv = get_query_val('fn_lottery8', 'shuang', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }elseif($zym_8 == $codes[$count]){
                $peilv = get_query_val('fn_lottery8', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jssscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
            continue;
        }
    }
}



function MT_jiesuan($roomid){
    select_query("fn_mtorder", '*', array("status" => "未结算",'roomid'=>$roomid));
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_1 = $con['mingci'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];
        $opencode = get_query_val('fn_sopen', 'code', "`term` = '$term' and `type` = '6' and `roomid` = '$roomid'");
        $opencode = str_replace('10', '0', $opencode);
        if($opencode == "")continue;
        $code = explode(',', $opencode);
        if($zym_1 == '1'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[0] > 5 || $code[0] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[0] < 6 && $code[0] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0 && (int)$code[0] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0 && ((int)$code[0] == 6 || (int)$code[0] == 8|| (int)$code[0] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0 && ((int)$code[0] == 2 || (int)$code[0] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0 && (int)$code[0] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery6', '`long`', "`roomid` = '$roomid'");
                if((int)$code[0] > (int)$code[9] && $code[9] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[0] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery6', 'hu', "`roomid` = '$roomid'");
                if((int)$code[0] < (int)$code[9] && $code[0] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[9] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[0]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '2'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[1] > 5 || $code[1] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[1] < 6 && $code[1] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0 && (int)$code[1] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0 && ((int)$code[1] == 6 || (int)$code[1] == 8|| (int)$code[1] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0 && ((int)$code[1] == 4 || (int)$code[1] == 2)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0 && (int)$code[1] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery6', '`long`', "`roomid` = '$roomid'");
                if((int)$code[1] > (int)$code[8] && $code[8] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[1] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery6', 'hu', "`roomid` = '$roomid'");
                if((int)$code[1] < (int)$code[8] && $code[1] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[8] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[1]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '3'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[2] > 5 || $code[2] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[2] < 6 && $code[2] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0 && (int)$code[2] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0 && ((int)$code[2] == 6 || (int)$code[2] == 8|| (int)$code[2] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0 && ((int)$code[2] == 2 || (int)$code[2] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0 && (int)$code[2] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery6', '`long`', "`roomid` = '$roomid'");
                if((int)$code[2] > (int)$code[7] && $code[7] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[2] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery6', 'hu', "`roomid` = '$roomid'");
                if((int)$code[2] < (int)$code[7] && $code[2] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[7] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[2]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '4'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[3] > 5 || $code[3] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[3] < 6 && $code[3] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0 && (int)$code[3] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0 && ((int)$code[3] == 6 || (int)$code[3] == 8|| (int)$code[3] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0 && ((int)$code[3] == 2 || (int)$code[3] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0 && (int)$code[3] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery6', '`long`', "`roomid` = '$roomid'");
                if((int)$code[3] > (int)$code[6] && $code[6] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[3] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery6', 'hu', "`roomid` = '$roomid'");
                if((int)$code[3] < (int)$code[6] && $code[3] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[6] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[3]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '5'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[4] > 5 || $code[4] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[4] < 6 && $code[4] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0 && (int)$code[4] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0 && ((int)$code[4] == 6 || (int)$code[4] == 8|| (int)$code[4] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0 && ((int)$code[4] == 2 || (int)$code[4] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0 && (int)$code[4] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery6', '`long`', "`roomid` = '$roomid'");
                if((int)$code[4] > (int)$code[5] && $code[5] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[4] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery6', 'hu', "`roomid` = '$roomid'");
                if((int)$code[4] < (int)$code[5] && $code[4] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[5] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[4]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '6'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[5] > 5 || $code[5] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[5] < 6 && $code[5] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0 && (int)$code[5] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0 && ((int)$code[5] == 6 || (int)$code[5] == 8|| (int)$code[5] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0 && ((int)$code[5] == 2 || (int)$code[5] ==4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0 && (int)$code[5] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[5]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '7'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[6] > 5 || $code[6] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[6] < 6 && $code[6] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0 && (int)$code[6] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0 && ((int)$code[6] == 6 || (int)$code[6] == 8|| (int)$code[6] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0 && ((int)$code[6] == 2 || (int)$code[6] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0 && (int)$code[6] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[6]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '8'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[7] > 5 || $code[7] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[7] < 6 && $code[7] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0 && (int)$code[7] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0 && ((int)$code[7] == 6 || (int)$code[7] == 8|| (int)$code[7] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0 && ((int)$code[7] == 2 || (int)$code[7] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0 && (int)$code[7] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[7]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '9'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[8] > 5 || $code[8] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[8] < 6 && $code[8] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0 && (int)$code[8] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0 && ((int)$code[8] == 6 || (int)$code[8] == 8|| (int)$code[8] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0 && ((int)$code[8] == 2 || (int)$code[8] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0 && (int)$code[8] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[8]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '0'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
                if((int)$code[9] > 5 || $code[9] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[9] < 6 && $code[9] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'dan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery6', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0 && (int)$code[9] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery6', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0 && ((int)$code[9] == 6 || (int)$code[9] == 8|| (int)$code[9] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery6', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0 && ((int)$code[9] == 2 || (int)$code[9] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery6', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0 && (int)$code[9] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[9]){
                $peilv = get_query_val('fn_lottery6', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '和'){
            if((int)$code[0] == 0 || (int)$code[1] == 0){
                $hz = (int)$code[0] + (int)$code[1] + 10;
            }else{
                $hz = (int)$code[0] + (int)$code[1];
            }
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery6', 'heda', "`roomid` = '$roomid'");
                if($hz > 11){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery6', 'hexiao', "`roomid` = '$roomid'");
                if($hz < 12){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery6', 'hedan', "`roomid` = '$roomid'");
                if($hz % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery6', 'heshuang', "`roomid` = '$roomid'");
                if($hz % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif((int)$zym_8 == $hz){
                if($hz == 3 || $hz == 4 || $hz == 18 || $hz == 19){
                    $peilv = get_query_val('fn_lottery6', 'he341819', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 5 || $hz == 6 || $hz == 16 || $hz == 17){
                    $peilv = get_query_val('fn_lottery6', 'he561617', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 7 || $hz == 8 || $hz == 14 || $hz == 15){
                    $peilv = get_query_val('fn_lottery6', 'he781415', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 9 || $hz == 10 || $hz == 12 || $hz == 13){
                    $peilv = get_query_val('fn_lottery6', 'he9101213', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 11){
                    $peilv = get_query_val('fn_lottery6', 'he11', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速摩托', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_mtorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
    }
}






function JSSC_jiesuan($roomid){
    select_query("fn_jsscorder", '*', array("status" => "未结算",'roomid'=>$roomid));
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_1 = $con['mingci'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];
        $opencode = get_query_val('fn_sopen', 'code', "`term` = '$term' and `type` = '7' and `roomid` = '$roomid'");
        $opencode = str_replace('10', '0', $opencode);
        if($opencode == "")continue;
        $code = explode(',', $opencode);
        if($zym_1 == '1'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[0] > 5 || $code[0] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[0] < 6 && $code[0] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0 && (int)$code[0] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0 && ((int)$code[0] == 6 || (int)$code[0] == 8|| (int)$code[0] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 == 0 && ((int)$code[0] == 2 || (int)$code[0] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[0] % 2 != 0 && (int)$code[0] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery7', '`long`', "`roomid` = '$roomid'");
                if((int)$code[0] > (int)$code[9] && $code[9] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[0] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery7', 'hu', "`roomid` = '$roomid'");
                if((int)$code[0] < (int)$code[9] && $code[0] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[9] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[0]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '2'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[1] > 5 || $code[1] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[1] < 6 && $code[1] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0 && (int)$code[1] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0 && ((int)$code[1] == 6 || (int)$code[1] == 8|| (int)$code[1] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 == 0 && ((int)$code[1] == 4 || (int)$code[1] == 2)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[1] % 2 != 0 && (int)$code[1] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery7', '`long`', "`roomid` = '$roomid'");
                if((int)$code[1] > (int)$code[8] && $code[8] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[1] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery7', 'hu', "`roomid` = '$roomid'");
                if((int)$code[1] < (int)$code[8] && $code[1] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[8] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[1]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '3'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[2] > 5 || $code[2] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[2] < 6 && $code[2] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0 && (int)$code[2] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0 && ((int)$code[2] == 6 || (int)$code[2] == 8|| (int)$code[2] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 == 0 && ((int)$code[2] == 2 || (int)$code[2] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[2] % 2 != 0 && (int)$code[2] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery7', '`long`', "`roomid` = '$roomid'");
                if((int)$code[2] > (int)$code[7] && $code[7] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[2] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery7', 'hu', "`roomid` = '$roomid'");
                if((int)$code[2] < (int)$code[7] && $code[2] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[7] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[2]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '4'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[3] > 5 || $code[3] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[3] < 6 && $code[3] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0 && (int)$code[3] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0 && ((int)$code[3] == 6 || (int)$code[3] == 8|| (int)$code[3] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 == 0 && ((int)$code[3] == 2 || (int)$code[3] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[3] % 2 != 0 && (int)$code[3] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery7', '`long`', "`roomid` = '$roomid'");
                if((int)$code[3] > (int)$code[6] && $code[6] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[3] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery7', 'hu', "`roomid` = '$roomid'");
                if((int)$code[3] < (int)$code[6] && $code[3] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[6] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[3]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '5'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[4] > 5 || $code[4] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[4] < 6 && $code[4] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0 && (int)$code[4] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0 && ((int)$code[4] == 6 || (int)$code[4] == 8|| (int)$code[4] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 == 0 && ((int)$code[4] == 2 || (int)$code[4] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[4] % 2 != 0 && (int)$code[4] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '龙'){
                $peilv = get_query_val('fn_lottery7', '`long`', "`roomid` = '$roomid'");
                if((int)$code[4] > (int)$code[5] && $code[5] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[4] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '虎'){
                $peilv = get_query_val('fn_lottery7', 'hu', "`roomid` = '$roomid'");
                if((int)$code[4] < (int)$code[5] && $code[4] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($code[5] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[4]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '6'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[5] > 5 || $code[5] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[5] < 6 && $code[5] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0 && (int)$code[5] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0 && ((int)$code[5] == 6 || (int)$code[5] == 8|| (int)$code[5] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 == 0 && ((int)$code[5] == 2 || (int)$code[5] ==4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[5] % 2 != 0 && (int)$code[5] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[5]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '7'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[6] > 5 || $code[6] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[6] < 6 && $code[6] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0 && (int)$code[6] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0 && ((int)$code[6] == 6 || (int)$code[6] == 8|| (int)$code[6] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 == 0 && ((int)$code[6] == 2 || (int)$code[6] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[6] % 2 != 0 && (int)$code[6] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[6]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '8'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[7] > 5 || $code[7] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[7] < 6 && $code[7] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0 && (int)$code[7] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0 && ((int)$code[7] == 6 || (int)$code[7] == 8|| (int)$code[7] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 == 0 && ((int)$code[7] == 2 || (int)$code[7] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[7] % 2 != 0 && (int)$code[7] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[7]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '9'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[8] > 5 || $code[8] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[8] < 6 && $code[8] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0 && (int)$code[8] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0 && ((int)$code[8] == 6 || (int)$code[8] == 8|| (int)$code[8] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 == 0 && ((int)$code[8] == 2 || (int)$code[8] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[8] % 2 != 0 && (int)$code[8] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[8]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '0'){
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'da', "`roomid` = '$roomid'");
                if((int)$code[9] > 5 || $code[9] == '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'xiao', "`roomid` = '$roomid'");
                if((int)$code[9] < 6 && $code[9] != '0'){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'dan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'shuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大单'){
                $peilv = get_query_val('fn_lottery7', 'dadan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0 && (int)$code[9] > 5){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '大双'){
                $peilv = get_query_val('fn_lottery7', 'dashuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0 && ((int)$code[9] == 6 || (int)$code[9] == 8|| (int)$code[9] == 0)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小双'){
                $peilv = get_query_val('fn_lottery7', 'xiaoshuang', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 == 0 && ((int)$code[9] == 2 || (int)$code[9] == 4)){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小单'){
                $peilv = get_query_val('fn_lottery7', 'xiaodan', "`roomid` = '$roomid'");
                if((int)$code[9] % 2 != 0 && (int)$code[9] < 6){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == $code[9]){
                $peilv = get_query_val('fn_lottery7', 'tema', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if($zym_1 == '和'){
            if((int)$code[0] == 0 || (int)$code[1] == 0){
                $hz = (int)$code[0] + (int)$code[1] + 10;
            }else{
                $hz = (int)$code[0] + (int)$code[1];
            }
            if($zym_8 == '大'){
                $peilv = get_query_val('fn_lottery7', 'heda', "`roomid` = '$roomid'");
                if($hz > 11){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '小'){
                $peilv = get_query_val('fn_lottery7', 'hexiao', "`roomid` = '$roomid'");
                if($hz < 12){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '单'){
                $peilv = get_query_val('fn_lottery7', 'hedan', "`roomid` = '$roomid'");
                if($hz % 2 != 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif($zym_8 == '双'){
                $peilv = get_query_val('fn_lottery7', 'heshuang', "`roomid` = '$roomid'");
                if($hz % 2 == 0){
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }else{
                    $zym_11 = '-' . $zym_7;
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }elseif((int)$zym_8 == $hz){
                if($hz == 3 || $hz == 4 || $hz == 18 || $hz == 19){
                    $peilv = get_query_val('fn_lottery7', 'he341819', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 5 || $hz == 6 || $hz == 16 || $hz == 17){
                    $peilv = get_query_val('fn_lottery7', 'he561617', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 7 || $hz == 8 || $hz == 14 || $hz == 15){
                    $peilv = get_query_val('fn_lottery7', 'he781415', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 9 || $hz == 10 || $hz == 12 || $hz == 13){
                    $peilv = get_query_val('fn_lottery7', 'he9101213', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }elseif($hz == 11){
                    $peilv = get_query_val('fn_lottery7', 'he11', "`roomid` = '$roomid'");
                    $zym_11 = $peilv * (int)$zym_7;
                    用户_上分($user, $zym_11, $roomid, '极速赛车', $term, $zym_1 . '/' . $zym_8 . '/' . $zym_7);
                    update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                    continue;
                }
            }else{
                $zym_11 = '-' . $zym_7;
                update_query("fn_jsscorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
    }
}
function TWK3_jiesuan($roomid){

		select_query('fn_twk3order','*',array('status'=>'未结算','roomid'=>$roomid));

	while($con = db_fetch_array()){
		$cons[] = $con;
	}
	foreach($cons as $con){
		$id = $con['id'];
		$roomid = $con['roomid'];
		$gametype = get_query_val('fn_lottery15', 'setting_open', array('roomid'=>$roomid));
		$user = $con['userid'];
		$term = $con['term'];
		$名次 = $con['mingci'];
		$内容 = $con['content'];
		$金额 = $con['money'];
		$opencode = get_query_val('fn_sopen','code',"`term` = '$term' and `type` = '15' and `roomid` = '$roomid'");
		if($opencode == "") continue;
		$codes = explode(',',$opencode);
		$sum = $codes[0] + $codes[1] + $codes[2];

		if($codes[0] == $codes[1] && $codes[1] == $codes[2]){
			$ts = "豹子";
		}elseif($codes[0] == $codes[1] || $codes[1] == $codes[2] || $codes[0] == $codes[2]){
			$ts = "对子";
		}elseif($codes[0] + 1 == $codes[1] && $codes[1] + 1 == $codes[2]){
			$ts = "顺子";
		}else{
			$ts = "三杂";
		}
		$settings = get_query_val('fn_lottery15', '*', array('roomid'=>$roomid));
		if($settings['setting_10shazuhe'] == "true"){
			$kai10shazuhe = true;
		}else{
			$kai10shazuhe = false;
		}
		if($settings['setting_baozitongsha'] == "true"){
			$baozitongsha = true;
		}else{
			$baozitongsha = false;
		}

		switch($名次){
			case '总':
				switch($内容){
					case '大':
						$peilv = get_query_val('fn_lottery15','da',"`roomid` = '$roomid'");
						if($sum > 10){
							if($baozitongsha && $ts == "豹子"){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '小':
						$peilv = get_query_val('fn_lottery15','xiao',"`roomid` = '$roomid'");
						if($sum < 11){
							if($baozitongsha && $ts == "豹子"){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '单':
						$peilv = get_query_val('fn_lottery15','dan',"`roomid` = '$roomid'");
						if($sum %2 != 0){
							if($baozitongsha && $ts == "豹子"){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '双':
						$peilv = get_query_val('fn_lottery15','shuang',"`roomid` = '$roomid'");
						if($sum %2 == 0){
							if($baozitongsha && $ts == "豹子"){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '大单':
						$peilv = get_query_val('fn_lottery15','dadan',"`roomid` = '$roomid'");
						if($sum %2 != 0 && $sum >10){
							if($kai10shazuhe && $sum == 10){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '小单':
						$peilv = get_query_val('fn_lottery15','xiaodan',"`roomid` = '$roomid'");
						if($sum %2 != 0 && $sum < 11){
							if($kai10shazuhe && $sum == 10){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '大双':
						$peilv = get_query_val('fn_lottery15','dashuang',"`roomid` = '$roomid'");
						if($sum %2 == 0 && $sum > 10){
							if($kai10shazuhe && $sum == 10){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '小双':
						$peilv = get_query_val('fn_lottery15','xiaoshuang',"`roomid` = '$roomid'");
						if($sum %2 == 0 && $sum < 11){
							if($kai10shazuhe && $sum == 10){
								$中 = '-'.$金额;
								update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
								break;
							}
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
				}
				break;
			case '特':
				switch($内容){
					case '顺子':
						$peilv = get_query_val('fn_lottery15','tong_shunzi',"`roomid` = '$roomid'");
						if($ts == "顺子"){
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '豹子':
						$peilv = get_query_val('fn_lottery15','tong_baozi',"`roomid` = '$roomid'");
						if($ts == "豹子"){
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '对子':
						$peilv = get_query_val('fn_lottery15','tong_duizi',"`roomid` = '$roomid'");
						if($ts == "对子"){
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '三杂':
						$peilv = get_query_val('fn_lottery15','tong_sanza',"`roomid` = '$roomid'");
						if($ts == "三杂" || $ts == '顺子'){
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
					case '二杂':
						$peilv = get_query_val('fn_lottery15','tong_erza',"`roomid` = '$roomid'");
						if($codes[0] != $codes[1] || $codes[1] != $codes[2] || $codes[0] != $codes[2]){
							$中 = $peilv * (int)$金额;
							用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}else{
							$中 = '-'.$金额;
							update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
							break;
						}
						break;
				}
				break;
			case '豹子':
				$peilv = get_query_val('fn_lottery15','zhi_baozi',"`roomid` = '$roomid'");
				if($ts == "豹子" && ($codes[0].$codes[1].$codes[2]) == $内容){
					$中 = $peilv * (int)$金额;
					用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}else{
					$中 = '-'.$金额;
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}
				break;
			case '顺子':
				$peilv = get_query_val('fn_lottery15','zhi_shunzi',"`roomid` = '$roomid'");
				if($ts == "顺子" && ($codes[0].$codes[1].$codes[2]) == $内容){
					$中 = $peilv * (int)$金额;
					用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}else{
					$中 = '-'.$金额;
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}
				break;
			case '对子':
				$peilv = get_query_val('fn_lottery15','zhi_duizi',"`roomid` = '$roomid'");
				if($ts == "对子" && strpos($codes[0].$codes[1].$codes[2], $内容) !== false){
					$中 = $peilv * (int)$金额;
					用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}else{
					$中 = '-'.$金额;
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}
				break;
			case '三杂':
				$peilv = get_query_val('fn_lottery15','zhi_sanza',"`roomid` = '$roomid'");
				$c = $codes[0].$codes[1].$codes[2];
				if(($ts == "三杂" || $ts == '顺子') && strpos($c, $内容) !== false){
					$中 = $peilv * (int)$金额;
					用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}else{
					$中 = '-'.$金额;
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}
				break;
			case '二杂':
				$peilv = get_query_val('fn_lottery15','zhi_erza',"`roomid` = '$roomid'");
				$c = $codes[0].$codes[1].$codes[2];
				if(strpos($c, $内容) !== false){
					$中 = $peilv * (int)$金额;
					用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}else{
					$中 = '-'.$金额;
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}
				break;
			case '三军':
				$peilv = get_query_val('fn_lottery15','zhi_sanjun',"`roomid` = '$roomid'");
				$c = $codes[0].$codes[1].$codes[2];
				if(strpos($c, $内容) !== false){
					$中 = $peilv * (int)$金额;
					用户_上分($user,$中,$roomid,'台湾快三',$term,$名次.'/'.$内容.'/'.$金额); 
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}else{
					$中 = '-'.$金额;
					update_query('fn_twk3order',array('status'=>$中),array('id'=>$id));
					break;
				}
				break;
		
		}
		continue;
	}
}
function kaichat($game, $term ,$roomid){
       if($game == 'jsmt'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '6' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
         foreach($fenge as $val){
          $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
        select_query('fn_lottery6', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '6' and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'jsmt');
            echo "jsmt喊话-" . $con['roomid'] . '..<br>';
        }
    }elseif($game == 'jssc'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '7' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
         foreach($fenge as $val){
          $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
        select_query('fn_lottery7', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '7' and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'jssc');
            echo "jssc喊话-" . $con['roomid'] . '..<br>';
        }
    }elseif($game == 'jsssc'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '8' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
          foreach($fenge as $val){
          $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
        select_query('fn_lottery8', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '8'  and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'jsssc');
            echo "jsssc喊话-" . $con['roomid'] . '..<br>';
        }
    }elseif($game == 'bjl'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '10' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
         foreach($fenge as $val){
          $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
        select_query('fn_lottery10', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '10' and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'bjl');
            echo "bjl喊话-" . $con['roomid'] . '..<br>';
        }
    }elseif($game == 'jssm'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '12' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
         foreach($fenge as $val){
         $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
   
        select_query('fn_lottery12', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '12' and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'jssm');
            echo "jssm喊话-" . $con['roomid'] . '..<br>';
        }
    }elseif($game == 'jslhc'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '14' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
         foreach($fenge as $val){
          $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
        select_query('fn_lottery14', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '14' and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'jslhc');
            echo "jslhc喊话-" . $con['roomid'] . '..<br>';
        }
    }elseif($game == 'twk3'){
          $haoma = get_query_val('fn_sopen','code',"`type` = '15' and `roomid`='$roomid' order by `term` desc limit 1");
          $fenge = explode(",",$haoma);
         foreach($fenge as $val){
          $haomachuan .= "<span class='pk_".(int)$val."'>".(int)$val."</span>";
       }
        select_query('fn_lottery15', '*', array('gameopen' => 'true','roomid'=>$roomid));
        while($con = db_fetch_array()){
            $cons[] = $con;
        }
        foreach($cons as $con){
         
            $kjqh =  get_query_val('fn_sopen','term',"`type` = '15' and `roomid`='$roomid' order by `term` desc limit 1");
            管理员喊话("第 $kjqh 期&nbsp;开&nbsp;奖&nbsp;号&nbsp;码<br><br>$haomachuan<br><br> $term 期已经开启,请下注!", $con['roomid'], 'twk3');
            echo "twk3喊话-" . $con['roomid'] . '..<br>';
        }
    }
}
function 管理员喊话($Content, $roomid, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $roomid));
    insert_query("fn_chat", array("username" => "播报员", "headimg" => $headimg, 'content' => $Content, 'game' => $game, 'addtime' => date('H:i:s'), 'time' => date('Y-m-d H:i:s',time()), 'type' => 'S3', 'userid' => 'system', 'roomid' => $roomid));
}
function 文本_逐字分割($str, $split_len = 1) {
        if (!preg_match('/^[0-9]+$/', $split_len) || $split_len < 1) return FALSE;
        $len = mb_strlen($str, 'UTF-8');
        if ($len <= $split_len) return array($str);
        preg_match_all("/.{" . $split_len . '}|[^x00]{1,' . $split_len . '}$/us', $str, $ar);
        return $ar[0];
    }
?>