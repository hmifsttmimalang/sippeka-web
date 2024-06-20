<?php

class Login extends Controller {
    public function index()
    {
        $data['title'] = 'Pages / Login';
        $this->view('layout/admin-header', $data);
        $this->view('login/index');
        $this->view('layout/admin-footer');
    }
}