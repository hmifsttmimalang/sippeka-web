<?php

use App\Core\Database;

class User
{
    private $table = 'users';
    private $db;

    public function __construct(Database $db = null)
    {
        if ($db === null) {
            $db = Database::getInstance();
        }
        $this->db = $db;
    }

    public function register($username, $password)
    {
        $hashed_password = md5($password);
        $sql = 'INSERT INTO '. $this->table. ' (username, password) VALUES (:username, :password)';
        $this->db->query($sql);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $hashed_password);
        return $this->db->execute();
    }

    public function login($username, $password)
    {
        $hashed_password = md5($password);
        $sql = 'SELECT * FROM '. $this->table. ' WHERE username = :username AND password = :password';
        $this->db->query($sql);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $hashed_password);
        $this->db->execute();
        return $this->db->single();
    }
}