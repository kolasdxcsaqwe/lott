<?php
include_once "../../../Public/config.php";
function getTimestamp($digits = false)
{
    $digits = $digits > 10 ? $digits : 10;
    $digits = $digits - 10;
    if ((!$digits) || ($digits == 10)) {
        return time();
    } else {
        return number_format(microtime(true), $digits, '', '');
    }
}

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");


if ($_COOKIE['game'] == 'xy28' || $_COOKIE['game'] == 'ny28') {
    $gametype = 'pc28a';

    if ($_COOKIE['game'] == 'xy28') {
        $data = get_query_vals('fn_open', '*', "type = 4 order by term desc limit 1");
    }

    if ($_COOKIE['game'] == 'ny28') {
        $data = get_query_vals('fn_open', '*', "type = 19 order by term desc limit 1");
    }

    $term = $data['term'];
    $time = $data['time'];
    $code = $data['code'];
    $codes = explode(',', $code);


    $number1 = (int)$codes[0] + (int)$codes[1] + (int)$codes[2] + (int)$codes[3] + (int)$codes[4] + (int)$codes[5];
    $number2 = (int)$codes[6] + (int)$codes[7] + (int)$codes[8] + (int)$codes[9] + (int)$codes[10] + (int)$codes[11];
    $number3 = (int)$codes[12] + (int)$codes[13] + (int)$codes[14] + (int)$codes[15] + (int)$codes[16] + (int)$codes[17];

    $number1 = substr($number1, -1);
    $number2 = substr($number2, -1);
    $number3 = substr($number3, -1);
    $hz = (int)$number1 + (int)$number2 + (int)$number3;


    $next_term = $data['next_term'];
    $next_time = $data['next_time'];
    $next_ss = ((int)strtotime($next_time) . '000') - getTimestamp(13);
    $next_game = $gametype;

    echo "
    {
       \"time\":" . getTimestamp(13) . ",
       \"current\": {
          \"game\":\"" . $gametype . "\",
          \"periodNumber\":\"" . $term . "\",
          \"awardTime\":\"" . $time . "\",
          \"awardNumbers\":\"" . $number1 . ',' . $number2 . ',' . $number3 . "\"
          },
          \"next\":{
              \"game\":\"" . $next_game . "\",
              \"periodNumber\":\"" . $next_term . "\",
              \"awardTime\":\"" . $next_time . "\",
              \"awardTimeInterval\":" . $next_ss . ",
              \"delayTimeInterval\": 0 
          }
      }

      ";
} else if ($_COOKIE['game'] == 'jnd28') {
    $gametype = 'pc28b';

    $data = get_query_vals('fn_open', '*', "type = 5 order by term desc limit 1");
    $term = $data['term'];
    $time = $data['time'];
    $code = $data['code'];
    $codes = explode(',', $code);

    $ntime = $data['next_time'];


    $nntime = str_replace("/", "-", "$ntime");
    if (strlen($nntime) > 11) {
        $next_times = $nntime;
    } else {
        $next_times = date("Y-m-d H:i:s", strtotime($time) + 210);
    }

    $codes = explode(',', $code);
    $number1 = (int)$codes[1] + (int)$codes[4] + (int)$codes[7] + (int)$codes[10] + (int)$codes[13] + (int)$codes[16];
    $number2 = (int)$codes[2] + (int)$codes[5] + (int)$codes[8] + (int)$codes[11] + (int)$codes[14] + (int)$codes[17];
    $number3 = (int)$codes[3] + (int)$codes[6] + (int)$codes[9] + (int)$codes[12] + (int)$codes[15] + (int)$codes[18];

    $number1 = substr($number1, -1);
    $number2 = substr($number2, -1);
    $number3 = substr($number3, -1);
    $hz = (int)$number1 + (int)$number2 + (int)$number3;

    $next_term = $data['next_term'];
    $next_ss = (int)strtotime($next_times) . '000' - getTimestamp(13);


    echo "
  {
   \"time\":" . getTimestamp(13) . ",
   \"current\": {
      \"game\":\"" . $gametype . "\",
      \"periodNumber\":\"" . $term . "\",
      \"awardTime\":\"" . $time . "\",
      \"awardNumbers\":\"" . $number1 . ',' . $number2 . ',' . $number3 . "\"
      },
      \"next\":{
          \"game\":\"" . $gametype . "\",
          \"periodNumber\":\"" . $next_term . "\",
          \"awardTime\":\"" . $next_times . "\",
          \"awardTimeInterval\":" . $next_ss . ",
          \"delayTimeInterval\": 0 
      }
  }

  ";
}


?>