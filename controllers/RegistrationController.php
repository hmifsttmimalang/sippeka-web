<?php

class RegistrationController 
{
    public function index()
    {
        include 'views/pendaftaran/form_registrasi.php';
    }

    public function register()
    {

    }
    
    public function registered()
    {
        include 'views/pendaftaran/terdaftar.php';
    }
}