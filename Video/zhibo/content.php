<?php
/**
* 
*/
class Index
{
	
	public function curl_get($url,&$httpCode = 0){
	    $ch = curl_init();
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

	    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);

	    $file_contents = curl_exec($ch);
	    $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

	    curl_close($ch);
	    return $file_contents;
	}
}
$index = new Index();
$res = $index->curl_get('https://www.14jh.com/player.php?type=m');
$end_str = str_replace(array("chat(",")"),"",$res);
echo $end_str;

