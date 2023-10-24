<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$arr = array();
if($_POST['id'] == ''){
    $arr['success'] = false;
    $arr['msg'] = '参数错误..Err(-1203)';
}else{
    $tixian = '';
    update_query("fn_user", array("tixian" => $tixian), array('id' => $_POST['id']));
    $arr['success'] = true;
    if($tixian == ''){
        $arr['msg'] = '已删除';
    }else{
        $arr['msg'] = '删除失败';
    }
}
echo json_encode($arr);
?>