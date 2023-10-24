<?php
//2017-10-20 以post来的数据
header("Content-type:text/html;charset=utf-8");
$res=include_once("Public/config.php");

/*if(isset($_SESSION['userid'])&&!empty($_SESSION['userid'])){
    $agent = $_COOKIE["agent"];
    $userInfo =get_query_vals('fn_user', '*', array('userid' => $_SESSION['userid']));
    if( $agent&&!empty( $userInfo['agent'])){
        update_query("fn_user", array("agent" => $agent),array('userid' => $_SESSION['userid']));
    }
}*/

if($_POST['tuiguang'] == 'tuiguang'){
 require 'Templates/New/tuiguang.php';
  exit();
}
if((get_query_val('fn_user','hmd',array('userid'=>$_SESSION['userid'],'roomid'=>$_SESSION['roomid']))) == '1'){
header('Location: https://h5.ele.me/msite/');
		exit();
}
if(stristr($_SERVER['HTTP_USER_AGENT'], 'Android')){
  
	if($_POST['verify']=="n2oqcvVPpk1M"){
		//echo 'okay 1'; 
	}elseif($_COOKIE['logintime']=='temp'){
		//echo 'okay 2'; 
	}else{
		require "Templates/error.php";
		exit;
	}
}else{
	if( $_POST['verify']!="n2oqcvVPpk1M" ){
	//if( $_POST['verify']!="n2oqcvVPpk1M" && empty($_POST['room']) ){
		//require "Templates/error.php";
		
		header('Location: https://h5.ele.me/msite/');
		exit();
	}
}
if(is_weixin1()==true){
//$room = $_GET['room'];
$room = $_POST['room'];
$agent = $_POST['agent'];
if (!$agent){$level=2;}
$g = $_POST['g'];
//echo $room;exit;
 if($room==''){
  $room=$_SESSION['roomid'];
 }


if(room_isOK($room)){
    $_SESSION['roomid'] = $room;
    $sitename = get_query_val('fn_room', 'roomname', array('roomid' => $room));
	
	setcookie('logintime', 'temp', time() + 1800);
}else{
    $_SESSION['error_room'] = $room;
	//echo '555';exit;
    require "Templates/error.php";
    exit();
}
$roomtime = get_query_val('fn_room', 'roomtime', array('roomid' => $room));
if(strtotime($roomtime) - time() < 0){
    echo "<center><strong style='font-size:80px;'>您所访问的房间ID:{$room} <br>已于 <font color=red>$roomtime</font> 到期！<br>请提醒管理员进行续费！</strong></center>";
    exit;
}
if($_POST['agent'] != ""){
    setcookie('agent', $_POST['agent'], time() + 36000);
    $_COOKIE['agent'] = $_POST['agent'];
}
if($_SESSION['userid'] == ""){
	//echo "ERR: empty userid";//exit();//
    if(!empty($_POST['code'])){
		//echo "ERR: post code 取到了";//exit;//
        $token = wx_gettoken($wx['ID'], $wx['key'], $_POST['code']);
		//2017-10-21 add in
		//$accesstoken = wx_getaccesstoken($wx['ID'], $wx['key']);
        $userinfo = wx_getinfo($token['token'], $token['openid']);
		//$userinfo = wx_getinfo2($accesstoken['access_token'], $token['openid']);
        if($token['openid'] == ""){
			//echo "ERR: openid 没取到";exit;//
            //header('Location:' . $oauth . '&room=' . $room);
			header('Location:' . $oauth );
        }elseif(U_isOK($token['openid'], $userinfo['headimg'])){
			//echo "ERR: openid 取到了，更新了用户头像";
			//echo "openid - ".$token['openid'] . "<br />";
			//echo "nickname - ".$userinfo['nickname'] . "<br />";
			//echo "headimg - ".$userinfo['headimg']. "<br />";
			//exit;//
            $_SESSION['userid'] = $token['openid'];
            $_SESSION['username'] = $userinfo['nickname'];
            $_SESSION['headimg'] = $userinfo['headimg'];
        }else{
			//echo "ERR: openid 取到了，用户不在表内，创建用户";
			//echo "openid - ".$token['openid'] . "<br />";
			//echo "nickname - ".$userinfo['nickname'] . "<br />";
			//echo "headimg - ".$userinfo['headimg']. "<br />";
			//exit;//
            U_create($token['openid'], $userinfo['nickname'], $userinfo['headimg'], $_COOKIE['agent'],$level);
            $_SESSION['userid'] = $token['openid'];
            $_SESSION['username'] = $userinfo['nickname'];
            $_SESSION['headimg'] = $userinfo['headimg'];
            $_SESSION['agent'] =  $_COOKIE['agent'];
        }
    }else{
		//echo "ERR: post code 没取到";//
		//echo "bjump"; exit();
        //header("Location:" . $oauth . '&room=' . $room);
		header("Location:" . $oauth );
    }
}elseif(!U_isOK($_SESSION['userid'], $_SESSION['headimg'])){
	//echo "ERR: userid 不存在表内";//
    U_create($_SESSION['userid'], $_SESSION['username'], $_SESSION['headimg'], $_COOKIE['agent'],$level);
    $_SESSION['userid'] = $token['openid'];
    $_SESSION['username'] = $userinfo['nickname'];
    $_SESSION['headimg'] = $userinfo['headimg'];
    $_SESSION['agent'] =  $_COOKIE['agent'];
}
$tjagent =get_query_vals('fn_user', 'agent', array('userid' => $_SESSION['userid']));
if ($tjagent=="null"){
update_query('fn_user', array('agent' => $agent), array('userid' => $_SESSION['userid'], 'roomid' => $room));
}
//echo $token['openid'];exit;
$templates = get_query_val('fn_setting', 'setting_templates', array('roomid' => $_SESSION['roomid']));
if($templates == 'old'){
  $ip = get_query_vals('fn_userlog','*',array('ip'=>ip(),'time'=>date('Y-m-d'),'userid'=>$_SESSION['userid']));
  if(empty($ip)){
  insert_query('fn_userlog',array('ip'=>ip(),'time'=>date('Y-m-d',time()), 'addtime'=>date('Y-m-d H:i:s',time()),'userid'=> $_SESSION['userid'],'roomid'=> $_SESSION['roomid']));
  }
	//echo $token['openid']. "<br></br>";exit;
 // insert_query('fn_userlog',array('ip'=>ip(),'time'=>time(),'userid'=> $_SESSION['userid'],'roomid'=> $_SESSION['roomid']));
	//U_isOK($_SESSION['userid'], $_SESSION['headimg']);
    require 'default.php';
}elseif($templates == 'new'){
    require 'Templates/New/index.php';
} 
}else{
//$room = $_GET['room'];
$room = $_POST['room'];
$agent = $_POST['agent'];
$g = $_POST['g'];
 if($room==''){
  $room=$_SESSION['roomid'];
 }

if(room_isOK($room)){
    $_SESSION['roomid'] = $room;
    $sitename = get_query_val('fn_room', 'roomname', array('roomid' => $room));
	
	setcookie('logintime', 'temp', time() + 1800);
}else{
    $_SESSION['error_room'] = $room;
	//echo '555';exit;
    require "Templates/error.php";
    exit();
}
$roomtime = get_query_val('fn_room', 'roomtime', array('roomid' => $room));
if(strtotime($roomtime) - time() < 0){
    echo "<center><strong style='font-size:80px;'>您所访问的房间ID:{$room} <br>已于 <font color=red>$roomtime</font> 到期！<br>请提醒管理员进行续费！</strong></center>";
    exit;
}
if($_POST['agent'] != ""){
    setcookie('agent', $_POST['agent'], time() + 36000);
    $_COOKIE['agent'] = $_POST['agent'];
}
if(empty($g)){
	header('Location: home.php?room='.$room);
}

//if($_SESSION['userid'] == ""){
//	//echo "ERR: empty userid";//exit();//
//  if(!empty($_POST['code'])){
//		//echo "ERR: post code 取到了";//exit;//
//      $token = wx_gettoken($wx['ID'], $wx['key'], $_POST['code']);
//		//2017-10-21 add in
//		//$accesstoken = wx_getaccesstoken($wx['ID'], $wx['key']);
//      $userinfo = wx_getinfo($token['token'], $token['openid']);
//		//$userinfo = wx_getinfo2($accesstoken['access_token'], $token['openid']);
//      if($token['openid'] == ""){
//			//echo "ERR: openid 没取到";exit;//
//          //header('Location:' . $oauth . '&room=' . $room);
//			header('Location:' . $oauth );
//      }elseif(U_isOK($token['openid'], $userinfo['headimg'])){
//			//echo "ERR: openid 取到了，更新了用户头像";
//			//echo "openid - ".$token['openid'] . "<br />";
//			//echo "nickname - ".$userinfo['nickname'] . "<br />";
//			//echo "headimg - ".$userinfo['headimg']. "<br />";
//			//exit;//
//          $_SESSION['userid'] = $token['openid'];
//          $_SESSION['username'] = $userinfo['nickname'];
//          $_SESSION['headimg'] = $userinfo['headimg'];
//      }else{
//			//echo "ERR: openid 取到了，用户不在表内，创建用户";
//			//echo "openid - ".$token['openid'] . "<br />";
//			//echo "nickname - ".$userinfo['nickname'] . "<br />";
//			//echo "headimg - ".$userinfo['headimg']. "<br />";
//			//exit;//
//          U_create($token['openid'], $userinfo['nickname'], $userinfo['headimg'], $_COOKIE['agent']);
//          $_SESSION['userid'] = $token['openid'];
//          $_SESSION['username'] = $userinfo['nickname'];
//          $_SESSION['headimg'] = $userinfo['headimg'];
//      }
//  }else{
//		//echo "ERR: post code 没取到";//
//		//echo "bjump"; exit();
//      //header("Location:" . $oauth . '&room=' . $room);
//		header("Location:" . $oauth );
//  }
//}elseif(!U_isOK($_SESSION['userid'], $_SESSION['headimg'])){
//	//echo "ERR: userid 不存在表内";//
//  U_create($_SESSION['userid'], $_SESSION['username'], $_SESSION['headimg'], $_COOKIE['agent']);
//  $_SESSION['userid'] = $token['openid'];
//  $_SESSION['username'] = $userinfo['nickname'];
//  $_SESSION['headimg'] = $userinfo['headimg'];
//}
//echo $token['openid'];exit;
$templates = get_query_val('fn_setting', 'setting_templates', array('roomid' => $_SESSION['roomid']));
$templates= 'old';
if($templates == 'old'){
	//echo $token['openid']. "<br></br>";exit;
	//U_isOK($_SESSION['userid'], $_SESSION['headimg']);
  $ip = get_query_vals('fn_userlog','*',array('ip'=>ip(),'time'=>date('Y-m-d'),'userid'=>$_SESSION['userid']));
  if(empty($ip)){
  insert_query('fn_userlog',array('ip'=>ip(),'time'=>date('Y-m-d',time()), 'addtime'=>date('Y-m-d H:i:s',time()),'userid'=> $_SESSION['userid'],'roomid'=> $_SESSION['roomid']));
  }
     require 'default.php';
}elseif($templates == 'new'){
    require 'Templates/New/index.php';
}
}
 function is_weixin1(){
  if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
    return true;
    }  
    return false;
    } 

 function ip() {
    //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    return $res;
    //dump(phpinfo());//所有PHP配置信息
}
function city($ip){
$json=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
$arr=json_decode($json);
$gj = $arr->data->country;    //国家
$qy = $arr->data->area;    //区域
$sf = $arr->data->region;    //省份
$city = $arr->data->city;    //城市
$yys = $arr->data->isp;    //运营商
  if($gj == ''){
  $gj = '--';
  }
  if($qy == ''){
  $qy = '--';
  }
  if($sf == ''){
  $sf = '--';
  }
  if($city == ''){
  $city = '--';
  }
  if($yys == ''){
  $yys = '--';
  }
 return $gj.'|'.$sf.'|'.$qy.'|'.$city.'|'.$yys;
}

?>