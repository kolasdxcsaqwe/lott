<?php
include_once "../Public/Http.php";
include_once "../Public/config.php";

function startBot($betGame,$roomId)
{
    $robots = get_query_vals('fn_robots', '*', "roomid = {$roomId} and game = '{$betGame}' and status = '1' ");
    $headimg = $robots['headimg'];
    $name = $robots['name'];
    $plan = $robots['plan'];
    $rare=$robots['rare'];
    $plans = explode('|', $plan);
    if ($headimg == '' || $name == '' || $plan == '') return;

    $isContinue = rand(1, 10)>$rare/10;
    if(!$isContinue)
    {
        //随机不通过就不下注了
        return;
    }

    for ($i = 0; $i < count($plans); $i++) {
        $planJsonStr = get_query_val('fn_robotplan', 'content', array('id' => $plans[$i]));
        common(json_decode($planJsonStr));
    }

}

function common($plan)
{
    if($plan==null || count($plan)<1)
    {
        return;
    }

    //[{"gameType":"sjws","moneyType":"money1"}]
    for ($i = 0; $i < count($plan); $i++) {
        singlePlan($plan[$i]);
    }
}

function sjlh()
{
    $val = rand(1, 2);
    if ($val == 1) {
        $val = '龙';
    } elseif ($val == 2) {
        $val = '虎';
    }
    return $val;
}

function singlePlan($plan)
{
    $gameType=$plan['gameType'];
    $moneyType=$plan['moneyType'];
    $betMoney = 0;
    $betContent="";

    switch ($gameType)
    {
        case 'money1'://10-200的随机金额，整数。
            $betMoney= rand(10, 200);
            break;
        case 'money2'://100-1000的随机金额，整数。
            $betMoney= rand(100, 1000);
            break;
        case 'money3'://1000-15000的随机金额，整数。
            $betMoney= rand(1000, 15000);
            break;
    }

    switch ($gameType)
    {
        case 'sjws'://随机位数

            break;
        case 'sjtm'://随机特码

            break;
        case 'sjsm'://随机双面
            sjsm();
            break;
        case 'sjlh'://随机龙虎
            sjlh();
            break;
        case 'smdds'://随机大单双
            smdds();
            break;
        case 'sjxds'://随机小单双
            sjxds();
            break;
        case 'sjsz'://随机数字
            
            break;
        case 'sjts'://随机特殊

            break;
        case 'sjts'://随机特殊

            break;
        case 'sjhz'://随机和值

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

    if (preg_match("/{随机特码}/", $plan)) {
        $i2 = substr_count($plan, '{随机特码}');
        for ($i = 0; $i < $i2; $i++) {
            $plan = str_replace_once("{随机特码}", rand(0, 9), $plan);
        }
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

    HTTP::curlPost("http:///Application/ajax_chat.php?type=send",array('content'=>$betContent));
}

function smdds()
{
    $val = rand(1, 2);
    if ($val == 1) {
        $val = '大单';
    } elseif ($val == 2) {
        $val = '大双';
    }

    return $val;
}

function sjxds()
{
    $val = rand(1, 2);
    if ($val == 1) {
        $val = '小单';
    } elseif ($val == 2) {
        $val = '小双';
    }
    return $val;
}

function sjsm()
{
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
    return $val;
}