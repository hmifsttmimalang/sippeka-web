<?php

class Anggota extends Controller {
    public function index()
    {
        $data['title'] = 'Anggota - NiceAdmin Bootstrap Template';
        $this->view('layout/admin-header', $data);
        $this->view('anggota/index');
        $this->view('layout/admin-footer');
    }
}