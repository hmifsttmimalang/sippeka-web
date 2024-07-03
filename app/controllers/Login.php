<?php

use App\Core\Controller;

class Login extends Controller {
    public function index()
    {
        $data['title'] = 'Pages / Login';
        $this->view('layout/auth_header', $data);
        $this->view('login/index');
        $this->view('layout/auth_footer');
    }
}