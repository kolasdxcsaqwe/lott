<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/Bjl.php");
$game = $_COOKIE['game'];//$_COOKIE['game']
$roomid = $_SESSION['roomid'];
?>
<link rel="stylesheet" type="text/css" href="/Style/Old/css/common.css?t=asdjkasd" />
<body align="center">
	<br>
	<strong style="font-size:38px;">游戏走势图</strong>
<?php if($game == 'pk10'){
    $type = '1';
}elseif($game == 'xyft'){
    $type = '2';
}elseif($game == 'cqssc'){
    $type = '3';
}elseif($game == 'xy28'){
    $type = '4';
}elseif($game == 'jnd28'){
    $type = '5';
}elseif($game == 'jsmt'){
    $type = '6';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'jssc'){
    $type = '7';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'jsssc'){
    $type = '8';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'kuai3'){
    $type = '9';
}elseif($game == 'bjl'){
    $type = '10';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'gd11x5'){
    $type = '11';
}elseif($game == 'jssm'){
    $type = '12';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'lhc'){
    $type = '13';
}elseif($game == 'jslhc'){
    $type = '14';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'twk3'){
    $type = '15';
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
}elseif($game == 'txffc'){
    $type = '16';
}elseif($game == 'azxy10'){
    $type = '17';
}elseif($game == 'azxy5'){
    $type = '18';
}else{
    echo '<br><br><strong style="font-size:40px;color:red">该房间已经封盘啦！';
    exit();
}
?>
	<div class="g_w1000min open_form">
		<div class="sub_right  ">
			<div class="sub_r_bot">
				<div class="sub_bot_one">
					<span class="sub_bot_bt">开奖记录</span>
                  <span class="r"><a href="<? echo 'http://'.$_SERVER['HTTP_HOST'].'/qr.php?room='.$roomid.'&g='.$game?>" class="g_button btn_orange1" target="_blank">返回游戏</a></span>
					<span class="r"><a href="#" class="g_button btn_orange" target="_blank" >更多历史</a></span>
				</div>
			</div>
			<style>
				.dx_shadow { width: 1000px; }
				.top_right { border-bottom: 1px solid #e3e3e3; font-size: 12px; height: 25px; line-height: 25px; }
				.top_right_red { border-bottom: 1px solid #e3e3e3; color: red; font-size: 12px; height: 25px; line-height: 25px; }
				.chuxian { height: 25px; line-height: 25px; }
				.myyk{
					width: 5%;
					display: inline-block;
				}
				.myyk.st{
					width:8%;
    margin-left: 10px;
				}
			</style>
			<div class="sm g_hide"></div>
			<table class="sub_table" cellpadding="0" cellspacing="0" border="0" width="980">
			<?php if($game == 'xy28' || $game == 'jnd28'){
    ?>	
					<thead>
						<tr id="th_header">
							<th width="163" class="">时间</th>
							<th width="103" class="">期数</th>
							<th width="380" class="">开奖号码</th>
							<th colspan="3" class="" width="103">总和</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
	<?php select_query('fn_open', '*', "`type` = '$type' order by `term` desc limit 40");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    $ay = true;
    foreach($cons as $con){
        if($ay){
            $line_row = "";
            $ay = false;
        }else{
            $line_row = "line_row";
            $ay = true;
        }
        $ys['小'] = 'blue';
        $ys['大'] = 'gray';
        $ys['单'] = 'blue';
        $ys['双'] = 'gray';
        $ys['龙'] = 'gray';
        $ys['虎'] = 'blue';
        $codes = explode(",", $con['code']);
        if($codes){
            if($type == '4'){
                $number1 = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5];
                $number2 = (int)$codes[6] + (int)$codes[7] + (int)$codes[8] + (int)$codes[9] + (int)$codes[10] + (int)$codes[11];
                $number3 = (int)$codes[12] + (int)$codes[13] + (int)$codes[14] + (int)$codes[15] + (int)$codes[16] + (int)$codes[17];
            }elseif($type == '5'){
                $number1 = (int)$codes[1] + (int)$codes[4] + (int)$codes[7] + (int)$codes[10] + (int)$codes[13] + (int)$codes[16];
                $number2 = (int)$codes[2] + (int)$codes[5] + (int)$codes[8] + (int)$codes[11] + (int)$codes[14] + (int)$codes[17];
                $number3 = (int)$codes[3] + (int)$codes[6] + (int)$codes[9] + (int)$codes[12] + (int)$codes[15] + (int)$codes[18];
            }
            $number1 = substr($number1, -1);
            $number2 = substr($number2, -1);
            $number3 = substr($number3, -1);
            $hz = (int)$number1 + (int)$number2 + (int)$number3;
        }
        $dx = $hz < 14 ? '小' : '大';
        $ds = $hz % 2 == 0 ? '双' : '单';
        ?>
									<tr class="<?php echo $line_row;
        ?>">
										<td><?php echo date("H:i:s", strtotime($con['time']));
        ?></td>
										<td> <?php echo $con['term'];
        ?> </td>
										<td>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $number1;
        ?></span>
											<span class="ball_s_">+</span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $number2;
        ?></span>
											<span class="ball_s_">+</span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $number3;
        ?></span>
										</td>
										<td class="count"><?php echo $hz;
        ?></td>
										<td class="<?php echo $ys[$dx];
        ?>"><?php echo $dx;
        ?></td>
										<td class="<?php echo $ys[$ds];
        ?>"><?php echo $ds;
        ?></td>
									</tr>
						<?php }
    ?>
					</tbody>
			<?php }elseif($game == 'lhc'){
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
    ?>
					<thead>
						<tr id="th_header">
                            <th width="20%" class="">开奖期号</th>
                            <th width="70%" class="">开奖号码</th>
                            <th  class="" width="10%">总和</th>
                            <th colspan="5" class="" width="103">特码</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
						<?php select_query('fn_open', '*', "`type` = '13' order by `term` desc limit 12");
							while($con = db_fetch_array()){
								$cons[] = $con;
							}
							$ay = true;
							foreach($cons as $con){
								if($ay){
									$line_row = "";
									$ay = false;
								}else{
									$line_row = "line_row";
									$ay = true;
								}
								$ys['小'] = 'blue';
								$ys['大'] = 'gray';
								$ys['单'] = 'blue';
								$ys['双'] = 'gray';
								$ys['合小'] = 'blue';
								$ys['合大'] = 'gray';
								$ys['合单'] = 'blue';
								$ys['合双'] = 'gray';
								$ys['尾大'] = 'blue';
								$ys['尾小'] = 'gray';
								$ys['红波'] = 'red';
								$ys['蓝波'] = 'blue';
								$ys['绿波'] = 'green';
								$codes = explode(",", $con['code']);
						//		foreach($codes as $k=>$v){
						//			$codess[$k] = $v<10 ? $v : $v;	
						//		}
								if(count($codes) != 7){
									continue;
								}else{
									$hz = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5] + (int)$codes[6];
								}
								$dx = $hz >= 175 ? '大' : '小';
								$ds = $hz % 2 == 0 ? '双' : '单';
								$tdx = $codes[6] <= 24 ? '小' : '大';
								$tds = $codes[6] % 2 == 0 ? '双' : '单';
								if($codes[6]==49){
									$thdx = '和';	
								}else{
									$thdx = array_sum(str_split($codes[6]))>=7 ? '合大' : '合小';
								}
								if($codes[6]==49){
									$thds = '和';	
								}else{
									$thds = array_sum(str_split($codes[6]))%2==0 ? '合双' : '合单';
								}
								if($codes[6]==49){
									$twdx = '和';	
								}else{
                                    
                                   $haoma = str_split($codes[6]);
									$twdx = $haoma[1]>=5 ? '尾大' : '尾小';
								}
								?>
									<tr class="<?php echo $line_row;?>">
										<td><?php echo $con['term'] ;?></td>
										<td>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[0]]]; ?> ball_lenght5  "><?php echo (int)$codes[0];echo '<br>'; echo $shengxiao[(int)$codes[0]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[1]]]; ?> ball_lenght5  "><?php echo (int)$codes[1];echo '<br>'; echo $shengxiao[(int)$codes[1]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[2]]]; ?> ball_lenght5  "><?php echo (int)$codes[2];echo '<br>'; echo $shengxiao[(int)$codes[2]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[3]]]; ?> ball_lenght5  "><?php echo (int)$codes[3];echo '<br>'; echo $shengxiao[(int)$codes[3]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[4]]]; ?> ball_lenght5  "><?php echo (int)$codes[4];echo '<br>'; echo $shengxiao[(int)$codes[4]];?></span>
                                            <span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[5]]]; ?> ball_lenght5  "><?php echo (int)$codes[5];echo '<br>'; echo $shengxiao[(int)$codes[5]];?></span>
                                             <span>+</span>
                                            <span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[6]]]; ?> ball_lenght5  "><?php echo (int)$codes[6];echo '<br>'; echo $shengxiao[(int)$codes[6]];?></span>
										</td>
										<td class="count"><?php echo $hz;?></td>
										<td class="<?php echo $ys[$dx];?>"><?php echo $dx;?></td>
										<td class="<?php echo $ys[$ds];?>"><?php echo $ds;?></td>
										<td class="<?php echo $ys[$tdx];?>"><?php echo $tdx;?></td>
										<td class="<?php echo $ys[$tds];?>"><?php echo $tds;?></td>
