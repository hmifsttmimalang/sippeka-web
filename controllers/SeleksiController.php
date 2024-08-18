<?php

require_once 'models/Soal.php';
require_once 'models/Pendaftaran.php';

class SeleksiController 
{
    private $soal;
    private $pendaftaran;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: /login');
            exit;
        }

        global $pdo;

        $this->soal = new Soal($pdo);
        $this->pendaftaran = new Pendaftar($pdo);

        // Check if the user has registered
        $pendaftaran = $this->pendaftaran->getByUserId($_SESSION['user']['id']);
        if (!$pendaftaran) {
            header('Location: /pendaftaran');
            exit;
        }
    }

    public function simulasi()
    {
        $questions = $this->soal->getAll();
        include 'views/layout/simulasi_header.php';
        include 'views/tes_seleksi/tes_simulasi_peserta.php';
        include 'views/layout/simulasi_footer.php';
    }
    
    public function hasilSimulasi() 
    {
        $questions = $this->soal->getAll();
        include 'views/layout/simulasi_header.php';
        include 'views/tes_seleksi/hasil_simulasi.php';
        include 'views/layout/simulasi_footer.php';
    }

    public function tesSeleksi()
    {
        include 'views/layout/tes_header.php';
        include 'views/tes_seleksi/tes_seleksi_peserta.php';   
        include 'views/layout/tes_footer.php';
    }
}