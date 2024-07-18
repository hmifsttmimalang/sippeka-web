<?php

use App\Core\Controller;

class Home extends Controller 
{
    public function index()
    {
        session_start();
        $data['title'] = 'Halaman Utama';
        $this->view('layout/header', $data);
        $this->view('home/index');
        $this->view('layout/footer');
    }
}