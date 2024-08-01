<?php

class AdminController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        include 'views/admin/dashboard_admin.php';
    }

    public function kelolaData()
    {
        include 'views/admin/kelola_data.php';
    }

    public function peserta()
    {
        include 'views/admin/peserta.php';
    }

    public function infoUser()
    {
        include 'views/admin/info_user.php';
    }

    // halaman soal keahlian

    public function soalKeahlian()
    {

    }

    public function TambahSoalKeahlian()
    {

    }

    public function UbahSoalKeahlian()
    {

    }

    public function HapusSoalKeahlian()
    {

    }

    // kelas keahlian
    public function kelasKeahlian()
    {

    }

    // tes keahlian
    public function tesKeahlian()
    {

    }

    // sesi keahlian
    public function sesiKeahlian()
    {

    }
}
