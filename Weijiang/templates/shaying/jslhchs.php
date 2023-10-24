<?php
include_once('../../../Public/config.php');

function chaqishu(){

return opencan();

}
//返回注单
 function chazhudan($roomid,$qishu){
	 select_query('fn_jslhcorder','*',array('roomid'=>$roomid,'term'=>$qishu,'jia'=>'false','status'=>'未结算'));
    while($db = db_fetch_array()){
     $rs[] = $db;
    }
	if($rs){
	$lie="";
	for($i=0;$i<count($rs);$i++){           
$lie=$lie.$rs[$i]['mingci'].",".$rs[$i]['content'].",".$rs[$i]['money'].",".peilv($rs[$i]['mingci'],$rs[$i]['content'],$roomid)."|";
	}
return substr($lie,0,strlen($lie)-1);
	}
}
//返回随机号码 
function randK(){
$aa = range(1,49);
$a = array_rand($aa,7);
shuffle($a);
 $code_str = $aa[$a[0]].','.$aa[$a[1]].','.$aa[$a[2]].','.$aa[$a[3]].','.$aa[$a[4]].','.$aa[$a[5]].','.$aa[$a[6]]; 
  return $code_str;
}	   
	
//计算输赢
function jsshuying($haoma,$zhudan){
$hh=explode(',',$haoma);
$zhudan2=explode('|',$zhudan);
$count=count($zhudan2); 
$jiner=0;
for($i=0;$i<$count;$i++) 
{ 
$zhudan3=explode(',',$zhudan2[$i]);
                         //随机号码组，名次，内容，赔率，金额
$fanhuishuying=jisuanjieguo($hh,$zhudan3[0],$zhudan3[1],$zhudan3[3],$zhudan3[2]);
$jiner=$fanhuishuying+$jiner;
} 
return $jiner;
}	   
	   
//分布式运算        //随机号码组，名次，内容，赔率，金额
function jisuanjieguo($result,$mingci,$content,$peilv,$jine){
if(is_numeric($mingci)){  
	switch ($mingci){
		case'1': 
			return jieguopk($result[0],$content,$peilv,$jine);
			break;
		case '2' : 
			return jieguopk($result[1],$content,$peilv,$jine);
			break;
		case '3' : 
			return jieguopk($result[2],$content,$peilv,$jine);
			break;
		case '4' : 
			return jieguopk($result[3],$content,$peilv,$jine);
			break;
		case '5' : 
			return jieguopk($result[4],$content,$peilv,$jine);
			break;
		case '6' : 
			return jieguopk($result[5],$content,$peilv,$jine);
			break;
		case '7' : 
			return jieguopk($result[6],$content,$peilv,$jine);
			break;
	}
}elseif(is_string($mingci)){
  switch ($mingci){
        case '2中':
            return zhengpk2($result,$content,$peilv,$jine);
           break;
        case '3中':
            return zhengpk3($result,$content,$peilv,$jine);
           break;
        case '4中':
            return zhengpk4($result,$content,$peilv,$jine);
           break;
        case '2肖':
            return lianxiaopk($result,$content,$peilv,$jine);
           break;
        case '3肖':
            return lianxiaopk($result,$content,$peilv,$jine);
           break;
        case '4肖':
            return lianxiaopk($result,$content,$peilv,$jine);
           break;
        case '5肖':
            return lianxiaopk($result,$content,$peilv,$jine);
           break;
    }
}
}

