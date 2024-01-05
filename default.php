<?php
function is_weixin()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}

if ($_SESSION['userid'] != null) {
    $isJia = get_query_val("fn_user", "jia", "userid='{$_SESSION['userid']}'");
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php echo $sitename ?></title>
    <link rel="stylesheet" type="text/css" href="/default/css/sytle.css?v=a2s23sdd"/>
    <link rel="Stylesheet" type="text/css" href="Style/Xs/Public/css/layout.css?t=23"/>
    <script type="text/javascript" src="/default/js/jquery-1.8.2.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth / 750;
        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                document.write('<meta name="viewport" content="width=750, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
            } else {
                document.write('<meta name="viewport" content="width=750, target-densitydpi=device-dpi">');
            }
        } else {
            document.write('<meta name="viewport" content="width=750,user-scalable=no, target-densitydpi=device-dpi">');
        }
    </script>

</head>
<!--body id="wrap"-->
<body id="gamebox">

<!--div data-v-7f2b6a5e="" class="legacy" style="position: absolute; top: 10.5em;right: 0;z-index: 101;width: 6em;height: 2em;padding-left: .3em;line-height: 2em;background: red;"><a style="color:#ffffff;" data-v-7f2b6a5e="" href="/Templates/sign/index.php">签到<i data-v-7f2b6a5e="" class="iconfont icon-double-arrow1"></i></a></div-->

<div class="zytips">
    <div>asdasdsad</div>
</div>

<div class="lou">
    <div class="cover"></div>
</div>

