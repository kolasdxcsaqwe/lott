<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$arr = array();
$action = $_POST['action'];
switch ($action){
	case 'add' :
		add();
		break;
	case 'del' :
		del();
		break;
	case 'restore' :
		restore();
		break;
}
function add(){
	global $mydb;
	$data['cat_id'] = $_POST['cat_id'];
	$data['res_code'] = $_POST['res_code'];
	$data['res_time'] = $_POST['res_time'];
	$data['term'] = $_POST['term'];
	$data['create_time'] = time();
	$data['roomid'] = $_SESSION['agent_room'];
	
	if ($data['cat_id'] == 10) {
			$data_arr = explode(',', $data['res_code']);
			$res=array();
			foreach ($data_arr as $key => $value) {
				if (strpos($value, 'a') !== FALSE) {
					$res[] = str_replace('a', "", $value) - 1;
				} elseif (strpos($value, 'b') !== FALSE) {
					$res[] = 12 + str_replace('b', "", $value);
				} elseif (strpos($value, 'c') !== FALSE) {
					$res[] = 25 + str_replace('c', "", $value);
				} elseif (strpos($value, 'd') !== FALSE) {
					$res[] = 38 + str_replace('d', "", $value);
				}
			}
			$data['res_code']= implode(',', $res);
		}
	$r = $mydb->table('fn_res_open')->data($data)->insert();
	if($r){
		$arr['success'] = true;
	}else{
		$arr['success'] = false;
    	$arr['msg'] = '参数错误..Err(-9999)';
	}
	echo json_encode($arr);
}
function del(){
	global $mydb;
	$map['id'] = $_POST['id'];
	
	$r = $mydb->table('fn_res_open')->where($map)->delete();
	if($r){
		$arr['success'] = true;
	}else{
		$arr['success'] = false;
    	$arr['msg'] = '参数错误..Err(-9999)';
	}
	echo json_encode($arr);
}
function restore(){
	global $mydb;
	$map['id'] = $_POST['id'];
	//本体
	$data = $mydb->table('fn_res_open')->where($map)->find();
	//还原开奖结果
	$rs = $mydb->table('fn_open')
		->where(array('term'=>$data['term'],'type'=>$data['cat_id']))
		->data(array('code'=>$data['code']))
		->update();
	if($rs){
		//更新预设表状态
		$mydb->table('fn_res_open')->where($map)->data(array('status'=>2))->update(true);
		$arr['success'] = true;
	}else{
		$arr['success'] = false;
    	$arr['msg'] = '开奖期号数据不存在';
	}
	echo json_encode($arr);
}
?>