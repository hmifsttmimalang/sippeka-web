<?php

namespace App\Core;

class Database
{
    // private $host = DB_HOST; // host ini diperlukan jika ingin menggunakan MySQL
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = __DIR__ . '/../database/data_sipekka.db';

    private $dbh;
    private $stmt;

    private static $instance = null;

    public function __construct()
    {
        /* konfigurasi MySQL

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $err) {
            die($err->getMessage());
        }
        
        */

        // konfigurasi SQLite

        $dsn = 'sqlite:' . $this->db_name;

        $option = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new \PDO($dsn, $this->user, $this->pass, $option);
        } catch (\PDOException $err) {
            die($err->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
