<?php
/**
 * ---------------------参数生成页-------------------------------
 * 在您自己的服务器上生成新订单，并把计算好的订单信息传给您的前端网页。
 * 注意：
 * 1.key一定要在服务端计算，不要在网页中计算。
 * 2.token只能存放在服务端，不可以以任何形式存放在网页代码中（可逆加密也不行），也不可以通过url参数方式传入网页。
 * 3.接口跑通后，如果发现收款二维码是我们官方的，请检查APP是否正在运行。为保障您收款功能正常，如果您的收款手机APP掉线超过一分钟，就会触发代收款机制，详情请看网站帮助。
 * --------------------------------------------------------------
 */
 session_start();
	include_once("../Public/config.php");
    $price = $_POST["price"];   
    $istype = $_POST["istype"];  
    $userid = $_SESSION['username'];  
    $headimg = $_SESSION['headimg'];  
    $goodsname = '上分';
    $game = $_SESSION['game'];  
    $orderuid = $_SESSION['userid'];    
    $roomid = $_SESSION['roomid'];  
    $orderid = StrOrderOne();   
    $fangshi = '联系客服充值';
    $jieguo = '未处理';
    $jia = 'false';
    $sql = get_query_vals('fn_setting','*',array('roomid'=>$roomid));
    $uid = $sql['sid'];
    $token = $sql['skey'];
   // $return_url = 'http://ymh8.cn/wpay/payreturn.php';
    $return_url = 'http://'.$_SERVER['HTTP_HOST'].'/qr.php?room='.$roomid;
    $notify_url = 'http://'.$_SERVER['HTTP_HOST'].'/wpay/paynotify.php';
    $key = md5($goodsname. $istype . $notify_url . $orderid . $roomid . $price . $return_url . $token . $uid);
    $returndata['goodsname'] = $goodsname;
    $returndata['istype'] = $istype;
    $returndata['key'] = $key;
    $returndata['notify_url'] = $notify_url;
    $returndata['orderid'] = $orderid;
    $returndata['orderuid'] = $roomid;
    $returndata['price'] = $price;
    $returndata['return_url'] = $return_url;
    $returndata['uid'] = $uid;
	//插入数据
	$time = date('Y-m-d H:i:s');
   file_put_contents("callback_log1.txt", json_encode($_SESSION));
    insert_query('fn_upmark',array('userid'=>$orderuid,'headimg'=>$headimg,'username'=>$userid,'type'=>$goodsname,'money'=>$price,'time'=>$time,'status'=>$jieguo,'game'=>$game,'roomid'=>$roomid,'jia'=>$jia,'orderid'=>$orderid ,'czfangshi'=>$fangshi));
    echo jsonSuccess("OK",$returndata,"");
    //返回错误
    function jsonError($message = '',$url=null) 
    {
        $return['msg'] = $message;
        $return['data'] = '';
        $return['code'] = -1;
        $return['url'] = $url;
        return json_encode($return);
    }
    //返回正确
    function jsonSuccess($message = '',$data = '',$url=null) 
    {
        $return['msg']  = $message;
        $return['data'] = $data;
        $return['code'] = 1;
        $return['url'] = $url;
        return json_encode($return);
    }	
	function StrOrderOne(){
		date_default_timezone_set('Asia/Shanghai');
		/* 选择一个随机的方案 */
		mt_srand((double) microtime() * 1000000);
		return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
	}

?>