<?php

use App\Core\Controller;

class Auth extends Controller 
{
    public function login()
    {
        $data['title'] = 'Login - SIPPEKA';
        $this->view('layout/auth_header', $data);
        $this->view('auth/login');
        $this->view('layout/auth_footer');
    }

    public function register()
    {
        $data['title'] = 'Register - SIPPEKA';
        $this->view('layout/auth_header', $data);
        $this->view('auth/register');
        $this->view('layout/auth_footer');
    }
}