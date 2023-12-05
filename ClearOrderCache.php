<?php

include_once('Public/config.php');

//DELETE FROM fn_pcorder WHERE addtime < '2023-10-25 23:15:25'
$time=time();
delete_query("fn_pcorder", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_pcorder 的数据:".(time()-$time)."秒<br>";

$time=time();
delete_query("fn_jssscorder", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_jssscorder 的数据:".(time()-$time)."秒<br>";

$time=time();
delete_query("fn_twk3order", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_twk3order 的数据:".(time()-$time)."秒<br>";

$time=time();
delete_query("fn_lhcorder", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_lhcorder 的数据:".(time()-$time)."秒<br>";

$time=time();
delete_query("fn_order", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_order 的数据:".(time()-$time)."秒<br>";

$time=time();
delete_query("fn_jslhcorder", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_jslhcorder 的数据:".(time()-$time)."秒<br>";

$time=time();
delete_query("fn_marklog", 'addtime < ' . '\'' . date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 30)) . '\'');
echo "清理30天前的 fn_marklog 的数据:".(time()-$time)."秒<br>";
