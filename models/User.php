<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        if ($this->pdo === null) {
            die('PDO instance is null');
        }
    }

    public function register($username, $email, $password, $role = 'user')
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ]);
    }

    public function login($identifier, $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :identifier OR email = :identifier');
        $stmt->execute(['identifier' => $identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUsersByRole($role)
    {
        $stmt = $this->pdo->prepare('SELECT username, email, is_registered FROM users WHERE role = :role');
        $stmt->execute(['role' => $role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmailUserById($id) 
    {
        $stmt = $this->pdo->prepare('SELECT email FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsernameById($id) 
    {
        $stmt = $this->pdo->prepare('SELECT username FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
