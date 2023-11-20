<?
global $roboImg;
include_once("./Public/config.php");
$withdrawTime=get_query_val('fn_upmark','time',array('userid' => 'oWNAL0tlmHRQSisrrn2iciSfRXy4'));
$time=getMillisecond();
$openType='4';
$roomid='10029';
//for ($i = 0; $i < 120; $i++) {
//    $zuhe_zongzhu1 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu1', array('roomid' => $roomid));
//    $zuhe_zongzhu2 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu2', array('roomid' => $roomid));
//    $zuhe_zongzhu3 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu3', array('roomid' => $roomid));
//    $zuhe_1314_1 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_1', array('roomid' => $roomid));
//    $zuhe_1314_2 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_2', array('roomid' => $roomid));
//    $zuhe_1314_3 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_3', array('roomid' => $roomid));
//}


//select_query("fn_pcorder", '*', array("status" => "未结算"));
//while ($con = db_fetch_array()) {
//    $cons[] = $con;
//}
//echo count($cons)."条数 <br>";
//echo "查看条数使用时间:".(getMillisecond()-$time)."<br>";
//
//$time=getMillisecond();
//PC_jiesuan222('ny28');
//echo "使用时间:".(getMillisecond()-$time);
phpinfo();

function getTimestamp($digits = false)
{
    $digits = $digits > 10 ? $digits : 10;
    $digits = $digits - 10;
    if ((!$digits) || ($digits == 10)) {
        return getMillisecond();
    } else {
        return number_format(getMillisecond(true), $digits, '', '');
    }
}

function vv()
{
    $rare=30;
    $jj=rand(1, 10);
    var_dump($jj);
    var_dump($isContinue = $jj < $rare / 10);
}

