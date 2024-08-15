<?php

require_once 'connection/database.php';

class MataSoal 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll() 
    {
        $stmt = $this->pdo->query('SELECT * FROM mata_soal');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama) 
    {
        $stmt = $this->pdo->prepare('INSERT INTO mata_soal (nama) VALUES (?)');
        return $stmt->execute([$nama]);
    }

    public function get($id) 
    {
        $stmt = $this->pdo->prepare('SELECT * FROM mata_soal WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nama) 
    {
        $stmt = $this->pdo->prepare('UPDATE mata_soal SET nama = ? WHERE id = ?');
        return $stmt->execute([$nama, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM mata_soal WHERE id = ?');
        return $stmt->execute([$id]);
    }
}