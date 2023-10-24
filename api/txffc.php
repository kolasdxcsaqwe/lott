<?php


function getcode($szUrl){
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $szUrl);
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
$data = curl_exec($curl); 
return $data;
exit();
}

$url = 'http://www.off0.com/';
$data = getcode($url);
preg_match("/<table class=\"gridview\">([\s\S]*?)<\/table>/isU",$data,$nei);
preg_match_all("/<tr>(.*?)<\/tr>/U",$nei[1],$nei1);
preg_match_all("/<td>(.*?)<\/td>/i",$nei1[1][1],$nei2);
$term = str_replace('-','',$nei2[1][1]);
  
$opentime = $nei2[1][2];
$code = $nei2[1][4];
$next_time = date('Y-m-d H:i:s',strtotime($opentime) + 60);
$next_term = $term +1;  



$array['expect'] = $term;
$array['opencode'] = $code;
$array['opentime'] = $opentime;
$array['nexttime'] = $next_time;
$html['rows'] = 1;
$html['code'] = 'dm28';
$html['remain'] = 'QQ1878336950';
$html['data'] = $array;
header("Content-type:text/json;charset=utf-8");
echo json_encode($html);
