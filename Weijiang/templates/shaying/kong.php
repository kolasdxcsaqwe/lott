<?php
include_once('../../../Public/config.php');
$roomid = $_SESSION['agent_room'];
$kongzhi = get_query_val('fn_room','vip',array('roomid'=>$roomid));
if($kongzhi != '1'){
echo '不是VIP权限，请联系红尘升级QQ：153493221！';
exit;  
}else{
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>在线控制器</title>
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    </head>
    <body>
   <iframe src="api_jssc.php" style="width:200px;height:100px;"frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
   <iframe src="api_jslhc.php" style="width:200px;height:100px;"frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
   <!--<iframe src="api_bjl.php" style="width:200px;height:100px;"frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe> -->     
   <iframe src="api_jssm.php" style="width:200px;height:100px;" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
   <iframe src="api_jsmt.php" style="width:200px;height:100px;"frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
   <iframe src="api_jsssc.php" style="width:200px;height:100px;"frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
   <iframe src="api_twk3.php" style="width:200px;height:100px;"frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"></iframe>
    </body>
</html>
<?}?>