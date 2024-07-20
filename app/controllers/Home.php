<?php

use App\Core\Controller;

class Home extends Controller
{
<<<<<<< HEAD
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

=======
>>>>>>> dev
    public function index()
    {
        session_start();
        $data['title'] = 'Halaman Utama';
        $this->view('layout/header', $data);
        $this->view('home/index');
        $this->view('layout/footer');
    }

    public function dashboard_user()
    {
        session_start();

        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'user') {
            $data['title'] = 'Dasbor User';
            $this->view('layout/user_header', $data);
            $this->view('home/dashboard_user');
            $this->view('layout/user_footer');
        } else {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }
    }
    
    public function tes_seleksi()
    {
        session_start();

        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'user') {
            $data['title'] = 'Tes Seleksi';
            $this->view('layout/user_header', $data);
            $this->view('home/tes_seleksi');
            $this->view('layout/user_footer');
        } else {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }
    }
    
    public function edit_profile()
    {
        session_start();

        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'user') {
            $data['title'] = 'Edit Profil';
            $this->view('layout/user_header', $data);
            $this->view('home/edit_profile');
            $this->view('layout/user_footer');
        } else {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }
    }
}
