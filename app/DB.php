<?php

namespace App;

class DB
{
    private static ?\PDO $instance = null;

    public function __construct()
    {
        if (self::$instance === null) {
            return self::$instance = $this->initDB();
        }
        return self::$instance;
    }

    public function __call($name, $arguments) {
        return call_user_func_array([self::$instance, $name], $arguments);
    }

    public function getInstance()
    {
        return self::$instance;
    }

    public function initDB(): \PDO
    {
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            return new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}