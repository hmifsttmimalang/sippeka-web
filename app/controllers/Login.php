<?php

class Login extends Controller {
    public function index()
    {
        $data['title'] = 'Pages / Login - NiceAdmin Bootstrap Template';
        $this->view('layout/admin-header', $data);
        $this->view('login/index');
        $this->view('layout/admin-footer');
    }
}