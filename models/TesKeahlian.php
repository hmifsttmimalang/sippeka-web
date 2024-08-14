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
        $stmt = $this->pdo->query('SELECT * FROM tes_keahlian');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nama_tes, $mata_soal, $kelas, $acak_soal, $acak_jawaban, $durasi_menit)
    {
        $acak_soal = ($acak_soal == 'y') ? 1 : 0;
        $acak_jawaban = ($acak_jawaban == 'y') ? 1 : 0;

        $sql = "INSERT INTO tes_keahlian (nama_tes, mata_soal, kelas, acak_soal, acak_jawaban, durasi_menit) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $nama_tes,
            $mata_soal,
            $kelas,
            $acak_soal,
            $acak_jawaban,
            $durasi_menit
        ]);
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tes_keahlian WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nama_tes, $mata_soal, $kelas, $acak_soal, $acak_jawaban, $durasi_menit)
    {
        $acak_soal = ($acak_soal == 'y') ? 1 : 0;
        $acak_jawaban = ($acak_jawaban == 'y') ? 1 : 0;

        $sql = "UPDATE tes_keahlian SET nama_tes = ?, mata_soal = ?, kelas = ?, acak_soal = ?, acak_jawaban = ?, durasi_menit = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $nama_tes,
            $mata_soal,
            $kelas,
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
