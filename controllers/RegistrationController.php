<?php

require_once 'models/Keahlian.php';
require_once 'connection/database.php';

class RegistrationController 
{
    protected $keahlian;

    public function __construct()
    {
        global $pdo;

        $this->keahlian = new Keahlian($pdo);
    }

    public function index()
    {
        $keahlianList = $this->keahlian->getAll();
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