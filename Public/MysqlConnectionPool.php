<?php

class MysqlConnectionPool
{
    private $pool;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->pool = new SplQueue();
    }

    public function initConnections($size)
    {
        for ($i = 0; $i < $size; $i++) {
            $conn = new PDO(
                $this->config['dsn'],
                $this->config['username'],
                $this->config['password'],
                array(PDO::ATTR_PERSISTENT => true)
            );
            $this->pool->enqueue($conn);
        }
    }

    public function getConnection()
    {
        if ($this->pool->isEmpty()) {
            $conn = new PDO(
                $this->config['dsn'],
                $this->config['username'],
                $this->config['password'],
                array(PDO::ATTR_PERSISTENT => true)
            );
            return $conn;
        } else {
            return $this->pool->dequeue();
        }
    }

    public function releaseConnection($conn)
    {
        $this->pool->enqueue($conn);
    }
}