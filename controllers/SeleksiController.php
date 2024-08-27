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
        $this->pendaftaran = new Pendaftaran($pdo);

        // Check if the user has registered
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
