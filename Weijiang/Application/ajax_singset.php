<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

// global $mydb; 
 $info_singset = $mydb->table('fn_sign_set')->field('*')->where(array('id' => 1))->find();//
 //$info_singset = get_query_val('fn_sign_set', '*', "id = 1");
//session_unset('singset');
 //var_dump($info_singset);

 $_SESSION['singset']=$info_singset;

	if ($_POST['s_1'] && !empty($_POST['s_1'] )) {
		$data['s_1'] = $_POST['s_1'];
	}
	if ($_POST['s_2'] && !empty($_POST['s_2'] )) {

		$data['s_2'] = $_POST['s_2'];

	}	
	if ($_POST['s_3'] && !empty($_POST['s_3'] )) {

		$data['s_3'] = $_POST['s_3'];

	}	if ($_POST['s_4'] && !empty($_POST['s_4'] )) {
		$data['s_4'] = $_POST['s_4'];
	}	if ($_POST['s_5'] && !empty($_POST['s_5'] )) {
		$data['s_5'] = $_POST['s_5'];
	}	if ($_POST['s_6'] && !empty($_POST['s_6'] )) {
		$data['s_6'] = $_POST['s_6'];
	}	if ($_POST['s_7'] && !empty($_POST['s_7'] )) {
		$data['s_7'] = $_POST['s_7'];
	}

	
	 $r = update_query("fn_sign_set", $data, array("id" => 1));
	// $r = $mydb->table('fn_sign_set')->where(array("id" => 1))->update();
	 if ($r) {
	  	echo json_encode(array('res'=>1,'msg'=>'操作成功'));//

	 }else{
	 	echo json_encode(array('res'=>0,'msg'=>'操作失败',));//

	 }
	
?>