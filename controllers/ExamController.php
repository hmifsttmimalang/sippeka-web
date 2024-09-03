<?php

class ExamController
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
            $user_id = $_SESSION['user_id'];

            $keahlianPeserta = $this->pendaftaran->getKeahlianByUserId($user_id);

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

            $tes_keahlian_id = $keahlianPeserta['tes_keahlian_id'] ?? null;

            if (!$keahlianPeserta || !isset($keahlianPeserta['tes_keahlian_id'])) {
                echo "Tes keahlian tidak ditemukan untuk pengguna ini.";
                exit;
            }

            $questions = $this->soal->getSoalByTesKeahlianId($tes_keahlian_id);

            if (empty($questions)) {
                echo 'Soal tidak tersedia saat ini!';
                exit;
            }

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
            $user_id = $_SESSION['user_id'] ?? [];

            $keahlianData = $this->pendaftaran->getKeahlianByUserId($user_id);

            if (empty($userAnswers)) {
                echo "Tidak ada jawaban yang disimpan di session.";
                exit;
            }

            $tes_keahlian_id = $keahlianData['tes_keahlian_id'] ?? null;

            if (!$keahlianData || !isset($keahlianData['tes_keahlian_id'])) {
                echo "Tes keahlian tidak ditemukan untuk pengguna ini.";
                exit;
            }

            $questions = $this->soal->getSoalByTesKeahlianId($tes_keahlian_id);

            if (empty($questions)) {
                header('Location: /user');
                exit;
            }

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
    }

    private function isSesiAktif($sesi)
    {
        $timezone = new DateTimeZone('Asia/Jakarta'); // Atur timezone yang sesuai
        $now = new DateTime('now', $timezone); // Waktu sekarang dengan timezone yang sesuai
        $waktuMulai = new DateTime($sesi['waktu_mulai'], $timezone); // Waktu mulai sesi dengan timezone
        $waktuSelesai = new DateTime($sesi['waktu_selesai'], $timezone); // Waktu selesai sesi dengan timezone

        // Hitung sisa waktu dalam detik
        $remainingSeconds = $waktuSelesai->getTimestamp() - $now->getTimestamp();

        // Periksa apakah sesi aktif
        if ($now >= $waktuMulai && $now <= $waktuSelesai) {
            return $remainingSeconds; // Kembalikan sisa waktu dalam detik
        }

        return 0; // Jika sesi tidak aktif, kembalikan 0 detik
    }

    public function tesSeleksi()
    {
        $user_id = $_SESSION['user_id'];

        // Cek apakah user sudah pernah mengirim jawaban sebelumnya
        $existingScore = $this->pendaftaran->getNilaiTesKeahlian($user_id);

        if ($existingScore !== null) {
            // Jika user sudah mengerjakan, tampilkan pesan atau arahkan ke halaman lain
            header('Location: /tes_selesai');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->isAjaxRequest()) {
            $userAnswers = isset($_POST['userAnswers']) ? $_POST['userAnswers'] : [];

            $keahlianPeserta = $this->pendaftaran->getKeahlianByUserId($user_id);
            $tes_keahlian_id = $keahlianPeserta['tes_keahlian_id'] ?? null;

            if ($userAnswers) {
                $userAnswers = json_decode($userAnswers, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $questions = $this->soal->getSoalByTesKeahlianId($tes_keahlian_id);
                    $score = $this->calculateScore($userAnswers, $questions);
                    $scorePercentage = ($score / count($questions)) * 100;

                    // Simpan jawaban pengguna di sesi
                    $_SESSION['userAnswers'] = $userAnswers;

                    // Simpan nilai jawaban ke database
                    $this->pendaftaran->saveTesKeahlian($user_id, $scorePercentage);

                    echo json_encode([
                        'status' => 'success',
                        'score' => $score,
                        'scorePercentage' => $scorePercentage
                    ]);
                    exit;
                } else {
                    echo json_encode(['status' => 'error', 'message' => json_last_error_msg()]);
                    exit;
                }
            }

            echo json_encode(['status' => 'error', 'message' => 'No user answers provided']);
            exit;
        } else {
            // Dapatkan sesi seleksi aktif
            $activeSesi = $this->getActiveSesi('Seleksi');

            if (!$activeSesi) {
                echo "Tidak ada sesi seleksi yang aktif saat ini.";
                exit;
            }

            // Cek apakah sesi masih aktif berdasarkan waktu
            $remainingSeconds = $this->isSesiAktif($activeSesi);

            if ($remainingSeconds <= 0) {
                echo "Sesi seleksi sudah berakhir.";
                exit;
            }

            // Ambil data peserta untuk mendapatkan keahlian yang dipilih
            $keahlianPeserta = $this->pendaftaran->getKeahlianByUserId($user_id);

            // Inisialisasi userAnswers jika belum ada
            if (!isset($_SESSION['userAnswers'])) {
                $_SESSION['userAnswers'] = [];
            }

            $tes_keahlian_id = $keahlianPeserta['tes_keahlian_id'] ?? null;

            if (!$keahlianPeserta || !isset($keahlianPeserta['tes_keahlian_id'])) {
                echo "Tes keahlian tidak ditemukan untuk pengguna ini.";
                exit;
            }

            // Ambil soal berdasarkan keahlian peserta
            $questions = $this->soal->getSoalByTesKeahlianId($tes_keahlian_id);

            if (empty($questions)) {
                echo "Tidak ada soal untuk keahlian ini.";
                exit;
            }

            // Kirim sisa waktu sesi ke tampilan
            include 'views/layout/tes_header.php';
            include 'views/tes_seleksi/tes_seleksi_peserta.php';
            include 'views/layout/tes_footer.php';
        }
    }

    public function waktuHabis()
    {
        include 'views/tes_seleksi/waktu_habis.php';
    }

    public function waktuSimulasiHabis()
    {
        include 'views/tes_seleksi/waktu_simulasi_habis.php';
    }

    public function tesTerkirim()
    {
        include 'views/tes_seleksi/tes_terkirim.php';
    }

    public function tesSelesai()
    {
        include 'views/tes_seleksi/tes_selesai.php';
    }
}
