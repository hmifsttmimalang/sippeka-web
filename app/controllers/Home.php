<?php

use App\Core\Controller;

class Home extends Controller 
{

    public function __construct()
    {
        session_start();

        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'user') {
            return;
        } else {
            header('Location: '. MAIN_URL . 'auth/login');
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
}