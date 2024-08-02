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
        include 'views/admin/mata_keahlian/mata_soal_keahlian.php';
    }

    public function tambahSoalKeahlian()
    {
        include 'views/admin/mata_keahlian/tambah_mata_keahlian.php';
    }

    public function ubahSoalKeahlian()
    {
        include 'views/admin/mata_keahlian/edit_keahlian.php';
    }

    public function hapusSoalKeahlian()
    {

    }

    // kelas keahlian
    public function kelasKeahlian()
    {

    }

    public function TambahKelasKeahlian()
    {

    }

    public function ubahKelasKeahlian()
    {

    }

    public function hapusKelasKeahlian()
    {

    }

    // tes keahlian
    public function tesKeahlian()
    {

    }

    public function tambahTesKeahlian()
    {

    }

    public function ubahTesKeahlian()
    {

    }

    public function hapusTesKeahlian()
    {

    }

    // sesi keahlian
    public function sesiKeahlian()
    {

    }

    public function tambahSesiKeahlian()
    {

    }

    public function ubahSesiKeahlian()
    {

    }

    public function hapusSesiKeahlian()
    {

    }
}
