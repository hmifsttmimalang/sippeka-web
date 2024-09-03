<?php

class Keahlian
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM keahlian');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM keahlian WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdByName($name)
    {
        $stmt = $this->pdo->prepare('SELECT id FROM keahlian WHERE nama = ?');
        $stmt->execute([$name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null; // Kembalikan ID atau null jika tidak ditemukan
    }

    public function exists($id)
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM keahlian WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    public function create($nama)
    {
        $stmt = $this->pdo->prepare('INSERT INTO keahlian (nama) VALUES (?)');
        return $stmt->execute([$nama]);
    }

    public function update($id, $nama)
    {
        $stmt = $this->pdo->prepare('UPDATE keahlian SET nama = ? WHERE id = ?');
        return $stmt->execute([$nama, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM keahlian WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
