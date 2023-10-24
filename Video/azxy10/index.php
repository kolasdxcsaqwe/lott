
	<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . '/Public/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>北-京-赛-车-p-k-1-0-开-奖-直-播</title>
          <script src="./jquery.js"></script>
          
    </head>
    <body style="padding:0; margin: 0; background: #000;">
		<div style="position:absolute;left:440px;top:230px;display:block;color:#fff;z-index:99999;display:none;font-size:27px" id="acontainer"></div>
        <div style="text-align: center; font-size: 0">
            <canvas id="gameCanvas" width="1136" height="640"></canvas>
        </div>
    <?php
if (strpos(get_query_val('fn_room', 'roomadmin', array(
    'roomid' => $_SESSION['roomid']
)), 'gd')!==false) {
?>
       
    <?php
} else {
?>
        <script src="./cocos2d.js"></script>
    <?php
}
?>
            <div style="display:none;">

<script type="text/javascript">


var acontainer = $('#acontainer');
var hasData = false;
function AddList(data){
	if(data.length > 0){
		hasData = true;
		acontainer.html(data[0].data);
		acontainer.show();
	}
}
function beforeStartRunning(){
	acontainer.hide();
}
function afterEndRunning(){
	if(hasData)acontainer.show();
}
<?php
if (get_query_val('fn_setting', 'setting_video', array(
    "roomid" => $_SESSION['roomid']
))!="") {
?>
	AddList([{"code":"xyft_zhibo_html5","data":["<?php
    echo get_query_val('fn_setting', 'setting_video', array(
        "roomid" => $_SESSION['roomid']
    ));
?>"]}]);
<?php
}
?>
</script>
</div>

    </body>
</html>
