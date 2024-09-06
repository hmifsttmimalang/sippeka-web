<?php

class Soal
{
    private $pdo;
    private $tes_keahlian_id;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Metode untuk mengacak jawaban
    private function acakJawaban($soal)
    {
        // Buat array pilihan jawaban
        $pilihan = [
            'a' => $soal['pilihan_a'],
            'b' => $soal['pilihan_b'],
            'c' => $soal['pilihan_c'],
            'd' => $soal['pilihan_d'],
            'e' => $soal['pilihan_e']
        ];

        // Simpan jawaban yang benar sebelum diacak
        $jawabanAsli = $soal['jawaban_benar'];

        // Acak pilihan jawaban
        $keys = array_keys($pilihan);
        shuffle($keys);
        $acakPilihan = [];
        foreach ($keys as $key) {
            $acakPilihan[$key] = $pilihan[$key];
        }

        // Cari posisi baru untuk jawaban yang benar
        $soal['pilihan_a'] = $acakPilihan['a'];
        $soal['pilihan_b'] = $acakPilihan['b'];
        $soal['pilihan_c'] = $acakPilihan['c'];
        $soal['pilihan_d'] = $acakPilihan['d'];
        $soal['pilihan_e'] = $acakPilihan['e'];
        $soal['jawaban_benar'] = array_search($jawabanAsli, $acakPilihan); // Update posisi jawaban benar

        return $soal;
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

    // Gabungan method untuk mengacak soal dan jawaban
    public function getSoalByTesKeahlianId($tes_keahlian_id, $acak_soal = false, $acak_jawaban = false)
    {
        // SQL untuk mengambil soal, dengan opsi acak soal jika diaktifkan
        $sql = "SELECT * FROM soal WHERE tes_keahlian_id = ?";
        if ($acak_soal) {
            $sql .= " ORDER BY RAND()"; // Mengacak soal jika acak_soal diaktifkan
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tes_keahlian_id]);
        $soalList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Acak jawaban jika diaktifkan
        if ($acak_jawaban) {
            foreach ($soalList as &$soal) {
                $soal = $this->acakJawaban($soal);
            }
        }

        return $soalList;
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
