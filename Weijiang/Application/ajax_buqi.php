<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$arr = array();
	global $mydb;
	$data['term'] = $_POST['term'];
	$data['type'] = $_POST['type'];
	$data['code'] = $_POST['code'];
	$data['time'] = $_POST['time'];
	$data['next_term'] = $_POST['next_term'];
	$data['next_time'] = $_POST['next_time'];
	$data['roomid'] = $_SESSION['agent_room'];
	
	
	$cf = $mydb->table('fn_open')->where(array('term'=>$data['term']))->find();
	if(!$cf){
		$r = $mydb->table('fn_open')->data($data)->insert();
		if($r){
			$arr['success'] = true;
		}else{
			$arr['success'] = false;
			$arr['msg'] = '参数错误';
		}
		echo json_encode($arr);
	}else{
		$arr['success'] = false;
		$arr['msg'] = '期号已经存在';
		echo json_encode($arr);
	}
?>