<?php
//继承Threaded类，Threaded提供了隐式的线程安全机制
//这个对象中的所有操作都是线程安全的
class MyWork extends Threaded {
    private $name = '';
    private $do = false;
    private $data = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public function run() {
        $this->data = "{$this->name} run... in thread [" . $this->worker->getName() . "] \r\n";
        //通过do来判断是否完成
        //如果为true，则让Pool::collect回收
        $this->do = true;
    }

    public function isDo() {
        return  $this->do;
    }

    public function getData() {
        return $this->data;
    }
}

class MyWorker extends Worker {
    public static $name = 0;

    public function __construct() {
        self::$name++;
    }

    public function run() {

    }

    public function getName() {
        return self::$name;
    }
}

$pool = new Pool(5, 'MyWorker');

$works = array();
for($ix = 0; $ix < 20; ++$ix) {
    $work = new MyWork($ix);
    $works[] = $work;
}

foreach($works as $work) {
    $pool->submit($work);
}
$pool->shutdown();

foreach($works as $work) {
    echo $work->getData();
}

//回收已完成的对象
$pool->collect(function($work){
    //我们通过自定义函数isDo来判断对象是否执行完毕
    return $work->isDo();
});