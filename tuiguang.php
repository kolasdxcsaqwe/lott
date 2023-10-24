<?php
include_once('../../Public/config.php');
function getSubstr($str, $leftStr, $rightStr){
    $left = strpos($str, $leftStr);
    $right = strpos($str, $rightStr, $left);
    if($left < 0 or $right < $left)return '';
    return substr($str, $left + strlen($leftStr), $right - $left - strlen($leftStr));
}
session_start();
$fenurl = get_query_val('fn_system','content1',array('id'=>'0'));
//$info = "http://" . $_SERVER['HTTP_HOST'] . "/qr.php?room=" . $_SESSION['roomid'] . "&agent=" . $_SESSION['userid'];
$info1 = "http://" . $fenurl . "/qr2.php?room=" . $_SESSION['roomid'] . "%26agent=" . $_SESSION['userid'];
$html = file_get_contents("https://cli.im/api/qrcode/code?text=".$info1."&mhid=txPFDF3pnZ8hMHcrItZcPa8");
//$html = file_get_contents("https://cli.im/api/qrcode/code?text=" . $info1 . "");
$qrcode = getSubstr($html, "<img src=\"", "\" id=");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>推广赚佣</title>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link href="/Style/New/css/activity-style.css" rel="stylesheet" type="text/css">
<style type="text/css">
	html{height: 100%;}
	body.aa{height: auto;
	background: url(../../Style/images/tgban.png)#F7F7F7 no-repeat center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	}

</style>
</head>

<body class="aa">

  
        <div class="main">
                <div id="outercont"  onclick="window.open('<? echo $info1;?>','_self')">
                    <div id="outer-cont">
                         <div id="outer"><img src="<?php echo $qrcode;?>" width="200"/></div> 
                    </div>
                </div>
                <div class="content">
                 <!-- <div class="boxcontent boxyellow">
                        <div class="box">
                          <div class="title-green"><span>复制链接：</span></div>
                            <div class="Detail">
                                <p><?php echo $info;?></p>
                            </div>
                        </div>
                      </div> -->
                    <div class="boxcontent boxyellow" >
                        <div class="box">
                            <div class="title-green">温馨提示：</div>
                            <div class="Detail">
                               <p>您的专属二维码，此二维码可以用于<span style="color:red;">推广</span>。</p>    
                               <p style="color:red;">入口只有此二维码，不要丢失！！</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</body>

</html>
