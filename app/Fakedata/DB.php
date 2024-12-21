<?php

namespace Fakedata;

use Exception;
use PDO as PDO;
use PDOException as PDOException;
class DB
{
    private const HOST = "192.168.2.8";
    private const USERNAME = "admin";
    private const PASSWORD = "admin";
    private const DATABASE = "test";
    private const PORT = "5432";

    private static ?DB $instance = null;
    private ?PDO $pdo = null;

    public static function getConnection(): ?DB
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public static function closeConnection(): void
    {
        self::$instance->pdo = null;
    }

    /**
     * @throws Exception
     */
    public function insert($table, $data): void
    {
        if (!$this->pdo) {
            throw new Exception('Connection not established');
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

    /**
     * @throws Exception
     */
    public function getMaxValue($table, $column): ?int
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
