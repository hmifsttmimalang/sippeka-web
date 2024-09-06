<?php

class UserController
{
    private $pendaftaran;
    private $user;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }

        global $pdo;

        $this->pendaftaran = new Pendaftaran($pdo);
        $this->user = new User($pdo);

        // Check if the user has registered
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if (!$pendaftaran) {
            header('Location: /pendaftaran');
            exit;
        }
    }

    public function index()
    {
        $user = $this->user->getUserById($_SESSION['user']['id']);
        $pendaftar = $this->pendaftaran->getByUserId($_SESSION['user']['id']);

        // Hitung nilai rata-rata jika keduanya ada
        $nilai_keahlian = $pendaftar['nilai_keahlian'] ?? 0;
        $nilai_wawancara = $pendaftar['nilai_wawancara'] ?? 0;
        $rataRata = (is_null($pendaftar['nilai_keahlian']) || is_null($pendaftar['nilai_wawancara']))
            ? null
            : ($nilai_keahlian + $nilai_wawancara) / 2;

        // Tentukan status hasil seleksi
        $status = null;
        if ($rataRata !== null) {
            if ($rataRata >= 70 && $rataRata <= 100) {
                $status = 'lolos';
            } else {
                $status = 'tidak_lolos';
            }
        }

        // Kirim data ke view
        $data = [
            'pendaftar' => $pendaftar,
            'rataRata' => $rataRata,
            'status' => $status,
        ];

        include 'views/layout/user_header.php';
        include 'views/user/dashboard_user.php';
        include 'views/layout/user_footer.php';
    }

    public function showSeleksi()
    {
        $user = $this->user->getUserById($_SESSION['user']['id']);
        $pendaftar = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        include 'views/layout/user_header.php';
        include 'views/user/tes_seleksi.php';
        include 'views/layout/user_footer.php';
    }

    public function editProfil()
    {
        $user = $this->user->getUserById($_SESSION['user']['id']);
        $pendaftar = $this->pendaftaran->getByUserId($_SESSION['user']['id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];

            $data = [
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => $agama,
                'alamat' => $alamat,
                'telepon' => $telepon,
            ];

            $id = $pendaftar['id'];
            $this->pendaftaran->update($id, $data);

            // Redirect to the success page
            header('Location: /user');
            exit;
        }

        include 'views/layout/user_header.php';
        include 'views/user/edit_profil.php';
        include 'views/layout/user_footer.php';
    }
}
