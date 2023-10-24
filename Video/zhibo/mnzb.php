<?php include_once('../../Public/config.php');
require "../../Templates/user/function.php";
$info = getinfo($_SESSION['userid']);
$sql = get_query_vals("fn_setting", "*", array( "roomid" => $_SESSION["roomid"] ));
select_query("fn_room", "*", array( "roomid" => $_SESSION["roomid"] ));
while( $con = db_fetch_array() ) 
{
    $sitename .= "" . $con["roomname"] . "";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>顶级娱乐</title>
</head>
<body>
<div style="    z-index:999999999; -webkit-border-radius: 15px; border: 2px solid #ff01e3;      background: linear-gradient(to top, #040404, #6b6b6b); padding: 5px 10px 0px;  right: 1%;position: fixed;margin-top: 1%;height: 50px; ">
<div style="   font-weight: 670;background-image: linear-gradient(to bottom, #ffff00 0%, #ffff00 40%, #8c5c2e 55%, #ffff00 80%, #ffff00 91%);
    color: transparent;  -webkit-background-clip: text;font-size: 25px;"id="kf"></div></div>
<video id="movies" src="" width="980" height="565" controls="controls" autobuffer="true"  x-webkit-airplay="true" poster="/Style/images/rgzbbj.png"webkit-playsinline="true" webkit-playsinline="true" playsinline="true">
			 <!-- <source src="" type="video/mp4">Your browser does not support the video tag.<!--  -->您的浏览器不支持video标签 -->
		</video>
		<div style="background: #887F7F; width: 100%; height: 65px;"><div style="line-height:65px;float: left; margin-top: -0px;width: 5%; height: 65px;"><img style="width:60px;height:65px;"src="/Style/images/rglaba.png" /></div><div  style="background: #fff;float: right;width: 95%; height: 65px; line-height:65px;  margin-top: -0px; right: 7%; background: url(/images/gb.png);"><marquee scrollamount="8" style="font-size: 35px;color:#fff;height:65px;line-height:65px;margin-top:0px;margin-left:15px;margin-right:5px; " ng-click="showNoticeInfo();" class="ng-binding">欢迎来到<?php echo $sitename ?>，在这里我们竭尽全力为您提供最好的服务！欢迎推广发展下线会员，待遇丰厚！详情请联系客服进行咨询。</marquee></div></div>
			<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		  <script type="text/javascript">
	$(function(){
		$.ajax({
			url:'/Video/zhibo/content.php',
			dataType:"JSON",

			success:function(obj){
				console.log(obj.hls);
				$("#movies").attr('src',obj.hls)
			}
		});
	});
</script>
<script>
        var ic = 0;
        function Dcolor() {
            var Tname = "<?php echo $sitename ?>";
            var Tlen = Tname.length;
            var kf = document.getElementById('kf');
            kf.innerHTML = Tname;
            var col = new Array("#f9ff00", "#f3e", "#00fdff", "#DC174C", "#02ff00", "#f3e", "#00fdff", "#DC174C", "#02ff00");
            var Strname = "";
            for (var i = 0; i < Tlen; ++i) {
                var Strname = Strname + "<font color=" + col[ic] + ">" + Tname.substring(i, i + 1) + "</font>";
                ic = ic + 1;
                if (ic == col.length) ic = 0;
            }
            kf.innerHTML = Strname;
            setTimeout("Dcolor()", 400);
        }
        Dcolor();
    </script>
</body>
</html>