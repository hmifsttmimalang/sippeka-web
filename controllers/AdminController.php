<?php

require_once 'models/User.php';
require_once 'models/Pendaftaran.php';
require_once 'models/Keahlian.php';
require_once 'connection/database.php';

class AdminController
{
    private $user;
    private $identifier;
    private $password;
    private $pendaftar;
    protected $kelasKeahlian;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        global $pdo;
        $this->pendaftar = new Pendaftar($pdo);
        $this->user = new User($pdo);
        $this->kelasKeahlian = new Keahlian($pdo);
    }

    public function index()
    {
        $pendaftar_baru = $this->pendaftar->getNewRegistrations();
        $jumlah_pendaftar = $this->pendaftar->getAll();
        $jumlah_pendaftar_count = count($jumlah_pendaftar);
        $persentase_pendaftar = ($jumlah_pendaftar_count > 0) ? 100 : 0;

        include 'views/admin/dashboard_admin.php';
    }

    public function kelolaData()
    {
        $keahlian = $this->kelasKeahlian->getAll();
        $listPendaftar = $this->pendaftar->getAll();
        include 'views/admin/kelola_data.php';
    }

    public function peserta()
    {
        $listPendaftar = $this->pendaftar->getAll();
        include 'views/admin/peserta.php';
    }

    public function infoUser()
    {
        $users = $this->user->getUsersByRole('user');
        include 'views/admin/info_user.php';
    }

    public function detailPendaftar($id)
    {
        $user = $this->user->getUserById($id);
        $userPendaftar = $this->pendaftar->getByUserId($id);
        include 'views/admin/detail_pendaftar.php';
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

    public function hapusSoalKeahlian() {}

    // kelas keahlian
    public function kelasKeahlian()
    {
        $keahlian = $this->kelasKeahlian->getAll();
        include 'views/admin/kelas_keahlian/kelas_keahlian.php';
    }

    public function tambahKelasKeahlian()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nama']) && !empty(trim($_POST['nama']))) {
                $nama = trim($_POST['nama']);
                if ($this->kelasKeahlian->create($nama)) {
                    header('Location: /admin/kelas_keahlian');
                    exit();
                } else {
                    echo "Error saving data.";
                }
            } else {
                echo "Nama Kelas Keahlian tidak boleh kosong.";
            }
        } else {
            include 'views/admin/kelas_keahlian/tambah_kelas_keahlian.php';
        }
    }

    public function ubahKelasKeahlian($id)
    {
        $nama = $_POST['nama'] ?? null;
        if ($nama) {
            if ($this->kelasKeahlian->update($id, $nama)) {
                header('Location: /admin/kelas_keahlian');
                exit; // Tambahkan exit setelah redirect
            }
        }

        // Ambil data untuk edit jika tidak ada POST data
        $keahlian = $this->kelasKeahlian->getById($id);
        include 'views/admin/kelas_keahlian/edit_kelas_keahlian.php';
    }

    public function hapusKelasKeahlian($id)
    {
        if ($this->kelasKeahlian->delete($id)) {
            header('Location: /admin/kelas_keahlian');
            exit;
        }
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

    public function hapusTesKeahlian() {}


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
    public function hapusSoalTesKeahlian() {}

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

    public function hapusSesiTesKeahlian() {}
}
