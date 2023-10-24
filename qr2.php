<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include_once("./Public/config.php");
$fenurl = get_query_val('fn_system','content1',array('id'=>'3'));

if(empty($_GET['room'])){
 
	$_GET['room'] = $_SESSION['roomid'];
}
$room=$_GET['room'];
if(!$room) $room=$_SESSION['roomid'];
$agent=@$_GET['agent'];

$g=@$_GET['g']; //pk10,xyft,cqssc,xy28,jnd28,jsmt,jssc,jsssc
if(is_weixin1()==true){
	$wx['ID'] = 'wxee7dd51e40475df6';
	$time = date('Y-m-d H:i:s',time());
	
	//make code 
	$oauth = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=".$wx["ID"]."&redirect_uri=".urlencode("http://".$fenurl."/qr2.php?g=".$_GET['g']."&room=".$_GET['room']."&agent=".$_GET['agent'])."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
	
	if($_GET['code']==''){
      //var_dump($oauth);exit;
		Header("Location: $oauth");
	}
	$code=$_GET['code'];
  
	echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://".$fenurl."/index2.php'>
             
              <input name='verify' type='text' value='n2oqcvVPpk1M' />
			  <input name='room' type='text' value='".$room."' />
			  <input name='agent' type='text' value='".$agent."' />
			  <input name='g' type='text' value='".$g."' />
			  <input name='code' type='text' value='".$code."' />
			  <input name='time' type='text' value='".$time."' />
            </form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
	}
	else{
  
	$time = date('Y-m-d H:i:s',time());
	//unset($_SESSION['userid']);
	//session_destroy();
	echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://".$fenurl."/index2.php'>
              <input name='verify' type='text' value='n2oqcvVPpk1M' />
			  <input name='room' type='text' value='".$room."' />
			  <input name='agent' type='text' value='".$agent."' />
			  <input name='g' type='text' value='".$g."' />
			  <input name='time' type='text' value='".$time."' />
            </form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
}

function is_weixin1(){
  if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
    return true;
  }  
  return false;
} 
?>