function getMillisecond() {
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}
function PC_jiesuan($game)
{
    select_query("fn_pcorder", '*', array("status" => "未结算"));
    while ($con = db_fetch_array()) {
        $cons[] = $con;
    }
    foreach ($cons as $con) {
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];

        if ($game == 'jnd28') {
            $openType = 5;
            $game = '加拿大28';
            $jsdiy = get_query_val('fn_lottery' . $openType, 'jsdiy', array('roomid' => $roomid));
            if ($jsdiy == 1) continue;
        } else if ($game == 'xy28') {
            $openType = 4;
            $game = '新加坡28';
            $jsdiy = get_query_val('fn_lottery' . $openType, 'jsdiy', array('roomid' => $roomid));
            if ($jsdiy == 1) continue;
        } else if ($game == 'ny28') {
            $openType = 19;
            $game = '纽约28';
            $jsdiy = get_query_val('fn_lottery' . $openType, 'jsdiy', array('roomid' => $roomid));
            if ($jsdiy == 1) continue;
        }


        $zym_9 = (int)get_query_val('fn_pcorder', 'sum(`money`)', array('roomid' => $roomid, 'term' => $term, 'userid' => $user));

        $opencode = get_query_val('fn_open', 'code', "`term` = '$term' and `type` = '$openType'");

        if ($opencode == "") {
            continue;
        }

        $codes = explode(',', $opencode);
        if (count($codes) < 15) {
            echo 'ERROR!';
            exit();
        } else {
            if ($openType == 4 || $openType == 19) {
                $number1 = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5];
                $number2 = (int)$codes[6] + (int)$codes[7] + (int)$codes[8] + (int)$codes[9] + (int)$codes[10] + (int)$codes[11];
                $number3 = (int)$codes[12] + (int)$codes[13] + (int)$codes[14] + (int)$codes[15] + (int)$codes[16] + (int)$codes[17];
                $number1 = substr($number1, -1);
                $number2 = substr($number2, -1);
                $number3 = substr($number3, -1);
                $hz = (int)$number1 + (int)$number2 + (int)$number3;
            } elseif ($openType == 5) {
                $number1 = (int)$codes[1] + (int)$codes[4] + (int)$codes[7] + (int)$codes[10] + (int)$codes[13] + (int)$codes[16];
                $number2 = (int)$codes[2] + (int)$codes[5] + (int)$codes[8] + (int)$codes[11] + (int)$codes[14] + (int)$codes[17];
                $number3 = (int)$codes[3] + (int)$codes[6] + (int)$codes[9] + (int)$codes[12] + (int)$codes[15] + (int)$codes[18];
                $number1 = substr($number1, -1);
                $number2 = substr($number2, -1);
                $number3 = substr($number3, -1);
                $hz = (int)$number1 + (int)$number2 + (int)$number3;
            }
        }
        if ($number1 == $number2 && $number2 == $number3) {
            $zym_10 = true;
        }
        if ($number1 == $number2 || $number2 == $number3 || $number1 == $number3) {
            if (!$zym_10) {
                $zym_6 = true;
            }
        }
        if ($number1 + 1 == $number2 && $number2 + 1 == $number3 || $number1 - 1 == $number2 && $number2 - 1 == $number3) {
            $zym_5 = true;
        }
        if ($zym_8 == '大' || $zym_8 == '小' || $zym_8 == '单' || $zym_8 == '双') {
            $peilv = get_query_val('fn_lottery' . $openType, 'dxds', "`roomid` = '$roomid'");
            if ($hz == 13 || $hz == 14) {
                $dxds_zongzhu1 = get_query_val('fn_lottery' . $openType, 'dxds_zongzhu1', array('roomid' => $roomid));
                $dxds_zongzhu2 = get_query_val('fn_lottery' . $openType, 'dxds_zongzhu2', array('roomid' => $roomid));
                $dxds_zongzhu3 = get_query_val('fn_lottery' . $openType, 'dxds_zongzhu3', array('roomid' => $roomid));
                $dxds_1314_1 = get_query_val('fn_lottery' . $openType, 'dxds_1314_1', array('roomid' => $roomid));
                $dxds_1314_2 = get_query_val('fn_lottery' . $openType, 'dxds_1314_2', array('roomid' => $roomid));
                $dxds_1314_3 = get_query_val('fn_lottery' . $openType, 'dxds_1314_3', array('roomid' => $roomid));
                if ($dxds_zongzhu1 != "") {
                    if ($zym_9 > (int)$dxds_zongzhu1) {
                        $peilv = $dxds_1314_1;
                    }
                }
                if ($dxds_zongzhu2 != "") {
                    if ($zym_9 > (int)$dxds_zongzhu2) {
                        $peilv = $dxds_1314_2;
                    }
                }
                if ($dxds_zongzhu3 != "") {
                    if ($zym_9 > (int)$dxds_zongzhu3) {
                        $peilv = $dxds_1314_3;
                    }
                }
            }
            if ($zym_8 == '大' && $hz > 13) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '小' && $hz < 14) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '单' && $hz % 2 != 0) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '双' && $hz % 2 == 0) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if ($zym_8 == '极大' || $zym_8 == '极小') {
            if ($zym_8 == '极大' && $hz > 21) {
                $peilv = get_query_val('fn_lottery' . $openType, 'jida', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '极小' && $hz < 6) {
                $peilv = get_query_val('fn_lottery' . $openType, 'jixiao', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if ($zym_8 == '大单' || $zym_8 == '大双' || $zym_8 == '小单' || $zym_8 == '小双') {
            if ($zym_8 == '大单' && $hz > 13 && $hz % 2 != 0) {
                $peilv = get_query_val('fn_lottery' . $openType, 'dadan', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '小单' && $hz < 14 && $hz % 2 != 0) {
                $peilv = get_query_val('fn_lottery' . $openType, 'xiaodan', "`roomid` = '$roomid'");
                if ($hz == 13) {
                    $zuhe_zongzhu1 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu1', array('roomid' => $roomid));
                    $zuhe_zongzhu2 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu2', array('roomid' => $roomid));
                    $zuhe_zongzhu3 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu3', array('roomid' => $roomid));
                    $zuhe_1314_1 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_1', array('roomid' => $roomid));
                    $zuhe_1314_2 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_2', array('roomid' => $roomid));
                    $zuhe_1314_3 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_3', array('roomid' => $roomid));
                    if ($zuhe_zongzhu1 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu1) {
                            $peilv = $zuhe_1314_1;
                        }
                    }
                    if ($zuhe_zongzhu2 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu2) {
                            $peilv = $zuhe_1314_2;
                        }
                    }
                    if ($zuhe_zongzhu3 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu3) {
                            $peilv = $zuhe_1314_3;
                        }
                    }
                }
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '大双' && $hz > 13 && $hz % 2 == 0) {
                $peilv = get_query_val('fn_lottery' . $openType, 'dashuang', "`roomid` = '$roomid'");
                if ($hz == 14) {
                    $zuhe_zongzhu1 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu1', array('roomid' => $roomid));
                    $zuhe_zongzhu2 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu2', array('roomid' => $roomid));
                    $zuhe_zongzhu3 = get_query_val('fn_lottery' . $openType, 'zuhe_zongzhu3', array('roomid' => $roomid));
                    $zuhe_1314_1 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_1', array('roomid' => $roomid));
                    $zuhe_1314_2 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_2', array('roomid' => $roomid));
                    $zuhe_1314_3 = get_query_val('fn_lottery' . $openType, 'zuhe_1314_3', array('roomid' => $roomid));
                    if ($zuhe_zongzhu1 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu1) {
                            $peilv = $zuhe_1314_1;
                        }
                    }
                    if ($zuhe_zongzhu2 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu2) {
                            $peilv = $zuhe_1314_2;
                        }
                    }
                    if ($zuhe_zongzhu3 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu3) {
                            $peilv = $zuhe_1314_3;
                        }
                    }
                }
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '小双' && $hz < 14 && $hz % 2 == 0) {
                $peilv = get_query_val('fn_lottery' . $openType, 'xiaoshuang', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if ($zym_8 == '豹子' || $zym_8 == '对子' || $zym_8 == '顺子') {
            if ($zym_8 == '豹子' && $zym_10 == true) {
                $peilv = get_query_val('fn_lottery' . $openType, 'baozi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '对子' && $zym_6 == true) {
                $peilv = get_query_val('fn_lottery' . $openType, 'duizi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '顺子' && $zym_5 == true) {
                $peilv = get_query_val('fn_lottery' . $openType, 'shunzi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        if ((int)$zym_8 == $hz) {
            if ($hz == 0 || $hz == 27) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0027`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 1 || $hz == 26) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0126`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 2 || $hz == 25) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0225`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 3 || $hz == 24) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0324`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 4 || $hz == 23) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0423`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 5 || $hz == 22) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0522`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 6 || $hz == 21) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0621`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 7 || $hz == 20) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0720`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 8 || $hz == 9 || $hz == 18 || $hz == 19) {
                $peilv = get_query_val('fn_lottery' . $openType, '`891819`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                echo $peilv . '<br>';
                echo $zym_7 . '<br>';
                echo $peilv * $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 10 || $hz == 11 || $hz == 16 || $hz == 17) {
                $peilv = get_query_val('fn_lottery' . $openType, '`10111617`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 12 || $hz == 15) {
                $peilv = get_query_val('fn_lottery' . $openType, '`1215`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 13 || $hz == 14) {
                $peilv = get_query_val('fn_lottery' . $openType, '`1314`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        } else {
            $zym_11 = '-' . $zym_7;
            update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
            continue;
        }
    }
}

function PC_jiesuan222($game)
{
    $time=getMillisecond();

    select_query("fn_pcorder", '*', array("status" => "未结算"));
    while ($con = db_fetch_array()) {
        $cons[] = $con;
    }
    foreach ($cons as $con) {
        $id = $con['id'];
        $roomid = $con['roomid'];
        $user = $con['userid'];
        $term = $con['term'];
        $zym_8 = $con['content'];
        $zym_7 = $con['money'];

        if ($game == 'jnd28') {
            $openType = 5;
            $game = '加拿大28';
            $jsdiy = get_query_val('fn_lottery' . $openType, 'jsdiy', array('roomid' => $roomid));
            if ($jsdiy == 1) continue;
        } else if ($game == 'xy28') {
            $openType = 4;
            $game = '新加坡28';
            $jsdiy = get_query_val('fn_lottery' . $openType, 'jsdiy', array('roomid' => $roomid));
            if ($jsdiy == 1) continue;
        } else if ($game == 'ny28') {
            $openType = 19;
            $game = '纽约28';
            $jsdiy = get_query_val('fn_lottery' . $openType, 'jsdiy', array('roomid' => $roomid));
            if ($jsdiy == 1) continue;
        }

        echo "使用时间111:".(getMillisecond()-$time)."<br>";
        $time=getMillisecond();

        $lotteryData = get_query_vals('fn_lottery' . $openType, '*', "`roomid` = '$roomid' limit 1");

        echo "使用时间bbbb:".(getMillisecond()-$time)."<br>";
        $time=getMillisecond();

        $timeaaa=getMillisecond();
        $zym_9 = (int)get_query_val('fn_pcorder', 'sum(`money`)', array('roomid' => $roomid, 'term' => $term, 'userid' => $user));
        echo "使用时间aaaa:".(getMillisecond()-$timeaaa)."term=$term user=$user"."<br>";

        $opencode = get_query_val('fn_open', 'code', "`term` = '$term' and `type` = '$openType'");

        echo "使用时间vvvvv:".(getMillisecond()-$time)."<br>";
        $time=getMillisecond();

        if ($opencode == "") {
            continue;
        }
        echo "使用时间222:".(getMillisecond()-$time)."<br>";
        $time=getMillisecond();

        $codes = explode(',', $opencode);
        if (count($codes) < 15) {
            echo 'ERROR!';
            exit();
        } else {
            if ($openType == 4 || $openType == 19) {
                $number1 = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5];
                $number2 = (int)$codes[6] + (int)$codes[7] + (int)$codes[8] + (int)$codes[9] + (int)$codes[10] + (int)$codes[11];
                $number3 = (int)$codes[12] + (int)$codes[13] + (int)$codes[14] + (int)$codes[15] + (int)$codes[16] + (int)$codes[17];
                $number1 = substr($number1, -1);
                $number2 = substr($number2, -1);
                $number3 = substr($number3, -1);
                $hz = (int)$number1 + (int)$number2 + (int)$number3;
            } elseif ($openType == 5) {
                $number1 = (int)$codes[1] + (int)$codes[4] + (int)$codes[7] + (int)$codes[10] + (int)$codes[13] + (int)$codes[16];
                $number2 = (int)$codes[2] + (int)$codes[5] + (int)$codes[8] + (int)$codes[11] + (int)$codes[14] + (int)$codes[17];
                $number3 = (int)$codes[3] + (int)$codes[6] + (int)$codes[9] + (int)$codes[12] + (int)$codes[15] + (int)$codes[18];
                $number1 = substr($number1, -1);
                $number2 = substr($number2, -1);
                $number3 = substr($number3, -1);
                $hz = (int)$number1 + (int)$number2 + (int)$number3;
            }
        }
        if ($number1 == $number2 && $number2 == $number3) {
            $zym_10 = true;
        }
        if ($number1 == $number2 || $number2 == $number3 || $number1 == $number3) {
            if (!$zym_10) {
                $zym_6 = true;
            }
        }
        if ($number1 + 1 == $number2 && $number2 + 1 == $number3 || $number1 - 1 == $number2 && $number2 - 1 == $number3) {
            $zym_5 = true;
        }
        echo "使用时间333:".(getMillisecond()-$time)."<br>";
        $time=getMillisecond();

        if ($zym_8 == '大' || $zym_8 == '小' || $zym_8 == '单' || $zym_8 == '双') {
            $peilv = $lotteryData['dxds'];
            if ($hz == 13 || $hz == 14) {
                $dxds_zongzhu1 = $lotteryData['dxds_zongzhu1'];
                $dxds_zongzhu2 =$lotteryData['dxds_zongzhu2'];
                $dxds_zongzhu3 = $lotteryData['dxds_zongzhu3'];
                $dxds_1314_1 = $lotteryData['dxds_1314_1'];
                $dxds_1314_2 = $lotteryData['dxds_1314_2'];
                $dxds_1314_3 = $lotteryData['dxds_1314_3'];
                if ($dxds_zongzhu1 != "") {
                    if ($zym_9 > (int)$dxds_zongzhu1) {
                        $peilv = $dxds_1314_1;
                    }
                }
                if ($dxds_zongzhu2 != "") {
                    if ($zym_9 > (int)$dxds_zongzhu2) {
                        $peilv = $dxds_1314_2;
                    }
                }
                if ($dxds_zongzhu3 != "") {
                    if ($zym_9 > (int)$dxds_zongzhu3) {
                        $peilv = $dxds_1314_3;
                    }
                }
            }
            if ($zym_8 == '大' && $hz > 13) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '小' && $hz < 14) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '单' && $hz % 2 != 0) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '双' && $hz % 2 == 0) {
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        echo "使用时间444:".(getMillisecond()-$time)."<br>";
        if ($zym_8 == '极大' || $zym_8 == '极小') {
            if ($zym_8 == '极大' && $hz > 21) {
                $peilv = get_query_val('fn_lottery' . $openType, 'jida', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '极小' && $hz < 6) {
                $peilv = get_query_val('fn_lottery' . $openType, 'jixiao', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        echo "使用时间555:".(getMillisecond()-$time)."<br>";
        if ($zym_8 == '大单' || $zym_8 == '大双' || $zym_8 == '小单' || $zym_8 == '小双') {
            if ($zym_8 == '大单' && $hz > 13 && $hz % 2 != 0) {
                $peilv = get_query_val('fn_lottery' . $openType, 'dadan', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '小单' && $hz < 14 && $hz % 2 != 0) {
                $peilv = $lotteryData['xiaodan'];
                if ($hz == 13) {
                    $zuhe_zongzhu1 = $lotteryData['zuhe_zongzhu1'];
                    $zuhe_zongzhu2 =$lotteryData['zuhe_zongzhu2'];
                    $zuhe_zongzhu3 = $lotteryData['zuhe_zongzhu3'];
                    $zuhe_1314_1 = $lotteryData['zuhe_1314_1'];
                    $zuhe_1314_2 = $lotteryData['zuhe_1314_2'];
                    $zuhe_1314_3 =$lotteryData['zuhe_1314_3'];
                    if ($zuhe_zongzhu1 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu1) {
                            $peilv = $zuhe_1314_1;
                        }
                    }
                    if ($zuhe_zongzhu2 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu2) {
                            $peilv = $zuhe_1314_2;
                        }
                    }
                    if ($zuhe_zongzhu3 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu3) {
                            $peilv = $zuhe_1314_3;
                        }
                    }
                }
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '大双' && $hz > 13 && $hz % 2 == 0) {
                $peilv = $lotteryData['dashuang'];
                if ($hz == 14) {
                    $zuhe_zongzhu1 = $lotteryData['zuhe_zongzhu1'];
                    $zuhe_zongzhu2 = $lotteryData['zuhe_zongzhu2'];
                    $zuhe_zongzhu3 = $lotteryData['zuhe_zongzhu3'];
                    $zuhe_1314_1 = $lotteryData['zuhe_1314_1'];
                    $zuhe_1314_2 = $lotteryData['zuhe_1314_2'];
                    $zuhe_1314_3 = $lotteryData['zuhe_1314_3'];
                    if ($zuhe_zongzhu1 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu1) {
                            $peilv = $zuhe_1314_1;
                        }
                    }
                    if ($zuhe_zongzhu2 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu2) {
                            $peilv = $zuhe_1314_2;
                        }
                    }
                    if ($zuhe_zongzhu3 != "") {
                        if ($zym_9 > (int)$zuhe_zongzhu3) {
                            $peilv = $zuhe_1314_3;
                        }
                    }
                }
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '小双' && $hz < 14 && $hz % 2 == 0) {
                $peilv = get_query_val('fn_lottery' . $openType, 'xiaoshuang', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        echo "使用时间666:".(getMillisecond()-$time)."<br>";
        if ($zym_8 == '豹子' || $zym_8 == '对子' || $zym_8 == '顺子') {
            if ($zym_8 == '豹子' && $zym_10 == true) {
                $peilv = get_query_val('fn_lottery' . $openType, 'baozi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '对子' && $zym_6 == true) {
                $peilv = get_query_val('fn_lottery' . $openType, 'duizi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($zym_8 == '顺子' && $zym_5 == true) {
                $peilv = get_query_val('fn_lottery' . $openType, 'shunzi', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        }
        echo "使用时间777:".(getMillisecond()-$time)."<br>";
        if ((int)$zym_8 == $hz) {
            if ($hz == 0 || $hz == 27) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0027`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 1 || $hz == 26) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0126`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 2 || $hz == 25) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0225`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 3 || $hz == 24) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0324`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 4 || $hz == 23) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0423`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 5 || $hz == 22) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0522`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 6 || $hz == 21) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0621`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 7 || $hz == 20) {
                $peilv = get_query_val('fn_lottery' . $openType, '`0720`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 8 || $hz == 9 || $hz == 18 || $hz == 19) {
                $peilv = get_query_val('fn_lottery' . $openType, '`891819`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                echo $peilv . '<br>';
                echo $zym_7 . '<br>';
                echo $peilv * $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 10 || $hz == 11 || $hz == 16 || $hz == 17) {
                $peilv = get_query_val('fn_lottery' . $openType, '`10111617`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 12 || $hz == 15) {
                $peilv = get_query_val('fn_lottery' . $openType, '`1215`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } elseif ($hz == 13 || $hz == 14) {
                $peilv = get_query_val('fn_lottery' . $openType, '`1314`', "`roomid` = '$roomid'");
                $zym_11 = $peilv * (int)$zym_7;
                用户_上分($user, $zym_11, $roomid, $game, $term, $zym_8 . '/' . $zym_7);
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            } else {
                $zym_11 = '-' . $zym_7;
                update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
                continue;
            }
        } else {
            $zym_11 = '-' . $zym_7;
            update_query("fn_pcorder", array("status" => $zym_11), array('id' => $id));
            continue;
        }
        echo "使用时间888:".(getMillisecond()-$time)."<br>";
    }
}
?>