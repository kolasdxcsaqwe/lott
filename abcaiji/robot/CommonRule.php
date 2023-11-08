<?php
include_once dirname(dirname(__FILE__)) . '/Public/Http.php';
include_once dirname(dirname(__FILE__)) . '/Public/config.php';

function startBot($betGame, $roomId,$periodMin,$period)
{
//    sleep($periodMin);
    select_query('fn_robots','*',"roomid = {$roomId} and game = '{$betGame}' and runstatus = '1' limit 30");
    $arr=array();
    $index=0;
    while($con = db_fetch_array()){
        $arr[$index++]=$con;
    }

    echo "有".count($arr)."个机器人<br>";
    
    if(count($arr)>0)
    {
        for ($j = 0; $j < count($arr); $j++) {
            $headimg = $arr[$j]['headimg'];
            $name = $arr[$j]['name'];
            $plan = $arr[$j]['plan'];
            $rare = $arr[$j]['rare'];
            $userid = $arr[$j]['userid'];
            $plans = explode('|', $plan);
//            sleep(rand(1,5));
            if ($headimg == '' || $name == '' || $plan == '') return;

            for ($i = 0; $i < count($plans); $i++) {
                $isContinue = rand(1, 10) < $rare / 10;
                if($isContinue)
                {
                    $planJsonStr = get_query_val('fn_robotplan', 'content', array('id' => $plans[$i]));
                    common(json_decode($planJsonStr), $betGame, $headimg, $name, $roomId, $userid);
                }
            }
        }


    }
   



//    if(!$isContinue)
//    {
//        //随机不通过就不下注了
//        return;
//    }



}

function common($plan, $betGame, $headimg, $name, $roomId, $userid)
{

    if ($plan == null || count($plan) < 1) {
        return;
    }

    //[{"gameType":"sjws","moneyType":"money1"}]
    for ($i = 0; $i < count($plan); $i++) {
        singlePlan($plan[$i], $betGame, $headimg, $name, $roomId, $userid);
    }
}

