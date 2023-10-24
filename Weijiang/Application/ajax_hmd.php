<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$arr = array();
if($_POST['id'] != ''){
    $id = $_POST['id'];
    $userid = get_query_vals('fn_user', '*', array('id' => $id));
    
    if($userid['hmd'] == '1'){
        update_query('fn_user',array('hmd'=>'0'),array('id' => $id));
        $arr['success'] = false;
        $arr['msg'] = '取消屏蔽成功';
        echo json_encode($arr);
        exit();
    
    }elseif($userid['hmd'] == '0' || $userid['hmd'] == ''){
       update_query('fn_user',array('hmd'=>'1'),array('id' => $id));
        $arr['success'] = false;
        $arr['msg'] = '屏蔽游戏成功.';
        echo json_encode($arr);
        exit();
    
    }
      
    
}else{
    $arr['success'] = false;
    $arr['msg'] = '参数错误..Err(-1203)';
}
echo json_encode($arr);
?>