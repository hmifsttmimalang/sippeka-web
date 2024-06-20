<?php

class Register extends Controller {
    public function index()
    {
        $data['title'] = 'Register';
        $this->view('layout/admin-header', $data);
        $this->view('register/index');
        $this->view('layout/admin-footer');
    }
}