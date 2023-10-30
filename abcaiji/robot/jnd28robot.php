<?php
include_once "../Public/config.php";

function startBot($betGame,$roomId)
{
    $robots = get_query_vals('fn_robots', '*', "roomid = {$roomId} and game = '{$betGame}' order by rand() desc limit 1");
    $headimg = $robots['headimg'];
    $name = $robots['name'];
    $plan = $robots['plan'];
    $plan = explode('|', $plan);
    if ($headimg == '' || $name == '' || $plan == '') return;
    $use = rand(0, count($plan) - 1);
    $plan = get_query_val('fn_robotplan', 'content', array('id' => $plan[$use]));
    if (preg_match("/{随机名次}/", $plan)) {
        $i2 = substr_count($plan, '{随机名次}');
        for ($i = 0; $i < $i2; $i++) {
            $plan = str_replace_once("{随机名次}", rand(0, 9), $plan);
        }
    }
    if (preg_match("/{随机特码}/", $plan)) {
        $i2 = substr_count($plan, '{随机特码}');
        for ($i = 0; $i < $i2; $i++) {
            $plan = str_replace_once("{随机特码}", rand(0, 9), $plan);
        }
    }
    if (preg_match("/{随机双面}/", $plan)) {
        $val = rand(1, 4);
        if ($val == 1) {
            $val = '大';
        } elseif ($val == 2) {
            $val = '小';
        } elseif ($val == 3) {
            $val = '单';
        } elseif ($val == 4) {
            $val = '双';
        }
        $plan = str_replace('{随机双面}', $val, $plan);
    }
    if (preg_match("/{随机龙虎}/", $plan)) {
        $val = rand(1, 2);
        if ($val == 1) {
            $val = '龙';
        } elseif ($val == 2) {
            $val = '虎';
        }
        $plan = str_replace('{随机龙虎}', $val, $plan);
    }
    if (preg_match("/{随机极值}/", $plan)) {
        $val = rand(1, 2);
        if ($val == 1) {
            $val = '极大';
        } elseif ($val == 2) {
            $val = '极小';
        }
        $plan = str_replace('{随机极值}', $val, $plan);
    }
    if (preg_match("/{随机组合1}/", $plan)) {
        $val = rand(1, 2);
        if ($val == 1) {
            $val = '大单';
        } elseif ($val == 2) {
            $val = '大双';
        }
        $plan = str_replace('{随机组合1}', $val, $plan);
    }
    if (preg_match("/{随机组合2}/", $plan)) {
        $val = rand(1, 2);
        if ($val == 1) {
            $val = '小单';
        } elseif ($val == 2) {
            $val = '小双';
        }
        $plan = str_replace('{随机组合2}', $val, $plan);
    }
    if (preg_match("/{随机数字}/", $plan)) {
        $i2 = substr_count($plan, '{随机数字}');
        for ($i = 0; $i < $i2; $i++) {
            $plan = str_replace_once("{随机数字}", rand(0, 27), $plan);
        }
    }
    if (preg_match("/{随机和值}/", $plan)) {
        $i2 = substr_count($plan, '{随机和值}');
        for ($i = 0; $i < $i2; $i++) {
            $plan = str_replace_once("{随机和值}", rand(3, 19), $plan);
        }
    }
    if (preg_match("/{随机特殊}/", $plan)) {
        $val = rand(1, 3);
        if ($val == 1) {
            $val = '豹子';
        } elseif ($val == 2) {
            $val = '对子';
        } elseif ($val == 3) {
            $val = '顺子';
        }
        $plan = str_replace('{随机特殊}', $val, $plan);
    }
    if (preg_match("/{随机金额1}/", $plan)) {
        $plan = str_replace('{随机金额1}', rand(20, 300), $plan);
    }
    if (preg_match("/{随机金额2}/", $plan)) {
        $plan = str_replace('{随机金额2}', rand(300, 1000), $plan);
    }
    if (preg_match("/{随机金额3}/", $plan)) {
        $plan = str_replace('{随机金额3}', rand(1000, 3000), $plan);
    }
    insert_query("fn_chat", array("userid" => "robot", "username" => $name, 'headimg' => $headimg, 'content' => $plan, 'addtime' => date('H:i:s'), 'time' => date('Y-m-d H:i:s', time()), 'game' => $BetGame, 'roomid' => $_SESSION['roomid'], 'type' => 'U3'));
    if (get_query_val("fn_setting", "setting_tishi", array("roomid" => $_SESSION['roomid'])) == 'open') {
        管理员喊话("@$name,投注成功！请选择左侧菜单核对投注！");
    }
}