<section id="allpage" class="p-index">
    <!--div class="banner"><img src="/default/images/banner2.jpg"></div-->

    <div class="userbox">
        <div class="infobox"><span class="touxiang"><img
                        src="<?php echo $_SESSION['headimg']; ?>"></span><span><?php echo $_SESSION['username']; ?></span>
        </div>
        <div id="balance" class="infobox">游戏点数：</div>
        <div id="online" class="infobox"></div>

        <div class="banner">
            <!--<img src="/default/images/banner2.jpg"></div>   -->
            <div class="gonggao">
                <!--<span>欢迎大家来到大唐国际，祝大家赚钱多多！</span>-->
            </div>
        </div>
        <div class="gamebox">
            <div data-v-7f2b6a5e="" class="gamebox"
                 style="position: absolute; top: 65%;right: 4rem;z-index: 101;width: 2em;height: 2.8em;line-height: 2em;background: ;">
                <a href="/Templates/sign/index.php">
                    <img style="width: 5em;height: 4.8em;" src="/Style/Home/images/sign.gif" title="签到">
                    <i data-v-7f2b6a5e="" class="iconfont icon-double-arrow1"></i></a></div>

            <!--div class="navhl_b">
                <a href="javascript:;" class="xcnav_1 navhl_h">彩票游戏</a>
                <a href="javascript:;" class="xcnav_2">真人视讯</a>
            </div-->

            <div class="ss_nav">
                <div id="ss_menu" style="display: block;position:inherit;" class="in" aria-hidden="false">
                    <div class=""></div>
                    <div class="ss_nav"
                         style="overflow:hidden;width:100%;height: 100%;">
                        <!--	<i class="iconfont close" data-id="#ss_menu"></i> -->
                        <ul class="lottery" style="padding-right: 2%;padding-left: 2%;width: 100%;">


                            <li style=" width: 50%; " id="xy28">
                                <img src="/Style/Home/images/xjp28_23.jpg" title="新加坡28"
                                     style=" width: 95%; " alt="">
                                <!--		<font>加拿大28</font>-->
                            </li>

                            <li style=" width: 50%; " id="ny28">
                                <img src="/Style/Home/images/ny28-11.jpg" title="纽约28"
                                     style=" width: 95%; " alt="">
                                <!--		<font>加拿大28</font>-->
                            </li>

                            <li style=" width: 50%; " id="qxc">
                                <img src="/Style/Home/images/qxc-2023-12.jpg" title="七星彩"
                                     style=" width: 95%; " alt="">
                            </li>

                            <li style=" width: 50%; " id="pl5">
                                <img src="/Style/Home/images/pl5-2023-12-18.jpg" title="排列5"
                                     style=" width: 95%; " alt="">
                            </li>

                            <li style=" width: 50%; " id="fc3d">
                                <img src="/Style/Home/images/fc3d_23_12_20.jpg" title="福彩3D"
                                     style=" width: 95%; " alt="">
                            </li>

                            <li style=" width: 50%; " id="jsssc">
                                <img src="/Style/Home/images/jsssc-logo-new.jpg" title="极速时时彩"
                                     style=" width: 95%; " alt=""/>

                            </li>

                            <li style=" width: 50%; " id="pk10">
                                <img src="/Style/Home/images/pk10-logo-new.jpg" title="北京赛车"
                                     style=" width: 95%; " alt="">
                                <!--<font>北京赛车</font>-->
                            </li>

                            <li style=" width: 50%; " id="jnd28">
                                <img src="/Style/Home/images/jnd28.jpg" title="加拿大28" style=" width: 95%; " alt=""/>
                            </li>

                            <li style=" width: 50%; " id="twk3">
                                <img src="/Style/Home/images/twk3.jpg" title="台湾快三" style=" width: 95%; " alt="">
                            </li>

                            <li style=" width: 50%; " id="jslhc">
                                <img src="/Style/Home/images/jslhc-logo_new.jpg" title="极速六合彩"
                                     style=" width: 95%; " alt=""/>
                            </li>

                            <li style=" width: 50%;" id="lhc">
                                <img src="/Style/Home/images/lhc-logo-new.jpg" title="六合彩" style=" width: 95%; "
                                     alt=""/>
                            </li>


                            <!--<li style=" width: 50%; ">
					 <a href="/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=jssm">
						 <img src="/Style/Home/images/jssm.png" title="极速赛马" style=" width: 95%; ">

					 </a>
			</li>
			<li style=" width: 50%; ">
				<a href="/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=jnd28">
					<img src="/Style/Home/images/jnd28.png" title="加拿大28" style=" width: 95%; ">
					<!--		<font>加拿大28</font>-->
                            <!--</a>
			</li>
			<li style=" width: 50%; ">
					<a href="/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=pk10">
						<img src="/Style/Home/images/pk10-logo-new.png" title="北京赛车" style=" width: 95%; ">

					 <!--</a>
			</li>
			<!--<li style=" width: 50%; ">-->
                            <!--	<a href="/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=cqssc">-->
                            <!--		<img src="/Style/Home/images/cqssc-logo.png" title="重庆欢乐生肖" style=" width: 95%; ">-->
                            <!--		<font>重庆欢乐生肖</font>-->
                            <!--	</a>-->
                            <!--</li>-->
                            <!--<li style=" width: 50%; ">-->
                            <!--		<a href="/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=gd11x5">-->
                            <!--			<img src="/Style/Home/images/gd11x5-logo.png" title="十一选五" style=" width: 95%; ">-->
                            <!--			<font>十一选五</font>-->
                            <!--		</a>-->
                            <!--</li>-->
                            <!--<li style=" width: 50%; ">
				<a href="/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=lhc">
					<img src="/Style/Home/images/lhc-logo-new.png" title="六合彩" style=" width: 95%; ">
					<!--<font>六合彩</font>-->
                            <!--	</a>
                           <!--</li>
                               <!--<li style="display:none; width: 50%;">-->
                            <!--		<a href="#" class="gray">-->
                            <!--			<img src="/Style/Home/images/jsk3-logo.png" title="江苏快三" style=" width: 95%; ">-->
                            <!--			<font>江苏快三</font>-->
                            <!--		</a>-->


                    </div>
                </div>
                <div class="zhenren">
                    <?php if (is_weixin() == true) { ?>
                        <a href="/qr.php?room=<?php echo $_SESSION['roomid']; ?>&g=bjl"><img
                                    src="/default/images/zhenren1.jpg"></a>
                    <?php } else { ?>
                        <a href="/zhenren/login.php?=<?php $_SESSION['username']; ?>"
                           style="display:block;margin-bottom:10px;"><img src="/default/images/zhenren.jpg"></a>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="ft">
            <div class="nav">
                <ul>
                    <li class="a1"><a href="/qr.php?room=<?php echo $_SESSION['roomid']; ?>" class="hover"><span
                                    class="ft_icon"></span>
                            <div class="ft_nav">游戏大厅</div>
                        </a></li>
                    <li class="a2"><a href="/Templates/user/"><span class="ft_icon"></span>
                            <div class="ft_nav">用户中心</div>
                        </a></li>
                    <?php $key = (int)get_query_val('fn_setting', 'payfs', array('roomid' => $_SESSION['roomid'])); ?>
                    <?php if ($key == 2) { ?>
                        <li class="a4" data-id="cz"><a href="/pay/index.php"><span class="ft_icon"></span>
                                <div class="ft_nav">在线充值</div>
                            </a></li>
                    <?php } elseif ($key == 1) { ?>
                        <li class="a4" data-id="cz"><a
                                    href="/spay/index.php?roomid=<? echo $_SESSION['roomid']; ?>&g=<? echo $_COOKIE['game']; ?>&img=<? echo $_SESSION['headimg']; ?>&m=<? echo $_SESSION['username']; ?>&id=<? echo $_SESSION['userid']; ?>"><span
                                        class="ft_icon"></span>
                                <div class="ft_nav">在线充值</div>
                            </a></li>
                    <?php } elseif ($key == 3) { ?>
                        <li class="a4" data-id="cz"><a href="/dspay/index.php"><span class="ft_icon"></span>
                                <div class="ft_nav">在线充值</div>
                            </a></li>
                    <?php } ?>

                    <li class="a5"><a href="/tui.php"><span class="ft_icon"></span>
                            <div class="ft_nav">退出登录</div>
                        </a></li>
                </ul>
            </div>
        </div>
</section>

<div id="orientLayer" class="mod-orient-layer" style="display: block;">
    <div class="mod-orient-layer__content">
        <i class="icon mod-orient-layer__icon-orient"></i>

        <div class="mod-orient-layer__desc">为了更好的体验，请使用竖屏浏览,如未显示出页面，请刷新浏览器</div>
    </div>
</div>
<script type="text/javascript">

    var statusList
    var hrefData = parseURL(window.location.href)
    var baseUrl = hrefData.protocol + "://" + hrefData.host + ":8653";
    makeTabs()


    var zy = zy || {};
    zy.tips = function (msg, time) {
        var zytips = $(".zytips");
        zytips.css("display", "block")
        if (zytips.length == 0) {
            zytips = $('<div class="zytips"></div>').appendTo("body");
        }
        zytips.html("<div>" + msg + "</div>");
        $(".zytips").fadeOut('fast');
        zytips.fadeIn();
        time = time || 2;
        var tt = window.setTimeout(function () {
            $(".zytips").fadeOut('fast');
        }, time * 1000);
    }

    function parseURL(url) {
        var a = document.createElement('a');
        a.href = url;
        return {
            source: url,
            protocol: a.protocol.replace(':', ''),
            host: a.hostname,
            port: a.port,
            query: a.search,
            params: (function () {
                var ret = {},
                    seg = a.search.replace(/^\?/, '').split('&'),
                    len = seg.length, i = 0, s;
                for (; i < len; i++) {
                    if (!seg[i]) {
                        continue;
                    }
                    s = seg[i].split('=');
                    ret[s[0]] = s[1];
                }
                return ret;
            })(),
            file: (a.pathname.match(/\/([^\/?#]+)$/i) || [, ''])[1],
            hash: a.hash.replace('#', ''),
            path: a.pathname.replace(/^([^\/])/, '/$1'),
            relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [, ''])[1],
            segments: a.pathname.replace(/^\//, '').split('/')
        };
    }

    function makeTabs() {
        var datas = {game: "xy28,ny28,jnd28,qxc,pl5,lhc,twk3,jslhc,jsssc,pk10,fc3d"}

        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "/getALlLotteryStatus",//url
            data: datas,
            crossDomain: true,
            success: function (result) {
                $(".zytips").css("display", "none")
                if (result.code === 0) {
                    statusList = result.datas.statusList
                    $(".lottery li").each(function (i, e) {
                        let obj = result.datas.statusList[e.id]
                        if (obj.status <= 0) {

                        }
                    })

                    $(".lottery li").click(function (e) {
                        let obj = statusList[$(this).attr("id")]
                        if (obj.status <= 0) {
                            zy.tips("该彩种维护中");
                        } else {
                            window.location.href = "/qr.php?room=<?php echo $_SESSION['roomid'] ?>&g=" + $(this).attr("id")
                        }
                    })

                } else {
                    zy.tips(result.msg);
                }
            },
            error: function () {
            },
            complete: function (a, b) {
                $("#loadingDiv").hide()
            }
        });
    }

    function getUserInfo() {
        $.ajax({
            url: '/Application/ajax_getuserinfo.php',
            type: 'get',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('#balance').html("游戏点数：" + data.price);
                    // $('#online').html("在线人数：" + data.online);
                } else {
                    alert('登录过期,请重新登录！');
                    //window.location.href="http://" + location.host + "/?room=" + info['roomid'];
                    window.location.href = "http://" + location.host + "/LoginAndRegister";
                }
            },
            error: function () {
            }
        });
    }

    $(document).ready(function () {
        getUserInfo();
        $(".xcnav_1").click(function (e) {
            $(".zhenren").hide()
            $(".caipiao").show()
            $(".xcnav_2").removeClass("navhl_h")
            $(this).addClass("navhl_h")
        });
        $(".xcnav_2").click(function (e) {
            $(".zhenren").show()
            $(".caipiao").hide()
            $(".xcnav_1").removeClass("navhl_h")
            $(this).addClass("navhl_h")
        });
    })


</script>

<script>
    var orientLayer = document.getElementById("orientLayer");

    //判断横屏竖屏
    function checkDirect() {
        if (document.documentElement.clientHeight >= document.documentElement.clientWidth) {
            return "portrait";
        } else {
            return "landscape";
        }
    }

    //显示屏幕方向提示浮层
    function orientNotice() {
        var orient = checkDirect();
        if (orient == "portrait") {
            orientLayer.style.display = "none";
        } else {
            orientLayer.style.display = "block";
        }
    }

    function init() {
        orientNotice();
        window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function () {
            setTimeout(orientNotice, 700);
        })
    }

    init();

    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        WeixinJSBridge.call('hideToolbar');
    });
</script>


</body>
</html>