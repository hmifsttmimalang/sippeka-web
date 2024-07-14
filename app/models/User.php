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

    public function register($data)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $this->db->query($sql);
        $this->db->bind(':username', $data['username']);
        $result = $this->db->single();

        if ($result) {
            return false;
        }

        $sql = "INSERT INTO " . $this->table . " (nama, username, email, password, role) VALUES (:nama, :username, :email, :password, 'user')";
        $this->db->query($sql);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', md5($data['password']));
        return $this->db->execute();
    }

    public function login($username, $password)
    {
        $hashed_password = md5($password);
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE username = :username AND password = :password';
        $this->db->query($sql);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $hashed_password);
        $this->db->execute();
        return $this->db->single();
    }
}
