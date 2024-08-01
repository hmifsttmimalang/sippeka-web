<?
include '../../controllers/AuthController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIPPEKA | User</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/profile/img/logo_jatim.png" rel="icon">
  <link href="assets/profile/img/logo_jatim.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/profile/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/profile/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/profile/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/profile/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/profile/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/profile/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/profile/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/profile/css/style.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

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
            <img src="assets/profile/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Nama Peserta</span>
          </a><!-- End Profile Iamge Icon -->

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
            <form class="user" method="post" action="/auth/login">

              <div class="form-group">
                <label for="nilai_tes">Username atau Email </label>
                <input type="text" name="identifier" class="form-control" id="nilai_tes" placeholder="example@gmail.com">
              </div>

              <br>
              <div class="form-group">
                <label for="nilai_interview">Password </label>
                <input type="text" name="password" class="form-control" id="nilai_interview" placeholder="">
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
                <img src="assets/profile/img/messages-3.jpg" alt="fotoprofil" class="img-fluid rounded-circle" style="width: 200px" alt="menunggu">
              </div>

              <div class="text-right" style="text-align: end;">
                <a href="/user/edit_profil" class="btn btn-warning btn-sm">Edit Profil</a>
              </div>

              <h5 class="text-center card-title"><b>ADI CHANDRA</b></h5>

              <ul class="list-group">
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Tempat, Tangal Lahir</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">Malang, 13 September 2004</h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Jenis Kelamin</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">Pria</h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Agama</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">Islam</h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Alamat</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">Jl.Dieng Atas Kalisongo</h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Email</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">adi99@gmail.com</h6>
                </li>
                <li class="list-group-item">
                  <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Telepon</h6>
                  <h6 class="mb-0" style="color: black; text-align: left;">082236541717</h6>
                </li>
              </ul>

            </div>
          </div>
        </div>
      </div>

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

      <div class="col-md-6">
        <!-- Success -->
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

      <div class="col-md-6">
        <!-- Failed -->
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

  <!-- Vendor JS Files -->
  <script src="assets/profile/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/profile/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/profile/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/profile/vendor/echarts/echarts.min.js"></script>
  <script src="assets/profile/vendor/quill/quill.js"></script>
  <script src="assets/profile/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/profile/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/profile/vendor/php-email-form/validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Template Main JS File -->
  <script src="assets/profile/js/main.js"></script>

</body>

</html>