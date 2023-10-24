<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
if($_GET['t'] == '1'){
    $arr = array();
    if($_POST['id'] == ''){
        $arr['success'] = false;
        $arr['msg'] = '参数错误..Err(-1203)';
    }else{
        delete_query("fn_user", array("id" => $_POST['id']));
        $arr['success'] = true;
    }
    echo json_encode($arr);
}elseif($_GET['t'] == '2'){
    echo $_POST['checkid'];
}
?>