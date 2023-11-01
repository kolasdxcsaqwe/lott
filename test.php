<?
include_once("./Public/config.php");
$withdrawTime=get_query_val('fn_upmark','time',array('userid' => 'oWNAL0tlmHRQSisrrn2iciSfRXy4'));


$i='3594215';
$i2='3593218';

$ii=(int)$i;
$ii2=(int)$i2;

$o=$ii>$ii2;

echo getTimestamp(13);

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