<?php

class Register extends Controller {
    public function index()
    {
        $data['title'] = 'Register';
        $this->view('layout/login-layout', $data);
        $this->view('register/index');
        $this->view('layout/admin-footer');
    }
}