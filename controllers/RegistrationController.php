<?php

require_once 'models/Keahlian.php';
require_once 'models/Pendaftaran.php';
require_once 'connection/database.php';

class RegistrationController
{
    protected $keahlian;
    private $pendaftaran;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }

        global $pdo;

        $this->keahlian = new Keahlian($pdo);
        $this->pendaftaran = new Pendaftar($pdo);
    }

    public function index()
    {
        $keahlianList = $this->keahlian->getAll();

        // jika terdaftar maka akan dibatasi
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if ($pendaftaran) {
            header('Location: /pendaftaran/terdaftar');
            exit;
        }

        include 'views/layout/pendaftaran_header.php';
        include 'views/pendaftaran/form_registrasi.php';
        include 'views/layout/pendaftaran_footer.php';
    }

    public function register()
    {
        // Check if the user has already registered
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if ($pendaftaran) {
            header('Location: /user');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $keahlian = $_POST['keahlian'];

            $foto_ktp = $_FILES['foto_ktp'];
            $foto_ijazah = $_FILES['foto_ijazah'];
            $foto_bg_biru = $_FILES['foto_bg_biru'];
            $foto_kk = $_FILES['foto_kk'];

            // Validate uploaded files
            if (!isset($foto_ktp['tmp_name']) || !isset($foto_ijazah['tmp_name']) || !isset($foto_bg_biru['tmp_name']) || !isset($foto_kk['tmp_name'])) {
                // Handle error: no files uploaded
                echo 'Error: no files uploaded';
                exit;
            }

            function sanitize_string($str)
            {
                $str = preg_replace('/[^a-zA-Z0-9_-]/', '', $str);
                return $str;
            }

            // Create folder for uploaded files
            $folder_name = sanitize_string($_SESSION['user']['username']);
            $folder_path = 'assets/uploads/' . $folder_name;
            if (!is_dir($folder_path)) {
                mkdir($folder_path, 0777, true);
            }

            // Upload files
            try {
                $file_name_ktp = $nama . '_' . $tempat_lahir . '_' . $tanggal_lahir . '_ktp.' . pathinfo($foto_ktp['name'], PATHINFO_EXTENSION);
                $file_name_ijazah = $nama . '_' . $tempat_lahir . '_' . $tanggal_lahir . '_ijazah.' . pathinfo($foto_ijazah['name'], PATHINFO_EXTENSION);
                $file_name_bg_biru = $nama . '_' . $tempat_lahir . '_' . $tanggal_lahir . '_bg_biru.' . pathinfo($foto_bg_biru['name'], PATHINFO_EXTENSION);
                $file_name_kk = $nama . '_' . $tempat_lahir . '_' . $tanggal_lahir . '_kk.' . pathinfo($foto_kk['name'], PATHINFO_EXTENSION);

                move_uploaded_file($foto_ktp['tmp_name'], $folder_path . '/' . $file_name_ktp);
                move_uploaded_file($foto_ijazah['tmp_name'], $folder_path . '/' . $file_name_ijazah);
                move_uploaded_file($foto_bg_biru['tmp_name'], $folder_path . '/' . $file_name_bg_biru);
                move_uploaded_file($foto_kk['tmp_name'], $folder_path . '/' . $file_name_kk);
            } catch (Exception $e) {
                // Handle error: file upload failed
                echo 'Error: file upload failed';
                exit;
            }

            // Create new pendaftar
            $user_id = $_SESSION['user']['id'];
            $data = [
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => $agama,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'keahlian' => $keahlian,
                'foto_ktp' => $file_name_ktp,
                'foto_ijazah' => $file_name_ijazah,
                'foto_bg_biru' => $file_name_bg_biru,
                'foto_kk' => $file_name_kk
            ];
            $this->pendaftaran->create($data, $user_id);

            // Redirect to success page
            header('Location: /pendaftaran/terdaftar');
            exit;
        }
    }

    public function registered()
    {
        include 'views/layout/pendaftaran_header.php';
        include 'views/pendaftaran/terdaftar.php';
        include 'views/layout/pendaftaran_footer.php';
    }
}
