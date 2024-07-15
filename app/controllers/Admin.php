<?php

use App\Core\Controller;

class Redirect extends Controller
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return;
        } else {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }
    }
}

class Admin extends Redirect
{
    public function dashboard()
    {
        Redirect::class;
        $data['title'] = 'Dashboard';
        $this->view('layout/admin_header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('layout/admin_footer');
    }
    
    public function kelola_data()
    {
        Redirect::class;
        $data['title'] = 'Kelola Data';
        $this->view('layout/admin_header', $data);
        $this->view('admin/kelola_data', $data);
        $this->view('layout/admin_footer');
    }

    public function peserta()
    {
        Redirect::class;
        $data['title'] = 'Peserta';
        $this->view('layout/admin_header', $data);
        $this->view('admin/peserta', $data);
        $this->view('layout/admin_footer');
    }
}
