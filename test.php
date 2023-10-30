<?
include_once("./Public/config.php");
$withdrawTime=get_query_val('fn_upmark','time',array('userid' => 'oWNAL0tlmHRQSisrrn2iciSfRXy4'));

static $timeRecord;
$timeRecord[$_GET['q']]=$_GET['q'];
var_dump(json_encode($timeRecord));

?>