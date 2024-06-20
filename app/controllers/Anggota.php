<?php

class Anggota extends Controller {
    public function index()
    {
        $data['title'] = 'Anggota';
        $this->view('layout/admin-header', $data);
        $this->view('anggota/index');
        $this->view('layout/admin-footer');
    }
}