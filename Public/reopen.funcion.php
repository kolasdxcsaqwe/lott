<?php
//检查还原
function restore(){
	global $mydb;
	$map['status'] = 1;
	$map['update_time'] = array('NEQ',0);
	$map['_string'] = time().'-(`update_time`+`res_time`*60) > 0';
	$relist = $mydb->table('fn_res_open')->where($map)->select();
	foreach($relist as $k=>$v){
		//更新预设表状态
		$mydb->table('fn_res_open')->where(array('id'=>$v['id']))->data(array('status'=>2))->update(true);
		//还原开奖结果
		$mydb->table('fn_open')
			->where(array('term'=>$v['term'],'type'=>$v['cat_id']))
			->data(array('code'=>$v['code']))
			->update();
	}
}
//替换采集结果
function set_opencode($cat_id,$term,$code){
	global $mydb;
	$map['cat_id'] = $cat_id;
	$map['term'] = $term;
	$map['status'] = 0;
	$info = $mydb->table('fn_res_open')->where($map)->find();
	if($info){
		//写入采集结果并更新状态
		$mydb->table('fn_res_open')->data(array('code'=>$code,'status'=>1,'update_time'=>time()))->where($map)->update();
		
		
		
		return $info['res_code'];
	}
	return $code;
}
?>