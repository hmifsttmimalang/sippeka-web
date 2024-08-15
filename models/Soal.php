<?php

require_once 'connection/database.php';

class Soal
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar)
    {
        $sql = "INSERT INTO soal (soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, jawaban_benar) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $soal,
            $pilihan_a,
            $pilihan_b,
            $pilihan_c,
            $pilihan_d,
            $pilihan_e,
            $jawaban_benar
        ]);
    }

    public function get($id) 
    {
        $sql = "SELECT * FROM soal WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() 
    {
        $stmt = $this->pdo->query('SELECT * FROM soal');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar) 
    {
        $sql = "UPDATE soal SET soal = ?, pilihan_a = ?, pilihan_b = ?, pilihan_c = ?, pilihan_d = ?, pilihan_e = ?, jawaban_benar = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $soal,
            $pilihan_a,
            $pilihan_b,
            $pilihan_c,
            $pilihan_d,
            $pilihan_e,
            $jawaban_benar,
            $id
        ]);
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM soal WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}