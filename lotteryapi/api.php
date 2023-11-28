<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "../Public/config.php";
$openType=$_GET['code'];
select_query("fn_open","*","type = $openType order by term Desc");
while ($con = db_fetch_array()) {
    $result[] = $con;
}
header('content-type:application/json');
echo json_encode($result);