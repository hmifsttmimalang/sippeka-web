<?php

require_once 'connection/database.php';

class Pendaftar 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;   
    }

    public function create($data) 
    {
        $stmt = $this->pdo->prepare('INSERT INTO pendaftar (nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, telepon, keahlian_id, foto_ktp, foto_ijazah, foto_bg_biru, foto_kk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['nama'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['jenis_kelamin'],
            $data['agama'],
            $data['alamat'],
            $data['telepon'],
            $data['keahlian_id'],
            $data['foto_ktp'],
            $data['foto_ijazah'],
            $data['foto_bg_biru'],
            $data['foto_kk']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getAll() {
        $stmt = $this->pdo->prepare('SELECT * FROM pendaftar');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM pendaftar WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}