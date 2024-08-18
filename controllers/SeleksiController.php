<?php

require_once 'models/Soal.php';
require_once 'models/Pendaftaran.php';

class SeleksiController
{
    private $soal;
    private $pendaftaran;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }

        global $pdo;

        $this->soal = new Soal($pdo);
        $this->pendaftaran = new Pendaftar($pdo);

        // Check if the user has registered
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if (!$pendaftaran) {
            header('Location: /pendaftaran');
            exit;
        }
    }

    public function simulasi()
    {
        if ($this->isAjaxRequest()) {
            // Menerima data yang dikirim melalui AJAX
            $userAnswers = isset($_POST['userAnswers']) ? json_decode($_POST['userAnswers'], true) : [];
            if (json_last_error() === JSON_ERROR_NONE) {
                $_SESSION['userAnswers'] = $userAnswers;
            } else {
                echo "Error decoding JSON: " . json_last_error_msg();
                exit;
            }
        } else {
            // Memproses data dari POST jika ada
            if (isset($_POST['userAnswers'])) {
                $userAnswers = json_decode($_POST['userAnswers'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $_SESSION['userAnswers'] = $userAnswers;
                } else {
                    echo "Error decoding JSON: " . json_last_error_msg();
                    exit;
                }
            }

            // Mengambil data soal dari model
            $questions = $this->soal->getAll();

            // Menampilkan halaman simulasi
            include 'views/layout/simulasi_header.php';
            include 'views/tes_seleksi/tes_simulasi_peserta.php';
            include 'views/layout/simulasi_footer.php';
        }
    }


    public function hasilSimulasi()
    {
        if ($this->isAjaxRequest()) {
            $userAnswers = $_POST['userAnswers'] ?? [];
            $questions = $this->soal->getAll();
            $score = $this->calculateScore($userAnswers, $questions);
            $scorePercentage = ($score / count($questions)) * 100;

            $response = ['scorePercentage' => $scorePercentage];
            header('Content-Type: application/json');
            echo json_encode($response);
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

            // Pass the variables to the view
            $data = [
                'userAnswers' => $userAnswers,
                'questions' => $questions,
                'score' => $score,
                'scorePercentage' => $scorePercentage,
            ];

            include 'views/layout/simulasi_header.php';
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

    public function tesSeleksi()
    {
        include 'views/layout/tes_header.php';
        include 'views/tes_seleksi/tes_seleksi_peserta.php';
        include 'views/layout/tes_footer.php';
    }
}
