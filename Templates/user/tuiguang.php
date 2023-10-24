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
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="user-scalable=no,width=device-width" />
    <meta name="baidu-site-verification" content="W8Wrhmg6wj" />
    <meta content="telephone=no" name="format-detection">
    <meta content="1" name="jfz_login_status">
    <script type="text/javascript" src="js/record.origin.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/common.css?v=1.2" />
    <link rel="stylesheet" type="text/css" href="css/new_cfb.css?v=1.2" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?v=1.2" />

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.js?v=1.2"></script>
    <script type="text/javascript" src="js/global.js?v=1.2"></script>
    <script type="text/javascript" src="js/common.v3.js?v=1.2"></script>
    <script type="text/javascript" src="js/jweixin-1.0.0.js"></script>
    <title>个人中心</title>
</head>

<body>
    <div class="wx_cfb_container wx_cfb_account_center_container">
        <div class="wx_cfb_account_center_wrap">
            <div class="wx_cfb_ac_fund_detail">
                <div class="user_info clearfix">
                    <div class="user_photo"><img src="<?php echo $_SESSION['headimg'];?>" style="width:45px; height:45px; "></div>
                    <div class="user_txt">
                        <div class="p1">
                            <?php echo $_SESSION['username'];?>
                        </div>
                        <div class="p2">欢迎来到【<?php echo get_query_val("fn_room", "roomname", array("roomid" => $_SESSION['roomid']));?>】</div>
                    </div>
                </div>
                <!--div class="fund_info">
                    <div class="kv_tb_list clearfix">
                        <div class="kv_item">
                            <span class="val"><?php echo get_query_val("fn_user", "money", array("roomid" => $_SESSION['roomid'], 'userid' => $_SESSION['userid']));?></span>
                            <span class="key">我的钱包</span>
                        </div>
                        <div class="kv_item">
                            <span class="val"><?php echo $info['yk'];?></span>
                            <span class="key">今日盈亏</span>
                        </div>
                        <div class="kv_item">
                            <span class="val"><?php echo $info['liu'];?></span>
                            <span class="key">今日流水</span>
                        </div>
                    </div>
                </div-->
            </div>
                <br>
              <div class="main">
                 <div class="boxcontent boxyellow" >
                        <div class="box" style="text-align:center">
                            <div class="title-green">温馨提示：</div>
                            <div class="Detail">
                               <p>您的专属推广二维码，新客户识别此二维码即为您的下级！</p>    
                            </div>
                        </div>
                 </div>
                <div id="outercont">
                    <div id="outer-cont">
                         <div id="outer"><img src="<?php echo $qrcode;?>" width="200"/></div> 
                    </div>
                </div>
             </div>
        </div>
    </div>

    <div class="wx_cfb_fixed_btn_box">
        <div class="wx_cfb_fixed_btn_wrap">
            <div class="btn_box clearfix">
                <a href="/Templates/user/" class="btns tel_btn clearfix">
                    <em class="ico ui_ico_size_40 ui_tel_ico"></em><span class="txt">返回个人中心</span>
                </a>
            </div>
        </div>
    </div>
  </body>
</html>