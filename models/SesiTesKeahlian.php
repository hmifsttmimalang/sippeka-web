<?php

class SesiTesKeahlian
{
    private $pdo;
    const SELEKSI = 'Seleksi';
    const SIMULASI = 'Simulasi';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($nama_sesi, $tes_keahlian_id, $waktu_mulai, $waktu_selesai, $jenis_sesi)
    {
        $this->validateJenisSesi($jenis_sesi);

        $stmt = $this->pdo->prepare('INSERT INTO sesi_tes_keahlian (nama_sesi, tes_keahlian_id, waktu_mulai, waktu_selesai, jenis_sesi) VALUES (?, ?, ?, ?, ?)');
        if ($stmt->execute([$nama_sesi, $tes_keahlian_id, $waktu_mulai, $waktu_selesai, $jenis_sesi])) {
            return true;
        }

        // Log error jika terjadi
        error_log('Create Error: ' . print_r($stmt->errorInfo(), true));
        return false;
    }

    public function update($id, $nama_sesi, $tes_keahlian_id, $waktu_mulai, $waktu_selesai, $jenis_sesi)
    {
        $this->validateJenisSesi($jenis_sesi);

        $stmt = $this->pdo->prepare('UPDATE sesi_tes_keahlian SET nama_sesi = ?, tes_keahlian_id = ?, waktu_mulai = ?, waktu_selesai = ?, jenis_sesi = ? WHERE id = ?');
        if ($stmt->execute([$nama_sesi, $tes_keahlian_id, $waktu_mulai, $waktu_selesai, $jenis_sesi, $id])) {
            return true;
        }

        // Log error jika terjadi
        error_log('Update Error: ' . print_r($stmt->errorInfo(), true));
        return false;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM sesi_tes_keahlian');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM sesi_tes_keahlian WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM sesi_tes_keahlian WHERE id = ?');
        if ($stmt->execute([$id])) {
            return true;
        }

        // Log error jika terjadi
        error_log('Delete Error: ' . print_r($stmt->errorInfo(), true));
        return false;
    }

    private function validateJenisSesi($jenis_sesi)
    {
        $validJenisSesi = [
            self::SELEKSI,
            self::SIMULASI,
        ];

        if (!in_array($jenis_sesi, $validJenisSesi)) {
            throw new InvalidArgumentException('Jenis sesi tidak dikenal!');
        }
    }

    public function getSoalBySesiId($sesiId)
    {
        $stmt = $this->pdo->prepare('
            SELECT s.* 
            FROM soal s
            INNER JOIN tes_keahlian t ON s.tes_keahlian_id = t.id
            INNER JOIN sesi_tes_keahlian sk ON t.id = sk.tes_keahlian_id
            WHERE sk.id = ?
        ');
        $stmt->execute([$sesiId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
