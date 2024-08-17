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
        if (!$this->validateTanggalLahir($data['tanggal_lahir'])) {
            // Handle the error
            return false;
        }

        $stmt = $this->pdo->prepare('INSERT INTO pendaftar (user_id, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, telepon, keahlian, foto_ktp, foto_ijazah, foto_bg_biru, foto_kk, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
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

        $this->updateUserRegistrationStatus($user_id, 1);

        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        if (!$this->validateTanggalLahir($data['tanggal_lahir'])) {
            // Handle the error
            return false;
        }

        $columns = [];
        $values = [];
        foreach ($data as $column => $value) {
            $columns[] = "$column = ?";
            $values[] = $value;
        }
        $columns_str = implode(', ', $columns);
        $stmt = $this->pdo->prepare("UPDATE pendaftar SET $columns_str WHERE id = ?");
        $values[] = $id;
        $stmt->execute($values);

        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM pendaftar WHERE id = ?');
        $stmt->execute([$id]);

        $user_id = $this->get($id)['user_id'];
        $this->updateUserRegistrationStatus($user_id, 0);
    }

    private function updateUserRegistrationStatus($user_id, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET is_registered = ? WHERE id = ?");
        $stmt->execute([$status, $user_id]);
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

    public function getNewRegistrations()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pendaftar WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validateTanggalLahir($tanggal_lahir)
    {
        $dateOfBirth = new DateTime($tanggal_lahir);
        $today = new DateTime();
        $age = $today->diff($dateOfBirth)->y;

        if ($age < 17 || $age >= 40) {
            throw new Exception(' Anda harus berusia minimal 17 tahun dan maksimal 40 tahun untuk mendaftar.');
            return false;
        }

        return true;
    }
}
