<?
include_once('../../../Public/config.php');

require_once('./bjlhs.php');
$bjl = new bjl();
$roomid = $_SESSION['roomid'];
function bjl($roomid){
//$moshi=4;
$moshi=get_query_val('fn_lottery10','shenglv',array('roomid'=>$roomid));                     //模式0赢最多1赢随机2赢最少3随机4输最多5输最少
$jingque=500;                 //精确程度0-500   数值越大越精确建议300-400
$type=10;                     //极速赛车游戏ID
$qishua=explode('|',chaqishu());
if(strtotime($qishua[1])<time()){
	$qishu=$qishua[2];
	$opentime=$qishua[1];
    $nextterm=$qishua[0];
    $nexttime=$qishua[3];
}else{
exit;
}
$zhudan=chazhudan($roomid,$qishu);
$zzhaoma="";//最终号码
$sjmoney=0;//对比数  随机赢开出
$jieguo=0;//最终赢多少
$zsmoney=99999999;//对比数赢最少开出
$szdmoney=0;//输最多开出
$szsmoney=-99999999;//输最少开出
$qianzui="{\"ID\":10,\"code\":\"qq1878336950\",\"lottery\":\"bjl\",\"data\":[{\"expect\":";
$zhudan1=explode('|',$zhudan);
if($zhudan1[0]=="" || $moshi=="3"){
	//没有注单或随机开出
$zzhaoma=randK();
if($zzhaoma){

return $qianzui.$qishu.",\"opencode\":\"".$zzhaoma."\",\"opentime\":\"".$opentime."\",\"next_term\":\"".$nextterm."\",\"next_time\":\"".$nexttime."\"}]}";
exit;
}
}else{
	//有注单

		for($i=0;$i<$jingque;$i++){
			$haoma=randK();
			 if($moshi=="0"){   //赢最多
			    $money=jsshuying($haoma,$zhudan);
				if($jieguo<$money){
					$jieguo=$money;
					$zzhaoma=$haoma;
				}	
			}else if($moshi=="1"){//随机赢
				$money=jsshuying($haoma,$zhudan);
				if($sjmoney<$money){
					$jieguo=$money;
					$zzhaoma=$haoma;
					break;
				}	
			}else if($moshi=="2"){//赢最少
				$money=jsshuying($haoma,$zhudan);
				if($zsmoney>$money && $money>0){
					$zsmoney=$money;
					$jieguo=$zsmoney;
					$zzhaoma=$haoma;
				}
				
			}else if($moshi=='4'){//输最多
				$money=jsshuying($haoma,$zhudan);
					if($money<$szdmoney){
						$szdmoney=$money;
						$jieguo=$szdmoney;
						$zzhaoma=$haoma;
						}
			}else if($moshi=='5'){//输最少
				$money=jsshuying($haoma,$zhudan);
					if($money>$szsmoney && $money<0){
						$szsmoney=$money;
						$jieguo=$szsmoney;
						$zzhaoma=$haoma;
						}
			}
		}		
		if($zzhaoma==""){
			for($i=0;$i<$jingque;$i++){
			$money=jsshuying($haoma,$zhudan);
				if($zsmoney>$money && $money>0){
					$zsmoney=$money;
					$jieguo=$zsmoney;
					$zzhaoma=$haoma;
				}
			}
		}		
		if($zzhaoma){
	
		return $qianzui.$qishu.",\"opencode\":\"".$zzhaoma."\",\"opentime\":\"".$opentime."\",\"next_term\":\"".$nextterm."\",\"next_time\":\"".$nexttime."\"}]}";
		exit;
		}
}
}   
?>	


<?
include_once "./bjl_class.php";

$roomid = $_SESSION['roomid'];
$arr = bjl($roomid);
echo $arr;
echo '<br>';
$data = json_decode($arr,1);  
$term = $data['data'][0]['expect'];
$code = $data['data'][0]['opencode'];
$opentime = $data['data'][0]['opentime'];  
$next_time = $data['data'][0]['next_time'];
$next_term = $data['data'][0]['next_term'];
echo '<br>';

?>

 <thead>
                    </thead>
                    <tbody id="reslist" linNos="0,1,2,5">
                        <?php
          $con  = array('code'=>$code,'term'=>$term,'opentime'=>$opentime);
          //            $con = get_query_vals('fn_sopen','*',"`type`=10 order by `term` desc limit 1");
                        $ay = true;
                        $bjl=new bjl();
                        
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
                               <td><?php echo date("H:i:s", strtotime($con['opentime']));?></td>
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
                                    echo '庄赢';
                                }
                            ?></td>
                                <td class="gray"><?php if(in_array('PlayerWin', $result)){
                                    echo '闲赢';
                                }
                            ?></td>
                                <td class="blue"><?php if(in_array('Draw', $result)){
                                    echo '和';
                                }
                            ?></td>
                                <td class="gray"><?php if(in_array('BankerPair', $result)){
                                    echo '庄对';
                                }
                            ?></td>
                                <td class="blue"><?php if(in_array('PlayerPair', $result)){
                                    echo '闲对';
                                }
                            ?></td>
                                <td class="gray"><?php if(in_array('AnyPair', $result)){
                                    echo '任意和';
                                }
                            ?></td>
                            </tr>
                 
                    </tbody>