function shengxiao($mingci){
			$shengxiao = array(
			1=>'猪', 13=>'猪', 25=>'猪', 37=>'猪', 49=>'猪', 
			12=>'鼠', 24=>'鼠', 36=>'鼠', 48=>'鼠', 
			11=>'牛', 23=>'牛', 35=>'牛', 47=>'牛', 
			10=>'虎', 22=>'虎', 34=>'虎', 46=>'虎', 
			9=>'兔', 21=>'兔', 33=>'兔', 45=>'兔',
			8=>'龙', 20=>'龙', 32=>'龙', 44=>'龙',
			7=>'蛇', 19=>'蛇', 31=>'蛇', 43=>'蛇',
			6=>'马', 18=>'马', 30=>'马', 42=>'马',
			5=>'羊', 17=>'羊', 29=>'羊', 41=>'羊',
			4=>'猴', 16=>'猴', 28=>'猴', 40=>'猴',
			3=>'鸡', 15=>'鸡', 27=>'鸡', 39=>'鸡',
			2=>'狗', 14=>'狗', 26=>'狗', 38=>'狗',
		);
  
  return $shengxiao[(int)$mingci];	
}
function sebo($mingci){
$sebo = array(
			'1'=>'红波','2'=>'红波','7'=>'红波','8'=>'红波','12'=>'红波','13'=>'红波','18'=>'红波','19'=>'红波','23'=>'红波','24'=>'红波','29'=>'红波','30'=>'红波','34'=>'红波','35'=>'红波','40'=>'红波','45'=>'红波','46'=>'红波',
			'3'=>'蓝波','4'=>'蓝波','9'=>'蓝波','10'=>'蓝波','14'=>'蓝波','15'=>'蓝波','20'=>'蓝波','25'=>'蓝波','26'=>'蓝波','31'=>'蓝波','36'=>'蓝波','37'=>'蓝波','41'=>'蓝波','42'=>'蓝波','47'=>'蓝波','48'=>'蓝波',
			'5'=>'绿波','6'=>'绿波','11'=>'绿波','16'=>'绿波','17'=>'绿波','21'=>'绿波','22'=>'绿波','27'=>'绿波','28'=>'绿波','32'=>'绿波','33'=>'绿波','38'=>'绿波','39'=>'绿波','43'=>'绿波','44'=>'绿波','49'=>'绿波'
		);
 return $sebo[(int)$mingci];
}
	          
