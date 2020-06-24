<?php

class Database
{
    public function preparedQuery(string $sql, string $types, array $params): array
    {
        $host = '_SECRET_';
        $user = '_SECRET_';
        $name = '_SECRET_';
        $port = '_SECRET_';
    
        try {
            $connect = \mysqli_connect($host, $user, $pass, $name, $port);
            if ($connect->connect_error) {
                throw new \Error($connect->connect_errno , ': ' . $connect->connect_error);
            }
        } catch (\Error $error) {
            echo $error->getMessage();
            die();
        }
        
        try {
            $preparedQuery = $connection->prepare($sql);
            if (!$preparedQuery) {
                throw new \Error($connection->error);
            }
        } catch (\Error $e) {
            echo $e->getMessage();die();
        }

        if (strlen($types) === 1) {
            $preparedQuery->bind_param($types, $params[0]);
        } elseif (strlen($types) === 2) {
            $preparedQuery->bind_param($types, $params[0], $params[1]);
        } elseif (strlen($types) === 3) {
            $preparedQuery->bind_param($types, $params[0], $params[1], $params[2]);
        } elseif (strlen($types) === 4) {
            $preparedQuery->bind_param($types, $params[0], $params[1], $params[2], $params[3]);
        } elseif (strlen($types) === 5) {
            $preparedQuery->bind_param($types, $params[0], $params[1], $params[2], $params[3], $params[4]);
        }

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
