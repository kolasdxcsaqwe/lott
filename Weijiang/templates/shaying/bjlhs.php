<?php
include_once('../../../Public/config.php');
include_once('../../../Public/Bjl_1.php');
$bjl = new bjl();

function chaqishu(){
return opencan();
}
//返回注单
 function chazhudan($roomid,$qishu){
	 select_query('fn_bjlorder','*',array('roomid'=>$roomid,'term'=>$qishu,'jia'=>'false','status'=>'未结算'));
    while($db = db_fetch_array()){
     $rs[] = $db;
    }
	if($rs){
	$lie="";
	for($i=0;$i<count($rs);$i++){           
  $lie=$lie.$rs[$i]['content'].",".$rs[$i]['money'].",".peilv($rs[$i]['content'],$roomid)."|";
	}
return substr($lie,0,strlen($lie)-1);
	}
}
//返回随机号码 
function randK(){
  $poker = array();
            for ($index = 0; $index < 52; $index++) {
                $poker[$index] = $index;
            }
            //开奖号码
            $code = array();
            $rank = array_rand($poker, 6);
            //实际点数
            $p = 0;
            $b = 0;
            //有效点数
            $yxp = 0;
            $yxb = 0;

            $poker1 = $rank[0] % 13 + 1;
            $poker1 = $poker1 >= 10 ? 0 : $poker1;
            $p+=$poker1;
            $code[] = $rank[0];

            $poker2 = $rank[1] % 13+1;
            $poker2 = $poker2 >= 10 ? 0 : $poker2;
            $b+=$poker2;
            $code[] = $rank[1];

            $poker3 = $rank[2] % 13+1;
            $poker3 = $poker3 >= 10 ? 0 : $poker3;
            $p+=$poker3;
            $code[] = $rank[2];

            $poker4 = $rank[3] % 13+1;
            $poker4 = $poker4 >= 10 ? 0 : $poker4;
            $b+=$poker4;
            $code[] = $rank[3];

            $yxp = $p % 10;
            $yxb = $b % 10;
            if ($yxp == 8 || $yxp == 9 || $yxb == 8 || $yxb == 9) {
                
            } else {

                $poker5 = $rank[4] % 13;
                $poker5 = $poker5 >= 10 ? 0 : $poker5;
                $p+=$poker5;
                $code[] = $rank[4];
                $yxp = $p % 10;
                $yxb = $b % 10;
                if ($yxp < $yxb) {
                    
                } else {
                    $poker6 = $rank[5] % 13;
					if($poker6>=10){
						$poker6=0;
					}
                    $b+=$poker6;
                    $code[] = $rank[5];
                }
            }
            $code_str=  implode(",", $code);
            return $code_str;
}	   
	
//计算输赢
function jsshuying($haoma,$zhudan){
//$hh=explode(',',$haoma);
$zhudan2=explode('|',$zhudan);
$count=count($zhudan2); 
$jiner=0;
for($i=0;$i<$count;$i++) 
{ 
$zhudan3=explode(',',$zhudan2[$i]);
                         //随机号码组，内容，赔率，金额
$fanhuishuying=jisuanjieguo($haoma,$zhudan3[0],$zhudan3[2],$zhudan3[1]);
$jiner=$fanhuishuying+$jiner;
} 
return $jiner;
}	   
	   
//分布式运算        //随机号码组，内容，赔率，金额
function jisuanjieguo($result,$content,$peilv,$jine){

  switch ($content){
        case '庄':
            return zhuangpk($result,$peilv,$jine);
           break;
        case '闲':
            return xianpk($result,$peilv,$jine);
           break;
        case '和':
            return hepk($result,$peilv,$jine);
           break;
        case '庄对':
            return zhuangduipk($result,$peilv,$jine);
           break;
        case '闲对':
            return xianduipk($result,$peilv,$jine);
           break;
        case '任意和':
            return anyhepk($result,$peilv,$jine);
           break;
    }

}

     
function zhuangpk($mnmc,$peilv,$jine){
  $bjl = new bjl();
        $pb = $bjl->getPB($mnmc);
		$res = $bjl->Result($pb['p'], $pb['b']);
if (in_array('BankerWin', $res)) {
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}	 
function xianpk($mnmc,$peilv,$jine){
  $bjl = new bjl();
        $pb = $bjl->getPB($mnmc);
		$res = $bjl->Result($pb['p'], $pb['b']);
if (in_array('PlayerWin', $res)) {
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
function hepk($mnmc,$peilv,$jine){
  $bjl = new bjl();
        $pb = $bjl->getPB($mnmc);
		$res = $bjl->Result($pb['p'], $pb['b']);

if (in_array('Draw', $res)) {
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
function zhuangduipk($mnmc,$peilv,$jine){
  $bjl = new bjl();
        $pb = $bjl->getPB($mnmc);
		$res = $bjl->Result($pb['p'], $pb['b']);
if (in_array('BankerPair', $res)) {
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
function xianduipk($mnmc,$peilv,$jine){
  $bjl = new bjl();
        $pb = $bjl->getPB($mnmc);
		$res = $bjl->Result($pb['p'], $pb['b']);
 
if (in_array('PlayerPair', $res)) {
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
function anyhepk($mnmc,$peilv,$jine){
  $bjl = new bjl();
        $pb = $bjl->getPB($mnmc);
		$res = $bjl->Result($pb['p'], $pb['b']);
if (in_array('AnyPair', $res)) {
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
//查询赔率
function peilv($content,$roomid){
  switch($content){
    case '庄': $ziduan = '`zhuang`';
    break; 
    case '闲': $ziduan = '`xian`';
    break;    
    case '和': $ziduan = '`he`';
    break;
    case '庄对': $ziduan = '`zhuangdui`';
    break;
    case '闲对': $ziduan = '`xiandui`';
    break;
    case '任意和': $ziduan = '`anydui`';
    break;   
}
  $peilv = get_query_val('fn_lottery10',$ziduan,array('roomid'=>$roomid));
return $peilv;
}
	   
function opencan(){
  $bjl = new bjl();
 $cur = $bjl->get_period_info($bjl->getTodayCur());
           $term =$cur['periodNumber'];
           $time  =$cur['awardTime'];
           $next_term =$cur['next_periodNumber'];
           $next_time =$cur['next_awardTime'];
return ($term.'|'.$time.'|'.$next_term.'|'.$next_time);

}	   
	   
	

 

	   
  
?>