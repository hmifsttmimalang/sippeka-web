<?php

require_once 'connection/database.php';
require_once 'models/Pendaftaran.php';
require_once 'models/User.php';

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

        $this->pendaftaran = new Pendaftar($pdo);
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
        include 'views/layout/user_header.php';
        include 'views/user/dashboard_user.php';
        include 'views/layout/user_footer.php';
    }
    
    public function showSeleksi()
    {
        include 'views/user/tes_seleksi.php';
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

        include 'views/user/edit_profil.php';
    }
}
