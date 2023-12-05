<?php
include_once('Public/config.php');

$time=time();
delete_query("fn_chat", 'time < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 5)) . '\'');
echo "清理5天前的聊天的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime=date('Y-m-d H:i:s', time()-259200);//三天前数据删掉
delete_query('fn_open', "`type`= 5 and `time` < '$deleteTime'");
echo "清理加拿大28 3天前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime=date('Y-m-d H:i:s', time()-7200);//两小时前数据删掉
delete_query('fn_open', "`type`= 19 and `time` < '$deleteTime'");
echo "清理纽约28 两小时前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime=date('Y-m-d H:i:s', time()-7200);//两小时前数据删掉
delete_query('fn_open', "`type`= 4 and `time` < '$deleteTime'");
echo "清理新加坡28 两小时前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime = date('Y-m-d H:i:s', time() - 14400);//4小时前数据删掉
delete_query('fn_open', "`type`= 15 and `time` < '$deleteTime'");
echo "清理台湾快三 4小时前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime = date('Y-m-d H:i:s', time() - 14400);//4小时前数据删掉
delete_query('fn_open', "`type`= 14 and `time` < '$deleteTime'");
echo "清理极速六合彩 4小时前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime = date('Y-m-d H:i:s', time() - 14400);//4小时前数据删掉
delete_query('fn_open', "`type`= 8 and `time` < '$deleteTime'");
echo "清理极速时时彩 4小时前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime=date('Y-m-d H:i:s', time()-259200);//三天前数据删掉
delete_query('fn_open', "`type`= 1 and `time` < '$deleteTime'");
echo "清理北京赛车 3天前开奖的数据:".(time()-$time)."秒<br>";

$time=time();
$deleteTime=date('Y-m-d H:i:s', time()-(60 * 60 * 24 * 15));//15天前数据删掉
delete_query('fn_userlog', "`addtime` < '$deleteTime'");
echo "清理用户记录列表fn_userlog  15天前的数据:".(time()-$time)."秒<br>";