<!--                                        <td class="--><?php //echo $ys[$thdx];?><!--">--><?php //echo $thdx;?><!--</td>-->
<!--										<td class="--><?php //echo $ys[$thds];?><!--">--><?php //echo $thds;?><!--</td>-->
<!--                                        <td class="--><?php //echo $ys[$twdx];?><!--">--><?php //echo $twdx;?><!--</td>-->
									</tr>
						<?php }
    ?>
					</tbody>
			<?php }elseif($game == 'jslhc'){
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
    ?>
					<thead>
						<tr id="th_header">
							<th width="20%" class="">开奖期号</th>
							<th width="70%" class="">开奖号码</th>
							<th  class="" width="10%">总和</th>
                            <th colspan="5" class="" width="103">特码</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
						<?php 
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 40");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 40");
  }
							while($con = db_fetch_array()){
								$cons[] = $con;
							}
							$ay = true;
							foreach($cons as $con){
								if($ay){
									$line_row = "";
									$ay = false;
								}else{
									$line_row = "line_row";
									$ay = true;
								}
								$ys['小'] = 'blue';
								$ys['大'] = 'gray';
								$ys['单'] = 'blue';
								$ys['双'] = 'gray';
								$ys['合小'] = 'blue';
								$ys['合大'] = 'gray';
								$ys['合单'] = 'blue';
								$ys['合双'] = 'gray';
								$ys['尾大'] = 'blue';
								$ys['尾小'] = 'gray';
								$ys['红波'] = 'red';
								$ys['蓝波'] = 'blue';
								$ys['绿波'] = 'green';
								$codes = explode(",", $con['code']);
						//		foreach($codes as $k=>$v){
						//			$codess[$k] = $v<10 ? $v : $v;	
						//		}
								if(count($codes) != 7){
									continue;
								}else{
									$hz = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5] + (int)$codes[6];
								}
								$dx = $hz >= 175 ? '大' : '小';
								$ds = $hz % 2 == 0 ? '双' : '单';
								$tdx = $codes[6] <= 24 ? '小' : '大';
								$tds = $codes[6] % 2 == 0 ? '双' : '单';
								if($codes[6]==49){
									$thdx = '和';	
								}else{
									$thdx = array_sum(str_split($codes[6]))>=7 ? '合大' : '合小';
								}
								if($codes[6]==49){
									$thds = '和';	
								}else{
									$thds = array_sum(str_split($codes[6]))%2==0 ? '合双' : '合单';
								}
								if($codes[6]==49){
									$twdx = '和';	
								}else{
                                    
                                   $haoma = str_split($codes[6]);
									$twdx = $haoma[1]>=5 ? '尾大' : '尾小';
								}
								?>
									<tr class="<?php echo $line_row;?>">
										<td><?php echo $con['term'] ;?></td>
										<td>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[0]]]; ?> ball_lenght5  "><?php echo (int)$codes[0];echo '<br>'; echo $shengxiao[(int)$codes[0]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[1]]]; ?> ball_lenght5  "><?php echo (int)$codes[1];echo '<br>'; echo $shengxiao[(int)$codes[1]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[2]]]; ?> ball_lenght5  "><?php echo (int)$codes[2];echo '<br>'; echo $shengxiao[(int)$codes[2]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[3]]]; ?> ball_lenght5  "><?php echo (int)$codes[3];echo '<br>'; echo $shengxiao[(int)$codes[3]];?></span>
											<span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[4]]]; ?> ball_lenght5  "><?php echo (int)$codes[4];echo '<br>'; echo $shengxiao[(int)$codes[4]];?></span>
                                            <span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[5]]]; ?> ball_lenght5  "><?php echo (int)$codes[5];echo '<br>'; echo $shengxiao[(int)$codes[5]];?></span>
                                             <span>+</span>
                                            <span class="  ball_s_ ball_s_<?php echo $ys[$sebo[(int)$codes[6]]]; ?> ball_lenght5  "><?php echo (int)$codes[6];echo '<br>'; echo $shengxiao[(int)$codes[6]];?></span>
										</td>
										<td class="count"><?php echo $hz;?></td>
										<td class="<?php echo $ys[$dx];?>"><?php echo $dx;?></td>
										<td class="<?php echo $ys[$ds];?>"><?php echo $ds;?></td>
										<td class="<?php echo $ys[$tdx];?>"><?php echo $tdx;?></td>
										<td class="<?php echo $ys[$tds];?>"><?php echo $tds;?></td>
