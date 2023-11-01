<?php
$daynum = floor((time() - strtotime("2017-01-01 00:00:00")) / 3600 / 24);

$sclastno = ($daynum - 1) * 576 + 2155999;

function times ($interval){
    $beginTime = "00:00:00";
    $endTime = "23:59:59";
    $inter = explode(":",$interval);
    $arrH = 0;
    $arrM = 0;
    $arrS = 0;
    $arrs = array();

    $allTimes = 86400;
    $len = $allTimes / ((int)($inter[0] * 60) + (int)($inter[1]));
    for ($i = 0; $i < $len; $i++) {
        $arrS = $arrS + (int)($inter[1]);
        if((int)($arrS) >= 60){
            $arrS = 0;
            $arrM = (int)($arrM) + 1;
        }

        $arrM = $arrM + (int)($inter[0]);
        if((int)($arrM) >= 60){
            $arrM = 0;
            $arrH = (int)($arrH) + 1;
        }

        $arrH1 = $arrH;
        $arrM1 = $arrM;
        $arrS1 = $arrS;

        if ($arrH1 < 10) {
            $arrH1 = "0" . $arrH1;
        }
        if ($arrM1 < 10) {
            $arrM1 = "0" . $arrM1;
        }
        if ($arrS1 < 10) {
            $arrS1 = "0" . $arrS1;
        }

        if((int)($arrH) > 23){
            // $arrs.push("00:00:00");
            array_push($arrs,"00:00:00");
            return $arrs;
        }

        $arrTimes = $arrH1 . ":" . $arrM1 . ":" . $arrS1;
        array_push($arrs, $arrTimes);
    }
}

$tim = times("1:00");
$tarr =$tim ;
$c = 0;
$t = '';
if (date('H:i:s') > '23:56:00') {
    $c = 576;
    $t = '00:00:00';
} else {
    for ($i = 0; $i < 576; $i++) {
        if ($tarr[$i] > date('H:i:s')) {
            $c = $i + 1;
            $t = $tarr[$i];
            break;
        }
    }
}

$scissue = ($sclastno + $c) - 1;
$scnext_issue = ($sclastno + $c);



$time = date('Y-m-d H:i:s', strtotime(date('Y-m-d ') . $t) - 150);
$next_time = date('Y-m-d ') . $t;






function randNum ($min, $max, $len=5){
    $randArr = array();
    for($x=0;$x<$len;$x++){
        $rand = rand($min,$max);
        array_push($randArr,$rand);
    }
    return $randArr;
}
$ny28arr = randNum(0,9,3);
shuffle($ny28arr);
$ny28code = implode($ny28arr, ',');



$kt = '{"rows":1,"data":[';
$ny28 = '{"code":"ny28","opentime":"'.$time.'","expect":"'.$scissue.'","opencode":"'.$ny28code.'","load_time":"'.date('Y-m-d H:i:s',time()).'","next_phase":"'.$scnext_issue.'","next_time":"'.$next_time.'","now":"'.date('Y-m-d H:i:s',time()).'"}';
$sw = '],"now":"'.date('Y-m-d H:i:s',time()).'"}';
echo $kt;

echo $ny28;
echo $sw;
exit;

?>