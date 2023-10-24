<?php
$url='http://www.luckyairship.com/api/getwiningnumbers.ashx';
$content=curl_file_get_contents($url);
$a = strpos($content,'{');
$b = strpos($content,'}');
$data = substr($content,$a,$b);
echo $data;
function curl_file_get_contents($durl){ 
  $cookie_file = dirname(__FILE__)."/cookie.txt"; 
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $durl); 
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_redir_exec($ch);
  $r = curl_exec($ch); 
  curl_close($ch); 
  return $r; 
}

function curl_redir_exec($ch,$debug=""){
static $curl_loops = 0;
static $curl_max_loops = 20;
if ($curl_loops++ >= $curl_max_loops)
{
$curl_loops = 0;
return FALSE;
}
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
$debbbb = $data;
list($header, $data) = explode("\n\n", $data, 2);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($http_code == 301 || $http_code == 302) {
$matches = array();
preg_match('/Location:(.*?)\n/', $header, $matches);
$url = @parse_url(trim(array_pop($matches)));
if (!$url)
{
$curl_loops = 0;
return $data;
}
$last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
$new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query'] ? '?'.$url['query'] : '');
curl_setopt($ch, CURLOPT_URL, $new_url);
return curl_redir_exec($ch);
} else {
$curl_loops=0;
return $debbbb;
}
}