<!--                                        <td class="--><?php //echo $ys[$thdx];?><!--">--><?php //echo $thdx;?><!--</td>-->
<!--										<td class="--><?php //echo $ys[$thds];?><!--">--><?php //echo $thds;?><!--</td>-->
<!--                                        <td class="--><?php //echo $ys[$twdx];?><!--">--><?php //echo $twdx;?><!--</td>-->
									</tr>
						<?php }
    ?>
					</tbody>
			<?php }elseif($game == 'kuai3'){
    ?>	
					<thead>
						<tr id="th_header">
							<th width="163" class="">时间</th>
							<th width="103" class="">期数</th>
							<th width="380" class="">开奖号码</th>
							<th colspan="3" class="" width="103">总和</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
						<?php select_query('fn_open', '*', "`type` = '$type' order by `term` desc limit 40");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    $ay = true;
    foreach($cons as $con){
        if($ay){
            $line_row = "";
            $ay = false;
        }else{
            $line_row = "line_row";
            $ay = true;
        }
        $ys['小'] = 'blue';
        $ys['大'] = 'gray';
        $ys['单'] = 'blue';
        $ys['双'] = 'gray';
        $ys['龙'] = 'gray';
        $ys['虎'] = 'blue';
        $codes = explode(",", $con['code']);
        if(count($codes) != 3){
            continue;
        }else{
            $hz = (int)$codes[0] + (int)$codes[1] + (int)$codes[2];
        }
        $dx = $hz < 11 ? '小' : '大';
        $ds = $hz % 2 == 0 ? '双' : '单';
        ?>
									<tr class="<?php echo $line_row;
        ?>">
										<td><?php echo date("H:i:s", strtotime($con['time']));
        ?></td>
										<td> <?php echo $con['term'];
        ?> </td>
										<td>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[0];
        ?></span>
											<span class="ball_s_">+</span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[1];
        ?></span>
											<span class="ball_s_">+</span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[2];
        ?></span>
										</td>
										<td class="count"><?php echo $hz;
        ?></td>
										<td class="<?php echo $ys[$dx];
        ?>"><?php echo $dx;
        ?></td>
										<td class="<?php echo $ys[$ds];
        ?>"><?php echo $ds;
        ?></td>
									</tr>
						<?php }
    ?>
					</tbody>
              <?php }elseif($game == 'twk3'){
    ?>	
					<thead>
						<tr id="th_header">
							<th width="163" class="">时间</th>
							<th width="103" class="">期数</th>
							<th width="380" class="">开奖号码</th>
							<th colspan="3" class="" width="103">总和</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
						<?php 
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 40");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 40");
  }
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    $ay = true;
    foreach($cons as $con){
        if($ay){
            $line_row = "";
            $ay = false;
        }else{
            $line_row = "line_row";
            $ay = true;
        }
        $ys['小'] = 'blue';
        $ys['大'] = 'gray';
        $ys['单'] = 'blue';
        $ys['双'] = 'gray';
        $ys['龙'] = 'gray';
        $ys['虎'] = 'blue';
        $codes = explode(",", $con['code']);
        if(count($codes) != 3){
            continue;
        }else{
            $hz = (int)$codes[0] + (int)$codes[1] + (int)$codes[2];
        }
        $dx = $hz < 11 ? '小' : '大';
        $ds = $hz % 2 == 0 ? '双' : '单';
        ?>
									<tr class="<?php echo $line_row;
        ?>">
										<td><?php if($kong == '1'){echo date("H:i:s", strtotime($con['opentime']));}else{echo date("H:i:s", strtotime($con['time']));}?></td>
										<td> <?php echo $con['term'];
        ?> </td>
										<td>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[0];
        ?></span>
											<span class="ball_s_">+</span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[1];
        ?></span>
											<span class="ball_s_">+</span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[2];
        ?></span>
										</td>
										<td class="count"><?php echo $hz;
        ?></td>
										<td class="<?php echo $ys[$dx];
        ?>"><?php echo $dx;
        ?></td>
										<td class="<?php echo $ys[$ds];
        ?>"><?php echo $ds;
        ?></td>
									</tr>
						<?php }
    ?>
					</tbody>
              <?php }elseif ($game == 'bjl') {
                    ?>	
                    <thead>
                        <tr id="th_header">
                            <th width="163" class="">时间</th>
                            <th width="103" class="">期数</th>
                            <th width="380" class="">开奖号码</th>
                            <th colspan="1" class="" width="103">庄</th>
                            <th colspan="1" class="" width="103">闲</th>
                            <th colspan="1" class="" width="103">和</th>
                            <th colspan="1" class="" width="103">庄对</th>
                            <th colspan="1" class="" width="103">闲对</th>
                            <th colspan="1" class="" width="103">任意对</th>
                        </tr>
                    </thead>
                    <tbody id="reslist" linNos="0,1,2,5">
                        <?php
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 40");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 40");
  }
                        while ($con = db_fetch_array()) {
                            $cons[] = $con;
                        }
                        $ay = true;
                        $bjl=new Bjl();
                        foreach ($cons as $con) {
                            if ($ay) {
                                $line_row = "";
                                $ay = false;
                            } else {
                                $line_row = "line_row";
                                $ay = true;
                            }
                            $ys['庄'] = 'blue';
                            $ys['闲'] = 'gray';
                            $ys['和'] = 'blue';
                            $ys['庄对'] = 'gray';
                            $ys['闲对'] = 'gray';
                            $ys['任意对'] = 'blue';
                            $pb=$bjl->getPB($con['code']);
                            $player=  implode(" ", $bjl->HtmlCard($pb['p']));
                            $bank=  implode(" ", $bjl->HtmlCard($pb['b']));
                            $result=$bjl->Result($pb['p'], $pb['b']);
                            
                            ?>
                            <tr class="<?php echo $line_row;
                            ?>">
                               <td><?php if($kong == '1'){echo date("H:i:s", strtotime($con['opentime']));}else{echo date("H:i:s", strtotime($con['time']));}?></td>
                                <td> <?php echo $con['term'];
                            ?> </td>
                                <td>
								<?php
                                    $zhi = $pb['b'][0] % 13 + 1;
                                    if ($zhi == 11) {
                                        $zhi = 'J';
                                    }
                                    if ($zhi == 12) {
                                        $zhi = 'Q';
                                    }
                                    if ($zhi == 13) {
                                        $zhi = 'K';
                                    }
                                    ?>
                                    <span class="myyk st">庄:</span>
                                    <span class="myyk"><?php echo $zhi; ?></span>
                                    <?php
                                    $zhi = $pb['b'][1] % 13 + 1;
                                    if ($zhi == 11) {
                                        $zhi = 'J';
                                    }
                                    if ($zhi == 12) {
                                        $zhi = 'Q';
                                    }
                                    if ($zhi == 13) {
                                        $zhi = 'K';
                                    }
                                    ?>
                                    <span class="myyk">+</span>
                                    <span class="myyk"><?php echo $zhi; ?></span>
                                    <?php
                                    $zhi = $pb['b'][2] % 13 + 1;
                                    if ($zhi == 11) {
                                        $zhi = 'J';
                                    }
                                    if ($zhi == 12) {
                                        $zhi = 'Q';
                                    }
                                    if ($zhi == 13) {
                                        $zhi = 'K';
                                    }
                                    ?>
                                    <span class="myyk"><?php echo isset($pb['b'][2])?"+":""; ?></span>
                                    <span class="myyk"><?php echo isset($pb['b'][2])?$zhi:""; ?></span>
								<?php
                                    $zhi = $pb['p'][0] % 13 + 1;
                                    if ($zhi == 11) {
                                        $zhi = 'J';
                                    }
                                    if ($zhi == 12) {
                                        $zhi = 'Q';
                                    }
                                    if ($zhi == 13) {
                                        $zhi = 'K';
                                    }
                                    ?>
                                    <span class="myyk st">闲:</span>
                                    <span class="myyk"><?php echo $zhi; ?></span>
                                    <?php
                                    $zhi = $pb['p'][1] % 13 + 1;
                                    if ($zhi == 11) {
                                        $zhi = 'J';
                                    }
                                    if ($zhi == 12) {
                                        $zhi = 'Q';
                                    }
                                    if ($zhi == 13) {
                                        $zhi = 'K';
                                    }
                                    ?>
                                    <span class="myyk">+</span>
                                    <span class="myyk"><?php echo $zhi; ?></span>
                                    <?php
                                    $zhi = $pb['p'][2] % 13 + 1;
                                    if ($zhi == 11) {
                                        $zhi = 'J';
                                    }
                                    if ($zhi == 12) {
                                        $zhi = 'Q';
                                    }
                                    if ($zhi == 13) {
                                        $zhi = 'K';
                                    }
                                    ?>
                                    <span class="myyk"><?php echo isset($pb['p'][2])?"+":""; ?></span>
                                    <span class="myyk"><?php echo isset($pb['p'][2])?$zhi:""; ?></span>
                                </td>
                                <td class="blue"><?php if(in_array('BankerWin', $result)){
                                    echo '◇';
                                }
                            ?></td>
                                <td class="gray"><?php if(in_array('PlayerWin', $result)){
                                    echo '◇';
                                }
                            ?></td>
                                <td class="blue"><?php if(in_array('Draw', $result)){
                                    echo '◇';
                                }
                            ?></td>
                                <td class="gray"><?php if(in_array('BankerPair', $result)){
                                    echo '◇';
                                }
                            ?></td>
                                <td class="blue"><?php if(in_array('PlayerPair', $result)){
                                    echo '◇';
                                }
                            ?></td>
                                <td class="gray"><?php if(in_array('AnyPair', $result)){
                                    echo '◇';
                                }
                            ?></td>
                            </tr>
                    <?php }
                    ?>
                    </tbody>
              	<?php }elseif(strpos($game,'gd11x5')!==false){
			    ?>
                <thead>
                <tr id="th_header">
                    <th width="163" class="">时间</th>
                    <th width="103" class="">期数</th>
                    <th width="380" class="">开奖号码</th>
                    <th colspan="3" class="" width="103">总和</th>
                </tr>
                </thead>
                <tbody id="reslist" linNos="0,1,2,5">
                <?php select_query('fn_open', '*', "`type` = '$type'order by `term` desc limit 40");
                while($con = db_fetch_array()){
                    $cons[] = $con;
                }
                $ay = true;
                foreach($cons as $con){
                    if($ay){
                        $line_row = "";
                        $ay = false;
                    }else{
                        $line_row = "line_row";
                        $ay = true;
                    }
                    $ys['小'] = 'blue';
                    $ys['大'] = 'gray';
                    $ys['单'] = 'blue';
                    $ys['双'] = 'gray';
                    $ys['龙'] = 'gray';
                    $ys['虎'] = 'blue';
                    
                    $codes = explode(",", $con['code']);
                    if(count($codes) != 5){
                        continue;
                    }else{
                        $hz = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4];
                    }
                    $dx = $hz < 33 ? '小' : '大';
                    $ds = $hz % 2 == 0 ? '双' : '单';
                    ?>
                    <tr class="<?php echo $line_row;
                    ?>">
                        <td><?php echo date("H:i:s", strtotime($con['time']));
                            ?></td>
                        <td> <?php echo $con['term'];?> </td>
                        <td>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[0];
                                                ?></span>
                            <span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[1];
                                ?></span>
                            <span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[2];
                                ?></span>
                            <span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[3];
                                ?></span>
                            <span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[4];
                                ?></span>
                        </td>
                        <td class="count"><?php echo $hz;
                            ?></td>
                        <td class="<?php echo $ys[$dx];
                        ?>"><?php echo $dx;
                            ?></td>
                        <td class="<?php echo $ys[$ds];
                        ?>"><?php echo $ds;
                            ?></td>
                    </tr>
                <?php }
                ?>
                </tbody>


			<?php }elseif($game == 'cqssc' || $game == 'jsssc' || $game == 'txffc'|| $game == 'azxy5'){
    ?>
					<thead>
						<tr id="th_header">
							<th width="163" class="">时间</th>
							<th width="103" class="">期数</th>
							<th width="380" class="">开奖号码</th>
							<th colspan="4" class="" width="103">总和</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
	<?php 
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 40");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 40");
  }
    
   
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    $ay = true;
    foreach($cons as $con){
        if($ay){
            $line_row = "";
            $ay = false;
        }else{
            $line_row = "line_row";
            $ay = true;
        }
        $ys['小'] = 'blue';
        $ys['大'] = 'gray';
        $ys['单'] = 'blue';
        $ys['双'] = 'gray';
        $ys['龙'] = 'gray';
        $ys['虎'] = 'blue';
        $ys['和'] = 'green';
        $codes = explode(",", $con['code']);
        if(count($codes) != 5){
            continue;
        }else{
            $hz = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4];
        }
        $dx = $hz < 23 ? '小' : '大';
        $ds = $hz % 2 == 0 ? '双' : '单';
        $lh = (int)$codes[0] > (int)$codes[4] ? '龙' : ((int)$codes[0] == (int)$codes[4] ? '和' : '虎');
        ?>
									<tr class="<?php echo $line_row;
        ?>">
										<td><?php if($kong == '1'){echo date("H:i:s", strtotime($con['opentime']));}else{echo date("H:i:s", strtotime($con['time']));}?></td>
										<td> <?php echo substr($con['term'], -3, 3)?> </td>
										<td>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[0];
        ?></span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[1];
        ?></span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[2];
        ?></span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[3];
        ?></span>
											<span class="  ball_s_ ball_s_blue ball_lenght5  "><?php echo $codes[4];
        ?></span>
										</td>
										<td class="count"><?php echo $hz;
        ?></td>
										<td class="<?php echo $ys[$dx];
        ?>"><?php echo $dx;
        ?></td>
										<td class="<?php echo $ys[$ds];?>"><?php echo $ds;?></td>
                                        <td class="<?php echo $ys[$lh];?>"><?php echo $lh;?></td>
                                      
									</tr>
						<?php }
    ?>
					</tbody>
			<?php }else{
    ?>
					<thead>
						<tr id="th_header">
                            <th width="15%" class="">时间</th>
                            <th width="15%" class="">期数</th>
                            <th width="30%" class="">开奖号码</th>
                            <th colspan='3' class="g_r_line">冠亚</th>
                            <th colspan='5'>1-5球龙虎</th>
						</tr>
					</thead>
					<tbody id="reslist" linNos="0,1,2,5">
	<?php 
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 40");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 40");
  }
 
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    $ay = true;
    foreach($cons as $con){
        if($ay){
            $line_row = "";
            $ay = false;
        }else{
            $line_row = "line_row";
            $ay = true;
        }
        $g = explode(",", $con['code']);
        $ys['小'] = 'blue';
        $ys['大'] = 'gray';
        $ys['单'] = 'blue';
        $ys['双'] = 'gray';
        $ys['龙'] = 'gray';
        $ys['虎'] = 'blue';
        $h['冠亚'] = $g[0] + $g[1];
        $h['冠亚大小'] = ($h['冠亚'] > 11)?'大':'小';
        $h['冠亚单双'] = (($h['冠亚'] % 2) == 0)?'双':'单';
        $adb = array();
        $adb[] = ($g[0] > $g[9])?'龙':'虎';
        $adb[] = ($g[1] > $g[8])?'龙':'虎';
        $adb[] = ($g[2] > $g[7])?'龙':'虎';
        $adb[] = ($g[3] > $g[6])?'龙':'虎';
        $adb[] = ($g[4] > $g[5])?'龙':'虎';
        ?>
									<tr class="<?php echo $line_row;?>">
                                      
										<td><?php if($kong == '1'){echo date("H:i:s", strtotime($con['opentime']));}else{echo date("H:i:s", strtotime($con['time']));}?></td>
                                      
                                      
										<td><?php if($type == '1' || $type == '6' || $type == '7' || $type =='12' || $type == '17'){
            echo $con['term'];
        }else{
            echo substr($con['term'], 8);
        }
        ?></td>
										<td>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[0];
        ?> ball_lenght10" title="<?php echo (int)$g[0];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[1];
        ?> ball_lenght10" title="<?php echo (int)$g[1];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[2];
        ?> ball_lenght10" title="<?php echo (int)$g[2];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[3];
        ?> ball_lenght10" title="<?php echo (int)$g[3];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[4];
        ?> ball_lenght10" title="<?php echo (int)$g[4];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[5];
        ?> ball_lenght10" title="<?php echo (int)$g[5];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[6];
        ?> ball_lenght10" title="<?php echo (int)$g[6];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[7];
        ?> ball_lenght10" title="<?php echo (int)$g[7];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[8];
        ?> ball_lenght10" title="<?php echo (int)$g[8];
        ?>">&nbsp;</span>
											<span class="ball_pks_  ball_pks<?php echo (int)$g[9];
        ?> ball_lenght10" title="<?php echo (int)$g[9];
        ?>">&nbsp;</span>
										</td>
										<td class="count"><?php echo $h['冠亚'];
        ?></td>
										<td class="<?php echo $ys[$h['冠亚大小']];
        ?>"><?php echo $h['冠亚大小'];
        ?></td>
										<td class="<?php echo $ys[$h['冠亚单双']];
        ?> g_r_line g_td_p_right"><?php echo $h['冠亚单双'];
        ?></td>
										<td class="<?php echo $ys[$adb[0]];
        ?> g_td_p_left"><?php echo $adb[0];
        ?></td>
										<td class="<?php echo $ys[$adb[1]];
        ?>"><?php echo $adb[1];
        ?></td>
										<td class="<?php echo $ys[$adb[2]];
        ?>"><?php echo $adb[2];
        ?></td>
										<td class="<?php echo $ys[$adb[3]];
        ?>"><?php echo $adb[3];
        ?></td>
										<td class="<?php echo $ys[$adb[4]];
        ?>"><?php echo $adb[4];
        ?></td>
									</tr>
						<?php }
    ?>
					</tbody>
			<?php }
?>
			</table>
			<div class="sub_hr"></div>
		</div>
	</div>
	<div class="clear"></div>
</body>
