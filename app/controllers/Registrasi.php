<?php

use App\Core\Controller;

class Registrasi extends Controller 
{
    public function index()
    {
        $data['title'] = 'Pendaftaran - SIPPEKA';
        $this->view('layout/form_header', $data);
        $this->view('registrasi/index');
        $this->view('layout/form_footer');
    }   
}