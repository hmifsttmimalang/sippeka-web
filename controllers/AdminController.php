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
        include 'views/admin/kelas_keahlian/kelas_keahlian.php';
    }

    public function tambahKelasKeahlian()
    {
        include 'views/admin/kelas_keahlian/tambah_kelas_keahlian.php';
    }
    
    public function ubahKelasKeahlian()
    {
        include 'views/admin/kelas_keahlian/edit_kelas_keahlian.php';
    }

    public function hapusKelasKeahlian()
    {

    }

    // tes keahlian
    public function tesKeahlian()
    {
        include 'views/admin/tes_keahlian/tes_keahlian.php';
    }

    public function tambahTesKeahlian()
    {
        include 'views/admin/tes_keahlian/tambah_soal_keahlian.php';
    }

    public function detailUjian()
    {
        include 'views/admin/tes_keahlian/detail_ujian.php';   
    }
    
    public function editTesKeahlian()
    {
        include 'views/admin/tes_keahlian/edit_soal_keahlian.php';
    }
    
    public function hapusTesKeahlian()
    {
        include '';   
    }
    
    
    // tambah soal tes
    public function tambahSoalTesKeahlian()
    {
        include 'views/admin/tes_keahlian/tambah_soal_tes_keahlian.php';   
    }
    
    public function importSoalTesKeahlian()
    {
        include 'views/admin/tes_keahlian/import_soal_tes.php';
    }

    // edit soal tes
    public function editSoalTesKeahlian()
    {
        include 'views/admin/tes_keahlian/edit_detail_tes.php';
    }

    // hapus soal tes
    public function hapusSoalTesKeahlian()
    {

    }

    // sesi keahlian
    public function sesiTesKeahlian()
    {
        include 'views/admin/sesi_keahlian/sesi_tes_keahlian.php';
    }

    public function detailSesiTesKeahlian()
    {
        include 'views/admin/sesi_keahlian/detail_sesi_keahlian.php';
    }

    public function tambahSesiTesKeahlian()
    {
        include 'views/admin/sesi_keahlian/tambah_sesi_keahlian.php';
    }

    public function editSesiTesKeahlian()
    {
        include 'views/admin/sesi_keahlian/edit_sesi_keahlian.php';
    }

    public function hapusSesiTesKeahlian()
    {

    }
}
