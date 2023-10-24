<?php 
//echo file_get_contents('http://www.1391c.com/xyft/ajax?ajaxhandler=GetXyftAwardData');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include_once('../../../../Public/config.php');
date_default_timezone_set("Asia/Shanghai");
    function getTimestamp($digits = false) {  
        $digits = $digits > 10 ? $digits : 10;  
        $digits = $digits - 10;
        if ((!$digits) || ($digits == 10))  
        {  
            return time();  
        }  
        else  
        {  
            return number_format(microtime(true),$digits,'','');  
        }  
    }  
$type = '6';
$roomid = $_SESSION['roomid'];
$kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
$pre_open = get_query_vals('fn_sopen', '*', "`type` = '$type' and `roomid` = '$roomid'order by `term` desc limit 1");
if($kong == '1' && $pre_open ){
$json = get_query_vals('fn_sopen', '*', "`type` = '$type' and `roomid` = '$roomid'order by `term` desc limit 1");
  $aa = $json['code'];
  $term = $json['term'];
  $opentime = $json['opentime'];
  $next_term = $json['next_term'];
  $next_time = $json['next_time'];
}else{
$json = get_query_vals('fn_open', '*', "`type` = '$type' order by `term` desc limit 1");
   $aa = $json['code'];
  $term = $json['term'];
  $opentime = $json['time'];
  $next_term = $json['next_term'];
  $next_time = $json['next_time'];
}


$arr = explode(",",$aa);
$opencode.= (int)$arr[0].",";
$opencode.= (int)$arr[1].",";
$opencode.= (int)$arr[2].",";
$opencode.= (int)$arr[3].",";
$opencode.= (int)$arr[4].",";
$opencode.= (int)$arr[5].",";
$opencode.= (int)$arr[6].",";
$opencode.= (int)$arr[7].",";
$opencode.= (int)$arr[8].",";
$opencode.= (int)$arr[9];

$IntervalTimeMs=strtotime($next_time)."000";
$IntervalTimeMs = $IntervalTimeMs - getTimestamp(13);
$periodNumber1 = (int)$term;
$periodNumber2 = (int)$next_term;

echo "
{
	\"time\":".getTimestamp(13).",
	\"current\":{
		\"periodNumber\":" . $periodNumber1 . ",
		\"awardTime\":\"" . $opentime . "\",
		\"awardNumbers\":\"". $opencode ."\"
	},\"next\":{
		\"periodNumber\":".$periodNumber2.",
		\"awardTime\":\"". $next_time ."\",
		\"awardTimeInterval\": ". $IntervalTimeMs  .",
		\"delayTimeInterval\":-6
	}
}

";

?>