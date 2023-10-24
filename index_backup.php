<?php
//2017-10-20 以post来的数据
//header("Content-type:text/html;charset=utf-8");
include_once("Public/config.php");

if(stristr($_SERVER['HTTP_USER_AGENT'], 'Android')){

	//
	if($_SESSION['userid2'] == ""){
    if(!empty($_POST['code'])){
        $token2 = wx_gettoken($wx['ID'], $wx['key'], $_POST['code']);
        $userinfo2 = wx_getinfo($token2['token'], $token2['openid']);
        if($token2['openid'] == ""){
			header('Location:' . $oauth );
        }elseif(U_isOK($token2['openid'], $userinfo2['headimg'])){
            $_SESSION['userid2'] = $token2['openid'];
        }else{
            $_SESSION['userid2'] = $token2['openid'];
        }
    }else{
		header("Location:" . $oauth );
    }
	}else{
		$_SESSION['userid2'] = $token2['openid'];
	}
	//

	$oid = $_SESSION['userid2'];
	$time= $_POST['time'];
	//echo $oid;
	if($time!=''){
		update_query("fn_user", array("aztime" => $time), array('userid' => $oid));
		//$upusersql="update fn_user set aztime='$time' where userid='$oid'";
		//mysql_query($upusersql);
	}
	//$getuserlktimesql="select aztime from fn_user where userid='$oid'";
	//$usertime = mysql_fetch_object(mysql_query($getuserlktimesql));
	//$lktime=$usertime->aztime;
	$lktime2 = get_query_val('fn_user', 'aztime', array('userid' => $oid));
	if($lktime2=='0000-00-00 00:00:00'){
		//header('Location: https://h5.ele.me/msite/');
		require "Templates/error.php";
		exit;
	}
}
else{
	if( $_POST['verify']!="n2oqcvVPpk1M" ){
	//if( $_POST['verify']!="n2oqcvVPpk1M" && empty($_POST['room']) ){
		require "Templates/error.php";
		//header('Location: https://h5.ele.me/msite/');
		exit();
	}
}


//$room = $_GET['room'];
$room = $_POST['room'];
$agent = $_POST['agent'];
$g = $_POST['g'];

if(room_isOK($room)){
    $_SESSION['roomid'] = $room;
    $sitename = get_query_val('fn_room', 'roomname', array('roomid' => $room));
}else{
    $_SESSION['error_room'] = $room;
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
            U_create($token['openid'], $userinfo['nickname'], $userinfo['headimg'], $_COOKIE['agent']);
            $_SESSION['userid'] = $token['openid'];
            $_SESSION['username'] = $userinfo['nickname'];
            $_SESSION['headimg'] = $userinfo['headimg'];
        }
    }else{
		//echo "ERR: post code 没取到";//
		//echo "bjump"; exit();
        //header("Location:" . $oauth . '&room=' . $room);
		header("Location:" . $oauth );
    }
}elseif(!U_isOK($_SESSION['userid'], $_SESSION['headimg'])){
	//echo "ERR: userid 不存在表内";//
    U_create($_SESSION['userid'], $_SESSION['username'], $_SESSION['headimg'], $_COOKIE['agent']);
    $_SESSION['userid'] = $token['openid'];
    $_SESSION['username'] = $userinfo['nickname'];
    $_SESSION['headimg'] = $userinfo['headimg'];
}
//echo $token['openid'];exit;
$templates = get_query_val('fn_setting', 'setting_templates', array('roomid' => $_SESSION['roomid']));
if($templates == 'old'){
	//echo $token['openid']. "<br></br>";exit;
	//U_isOK($_SESSION['userid'], $_SESSION['headimg']);
    require 'Templates/Old/index.php';
}elseif($templates == 'new'){
    require 'Templates/New/index.php';
}
?>