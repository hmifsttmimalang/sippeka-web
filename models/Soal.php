<?php

require_once 'connection/database.php';

class Soal
{
    private $pdo;
    private $tes_keahlian_id;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar, $tes_keahlian_id)
    {
        $sql = "INSERT INTO soal (soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, jawaban_benar, tes_keahlian_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $soal,
            $pilihan_a,
            $pilihan_b,
            $pilihan_c,
            $pilihan_d,
            $pilihan_e,
            $jawaban_benar,
            $tes_keahlian_id
        ]);
    }

    public function get($id) 
    {
        $sql = "SELECT * FROM soal WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return false; // Jika tidak ada data, kembalikan false
        }

        return $result;

    }


    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM soal');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            $result['tes_keahlian_id'] = $result['tes_keahlian_id'];
        }
        return $results;
    }

    public function getSoalByTesKeahlianId($tes_keahlian_id)
    {
        $sql = "SELECT * FROM soal WHERE tes_keahlian_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tes_keahlian_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar, $tes_keahlian_id)
    {
        $sql = "UPDATE soal SET soal = ?, pilihan_a = ?, pilihan_b = ?, pilihan_c = ?, pilihan_d = ?, pilihan_e = ?, jawaban_benar = ?, tes_keahlian_id = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $soal,
            $pilihan_a,
            $pilihan_b,
            $pilihan_c,
            $pilihan_d,
            $pilihan_e,
            $jawaban_benar,
            $tes_keahlian_id,
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