function singlePlan($plan, $betGame, $headimg, $name, $roomId, $userid)
{

    $planType = $plan->gameType;
    $moneyType = $plan->moneyType;
    $betMoney = 0;
    $betContent = "";

    switch ($moneyType) {
        case 'money1'://10-200的随机金额，整数。
            $betMoney = rand(10, 200);
            break;
        case 'money2'://100-1000的随机金额，整数。
            $betMoney = rand(100, 1000);
            break;
        case 'money3'://1000-15000的随机金额，整数。
            $betMoney = rand(1000, 15000);
            break;
    }

    switch ($planType) {
        case 'sjws'://随机位数

            break;
        case 'sjtm'://随机特码

            break;
        case 'sjsm'://随机双面
            $betContent = sjsm($betGame, $betMoney);
            break;
        case 'sjlh'://随机龙虎
            $betContent = sjlh($betGame, $betMoney);
            break;
        case 'smdds'://随机大单双
            $betContent = smdds($betGame, $betMoney);
            break;
        case 'sjxds'://随机小单双
            $betContent = sjxds($betGame, $betMoney);
            break;
        case 'sjsz'://随机数字

            break;
        case 'sjts'://随机特殊

            break;
        case 'sjts'://随机特殊

            break;
        case 'sjhz'://随机和值
            $betContent = sjhz($betGame, $betMoney);
            break;
        case 'sjlhpt'://随机六合平特

            break;
        case 'sjlhhs'://随机六合号数

            break;

        case 'sjlhbs'://随机六合波色

            break;
        case 'sjlhdx'://随机六合单肖

            break;
        case 'sjkstx'://随机快三通选

            break;
        case 'sjkssj'://随机快三三军

            break;

        case 'sjksbz'://随机快三豹子

            break;
        case 'sjksdz'://随机快三对子

            break;
        case 'sjkssz'://随机快三三杂

            break;
        case 'sjksez'://随机快三二杂

            break;

    }

//    if (preg_match("/{随机特码}/", $plan)) {
//        $i2 = substr_count($plan, '{随机特码}');
//        for ($i = 0; $i < $i2; $i++) {
//            $plan = str_replace_once("{随机特码}", rand(0, 9), $plan);
//        }
//    }
//
//    if (preg_match("/{随机极值}/", $plan)) {
//        $val = rand(1, 2);
//        if ($val == 1) {
//            $val = '极大';
//        } elseif ($val == 2) {
//            $val = '极小';
//        }
//        $plan = str_replace('{随机极值}', $val, $plan);
//    }
//
//    if (preg_match("/{随机数字}/", $plan)) {
//        $i2 = substr_count($plan, '{随机数字}');
//        for ($i = 0; $i < $i2; $i++) {
//            $plan = str_replace_once("{随机数字}", rand(0, 27), $plan);
//        }
//    }
//    if (preg_match("/{随机和值}/", $plan)) {
//        $i2 = substr_count($plan, '{随机和值}');
//        for ($i = 0; $i < $i2; $i++) {
//            $plan = str_replace_once("{随机和值}", rand(3, 19), $plan);
//        }
//    }
//    if (preg_match("/{随机特殊}/", $plan)) {
//        $val = rand(1, 3);
//        if ($val == 1) {
//            $val = '豹子';
//        } elseif ($val == 2) {
//            $val = '对子';
//        } elseif ($val == 3) {
//            $val = '顺子';
//        }
//        $plan = str_replace('{随机特殊}', $val, $plan);
//    }

    echo "下注内容：" . $betContent . "   <br>";

    if($betContent!=null && strlen($betContent)>0)
    {
        $baseurl = "http://localhost:8123/Application/ajax_chat_robot.php?type=send";
        $request = HTTP::curlPost($baseurl, array('content' => $betContent, 'userid' => $userid,
            'gametype' => $betGame, 'headimg' => $headimg, 'username' => $name, 'roomid' => $roomId));
        echo $request . " <br>";
    }

}

function sjhz($game, $money)
{
    $result="";
    $val = rand(0, 27);
    switch ($game) {
        case 'xy28':
        case 'jnd28':
        case 'ny28':
            $result = $val . $money;
            break;
    }
    return $result;
}

function smdds($game, $money)
{
    $result="";
    $val = rand(1, 2);
    if ($val == 1) {
        $val = '大单';
    } elseif ($val == 2) {
        $val = '大双';
    }

    switch ($game) {
        case 'xy28':
        case 'jnd28':
        case 'ny28':
            $result = $val . $money;
            break;
        case 'twk3':
            $result = "总" . "/" . $val . "/" . $money;
            break;
    }

    return $result;
}

function sjxds($game, $money)
{
    $result="";

    $val = rand(1, 2);
    if ($val == 1) {
        $val = '小单';
    } elseif ($val == 2) {
        $val = '小双';
    }

    switch ($game) {
        case 'xy28':
        case 'jnd28':
        case 'ny28':
            $result = $val . $money;
            break;
        case 'twk3':
            $result = "总" . "/" . $val . "/" . $money;
            break;
    }

    return $result;
}

function sjsm($game, $money)
{
    $result="";
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

    $num = rand(1, 5);
    switch ($game) {
        case 'jsssc':
            $result = $num . "/" . $val . "/" . $money;
            break;
        case 'twk3':
            $result = "总" . "/" . $val . "/" . $money;
            break;
        case 'xy28':
        case 'jnd28':
        case 'ny28':
            $result = $val . $money;
            break;
    }

    return $result;
}

function sjlh($game, $money)
{
    $result="";
    $val = rand(1, 2);
    if ($val == 1) {
        $val = '龙';
    } elseif ($val == 2) {
        $val = '虎';
    }

    switch ($game) {
        case 'jsssc':
            $result = "/" . $val . "/" . $money;
            break;
    }
    return $result;
}