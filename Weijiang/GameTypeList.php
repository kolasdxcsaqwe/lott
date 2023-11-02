<?php

$array['sjws'] = '随机位数';
$array['sjtm'] = '随机特码';
$array['sjsm'] = '随机双面';
$array['sjlh'] = '随机龙虎';
$array['smdds'] = '随机大单双';
$array['sjxds'] = '随机小单双';
$array['sjsz'] = '随机数字';
$array['sjts'] = '随机特殊';
$array['sjhz'] = '随机和值';
$array['sjlhpt'] = '随机六合平特';
$array['sjlhhs'] = '随机六合号数';
$array['sjlhbs'] = '随机六合波色';
$array['sjlhdx'] = '随机六合单肖';
$array['sjkstx'] = '随机快三通选';
$array['sjkssj'] = '随机快三三军';
$array['sjksbz'] = '随机快三豹子';
$array['sjksdz'] = '随机快三对子';
$array['sjkssz'] = '随机快三三杂';
$array['sjksez'] = '随机快三二杂';

$array['money1'] = '随机金额1';
$array['money2'] = '随机金额2';
$array['money3'] = '随机金额3';

function getValue($key) {
    global $array;
    return $array[$key];
}

function formatJson($content)
{

    if(is_null($content) || empty($content))
    {
        return $content;
    }

    $jsonArray=json_decode($content);
    if(count($jsonArray)<1)
    {
        return $content;
    }

    $str="";

    for ($i = 0; $i < count($jsonArray); $i++) {
        $text="[".getValue($jsonArray[$i]->gameType).":".getValue($jsonArray[$i]->moneyType)."]  ";
        $str=$str.$text;
    }
    return $str;
}

function decodeUnicode($str)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}