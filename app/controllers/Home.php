<?php

use App\Core\Controller;

class Home extends Controller
{
    public function __construct()
    {
        session_start();

        if ($_SESSION['role'] === 'user') {
            return;
        } else {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Utama';
        $this->view('layout/header', $data);
        $this->view('home/index');
        $this->view('layout/footer');
    }

    public function dashboard_user()
    {
        $data['title'] = 'Dasbor User';
        $this->view('layout/user_header', $data);
        $this->view('home/dashboard_user');
        $this->view('layout/user_footer');
    }
    
    public function tes_seleksi()
    {
        $data['title'] = 'Tes Seleksi';
        $this->view('layout/user_header', $data);
        $this->view('home/tes_seleksi');
        $this->view('layout/user_footer');
    }
    
    public function edit_profile()
    {
        $data['title'] = 'Edit Profil';
        $this->view('layout/user_header', $data);
        $this->view('home/edit_profile');
        $this->view('layout/user_footer');
    }
}
