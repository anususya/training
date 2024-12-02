<?php

class DB
{
    private const HOST = "192.168.2.8";
    private const  USERNAME = "admin";
    private const  PASSWORD = "admin";
    private const  DATABASE = "test";
    private const  PORT = "5432";

    private static $instance = null;
    private $pdo = null;

    public static function getConnection()
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public static function closeConnection()
    {
        self::$instance->pdo = null;
    }

    public function insert($table, $data)
    {
        if (!$this->pdo) {
            throw Exception('Connection not established');
        }

        $query = 'INSERT INTO ' . $table . ' (';
        foreach ($data as $key => $value) {
            $query .= $key . ',';
        }
        $query = substr($query, 0, -1);
        $query .= ') VALUES (';
        foreach ($data as $key => $value) {
            $query .= ':' . $key . ',';
        }
        $query = substr($query, 0, -1);
        $query .= ');';

        $statement = $this->pdo->prepare($query);
        $statement->execute($data);
    }

    public function getMaxValue($table, $column)
    {
        if (!$this->pdo) {
            throw new Exception('Connection not established');
        }
        $statement = $this->pdo->prepare('SELECT MAX(' . $column . ') FROM ' . $table);
        $statement->execute();

        return $statement->fetchColumn();
    }

    private function __construct()
    {
        try {
            $dsn = 'pgsql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE . ';';
            // make a database connection
            $this->pdo = new PDO($dsn, self::USERNAME, self::PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}
