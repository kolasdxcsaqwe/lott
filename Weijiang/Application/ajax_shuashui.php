<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$arr = array();
if($_POST['id'] == ''){
    $arr['success'] = false;
    $arr['msg'] = '参数错误..Err(-1203)';
}else{
    $shuashui = get_query_val('fn_user', 'shuashui', array('id' => $_POST['id'])) == 'true' ? 'false' : 'true';
    update_query("fn_user", array("shuashui" => $shuashui), array('id' => $_POST['id']));
    $arr['success'] = true;
    if($shuashui == 'true'){
        $arr['msg'] = '已屏蔽刷水';
    }else{
        $arr['msg'] = '已打开返水';
    }
}
echo json_encode($arr);
?>