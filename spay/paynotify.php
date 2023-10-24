<?php
/**
 * ---------------------通知异步回调接收页-------------------------------

    include_once("../Public/config.php"); 
    $platform_trade_no = $_POST['platform_trade_no'];
    $orderid = $_POST['orderid'];
    $price = $_POST['price'];
    $realprice = $_POST['realprice'];
    $roomid = $_POST['orderuid'];  
    $key = $_POST['key'];
    $db = get_query_vals('fn_upmark','*',"orderid = {$orderid}");
    $status = $db['status'];
    $orderuid = $db['userid'];  
    $money = round(get_query_val("fn_user", "money", array("userid" => $orderuid , 'roomid' => $roomid)),2);                
    $tokey = get_query_val("fn_setting", "skey", array("roomid" => $roomid));  
    $chuli = '已处理';  
    $temps = md5($orderid . $roomid . $platform_trade_no . $price . $realprice . $token);
    if ($temps != $key){
        return jsonError('key值不匹配');
    }else if($status == '已处理'){           
        die('OK');                  
    }else{

        $price = round($price,2);      
        $moneys = $money+$price;
        //校验key成功，是自己人。执行自己的业务逻辑：加余额，订单付款成功，装备购买成功等等。
        
        continue;
      }
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


 * ---------------------通知异步回调接收页-------------------------------
 * 
 * 此页就是您之前传给pay.qpayapi.com的notify_url页的网址
 * 支付成功，平台会根据您之前传入的网址，回调此页URL，post回参数
 * 
 * --------------------------------------------------------------
 */
    session_start();
    require_once 'mysqli.php';
    $db  = ConnectMysqli::getInstance();    
    $platform_trade_no = $_POST["platform_trade_no"];
    $orderid = $_POST["orderid"];
    $price = $_POST["price"];
    $realprice = $_POST["realprice"];
    $roomid = $_POST["orderuid"];
    $key = $_POST["key"];
     // $money $_POST["money"];
    //校验传入的参数是否格式正确，略
    $sqlo = "select * from fn_upmark where orderid='$orderid'";
    $queryy=$db->query($sqlo);
	$roww=$queryy->fetch_array();
    $status = $roww["status"];
    $orderuid = $roww["userid"];

    $sql = "select * from fn_user where userid='$orderuid' and roomid='$roomid'";
    $query = $db->query($sql);
	$row = $query->fetch_array();
    $money = $row["money"];

    $sqlll = "select * from fn_setting where roomid='$roomid'";
    $queryl = $db->query($sqlll);
	$row1 = $queryl->fetch_array();
    $token = $row1["skey"];   

    $temps = md5($orderid . $roomid . $platform_trade_no . $price . $realprice . $token);
    if ($temps != $key){
        return jsonError("key值不匹配");
    }else if($status == '已处理'){           
        die("OK");                  
    }else{
        $price = round($price,2);      
        $money+=$price;
        //校验key成功，是自己人。执行自己的业务逻辑：加余额，订单付款成功，装备购买成功等等。
        $update_sql = " update fn_upmark set status= '已处理' where orderid = '$orderid'";
        $db->query($update_sql);
        $update_sqll = " update fn_user set money= '$money' where userid = '$orderuid' and roomid='$roomid'";
        $db->query($update_sqll);   
        exit;
      }

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
    
	
  


?>