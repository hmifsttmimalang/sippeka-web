<?php

class Home extends Controller {
    public function index()
    {
        $data['title'] = 'Halaman Utama';
        $this->view('layout/header', $data);
        $this->view('home/index');
        $this->view('layout/footer');
    }
}