function jieguopk($mnmc,$content,$peilv,$jine){

	$ifdanshuang="";
	$ifdaxiao="";
    $shengxiao="";
    $sebo="";
  
	if($mnmc>=25){
		$ifdaxiao="大";
	}else{
		$ifdaxiao="小";
	}
	
	if ($mnmc%2==0) {
		$ifdanshuang="双";	 	
	}else{
		$ifdanshuang="单";	
	}
    $shengxiao=shengxiao((int)$mnmc);
    $sebo=sebo((int)$mnmc);
  
	if(($content==$mnmc)||($content==$ifdaxiao)||($content==$ifdanshuang)||($content==$shengxiao)||($content==$sebo)){	
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}	   

function zhengpk2($result,$content,$peilv,$jine){
  $zhong = explode('.',$content);
  $zhong1 = false;
    if(in_array($zhong[0],$result) && in_array($zhong[1],$result)){
  $zhong1=true;
  }
    if($zhong1){	
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
function zhengpk3($result,$content,$peilv,$jine){
  $zhong = explode('.',$content);
  $zhong1 = false;
    if(in_array($zhong[0],$result) && in_array($zhong[1],$result) && in_array($zhong[2],$result)){
  $zhong1=true;
  }
    if($zhong1){	
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}
function zhengpk4($result,$content,$peilv,$jine){
  $zhong = explode('.',$content);
  $zhong1 = false;
    if(in_array($zhong[0],$result) && in_array($zhong[1],$result) && in_array($zhong[2],$result) && in_array($zhong[3],$result)){
  $zhong1=true;
  }
    if($zhong1){	
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}	
}

function lianxiaopk($result,$content,$peilv,$jine){
 $lianxiao = fenge($content);
 $lian = shengxiao($result[0]).','.shengxiao($result[1]).','.shengxiao($result[2]).','.shengxiao($result[3]).','.shengxiao($result[4]).','.shengxiao($result[5]).','.shengxiao($result[6]);
 $arr = explode(',',$lian);
  
  if(count($lianxiao)==2){
  if(in_array($lianxiao[0],$arr) && in_array($lianxiao[1],$arr)){
  $zhong1=true;
  }
  }elseif(count($lianxiao)==3){
    if(in_array($lianxiao[0],$arr) && in_array($lianxiao[1],$arr) && in_array($lianxiao[2],$arr)){
  $zhong1=true;
  }
  }elseif(count($lianxiao)==4){
    if(in_array($lianxiao[0],$arr) && in_array($lianxiao[1],$arr) && in_array($lianxiao[2],$arr) && in_array($lianxiao[3],$arr)){
  $zhong1=true;
  }
  }elseif(count($lianxiao)==5){
    if(in_array($lianxiao[0],$arr) && in_array($lianxiao[1],$arr) && in_array($lianxiao[2],$arr) && in_array($lianxiao[3],$arr) && in_array($lianxiao[4],$arr)){
  $zhong1=true;
  }
  }else{
  $zhong1 = false;
  }
  if($zhong1){	
		return $jine*(1-$peilv);			
	}else {	
	 	return $jine;
	}
}


//查询赔率
function peilv($mingci,$content,$roomid){
if(is_numeric($mingci) && is_numeric($content)){
  $ziduan = 'haoma';
  $peilv = get_query_val('fn_lottery14',$ziduan,array('roomid'=>$roomid));
return $peilv;
}elseif(is_numeric($mingci) && is_string($content)){
  switch($content){
    case '大': $ziduan = 'da';
    break; 
    case '小': $ziduan = 'xiao';
    break;    
    case '单': $ziduan = 'dan';
    break;
    case '双': $ziduan = 'shuang';
    break;
    case '红波': $ziduan = 'hongbo';
    break;
    case '蓝波': $ziduan = 'lanbo';
    break;
    case '绿波': $ziduan = 'lvbo';
    break; 
    case '猴':case '羊':case '马':case '蛇':case '龙':case '兔':case '虎':case '牛':case '鼠':case '猪':case '狗':case '鸡': $ziduan = 'shengxiao';
    break;  
  }
$peilv = get_query_val('fn_lottery14',$ziduan,array('roomid'=>$roomid));
return $peilv;
}elseif(is_string($mingci) && is_string($content)){
 switch($mingci){
    case '2中': $ziduan = 'zheng2';
    break;
    case '3中': $ziduan = 'zheng3';
    break;
    case '4中': $ziduan = 'zheng4';
    break;
    case '2肖': $ziduan = 'xiao2';
    break;
    case '3肖': $ziduan = 'xiao3';
    break;
    case '4肖': $ziduan = 'xiao4';
    break;
    case '5肖': $ziduan = 'xiao5';
    break;
  }
  $peilv = get_query_val('fn_lottery14',$ziduan,array('roomid'=>$roomid));
return $peilv;
}
}
	   
function opencan(){
$fixno = "500000 ";
$daynum = floor((time() - strtotime("2017-01-01 00:00:00")) / 3600 / 24);
$lastno = ($daynum - 1) * 288 + $fixno;
$tarr = ["00:00:30","00:05:30","00:10:30","00:15:30","00:20:30","00:25:30","00:30:30","00:35:30","00:40:30","00:45:30","00:50:30","00:55:30","01:00:30","01:05:30","01:10:30","01:15:30","01:20:30","01:25:30","01:30:30","01:35:30","01:40:30","01:45:30","01:50:30","01:55:30","02:00:30","02:05:30","02:10:30","02:15:30","02:20:30","02:25:30","02:30:30","02:35:30","02:40:30","02:45:30","02:50:30","02:55:30","03:00:30","03:05:30","03:10:30","03:15:30","03:20:30","03:25:30","03:30:30","03:35:30","03:40:30","03:45:30","03:50:30","03:55:30","04:00:30","04:05:30","04:10:30","04:15:30","04:20:30","04:25:30","04:30:30","04:35:30","04:40:30","04:45:30","04:50:30","04:55:30","05:00:30","05:05:30","05:10:30","05:15:30","05:20:30","05:25:30","05:30:30","05:35:30","05:40:30","05:45:30","05:50:30","05:55:30","06:00:30","06:05:30","06:10:30","06:15:30","06:20:30","06:25:30","06:30:30","06:35:30","06:40:30","06:45:30","06:50:30","06:55:30","07:00:30","07:05:30","07:10:30","07:15:30","07:20:30","07:25:30","07:30:30","07:35:30","07:40:30","07:45:30","07:50:30","07:55:30","08:00:30","08:05:30","08:10:30","08:15:30","08:20:30","08:25:30","08:30:30","08:35:30","08:40:30","08:45:30","08:50:30","08:55:30","09:00:30","09:05:30","09:10:30","09:15:30","09:20:30","09:25:30","09:30:30","09:35:30","09:40:30","09:45:30","09:50:30","09:55:30","10:00:30","10:05:30","10:10:30","10:15:30","10:20:30","10:25:30","10:30:30","10:35:30","10:40:30","10:45:30","10:50:30","10:55:30","11:00:30","11:05:30","11:10:30","11:15:30","11:20:30","11:25:30","11:30:30","11:35:30","11:40:30","11:45:30","11:50:30","11:55:30","12:00:30","12:05:30","12:10:30","12:15:30","12:20:30","12:25:30","12:30:30","12:35:30","12:40:30","12:45:30","12:50:30","12:55:30","13:00:30","13:05:30","13:10:30","13:15:30","13:20:30","13:25:30","13:30:30","13:35:30","13:40:30","13:45:30","13:50:30","13:55:30","14:00:30","14:05:30","14:10:30","14:15:30","14:20:30","14:25:30","14:30:30","14:35:30","14:40:30","14:45:30","14:50:30","14:55:30","15:00:30","15:05:30","15:10:30","15:15:30","15:20:30","15:25:30","15:30:30","15:35:30","15:40:30","15:45:30","15:50:30","15:55:30","16:00:30","16:05:30","16:10:30","16:15:30","16:20:30","16:25:30","16:30:30","16:35:30","16:40:30","16:45:30","16:50:30","16:55:30","17:00:30","17:05:30","17:10:30","17:15:30","17:20:30","17:25:30","17:30:30","17:35:30","17:40:30","17:45:30","17:50:30","17:55:30","18:00:30","18:05:30","18:10:30","18:15:30","18:20:30","18:25:30","18:30:30","18:35:30","18:40:30","18:45:30","18:50:30","18:55:30","19:00:30","19:05:30","19:10:30","19:15:30","19:20:30","19:25:30","19:30:30","19:35:30","19:40:30","19:45:30","19:50:30","19:55:30","20:00:30","20:05:30","20:10:30","20:15:30","20:20:30","20:25:30","20:30:30","20:35:30","20:40:30","20:45:30","20:50:30","20:55:30","21:00:30","21:05:30","21:10:30","21:15:30","21:20:30","21:25:30","21:30:30","21:35:30","21:40:30","21:45:30","21:50:30","21:55:30","22:00:30","22:05:30","22:10:30","22:15:30","22:20:30","22:25:30","22:30:30","22:35:30","22:40:30","22:45:30","22:50:30","22:55:30","23:00:30","23:05:30","23:10:30","23:15:30","23:20:30","23:25:30","23:30:30","23:35:30","23:40:30","23:45:30","23:50:30","23:55:30"];
$c = 0;
$t = '';
if (date('H:i:s') > '23:55:30') {
    $c = 288;
    $t = date('Y-m-d ',strtotime('+1 day')).'00:00:30';
} else {
    for ($i = 0; $i < 288; $i++) {
        if ($tarr[$i] > date('H:i:s')) {
            $c = $i + 1;
            $t = date('Y-m-d ').$tarr[$i];
            break;
        }
    }
}
$term = ($lastno + $c) - 1;
$time = date('Y-m-d H:i:s', strtotime($t) - 300);
$next_term = ($lastno + $c);
$next_time = $t;
 
return ($term.'|'.$time.'|'.$next_term.'|'.$next_time);

}	   
	   
function fenge($str, $split_len = 1) {
        if (!preg_match('/^[0-9]+$/', $split_len) || $split_len < 1) return FALSE;
        $len = mb_strlen($str, 'UTF-8');
        if ($len <= $split_len) return array($str);
        preg_match_all("/.{" . $split_len . '}|[^x00]{1,' . $split_len . '}$/us', $str, $ar);
        return $ar[0];
    }	   
	   
	   
	   
  
?>