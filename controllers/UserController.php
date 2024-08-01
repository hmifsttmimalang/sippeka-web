<?php

class UserController 
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        include 'views/user/dashboard_user.php';
    }

    public function showSeleksi()
    {
        include 'views/user/tes_seleksi.php';
    }

    public function editProfil()
    {
        include 'views/user/edit_profil.php';
    }
}