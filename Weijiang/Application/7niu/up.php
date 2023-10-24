<?php
include("autoload.php");
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;



$bucket = 'g5ll';
$accessKey = 'VPRZbvhwNIXz1myinifXbdQZY3gRBJeDlFdZwSwh';
$secretKey = 'ReyVdXK8_0LW1fWJDT9CZOFsOtXIUOsVN7Cr4kbh';

$expires = 6000;
$auth = new Auth($accessKey, $secretKey);


$policy = array(
    //'callbackUrl' => 'http://micuer.com/qiniuyun/examples/upload_verify_callback.php',
    'callbackBody' => 'key=$(key)&hash=$(etag)&bucket=$(bucket)&fsize=$(fsize)&name=$(x:name)',
    'callbackBodyType' => 'application/json'
);
$token = $auth->uploadToken($bucket, null, $expires, $policy, true);
// 构建 UploadManager 对象
$uploadMgr = new UploadManager();

