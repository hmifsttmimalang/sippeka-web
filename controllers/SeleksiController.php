<?php

require_once 'models/Soal.php';
require_once 'models/Pendaftaran.php';
require_once 'models/SesiTesKeahlian.php';

class SeleksiController
{
    private $soal;
    private $pendaftaran;
    private $sesiTesKeahlian;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }

        global $pdo;

        $this->soal = new Soal($pdo);
        $this->pendaftaran = new Pendaftaran($pdo);
        $this->sesiTesKeahlian = new SesiTesKeahlian($pdo);

        // memeriksa apabila user belum terdaftar akan diarahkan ke halaman pendaftaran
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if (!$pendaftaran) {
            header('Location: /pendaftaran');
            exit;
        }
    }

    public function simulasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->isAjaxRequest()) {
            $userAnswers = isset($_POST['userAnswers']) ? $_POST['userAnswers'] : [];

            if ($userAnswers) {
                $userAnswers = json_decode($userAnswers, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $_SESSION['userAnswers'] = $userAnswers;
                    echo json_encode(['status' => 'success']);
                    exit;
                } else {
                    echo json_encode(['status' => 'error', 'message' => json_last_error_msg()]);
                    exit;
                }
            }

            echo json_encode(['status' => 'error', 'message' => 'No user answers provided']);
            exit;
        } else {
            // Inisialisasi userAnswers jika belum ada
            if (!isset($_SESSION['userAnswers'])) {
                $_SESSION['userAnswers'] = [];
            }

            $ongoingSeleksi = $this->getActiveSesi('Seleksi');

            // Jika ada sesi seleksi aktif, batasi soal simulasi
            if ($ongoingSeleksi && $this->isSesiAktif($ongoingSeleksi)) {
                echo "Simulasi tidak tersedia saat sesi seleksi berlangsung.";
                exit;
            }

            if (isset($_POST['userAnswers'])) {
                $userAnswers = json_decode($_POST['userAnswers'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $_SESSION['userAnswers'] = $userAnswers;
                } else {
                    echo "Error decoding JSON: " . json_last_error_msg();
                    exit;
                }
            }

            $questions = $this->soal->getAll();

            include 'views/layout/simulasi_header.php';
            include 'views/tes_seleksi/tes_simulasi_peserta.php';
            include 'views/layout/simulasi_footer.php';
        }
    }

    public function hasilSimulasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->isAjaxRequest()) {
            $userAnswers = isset($_POST['userAnswers']) ? $_POST['userAnswers'] : [];
            $userAnswers = json_decode($userAnswers, true);
            $questions = $this->soal->getAll();
            $score = $this->calculateScore($userAnswers, $questions);
            $scorePercentage = ($score / count($questions)) * 100;

            echo json_encode([
                'score' => $score,
                'scorePercentage' => $scorePercentage
            ]);
            exit;
        } else {
            $userAnswers = $_SESSION['userAnswers'] ?? [];
            if (empty($userAnswers)) {
                echo "Tidak ada jawaban yang disimpan di session.";
                exit;
            }

            $questions = $this->soal->getAll();
            $score = $this->calculateScore($userAnswers, $questions);
            $scorePercentage = ($score / count($questions)) * 100;

            include 'views/layout/hasil_simulasi_header.php';
            include 'views/tes_seleksi/hasil_simulasi.php';
            include 'views/layout/simulasi_footer.php';
        }
    }

    private function calculateScore($userAnswers, $questions)
    {
        $score = 0;
        foreach ($questions as $question) {
            if (isset($userAnswers[$question['id']])) {
                $userAnswer = $userAnswers[$question['id']];
                if (is_array($userAnswer) && in_array($question['jawaban_benar'], $userAnswer)) {
                    $score++;
                }
            }
        }
        return $score;
    }

    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    private function getActiveSesi($jenisSesi)
    {
        $sesiList = $this->sesiTesKeahlian->getAll();
        foreach ($sesiList as $sesi) {
            if ($sesi['jenis_sesi'] === $jenisSesi && $this->isSesiAktif($sesi)) {
                return $sesi;
            }
        }
        return null;
    }

    private function isSesiAktif($sesi)
    {
        $now = new DateTime();
        $waktuMulai = new DateTime($sesi['waktu_mulai']);
        $waktuSelesai = new DateTime($sesi['waktu_selesai']);
        return $now >= $waktuMulai && $now <= $waktuSelesai;
    }

    public function tesSeleksi()
    {
        // Dapatkan sesi seleksi aktif
        $activeSesi = $this->getActiveSesi('Seleksi');

        if (!$activeSesi) {
            echo "Tidak ada sesi seleksi yang aktif saat ini.";
            exit;
        }

        // Cek apakah sesi masih aktif berdasarkan waktu
        if (!$this->isSesiAktif($activeSesi)) {
            echo "Sesi seleksi sudah berakhir.";
            exit;
        }

        // Ambil soal berdasarkan keahlian peserta dan sesi seleksi
        $soal = $this->sesiTesKeahlian->getSoalBySesiId($activeSesi['id']);

        include 'views/layout/tes_header.php';
        include 'views/tes_seleksi/tes_seleksi_peserta.php';
        include 'views/layout/tes_footer.php';
    }
}
