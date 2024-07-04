<?php

namespace App\Core;
use PDO;
use PDOException;

class Database
{
    private $type = DB_TYPE;
    private $host;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name;

    private $dbh;
    private $stmt;

    private static $instance = null;

    public function __construct()
    {
        switch ($this->type) {
            case 'mysql':
                $this->host = DB_HOST_MYSQL;
                $this->db_name = DB_NAME_MYSQL;
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
                break;
            case 'pgsql':
                $this->host = DB_HOST_PGSQL;
                $this->db_name = DB_NAME_PGSQL;
                $port = DB_PORT_PGSQL;
                $dsn = 'pgsql:host=' . $this->host . ';port=' . $port . ';dbname=' . $this->db_name;
                break;
            case 'sqlite':
                $this->db_name = DB_PATH_SQLITE;
                $dsn = 'sqlite:' . $this->db_name;
                break;
            default:
                throw new ("Jenis database yang digunakan tidak mendukung!");
                break;
        }

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $err) {
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
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
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
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
