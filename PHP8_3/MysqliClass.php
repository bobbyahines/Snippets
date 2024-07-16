<?php

use \mysqli_connect

class Database
{

    protected mysqli_connect $connect;
  
    public function __construct(string $host, string $user, string $name, int $port)
    {

        $this->connect = $this->connect($host, $user, $name, $port)      
    }

    protected function connect(): mysqli_connect
    {

        try {
            $connect = \mysqli_connect($host, $user, $pass, $name, $port);
            if ($connect->connect_error) {
                throw new \Error($connect->connect_errno , ': ' . $connect->connect_error);
            }
        } catch (\Error $error) {
            echo $error->getMessage() . PHP_EOL;
            echo $error->getTraceAsString() . PHP_EOL;
            die();
        }

        return $connect;
    }
  
    public function preparedQuery(string $sql, string $types, array $params): array
    {
        
        try {
            $preparedQuery = $this->connection->prepare($sql);
            if (!$preparedQuery) {
                throw new \Error($this->connection->error);
            }
        } catch (\Error $e) {
            echo $e->getMessage();die();
        }

        $preparedQuery->bind_param($types, ...$params);
        $preparedQuery->execute();
        
        $result = $preparedQuery->get_result();

        $preparedQuery->close();
        $connection->close();

        $numRows =  mysqli_num_rows($result);
        if ($numRows > 1) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result->fetch_assoc();
    }
}
