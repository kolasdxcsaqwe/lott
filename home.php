
<?php include_once('Public/config.php');

check_login();
$action = $_GET['action'];
if($action == 'getmoney'){
	$r = get_user_money();
	echo json_encode($r);
	exit();
}
$game = get_query_val('fn_setting','setting_game',array('roomid'=>$_SESSION['roomid']));
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
    </head>
    <body>
    <script>window.location.href='/qr2.php?room=<?php echo $_SESSION['roomid']?>&g=<?php echo $game?>';</script> 
    </body>
</html>