<?php

require_once 'connection/database.php';
require_once 'models/Pendaftaran.php';

class UserController
{
    private $pendaftaran;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }

        global $pdo;

        $this->pendaftaran = new Pendaftar($pdo);

        // Check if the user has registered
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if (!$pendaftaran) {
            header('Location: /pendaftaran');
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
