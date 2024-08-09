<?php

require_once 'connection/database.php';

class Pendaftar
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data, $user_id)
    {
        $stmt = $this->pdo->prepare('INSERT INTO pendaftar (user_id, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, telepon, keahlian, foto_ktp, foto_ijazah, foto_bg_biru, foto_kk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $user_id,
            $data['nama'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['jenis_kelamin'],
            $data['agama'],
            $data['alamat'],
            $data['telepon'],
            $data['keahlian'],
            $data['foto_ktp'],
            $data['foto_ijazah'],
            $data['foto_bg_biru'],
            $data['foto_kk']
        ]);

        $this->updateUserRegistrationStatus($user_id);

        return $this->pdo->lastInsertId();
    }

    private function updateUserRegistrationStatus($user_id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET is_registered = 1 WHERE id = ?");
        $stmt->execute([$user_id]);
    }

    public function getAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pendaftar');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pendaftar WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUserId($user_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pendaftar WHERE user_id = ?');
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
