<?php
//继承Threaded类，Threaded提供了隐式的线程安全机制
$redis = new Redis();
try {
    $redis->connect('127.0.0.1', 6379);
    $redis->set("sadsad", "123");
    echo $redis->time();
} catch (RedisException $e) {
    echo $e->getMessage();
}


