<?php
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "../../../Public/config.php";
$ajaxHandler = $_GET['ajaxHandler'];
$roomid = $_SESSION['roomid'];
$type = 10;
$kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
$pre_open = get_query_vals('fn_sopen', '*', "`type` = '$type' and `roomid` = '$roomid'order by `term` desc limit 1");

if($kong == '1' && $pre_open ){
include_once "../../../Public/Bjl_1.php";
switch ($ajaxHandler) {
    case 'GetBac1AwardData':
        $data = array();
        $bjl = new Bjl();
        $cur = $bjl->get_period_info($bjl->getTodayCur());
        $codes = $bjl->newCode($roomid,true);
        if (!$codes) {
            exit();
        }
        $pb = $bjl->getPB($codes);
        $data['time'] = time() * 1000;
        $data['result'] = array(
            "Bet" => array(
                'P',
                'B'
            ),
            "Player" => $pb['p'],
            "Banker" => $pb['b'],
            "Result" => $bjl->Result($pb['p'], $pb['b']),
            "HtmlCard" => array(
                "Player" => $bjl->HtmlCard($pb['p']),
                "Banker" => $bjl->HtmlCard($pb['b'])
            )
        );
        $data['next'] = array(
            'awardTime' => date("Y-m-d H:i:s",strtotime($cur['next_awardTime']+10)),
            'awardTimeInterval' => (strtotime($cur['next_awardTime'])+10 - time()) * 1000,
            'delayTimeInterval' => 5,
            'periodNumber' => $cur['next_periodNumber']
        );
        $data['current'] = array(
            'awardNumbers' => $codes,
            'awardTime' => date("Y-m-d H:i:s",strtotime($cur['awardTime']+10)),
            'periodNumber' => $cur['periodNumber']
        );
        exit(json_encode($data));
         
        break;
    case 'GetBac1HistData':
        db_query("select * from fn_sopen where type=10 and roomid=$roomid order by term desc limit 35 ");
        $data = array();
        $bjl = new Bjl();
        while ($row = db_fetch_array()) {
            $code = $row['code'];
            $pb = $bjl->getPB($code);
            $data["" . $row['term']] = array(
                "Player" => $pb['p'],
                "Banker" => $pb['b'],
                "Result" => $bjl->Result($pb['p'], $pb['b']),
                "HtmlCard" => array(
                    "Player" => $bjl->HtmlCard($pb['p']),
                    "Banker" => $bjl->HtmlCard($pb['b'])
                )
            );
        }
        exit(json_encode($data));
        break;
    default:
        break;
}
}else{
include_once "../../../Public/Bjl.php";
switch ($ajaxHandler) {
    case 'GetBac1AwardData':
        $data = array();
        $bjl = new Bjl();
        $cur = $bjl->get_period_info($bjl->getTodayCur());
        $codes = $bjl->newCode(false);
        if (!$codes) {
            exit();
        }
        $pb = $bjl->getPB($codes);
        $data['time'] = time() * 1000;
        $data['result'] = array(
            "Bet" => array(
                'P',
                'B'
            ),
            "Player" => $pb['p'],
            "Banker" => $pb['b'],
            "Result" => $bjl->Result($pb['p'], $pb['b']),
            "HtmlCard" => array(
                "Player" => $bjl->HtmlCard($pb['p']),
                "Banker" => $bjl->HtmlCard($pb['b'])
            )
        );
        $data['next'] = array(
            'awardTime' => $cur['next_awardTime'],
            'awardTimeInterval' => (strtotime($cur['next_awardTime']) - time()) * 1000,
            'delayTimeInterval' => 5,
            'periodNumber' => $cur['next_periodNumber']
        );
        $data['current'] = array(
            'awardNumbers' => $codes,
            'awardTime' => $cur['awardTime'],
            'periodNumber' => $cur['periodNumber']
        );
        exit(json_encode($data));
        break;
    case 'GetBac1HistData':
        db_query("select * from fn_open where type=10 order by term desc limit 25 ");
        $data = array();
        $bjl = new Bjl();
        while ($row = db_fetch_array()) {
            $code = $row['code'];
            $pb = $bjl->getPB($code);
            $data["" . $row['term']] = array(
                "Player" => $pb['p'],
                "Banker" => $pb['b'],
                "Result" => $bjl->Result($pb['p'], $pb['b']),
                "HtmlCard" => array(
                    "Player" => $bjl->HtmlCard($pb['p']),
                    "Banker" => $bjl->HtmlCard($pb['b'])
                )
            );
        }
        exit(json_encode($data));
        break;
    default:
        break;
}
}