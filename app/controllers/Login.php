<?php

class Login extends Controller {
    public function index()
    {
        $data['title'] = 'Pages / Login';
        $this->view('layout/login-layout', $data);
        $this->view('login/index');
        $this->view('layout/admin-footer');
    }
}