<?php
include dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php";
require "function.php";

date_default_timezone_set("PRC");

$time = getdate();


$mday = $time["mday"];
$mon = $time["mon"];
$year = $time["year"];


if($mon==4||$mon==6||$mon==9||$mon==11){
    $day = 30;
}elseif($mon==2){
    if(($year%4==0&&$year%100!=0)||$year%400==0){
        $day = 29;
    }else{
        $day = 28;
    }
}else{
    $day = 31;
}

$w = getdate(mktime(0,0,0,$mon,1,$year));//["wday"]
var_dump($w['wday']);