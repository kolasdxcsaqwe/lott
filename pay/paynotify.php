<?php
/*
 * 回调通知入库
 *
 */
    //连接数据库
	include_once('../Public/config.php');
      $po = $_REQUEST;
      $arr = get_query_vals('fn_upmark','*',array('orderid'=>$po['record']));
      $moneys = get_query_val('fn_user','money',array('userid'=>$arr['userid'],'roomid'=>$arr['roomid']));
      $keys = get_query_vals('fn_setting','*',array('roomid'=>$arr['roomid']));//KEY 和云端和软件上面保持一致 

          	$sdk_suc = 0;
   
              $sign = md5(number_format($po['money'], 2, '.','').trim($po['record']).$keys['sid']);
                if($po['sign'] == $sign) {
                  $sdk_suc=200;
                }
        

     if($sdk_suc!=200) exit("sign error");

    if($arr['status'] == '已处理'){  
     exit("ok");
    }else{
        $money = $po['money'];    
        $moneys+=$money;
        update_query('fn_upmark',array('status'=>'已处理'),array('orderid'=>$po['record']));      
        update_query('fn_user',array('money'=>$moneys),array('roomid'=>$arr['roomid'],'userid'=>$arr['userid']));               
        exit("ok");
        }
        

?>