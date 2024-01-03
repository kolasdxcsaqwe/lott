<?php
//作者：QQ 1878336950
//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务
switch ($_COOKIE['game']) {
    case 'qxc':
        $lot = 'fn_lottery20';
        break;
}
$roomid = $_SESSION['roomid'];
$gameid = $_COOKIE['game'];
$info = get_query_vals($lot, '*', array('roomid' => $_SESSION['roomid']));

function is_weixin()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no"-->
    <meta name="viewport" content="user-scalable=no">
    <title><?php echo $sitename ?></title>
    <link rel="Stylesheet" type="text/css" href="Style/Old/css/weui.min.css"/>
    <link rel="Stylesheet" type="text/css" href="Style/Old/css/style.css?t=sajiwq9iu3"/>
    <link rel="Stylesheet" type="text/css" href="Style/Old/css/bootstrap.new.css"/>
    <link rel="Stylesheet" type="text/css" href="Style/Xs/Public/css/NewLottery.css?t=22223"/>
    <link rel="Stylesheet" type="text/css" href="Style/Xs/Public/css/layout.css?t=34"/>
    <link rel="Stylesheet" type="text/css" href="Style/Xs/static/css/iconfont.css"/>
    <script src="Style/Old/js/jquery.min.js"></script>
    <script type="text/javascript">

        $(function () {
            $("#toop").click(function () {
                $("html,body").animate({scrollTop: 0}, 500);
            });
        })

    </script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="Style/Old/js/bootstrap.min.js"></script>
    <style type="text/css">

        .top {
            width: 100%;
            height: 120px;
            margin: 0 auto;

            position: fixed;
            bottom: 0;
            z-index: 995;
            text-align: right;
            border: 1px solid #9d9d9d;
            padding: 10px 10px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: #666 0px 0px 10px;
            -moz-box-shadow: #666 0px 0px 10px;
            box-shadow: #666 0px 0px 2px;
            background: #f4f4f4;
        }
        .pk_0,
        .pk_1,
        .pk_2,
        .pk_3,
        .pk_4,
        .pk_5,
        .pk_6,
        .pk_7,
        .pk_8,
        .pk_9,
        .pk_10,
        .pk_11,
        .pk_12,
        .pk_13,
        .pk_14,
        .pk_15,
        .pk_16,
        .pk_17,
        .pk_18,
        .pk_19,
        .pk_20,
        .pk_21,
        .pk_22,
        .pk_23,
        .pk_24,
        .pk_25,
        .pk_26,
        .pk_27,
        .pk_28,
        .pk_29,
        .pk_30,
        .pk_31,
        .pk_32,
        .pk_33,
        .pk_34,
        .pk_35,
        .pk_36,
        .pk_37,
        .pk_38,
        .pk_39,
        .pk_40,
        .pk_41,
        .pk_42,
        .pk_43,
        .pk_44,
        .pk_45,
        .pk_46,
        .pk_47,
        .pk_48,
        .pk_49 {
            width: 30px;
            height: 30px;
            float: left;
            line-height: 30px;
            color: #000;
            font-weight: normal;
            font-size: 25px;
            text-align: center;
            font-weight: bold;
            color: #fff;
            border-radius: 5px;
            margin: 0 10px 2px 0;
            text-align: center;
            text-shadow: #000 1px 0 0, #000 0 1px 0, #000 -1px 0 0, #000 0 -1px 0;
            -webkit-text-shadow: #000 1px 0 0, #000 0 1px 0, #000 -1px 0 0, #000 0 -1px 0;
            -moz-text-shadow: #000 1px 0 0, #000 0 1px 0, #000 -1px 0 0, #000 0 -1px 0;
            *filter: Glow(color=#000, strength=1);
        }

        .pk_0 {
            background: #FF0000;
        }

        .pk_1 {
            background: #FF0000;
        }

        .pk_2 {
            background: #FF0000;
        }

        .pk_7 {
            background: #FF0000;
        }

        .pk_8 {
            background: #FF0000;
        }

        .pk_12 {
            background: #FF0000;
        }

        .pk_13 {
            background: #FF0000;
        }

        .pk_18 {
            background: #FF0000;
        }

        .pk_19 {
            background: #FF0000;
        }

        .pk_23 {
            background: #FF0000;
        }

        .pk_24 {
            background: #FF0000;
        }

        .pk_29 {
            background: #FF0000;
        }

        .pk_30 {
            background: #FF0000;
        }

        .pk_34 {
            background: #FF0000;
        }

        .pk_35 {
            background: #FF0000;
        }

        .pk_40 {
            background: #FF0000;
        }

        .pk_45 {
            background: #FF0000;
        }

        .pk_46 {
            background: #FF0000;
        }

        .pk_3 {
            background: #3300FF;
        }

        .pk_4 {
            background: #3300FF;
        }

        .pk_9 {
            background: #3300FF;
        }

        .pk_10 {
            background: #3300FF;
        }

        .pk_14 {
            background: #3300FF;
        }

        .pk_15 {
            background: #3300FF;
        }

        .pk_20 {
            background: #3300FF;
        }

        .pk_25 {
            background: #3300FF;
        }

        .pk_26 {
            background: #3300FF;
        }

        .pk_31 {
            background: #3300FF;
        }

        .pk_36 {
            background: #3300FF;
        }

        .pk_37 {
            background: #3300FF;
        }

        .pk_41 {
            background: #3300FF;
        }

        .pk_42 {
            background: #3300FF;
        }

        .pk_47 {
            background: #3300FF;
        }

        .pk_48 {
            background: #3300FF;
        }

        .pk_5 {
            background: #009900;
        }

        .pk_6 {
            background: #009900;
        }

        .pk_11 {
            background: #009900;
        }

        .pk_16 {
            background: #009900;
        }

        .pk_17 {
            background: #009900;
        }

        .pk_21 {
            background: #009900;
        }

        .pk_22 {
            background: #009900;
        }

        .pk_27 {
            background: #009900;
        }

        .pk_28 {
            background: #009900;
        }

        .pk_32 {
            background: #009900;
        }

        .pk_33 {
            background: #009900;
        }

        .pk_38 {
            background: #009900;
        }

        .pk_39 {
            background: #009900;
        }

        .pk_43 {
            background: #009900;
        }

        .pk_44 {
            background: #009900;
        }

        .pk_49 {
            background: #009900;
        }


        .pk_he {
            font-size: 20px;
            font-weight: bold;
            color: cornflowerblue;
        }

        .pk_pink {
            font-size: 20px;
            font-weight: bold;
            color: #F00078;
        }

        .pk_blue {
            font-size: 20px;
            font-weight: bold;
            color: #0072E3;
        }

        .money_n {
            font-size: 23px;
            font-weight: bold;
            color: #000;
        }

        .money_y {
            font-size: 23px;
            font-weight: bold;
            color: #FF0000;
        }

        .pcdd {
            width: 30px;
            height: 30px;
            float: left;
            line-height: 30px;
            color: #fff;
            background-color: #0099FF;
            font-weight: normal;
            font-size: 20px;
            text-align: center;
            font-weight: bold;
            border-radius: 14px;
            margin: 0 10px 2px 0;
            text-align: center;
            text-shadow: #000 1px 0 0, #000 0 1px 0, #000 -1px 0 0, #000 0 -1px 0;
            -webkit-text-shadow: #000 1px 0 0, #000 0 1px 0, #000 -1px 0 0, #000 0 -1px 0;
            -moz-text-shadow: #000 1px 0 0, #000 0 1px 0, #000 -1px 0 0, #000 0 -1px 0;
            *filter: Glow(color=#000, strength=1);
        }

        .ball_s_ {
            display: inline-block;
            width: 35px;
            height: 35px;
            line-height: 35px;
            margin-right: 6px;
            text-align: center;
            font-size: 16px;
            font-family: "微软雅黑";
            color: #000;
            font-weight: bold;
            float: left;
        }


    </style>
</head>
<body>

<div class="loader" id="loadingDiv" hidden="hidden">
    <div class="loader-inner">
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var info = {
        'gameIndex':20,
        'nickname': "<?php echo $_SESSION['username'] ?>",
        'headimg': "<?php echo $_SESSION['headimg'] ?>",
        'userid': "<?php echo $_SESSION['userid'] ?>",
        'roomid': "<?php echo $_SESSION['roomid'] ?>",
        'minbet': "<?php echo $info['minbet'] ?>",
        'maxbet': "<?php echo $info['maxbet'] ?>",
        'anytwo': "<?php echo $info['anytwo'] ?>",
        'anythree': "<?php echo $info['anythree'] ?>",
        'fourfix': "<?php echo $info['fourfix'] ?>",
        'threefix': "<?php echo $info['threefix'] ?>",
        'twofix': "<?php echo $info['twofix'] ?>",
        'onefix': "<?php echo $info['onefix'] ?>",
        'touweifix': "<?php echo $info['touweifix'] ?>",
        'dxds': "<?php echo $info['dxds'] ?>",
        'game': "<?php echo $_COOKIE['game'];
            ?>"
    };
    var welcome = new Array(<?php echo $welcome;
        ?>);
    var welHeadimg = "<?php echo get_query_val("fn_setting", "setting_sysimg", array("roomid" => $_SESSION['roomid']));
        ?>";

    var sharetitle = '[<?php echo $_SESSION['username']?>]邀请您光临<?php echo $sitename;
        ?>:公平、公正的娱乐房间!';
    var shareurl = '<?php echo $oauth . '&room=' . $room;
        ?>';
    var shareImg = '<?php echo $_SESSION['headimg'];
        ?>';
    var sharedesc = "赶快来吧";
    var para = {};
    para.url = decodeURIComponent(location.href.split('#')[0]);
    $.ajax({
        url: 'Public/initJs.php',
        type: 'post',
        data: para,
        dataType: 'json',
        success: function (data) {
            wx.config({
                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: data.appId, // 必填，公众号的唯一标识
                timestamp: data.timestamp, // 必填，生成签名的时间戳
                nonceStr: data.noncestr, // 必填，生成签名的随机串
                signature: data.signature,// 必填，签名，见附录1
                jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo", "chooseImage", "previewImage", "getNetworkType", "scanQRCode", "chooseWXPay"]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: sharetitle, // 分享标题
            link: shareurl, // 分享链接
            imgUrl: shareImg, // 分享图标
            success: function () {

            },
            cancel: function () {

            }
        });
        wx.onMenuShareAppMessage({
            title: sharetitle, // 分享标题
            desc: sharedesc, // 分享描述
            link: shareurl, // 分享链接
            imgUrl: shareImg, // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });

</script>

<script type="text/javascript">
    function clearAllCookie() {
        var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
        if (keys) {
            for (var i = keys.length; i--;)
                document.cookie = keys[i] + '=0;path=/Templates/Old;expires=' + new Date(0).toUTCString()
        }
    }


</script>
<!-- New Templates Update -->
<script type="text/javascript" src="/Style/Old/js/NewTools.js?t=asd"></script>
<script type="text/javascript" src="/Style/Old/js/NewChat.js?t=sda"></script>
<script type="text/javascript" src="/Style/Old/js/qxc.js?t=2s333"></script>
<script type="text/javascript" src="/Style/Old/js/LotteryTabs.js?t=d22"></script>
<!-- ./New Templates Update -->

<iframe onload="iFrameHeight2();" src="/Templates/Old/shipin.php" name="ifarms" width="980" height="680"
        frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" id="ifarms" class="ifarms"></iframe>

<!-- 信息框 -->

<div class="modal fade" id="msgdialog"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     align="left">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <?php $qrcode = $sql['setting_qrcode'];
                    if ($qrcode == "") {
                        ?>
                        <strong Style="font-size:25px;color:red">财务还没设置二维码噢</strong>
                    <?php } else {
                        ?>
                        <strong Style="font-size:25px;color:red">长按二维码点击识别</strong><br/><br/>
                        <img src="<?php echo $qrcode; ?>" style="width:100%">
                    <?php } ?>
                </center>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal" style="z-index: 1055" id="orderDialog"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
>
    <div class="orderContent">
        <div style="display: block;text-align:center;width:100%;height:7%;position:absolute; background-color: #f43530;
        border-top-left-radius: 10px;border-top-right-radius: 10px">
            <div style="text-align: center;position: relative">
                <span id="orderDialogTitle" style="color: white;font-size: 38px;display: block;transform: translate(-0%, 35%)">注单编辑</span>
            </div>
        </div>
        <div class="closeDialog">
            <img id="closeOrderDialog" src="/Templates/Old/images/close.png" alt=""
                 style="float: right;padding: 10px 10px"/>
        </div>

        <div class="botView">
            <div class="timeBalance">
                <span class="betLimit">下注截止:&nbsp;&nbsp;<b></b></span>
                <span class="bal">余额:&nbsp;&nbsp;<b></b></span>
            </div>

            <div class="chooseNums">
                <span id="delAllOrders">删除全部</span>
                <span id="random1order">+ 机选一注</span>
                <span id="random5order">+ 机选五注</span>
            </div>

            <div class="syncBal">
                <label for="syncAllBal">
                    统一金额
                </label>
                <input id="syncAllBal" type="number">
            </div>

            <img src="/Templates/Old/images/order_top.png" alt="" width="88%"
                 style="margin-left: 6%; margin-bottom: -23px"/>

            <div class="orderList">
<!--                <div class='orderListItem'>-->
<!--                    <img  src='/Templates/Old/images/icon_qingchu.png' alt=''>-->
<!--                    <div class='orderListContent'>-->
<!--                        <p class='itemContent'>123456789|123456789|123456789|</p>-->
<!--                        <span class='gameItemDetail'>4定玩法 1000注</span>-->
<!--                    </div>-->
<!--                    <input class='singleOrderPrice' type='number'>-->
<!--                </div>-->

                <img src="/Templates/Old/images/order_bottom.png" alt="" width="84%"
                     style="margin-left: 2%; margin-top: -23px"/>
            </div>

            <div class="dialogBot">
                <div class="centerContent">
                    <span class="totalMoneySpan">共0元</span>
                    <div>
                        <span class="totalOrderSpan">共0注</span>
                    </div>
                </div>
                <span id="confirmOrder">确定下单</span>
            </div>


        </div>

    </div>
</div>

<div class="modal" id="betDialog"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
>
    <div class="betDialogContent">
        <div class="menu">
            <ul>
                <li class="gameli"><a href="javascript:;" data-t="1" class="on">任选3</a></li>
                <li class="gameli"><a href="javascript:;" class="" data-t="2">任选2</a></li>
                <li class="gameli"><a href="javascript:;" data-t="3" class="">大小单双</a></li>
                <li class="more-game">
                    <a href="javascript:;" class="triangle"><img src="/Style/images/game-arrow.png"></a>
                    <div class="sub-menu" style="display: none;">
                        <a href="javascript:;" data-t="4">前4定位</a>
                        <a href="javascript:;" data-t="5">前3定位</a>
                        <a href="javascript:;" data-t="6">前2定位</a>
                        <a href="javascript:;" data-t="7">定位胆</a>
                        <a href="javascript:;" data-t="8">头尾定位</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="game-bd six">
            <div class="gamenum" style="">
                <div class='rank-tit'><span class='lotteryType'></span></div>
            </div>

            <!--任选3 START-->
            <div class="gamenum game-type-1" style=""></div>

            <!--任选2 START-->
            <div class="gamenum game-type-2" style=""></div>

            <!--大小单双 START-->
            <div class="gamenum game-type-3" style=""></div>

            <!--前4定位 START-->
            <div class="gamenum game-type-4" style=""></div>

            <!--前3定位 START-->
            <div class="gamenum game-type-5" style=""></div>

            <!--前2定位 START-->
            <div class="gamenum game-type-6" style=""></div>

            <!--定位胆 START-->
            <div class="gamenum game-type-7" style=""></div>

            <!--头尾 START-->
            <div class="gamenum game-type-8" style=""></div>

        </div>
    </div>


</div>

<div id="frameRIGHTH">
    <?php $key = (int)get_query_val('fn_setting', 'payfs', array('roomid' => $_SESSION['roomid'])); ?>
    <div class="leftdiv">
        <ul>
            <!--li class="ulogo"><a href="/Templates/user/"><img src="<?php echo $_SESSION['headimg']; ?>" class="mlogo"></a></li-->
            <li class="ulogo"><a href="/qr.php?room=<?php echo $_SESSION['roomid']; ?>"><img
                            src="/Templates/Old/images/dt.png" class="mlogo"/></a></li>
            <?php if ($key == 2) { ?>
                <li class="cz" data-id="cz"><a href="/pay/index.php"><img src="/Templates/Old/images/cz.png"/></a></li>
            <?php } elseif ($key == 1) { ?>
                <li class="cz" data-id="cz"><a
                            href="/spay/index.php?roomid=<? echo $_SESSION['roomid']; ?>&g=<? echo $_COOKIE['game']; ?>&img=<? echo $_SESSION['headimg']; ?>&m=<? echo $_SESSION['username']; ?>&id=<? echo $_SESSION['userid']; ?>"><img
                                src="/Templates/Old/images/cz.png"/></a></li>
            <?php } elseif ($key == 3) { ?>
                <li class="cz" data-id="cz"><a href="/dspay/index.php"><img src="/Templates/Old/images/cz.png"/></a>
                </li>
            <?php } ?>
            <li class="tixian" data-id="tixian"><img src="/Templates/Old/images/tx.png"/></li>
            <li class="guess" data-id="guess"><img src="/Templates/Old/images/jc.png"/></li>
            <li class="logs" data-id="logs"><img src="/Templates/Old/images/jl.png"/></li>
            <li class="caiwu" data-id="caiwu"><img src="/Templates/Old/images/cw.png"/></li>
            <?php if ($sql['display_custom'] != 'false') { ?>
                <li class="skefu" data-id="skefu" data-reurl="roomid=<?php echo $roomid; ?>&g=<?php echo $gameid; ?>">
                    <img src="/Templates/Old/images/kf.png"/></li>
            <?php } ?>
            <!--
        <?php $isagent = get_query_val('fn_user', 'isagent', array('userid' => $_SESSION['userid'], 'roomid' => $_SESSION['roomid']));
            if ($sql['display_extend'] != 'false' && $isagent == 'true') {
                ?>
        <li class="tg" data-id="tgzq"><span>推广</span></li>
        <?php } elseif ($sql['display_extend'] == 'false') {
                ?>
        <li class="tg" data-id="tgzq"><span>推广</span></li>
        <?php } ?>
       -->
            <li class="cz"><a href="/Templates/user/"><img src="/Templates/Old/images/gr.png"/></a></li>
        </ul>
    </div>
    <div id="frameRIGHTH">
        <div class="nav_banner">
            <ul class="lottery">
                <?php if ($sql['display_game'] != 'false') { ?>
                    <li class="home" data-id="lottery">
                        <span style="color:#e3ff75;"> <i class="iconfont"></i><?php echo formatgame($game); ?></span>
                    </li>
                <?php } ?>
                <? if ($sql['zhibo'] == 'open') { ?>
                    <li class="sx" data-id="mnzb"><span>美女陪伴</span></li>
                <? } else { ?>
                <? } ?>
                <li class="smallwindows" data-id="donghua"><a href="#" onclick="clearAllCookie();"><span>刷新画面</span></a>
                </li>
                <!--li class="dh" data-id="donghua"><span>刷新动画</span></li-->
                <li class="wz" data-id="wenzi"><span>走势</span></li>
                <?php if ($sql['display_plan'] != 'false') { ?>
                    <!--li class="cl" data-id="changlong"><span>长龙</span></li>-->
                <?php } ?>
                <li class="gz" data-id="guize"><span>规则</span></li>
                <!--li class="sx" data-id="reload2"><span>刷新动画</span></li-->
                <?php if (is_weixin() == true) { ?>
                    <!--<li class="dh" data-id="appdown"><span><u>APP账号注册</u></span></li>-->
                <?php } else { ?>
                    <li class="cz"><a href="/tui.php"><span>退出登录</span></a></li>
                <? } ?>
                <!--li class="smallwindows" data-id="smallwindows"><span>小窗</span></li-->
            </ul>
            <ul class="uinfo">
                <li class="uname">昵称:<?php echo $_SESSION['username']; ?></li>
                <!--li class="id">ID:<b class="id"><?php echo get_query_val('fn_user', 'id', array('userid' => $_SESSION['userid'], 'roomid' => $_SESSION['roomid'])); ?></b></li-->
                <li class="money">余额: <b class="balance">0</b></li>
<!--                <li class="oline">在线: <b class="online">0</b>人</li>-->
            </ul>
        </div>

        <div class="touzu rbox">
            <div class="user_messages">
                <div class="top">
                    <input placeholder="" type="text" id="Message"
                           style="color:red;font-weight:bold;width:48%;">
                    <div style="text-align: right;height: 100%;display: inline-block;width: 50%">
                        <span class="txtbet">快捷下注</span>
                        <span class="botOrderEdit">注单编辑 (0)</span>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="game-box" ">
        <div class="game-hd">
            <div class="infuse">
                <div class="orderInformation">
                    <label style="display: inline-block">
                        <span>单注金额</span>
                        <input id="orderPrice" type="number"  max="1000000"/>
                    </label>
                    <div>
                        <span id="availableWin">奖金:&nbsp;<b></b></span>
                        <span id="payRare">赔率:&nbsp;<b></b></span>
                    </div>
                </div>

                <em id="bet_num">共<b>0</b>注</em>
                <a href="javascript:;" class="clearnum">清空所选</a>
                <div class="right">
                    <a href="javascript:;" class="addOrder">加入注单</a>
                    <a href="javascript:;" class="confirm-pour">立即下注</a>
                </div>
            </div>
        </div>

    </div>
    <div id="touzhu" class="">
        <div class="pour-info">
            <h4 class="game-tit game-tit-bg" style="font-size:45px;line-height:100px;">竞猜大小单双<a
                        href="javascript:;" class="close">×</a></h4>
            <div class="m-bd">
                <h4>共<em class="bet_n">1</em>注，投注金额<em class="bet_total">0</em>元</h4>
                <dl>
                    <dt>
                        <span>下注金额：</span>
                        <input type="number" class="text text-right bet_money" placeholder="下注金额">
                        <a href="javascript:;" class="money_clear">清零</a>
                    </dt>
                    <dd>
                        <i class="m5" data-money="5"></i>
                        <i class="m10" data-money="10"></i>
                        <i class="m50" data-money="50"></i>
                        <i class="m100" data-money="100"></i>
                        <i class="m500" data-money="500"></i>
                        <i class="m1000" data-money="1000"></i>
                        <i class="m5000" data-money="5000"></i>
                    </dd>
                </dl>
                <div class="sub-btn">
                    <a href="javascript:;" class="cancel">取消下注</a>
                    <a href="javascript:;" class="confirm">确定下注</a>
                </div>
            </div>
        </div>
    </div>

    <div class="rightdiv">
        <!--div class="saidright">
            <img src="/Public/images/gm.jpg">
            <div class="tousaidl">
                <span class="tousaid2">13:21:50</span>&nbsp;&nbsp;
                <span class="tousaid1">系统GM</span>
            </div>
            <div class="ts">
                <b style="border-color:transparent  transparent transparent #FFBBBB;"></b>
                <span class="neirongsaidl" style="background-color: #FFBBBB;">北京赛车<br>期号:632246<br>已封盘，请耐心等待开奖！</span>
            </div>
        </div>
        <div class="saidright">
            <img src="/Public/images/gm.jpg">
            <div class="tousaidl">
                <span class="tousaid2">13:21:50</span>&nbsp;&nbsp;
                <span class="tousaid1">系统GM</span>
            </div>
            <div class="ts">
                <b style="border-color:transparent  transparent transparent #98E165;"></b>
                <span class="neirongsaidl" style="background-color:#98E165;max-width: 100%">北京赛车<br>期号:632246<br>已封盘，请耐心等待开奖！</span>
            </div>
        </div>
        <div class="saidright">
            <img src="/Public/images/gm.jpg">
            <div class="tousaidl">
                <span class="tousaid2">13:21:50</span>&nbsp;&nbsp;
                <span class="tousaid1">系统GM</span>
            </div>
            <div class="ts">
                <b style=""></b>
                <span class="neirongsaidl" style="">北京赛车<br>期号:632246<br>已封盘，请耐心等待开奖！</span>
            </div>
        </div>
        <div class="saidleft">
            <img src="/Public/images/gm.jpg">
            <div class="tousaid">
                <span class="tousaid2">13:21:50</span>&nbsp;&nbsp;
                <span class="tousaid1">系统GM</span>
            </div>
            <div class="tsf">
                <b></b>
                <span class="neirongsaid" style="">北京赛车<br>期号:632246<br>已封盘，请耐心等待开奖！</span>
            </div>
        </div-->
    </div>
</div>
<!--div class="kefu rbox" style="display:none">
    <div class="user_messages">
        <input type="text" id="kfs"><span id="sendkf">发 送</span>
    </div>
    <div class="kfcs">
        <div class="saidright">
            <img src="/Public/images/kefu2.jpg">
            <div class="tousaidl">
                <span class="tousaid2">16:22:17</span>&nbsp;&nbsp;<span class="tousaid1">客服</span>
            </div>
            <div class="ts">
                <b></b>
                <span class="neirongsaidl">有任何问题请留言，我们将尽快为您解答。</span>
            </div>
        </div>
    </div>
</div-->
<div id="ss_menu" style="">
    <div class="ss_nav tabs">
        <ul class="lottery">

        </ul>
    </div>
</div>

<iframe width="880" height="0" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" id="iframe"
        class="iframe" style="display:none" onload="iFrameHeight();"></iframe>

<div class="zytips">
    <div>数据加载中..</div>
</div>
<script type="text/javascript">
    app.init();
    var headimg = "<?php echo $_SESSION['headimg'];
        ?>";
    var nickname = "<?php echo $_SESSION['username'];
        ?>";

    function showMask() {
        $("#mask").css("height", $(document).height());
        $("#mask").css("width", $(document).width());
        $("#mask").show();
    }

    function hideMask() {
        $("#mask").hide();
    }

    var welcome = new Array(<?php echo $welcome;
        ?>);
    var welHeadimg = "<?php echo get_query_val("fn_setting", "setting_sysimg", array("roomid" => $_SESSION['roomid']));
        ?>";

</script>


</body>
</html>