<?php
//继承Threaded类，Threaded提供了隐式的线程安全机制
//$redis = new Redis();
//try {
//    $redis->connect('127.0.0.1', 6379);
//    $redis->set("sadsad", "123");
//    echo $redis->time();
//} catch (RedisException $e) {
//    echo $e->getMessage();
//}
//include_once("./Public/sql.php");
//include_once("./Public/db.class.php");
//$db['host'] = "127.0.0.1";
//$db['user'] = "root";
//$db['pass'] = "123qwe";
//
//$db['name'] = "v9ym";
//
//$mydb = new db(array($db['host'], 'DB_USER' => $db['user'], 'DB_PWD' => $db['pass'], 'DB_NAME' => $db['name']));
//echo json_encode($mydb);
//$jj=$mydb->table("fn_chat")->field("*")->find();
//echo json_encode($jj);

include_once("./Public/config.php");
$nowTime= date('Y-m-d H:i:s', time());
$time= date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30));
echo $nowTime."    ".$time."<br>";

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo "Connection to server successfully"."<br>";
//查看服务是否运行
echo "Server is running: " . $redis->ping()."<br>";

if(empty($_SESSION["CUSERID"]))
{
    $_SESSION["CUSERID"]="sadsadsad";
}
else
{
    echo json_encode($_SESSION);
}






