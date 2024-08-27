<?php

require_once 'connection/database.php';

class TesKeahlian
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = 'SELECT tes_keahlian.*, keahlian.nama AS keahlian_nama
                FROM tes_keahlian
                LEFT JOIN keahlian ON tes_keahlian.keahlian_id = keahlian.id';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama_tes, $mata_soal, $keahlian_id, $acak_soal, $acak_jawaban, $durasi_menit)
    {
        $acak_soal = ($acak_soal == 'y') ? 1 : 0;
        $acak_jawaban = ($acak_jawaban == 'y') ? 1 : 0;

        $sql = "INSERT INTO tes_keahlian (nama_tes, mata_soal, keahlian_id, acak_soal, acak_jawaban, durasi_menit) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $nama_tes,
            $mata_soal,
            $keahlian_id,
            $acak_soal,
            $acak_jawaban,
            $durasi_menit,
        ]);
    }

    public function get($id)
    {
        $sql = 'SELECT tes_keahlian.*, keahlian.nama AS keahlian_nama
                FROM tes_keahlian
                LEFT JOIN keahlian ON tes_keahlian.keahlian_id = keahlian.id
                WHERE tes_keahlian.id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nama_tes, $mata_soal, $acak_soal, $acak_jawaban, $durasi_menit, $keahlian_id)
    {
        $acak_soal = ($acak_soal == 'y') ? 1 : 0;
        $acak_jawaban = ($acak_jawaban == 'y') ? 1 : 0;

        $sql = "UPDATE tes_keahlian SET nama_tes = ?, mata_soal = ?, keahlian_id = ?, acak_soal = ?, acak_jawaban = ?, durasi_menit = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $nama_tes,
            $mata_soal,
            $keahlian_id,
            $acak_soal,
            $acak_jawaban,
            $durasi_menit,
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tes_keahlian WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
