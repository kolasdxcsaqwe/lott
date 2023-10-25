<?php session_start();?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include_once("./Public/config.php");
$fenurl = get_query_val('fn_system','content1',array('id'=>'3'));
if(empty($_GET['room'])){
    $_GET['room'] = $_SESSION['roomid'];
}
$userid=$_GET['userid'];
$username=$_GET['username'];
$headimg=$_GET['headimg'];

$room=$_GET['room'];
$agent=$_GET['agent'];
$g=$_GET['g']; //pk10,xyft,cqssc,xy28,jnd28,jsmt,jssc,jsssc
$time = date('Y-m-d H:i:s',time());




if(isWeixin()==true){
    // $wx['ID'] = 'wxee7dd51e40475df6';
    $time = date('Y-m-d H:i:s',time());

//make code
    // $oauth = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=".$wx["ID"]."&redirect_uri=".urlencode("http://".$fenurl."/qr.php?g=".$_GET['g']."&room=".$_GET['room']."&agent=".$_GET['agent'])."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

    // var_dump("code->".$_GET['code']." room->".$room."  agent->".$agent."  g->".$g." fenurl->".$fenurl);
    // if($_GET['code']==''){

    //     Header("Location: $oauth");
    // }


    echo "请等待，正在进入房间";
    // echo $userid."<br>";
    // echo $agent."<br>";
    // echo $room."<br>";
    // echo $username."<br>";
    // echo $headimg."<br>";



     $_SESSION['roomid']=$room;
     if(!empty($userid) && !empty($username) && !empty($headimg) )
     {
         echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://".$fenurl."/index.php'>

              <input name='verify' type='text' value='n2oqcvVPpk1M' />
			  <input name='room' type='text' value='".$room."' />
			  	  <input name='username' type='text' value='".$username."' />
			  	  	  <input name='headimg' type='text' value='".$headimg."' />
			  <input name='agent' type='text' value='".$agent."' />
			  <input name='g' type='text' value='".$g."' />
			  <input name='userid' type='text' value='".$userid."' />
			  <input name='time' type='text' value='".$time."' />

            </form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
     }
     else
     {
         echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://".$fenurl."/index.php'>

              <input name='verify' type='text' value='n2oqcvVPpk1M' />
			  <input name='room' type='text' value='".$room."' />
			  <input name='agent' type='text' value='".$agent."' />
			  <input name='g' type='text' value='".$g."' />
			  <input name='time' type='text' value='".$time."' />

            </form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
     }

}else{

    $time = date('Y-m-d H:i:s',time());
//unset($_SESSION['userid']);
//session_destroy();
    // echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://".$fenurl."/'>

    //           <input name='verify' type='text' value='n2oqcvVPpk1M' />
			 // <input name='room' type='text' value='".$room."' />
			 // <input name='agent' type='text' value='".$agent."' />
			 // <input name='g' type='text' value='".$g."' />
			 // <input name='time' type='text' value='".$time."' />

    //         </form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
    header("Location:"."http://www.google.com");
}


?>