<?php

use App\Core\Controller;

class Registrasi extends Controller 
{
    private $userModel;
    private $registrationModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->registrationModel = $this->model('Registration');
    }

    public function index()
    {
        session_start();
        if (!isset($_SESSION['role']) && $_SESSION['role'] !== 'user') {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }

        $user_id = $_SESSION['user_id'];

        if ($this->registrationModel->hasRegistered($user_id)) {
            header('Location: ' . MAIN_URL . 'registrasi/terdaftar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $no_telepon = $_POST['no_telepon'];

            if ($this->registrationModel->createRegistration($user_id, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $no_telepon)) {
                header('Location: ' . MAIN_URL . 'registrasi/terdaftar');
                exit;
            } else {
                $data['title'] = 'Pendaftaran - SIPPEKA';
                $this->view('layout/form_header', $data);
                $this->view('registrasi/index', ['error' => 'Gagal menyimpan data']);
                $this->view('layout/form_footer');
                exit;
            }
        }

        $data['title'] = 'Pendaftaran - SIPPEKA';
        $this->view('layout/form_header', $data);
        $this->view('registrasi/index');
        $this->view('layout/form_footer');
    }
    
    public function terdaftar()
    {
        $data['title'] = 'Pendaftaran - SIPPEKA';
        $this->view('layout/form_header', $data);
        $this->view('registrasi/terdaftar', ['success' => 'Anda telah terdaftar']);
        $this->view('layout/form_footer');
    }
}