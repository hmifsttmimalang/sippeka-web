<?php

use App\Core\Controller;

class Register extends Controller {
    public function index()
    {
        $data['title'] = 'Register';
        $this->view('layout/auth_header', $data);
        $this->view('register/index');
        $this->view('layout/auth_footer');
    }
}