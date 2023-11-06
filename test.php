<?
include_once("./Public/config.php");
$withdrawTime=get_query_val('fn_upmark','time',array('userid' => 'oWNAL0tlmHRQSisrrn2iciSfRXy4'));


$arr=array();
$arr[]=array("sadsad"=>'3434');
$arr[]=array("sadsad"=>'324324');

$body=array();
$body['term']='324324dsfsdf';
$body['array']=$arr;

echo json_encode($body);

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

function vv()
{
    $rare=30;
    $jj=rand(1, 10);
    var_dump($jj);
    var_dump($isContinue = $jj < $rare / 10);
}

?>