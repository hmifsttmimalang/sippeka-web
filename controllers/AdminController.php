<?php

class AdminController
{
    private $user;
    private $pendaftaran;
    protected $kelasKeahlian;
    protected $tesKeahlian;
    protected $mataSoal;
    protected $sesiTesKeahlian;
    private $soal;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        global $pdo;
        $this->pendaftaran = new Pendaftaran($pdo);
        $this->user = new User($pdo);
        $this->kelasKeahlian = new Keahlian($pdo);
        $this->tesKeahlian = new TesKeahlian($pdo);
        $this->mataSoal = new MataSoal($pdo);
        $this->soal = new Soal($pdo);
        $this->sesiTesKeahlian = new SesiTesKeahlian($pdo);
    }

    public function index()
    {
        $pendaftar_baru = $this->pendaftaran->getNewRegistrations();
        $jumlah_pendaftar = $this->pendaftaran->getAll();
        $jumlah_pendaftar_count = count($jumlah_pendaftar);
        $persentase_pendaftar = ($jumlah_pendaftar_count > 0) ? 100 : 0;

        // Tambahkan nama keahlian ke data pendaftar
        foreach ($pendaftar_baru as &$pendaftar) {
            $keahlianId = $pendaftar['keahlian'];
            $keahlianData = $this->kelasKeahlian->getById($keahlianId);
            $pendaftar['keahlian_nama'] = $keahlianData['nama']; // Sesuaikan dengan nama kolom di tabel keahlian
        }

        $lolosSeleksiCount = array_reduce($jumlah_pendaftar, function ($count, $item) {
            $nilai_keahlian = $item['nilai_keahlian'] ?? null;
            $nilai_wawancara = $item['nilai_wawancara'] ?? null;
            if ($nilai_keahlian !== null && $nilai_wawancara !== null) {
                $rataRata = ($nilai_keahlian + $nilai_wawancara) / 2;
                if ($rataRata >= 70) {
                    $count++;
                }
            }
            return $count;
        }, 0);

        include 'views/layout/admin_header.php';
        include 'views/admin/dashboard_admin.php';
        include 'views/layout/admin_footer.php';
    }

    public function kelolaData()
    {
        $listPendaftar = $this->pendaftaran->getAll();

        // Tambahkan nama keahlian ke data pendaftar
        foreach ($listPendaftar as &$pendaftar) {
            $keahlianId = $pendaftar['keahlian'];
            $keahlianData = $this->kelasKeahlian->getById($keahlianId);
            $pendaftar['keahlian_nama'] = $keahlianData['nama']; // Sesuaikan dengan nama kolom di tabel keahlian
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/kelola_data.php';
        include 'views/layout/admin_footer.php';
    }

    public function peserta()
    {
        $listPendaftar = $this->pendaftaran->getAll();

        // Tambahkan nama keahlian ke data pendaftar
        foreach ($listPendaftar as &$pendaftar) {
            $keahlianId = $pendaftar['keahlian'];
            $keahlianData = $this->kelasKeahlian->getById($keahlianId);
            $pendaftar['keahlian_nama'] = $keahlianData['nama']; // Sesuaikan dengan nama kolom di tabel keahlian
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/peserta.php';
        include 'views/layout/admin_footer.php';
    }

    public function infoUser()
    {
        $users = $this->user->getUsersByRole('user');
        include 'views/layout/admin_header.php';
        include 'views/admin/info_user.php';
        include 'views/layout/admin_footer.php';
    }

    public function detailPendaftar($id)
    {
        $user = $this->user->getUserById($id);
        $userPendaftar = $this->pendaftaran->getByUserId($id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nilai_wawancara = $_POST['nilai_wawancara'] ?? null;
    
            // Menyimpan nilai tes wawancara
            if ($this->pendaftaran->saveTesWawancara($id, $nilai_wawancara)) {
                header('Location: /admin/kelola_data/detail_pendaftar/' . $id);
                exit;
            }
        }
    
        if (!empty($userPendaftar)) {
            include 'views/layout/admin_header.php';
            include 'views/admin/detail_pendaftar.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/kelola_data');
            exit;
        }
    }    

    // halaman soal keahlian
    public function soalKeahlian()
    {
        $mataSoal = $this->mataSoal->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/mata_keahlian/mata_soal_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function tambahSoalKeahlian()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nama']) && !empty(trim($_POST['nama']))) {
                $nama = trim($_POST['nama']);
                if ($this->mataSoal->create($nama)) {
                    header('Location: /admin/mata_soal_keahlian');
                    exit();
                } else {
                    echo "Error saving data.";
                }
            } else {
                echo "Nama Mata Soal tidak boleh kosong.";
            }
        } else {
            include 'views/layout/admin_header.php';
            include 'views/admin/mata_keahlian/tambah_mata_keahlian.php';
            include 'views/layout/admin_footer.php';
        }
    }

    public function ubahSoalKeahlian($id)
    {
        $mataSoal = $this->mataSoal->get($id);

        if (empty($mataSoal)) {
            header('Location: /admin/mata_soal_keahlian');
            exit;
        }

        $nama = $_POST['nama'] ?? null;
        if ($nama) {
            if ($this->mataSoal->update($id, $nama)) {
                header('Location: /admin/mata_soal_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/mata_keahlian/edit_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusSoalKeahlian($id)
    {
        if ($this->mataSoal->delete($id)) {
            header('Location: /admin/mata_soal_keahlian');
            exit;
        }
    }

    // kelas keahlian
    public function kelasKeahlian()
    {
        $keahlian = $this->kelasKeahlian->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/kelas_keahlian/kelas_keahlian.php';
        include 'views/layout/admin_footer.php';
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
            include 'views/layout/admin_header.php';
            include 'views/admin/kelas_keahlian/tambah_kelas_keahlian.php';
            include 'views/layout/admin_footer.php';
        }
    }

    public function ubahKelasKeahlian($id)
    {
        $keahlian = $this->kelasKeahlian->getById($id);

        if (empty($keahlian)) {
            header('Location: /admin/kelas_keahlian');
            exit;
        }

        $nama = $_POST['nama'] ?? null;
        if ($nama) {
            if ($this->kelasKeahlian->update($id, $nama)) {
                header('Location: /admin/kelas_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/kelas_keahlian/edit_kelas_keahlian.php';
        include 'views/layout/admin_footer.php';
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
        $tesKeahlianList = $this->tesKeahlian->getAll();
        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/tes_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function tambahTesKeahlian()
    {
        $keahlianList = $this->kelasKeahlian->getAll();
        $mataSoalList = $this->mataSoal->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_tes = $_POST['nama_tes'];
            $mata_soal_id = $_POST['mata_soal'];
            $keahlian_id = $_POST['keahlian_id']; // Update untuk menggunakan keahlian_id
            $acak_soal = $_POST['acak_soal'];
            $acak_jawaban = $_POST['acak_jawaban'];
            $durasi_menit = $_POST['durasi_menit'];

            if ($this->tesKeahlian->create($nama_tes, $mata_soal_id, $keahlian_id, $acak_soal, $acak_jawaban, $durasi_menit)) {
                header('Location: /admin/tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/tambah_soal_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function detailUjian($id)
    {
        $tesKeahlian = $this->tesKeahlian->get($id);

        if (!empty($tesKeahlian)) {
            $jumlahSoal = $this->soal->getSoalByTesKeahlianId($id);
            $hitungSoal = count($jumlahSoal);
            $soalList = $this->soal->getSoalByTesKeahlianId($id);

            include 'views/layout/admin_header.php';
            include 'views/admin/tes_keahlian/detail_ujian.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/tes_keahlian');
            exit;
        }
    }

    public function editTesKeahlian($id)
    {
        $tesKeahlian = $this->tesKeahlian->get($id);

        if (empty($tesKeahlian)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }

        $keahlianList = $this->kelasKeahlian->getAll();
        $mataSoalList = $this->mataSoal->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_tes = $_POST['nama_tes'] ?? null;
            $mata_soal_id = $_POST['mata_soal'] ?? null;
            $keahlian_id = $_POST['keahlian_id'] ?? null; // Update untuk menggunakan keahlian_id
            $acak_soal = $_POST['acak_soal'] ?? 't';
            $acak_jawaban = $_POST['acak_jawaban'] ?? 't';
            $durasi_menit = $_POST['durasi_menit'] ?? null;

            if ($this->tesKeahlian->update($id, $nama_tes, $mata_soal_id, $keahlian_id, $acak_soal, $acak_jawaban, $durasi_menit)) {
                header('Location: /admin/tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/edit_soal_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusTesKeahlian($id)
    {
        if ($this->tesKeahlian->delete($id)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }
    }

    // tambah soal tes
    public function tambahSoalTesKeahlian($id)
    {
        $tesKeahlian = $this->tesKeahlian->get($id);

        if (empty($tesKeahlian)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $soal = $_POST['soal'];
            $pilihan_a = $_POST['pilihan_a'];
            $pilihan_b = $_POST['pilihan_b'];
            $pilihan_c = $_POST['pilihan_c'];
            $pilihan_d = $_POST['pilihan_d'];
            $pilihan_e = $_POST['pilihan_e'];
            $jawaban_benar = $_POST['jawaban_benar'];

            $tes_keahlian_id = $tesKeahlian['id'];

            // Save the soal data
            if ($this->soal->create($soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar, $tes_keahlian_id)) {
                header('Location: /admin/tes_keahlian/detail_ujian/' . $id);
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/tambah_soal_tes_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function importSoalTesKeahlian($id)
    {
        $tesKeahlian = $this->tesKeahlian->get($id);

        if (!empty($tesKeahlian)) {
            include 'views/layout/admin_header.php';
            include 'views/admin/tes_keahlian/import_soal_tes.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/tes_keahlian');
            exit;
        }
    }

    // edit soal tes
    public function editSoalTesKeahlian($id, $id_soal)
    {
        $tesKeahlian = $this->tesKeahlian->get($id);

        if (empty($tesKeahlian)) {
            header('Location: /admin/tes_keahlian');
            exit;
        }

        $soal = $this->soal->get($id_soal);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $soal = $_POST['soal'];
            $pilihan_a = $_POST['pilihan_a'];
            $pilihan_b = $_POST['pilihan_b'];
            $pilihan_c = $_POST['pilihan_c'];
            $pilihan_d = $_POST['pilihan_d'];
            $pilihan_e = $_POST['pilihan_e'];
            $jawaban_benar = $_POST['jawaban_benar'];

            if ($this->soal->update($id, $soal, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $pilihan_e, $jawaban_benar, $tesKeahlian)) {
                header('Location: /admin/tes_keahlian/detail_ujian/' . $tesKeahlian);
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/tes_keahlian/edit_detail_tes.php';
        include 'views/layout/admin_footer.php';
    }

    // hapus soal tes
    public function hapusSoalTesKeahlian($id, $id_soal)
    {
        $tesKeahlianId = $this->tesKeahlian->get($id);
        $soal = $this->soal->get($id_soal);

        if ($this->soal->delete($id_soal)) {
            header('Location: /admin/tes_keahlian/detail_ujian/' . $id);
            exit;
        }
    }

    // sesi keahlian
    public function sesiTesKeahlian()
    {
        $sesiTesKeahlian = $this->sesiTesKeahlian->getAll();
        $tesKeahlianList = $this->tesKeahlian->getAll();

        // Cek apakah ID yang digunakan benar-benar ada
        foreach ($sesiTesKeahlian as $item) {
            if (!isset($tesKeahlianMap[$item['tes_keahlian_id']])) {
                error_log("ID tidak ditemukan: " . $item['tes_keahlian_id']);
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/sesi_keahlian/sesi_tes_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function detailSesiTesKeahlian($id)
    {
        $sesiTesKeahlian = $this->sesiTesKeahlian->get($id);

        if (!empty($sesiTesKeahlian)) {
            $startTime = strtotime($sesiTesKeahlian['waktu_mulai']);
            $endTime = strtotime($sesiTesKeahlian['waktu_selesai']);
            $durationInSeconds = $endTime - $startTime;
            $durationInMinutes = floor($durationInSeconds / 60);
            $hours = floor($durationInMinutes / 60);
            $minutes = $durationInMinutes % 60;
            $durationString = sprintf('%02d:%02d', $hours, $minutes);

            $soalList = $this->sesiTesKeahlian->getSoalBySesiId($id); // Ambil soal terkait

            $data = [
                'sesiTesKeahlian' => $sesiTesKeahlian,
                'duration' => $durationString,
                'soalList' => $soalList // Tambahkan soal ke data
            ];

            include 'views/layout/admin_header.php';
            include 'views/admin/sesi_keahlian/detail_sesi_keahlian.php';
            include 'views/layout/admin_footer.php';
        } else {
            header('Location: /admin/sesi_tes_keahlian');
            exit;
        }
    }

    public function tambahSesiTesKeahlian()
    {
        $tesKeahlianList = $this->tesKeahlian->getAll(); // Ganti mataSoal dengan tesKeahlian

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_sesi = $_POST['nama_sesi'];
            $tes_keahlian_id = $_POST['tes_keahlian_id']; // Ganti mata_soal dengan tes_keahlian_id
            $waktu_mulai = $_POST['waktu_mulai'];
            $waktu_selesai = $_POST['waktu_selesai'];
            $jenis_sesi = $_POST['jenis_sesi'];

            if ($this->sesiTesKeahlian->create($nama_sesi, $tes_keahlian_id, $waktu_mulai, $waktu_selesai, $jenis_sesi)) {
                header('Location: /admin/sesi_tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/sesi_keahlian/tambah_sesi_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function editSesiTesKeahlian($id)
    {
        $sesiTesKeahlian = $this->sesiTesKeahlian->get($id);

        if (empty($sesiTesKeahlian)) {
            header('Location: /admin/sesi_tes_keahlian');
            exit;
        }

        $tesKeahlianList = $this->tesKeahlian->getAll(); // Ganti mataSoal dengan tesKeahlian

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_sesi = $_POST['nama_sesi'];
            $tes_keahlian_id = $_POST['tes_keahlian_id']; // Ganti mata_soal dengan tes_keahlian_id
            $waktu_mulai = $_POST['waktu_mulai'];
            $waktu_selesai = $_POST['waktu_selesai'];
            $jenis_sesi = $_POST['jenis_sesi'];

            if ($this->sesiTesKeahlian->update($id, $nama_sesi, $tes_keahlian_id, $waktu_mulai, $waktu_selesai, $jenis_sesi)) {
                header('Location: /admin/sesi_tes_keahlian');
                exit;
            }
        }

        include 'views/layout/admin_header.php';
        include 'views/admin/sesi_keahlian/edit_sesi_keahlian.php';
        include 'views/layout/admin_footer.php';
    }

    public function hapusSesiTesKeahlian($id)
    {
        if ($this->sesiTesKeahlian->delete($id)) {
            header('Location: /admin/sesi_tes_keahlian');
            exit;
        }
    }
}
