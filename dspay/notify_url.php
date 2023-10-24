<?php
include_once('../Public/config.php');
require_once("zpay.config.php");
require_once("lib/zpay_notify.class.php");
file_put_contents('log.txt',json_encode($_REQUEST));
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

      $arr = get_query_vals('fn_upmark','*',array('orderid'=> $_REQUEST['out_trade_no']));
      $moneys = get_query_val('fn_user','money',array('userid'=>$arr['userid'],'roomid'=>$arr['roomid']));
      $keys = get_query_vals('fn_setting','*',array('roomid'=>$arr['roomid']));//KEY 和云端和软件上面保持一致 

if($verify_result){
	if ($_REQUEST['trade_status'] == 'TRADE_SUCCESS'){
 if($arr['status'] == '已处理'){  
     exit("success");
    }else{
        $money = $_REQUEST['money'];    
        $moneys+=$money;
        update_query('fn_upmark',array('status'=>'已处理','money'=>$_REQUEST['money']),array('orderid'=>$_REQUEST['out_trade_no']));      
        update_query('fn_user',array('money'=>$moneys),array('roomid'=>$arr['roomid'],'userid'=>$arr['userid']));               
        exit("success");
        }
    }
}else{
    echo "fail";
}
?>