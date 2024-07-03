<?php

use App\Core\Controller;

class Anggota extends Controller {
    public function index()
    {
        $data['title'] = 'Anggota';
        $this->view('layout/admin_header', $data);
        $this->view('anggota/index');
        $this->view('layout/admin_footer');
    }
}