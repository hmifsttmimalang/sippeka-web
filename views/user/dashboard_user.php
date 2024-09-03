<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="assets/profile/img/logo_jatim.png" alt="">
        <span class="d-none d-lg-block">SIPPEKA</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <!-- Profile User -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <?php
            $file_path = '../../../assets/uploads/' . $user['username'] . '/' . $pendaftar['nama'] . '_' . $pendaftar['tempat_lahir'] . '_' . $pendaftar['tanggal_lahir'] . '_bg_biru';
            $jpg_path = $file_path . '.jpg';
            $jpeg_path = $file_path . '.jpeg';
            ?>
            <img src="<?= $jpg_path ? $file_path . '.jpg' : $file_path . '.jpeg' ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $pendaftar['nama'] ?></span>
          </a>
          <!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $_SESSION['user']['username'] ?></h6>
              <span>Peserta</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/user/edit_profil">
                <i class="bi bi-person"></i>
                <span>Edit Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="/user">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/user/tes_seleksi">
          <i class="bi bi-clipboard2-check"></i>
          <span>Tes Seleksi</span>
        </a>
      </li>
      <!-- End Nilai Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/user/edit_profil">
          <i class="bi bi-person-fill-gear"></i>
          <span>Edit Profil</span>
        </a>
      </li>
      <!-- End Edit Profil Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/logout" data-modal="modal" data-target="#logoutModal">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Keluar</span>
        </a>
      </li>
      <!-- End Log Out Page Nav -->

    </ul>

  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <!-- Content -->

    <div class="row">
      <div class="col-md-6">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>SIMULASI TES SELEKSI</b></h6>
          </div>
          <div class="card-body">
            <p class="text-danger mt-3">* Masukkan Username atau Email dan Password
              untuk mencoba proses simulasi tes keahlian dan psikologi!
            </p>
            <form class="user" method="post" action="/auth/login_simulasi">

              <div class="form-group">
                <label for="nilai_tes">Username atau Email </label>
                <input type="text" name="identifier" class="form-control" id="nilai_tes" placeholder="Masukkan username atau email">
              </div>

              <br>
              <div class="form-group">
                <label for="nilai_interview">Password </label>
                <input type="password" name="password" class="form-control" id="nilai_interview" placeholder="Masukkan password">
              </div>

              <br>
              <div class="text-right" style="text-align: end;">
                <button type="submit" name="simpan" class="btn btn-primary">Masuk</button>
                <a href="/user" class="btn btn-danger">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Illustrations -->
      <div class="col-md-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><b>DATA DIRI</b></h6>
            <div class="card-body mt-3">
              <div class="col-auto text-center">
                <?php
                $file_path = '../../../assets/uploads/' . $user['username'] . '/' . $pendaftar['nama'] . '_' . $pendaftar['tempat_lahir'] . '_' . $pendaftar['tanggal_lahir'] . '_bg_biru';
                $jpg_path = $file_path . '.jpg';
                $jpeg_path = $file_path . '.jpeg';
                ?>
                <img src="<?= $jpg_path ? $file_path . '.jpg' : $file_path . '.jpeg' ?>" alt="Foto Profil Background Biru" class="img-fluid rounded-circle" style="width: 200px" alt="menunggu">
              </div>

              <div class="text-right" style="text-align: end;">
                <a href="/user/edit_profil" class="btn btn-warning btn-sm">Edit Profil</a>
              </div>

              <h5 class="text-center card-title"><b><?= strtoupper($pendaftar['nama']) ?></b></h5>

              <?php
              function bulan_indo($month)
              {
                $indonesianMonths = [
                  'Januari',
                  'Februari',
                  'Maret',
                  'April',
                  'Mei',
                  'Juni',
                  'Juli',
                  'Agustus',
                  'September',
                  'Oktober',
                  'November',
                  'Desember'
                ];
                return $indonesianMonths[$month - 1]; // subtract 1 because array indices start at 0
              }
              ?>

              <ul class="list-group">
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Tempat, Tangal Lahir</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">
                    <?= $pendaftar['tempat_lahir'] . ', ' .
                      ltrim(date('d', strtotime($pendaftar['tanggal_lahir'])), '0') . ' ' .
                      bulan_indo(date('m', strtotime($pendaftar['tanggal_lahir']))) . ' ' .
                      date('Y', strtotime($pendaftar['tanggal_lahir']))
                    ?>
                  </h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Jenis Kelamin</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;"><?= $pendaftar['jenis_kelamin'] ?></h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Agama</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;"><?= $pendaftar['agama'] ?></h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Alamat</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;"><?= $pendaftar['alamat'] ?></h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Email</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;"><?= $user['email'] ?></h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Telepon</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;"><?= $pendaftar['telepon'] ?></h6>
                </li>
              </ul>

            </div>
          </div>
        </div>
      </div>

      <?php if (is_null($pendaftar['nilai_keahlian']) || is_null($pendaftar['nilai_wawancara'])) : ?>

        <!-- Hasil Penilaian -->
        <div class="col-md-6">

          <!-- Illustrations -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>PENGUMUMAN HASIL SELEKSI</b></h6>
            </div>
            <div class="card-body mt-4">
              <div class="card text-center">
                <div class="card-body">
                  <h5 class="card-title mb-3">Proses Penilaian</h5>
                  <div class="col-auto">
                    <i class="fa-solid fa-spinner text-warning" style="font-size: 90px;"></i>
                    <p class="card-text mt-3">
                      Terima Kasih telah melaksanakan tes keahlian di SIPPEKA Singasari. Pengumuman pada tanggal :
                    </p>
                    <span class="badge bg-danger" style="font-size: 18px;">15 Agustus 2024</span>
                  </div>
                </div>
                <div class="card-footer">
                  <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGASARI</marquee>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php

      $rataRata = ($pendaftar['nilai_keahlian'] + $pendaftar['nilai_wawancara']) / 2;

      ?>

      <?php if ($rataRata <= 100 && $rataRata >= 70) : ?>
        <!-- Success -->
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>ANDA LOLOS</b></h6>
            </div>
            <div class="card-body mt-4">
              <div class="card text-center">
                <div class="card-body">
                  <h5 class="card-title mb-3">Proses Penilaian</h5>
                  <div class="col-auto">
                    <i class="fa-regular fa-circle-check text-success" style="font-size: 90px;"></i>
                    <p class="card-text mt-3">
                      Selamat anda lolos seleksi pelatihan pekerja SIPPEKA BALAI UPT SINGASARI. Silahkan lakukan daftar ulang.
                    </p>
                    <span class="badge bg-danger" style="font-size: 18px;">15 Agustus 2024</span>
                  </div>
                </div>
                <div class="card-footer">
                  <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGASARI</marquee>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php else : ?>
        <!-- Failed -->
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><b>ANDA TIDAK LOLOS</b></h6>
            </div>
            <div class="card-body mt-4">
              <div class="card text-center">
                <div class="card-body">
                  <h5 class="card-title mb-3">Proses Penilaian</h5>
                  <div class="col-auto">
                    <i class="fa-solid fa-xmark text-danger" style="font-size: 90px;"></i>
                    <p class="card-text mt-3">
                      Anda belum lolos. Terima kasih telah mengikuti tes dengan baik. Silahkan coba lagi di seleksi pelatihan berikutnya.
                    </p>
                  </div>
                </div>
                <div class="card-footer">
                  <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGASARI</marquee>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>
    </div>
    <!-- End Content -->

  </main>
  <!-- End #main -->

  <!-- Logout Modal-->
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>