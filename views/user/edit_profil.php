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
    <link href="../../assets/profile/img/logo_jatim.png" rel="icon">
    <link href="../../assets/profile/img/logo_jatim.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/profile/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/profile/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/profile/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/profile/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/profile/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/profile/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/profile/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/profile/css/style.css" rel="stylesheet">

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
                <img src="../../assets/profile/img/logo_jatim.png" alt="">
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
                        <img src="../../assets/profile/img/profile-img.jpg" alt="Profile" class="rounded-circle">
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
                <a class="nav-link collapsed" href="/user">
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
                <a class="nav-link" href="/user/edit_profil">
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
            <h1>Edit Profil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profil Peserta</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Content -->

        <div class="row">
            <div class="col-md-8">
                <form class="user" method="post" action="/user/edit_profil" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $pendaftar['nama'] ?>">
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= $pendaftar['tempat_lahir'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?= date('Y-m-d', strtotime($pendaftar['tanggal_lahir'])) ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="form-check">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-check-input" id="laki" <?= ($pendaftar['jenis_kelamin'] == 'Laki-laki') ? 'checked' : '' ?>>
                                <label for="laki" class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-check-input" id="perempuan" <?= ($pendaftar['jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?>>
                                <label for="perempuan" class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                <?php
                                $agama_options = [
                                    'Islam',
                                    'Kristen',
                                    'Katolik',
                                    'Hindu',
                                    'Buddha',
                                    'Konghucu'
                                ];
                                foreach ($agama_options as $option) {
                                    $selected = ($pendaftar['agama'] == $option) ? 'selected' : '';
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"><?= $pendaftar['alamat'] ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon" value="<?= $pendaftar['telepon'] ?>">
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email Aktif Anda...">
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password Anda...">
                        </div>
                        <div class="col-md-6">
                            <label for="ulangi_password">Ulangi Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Ulangi Password Anda...">
                        </div>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary mb-5">Ubah</button>
                    <a href="/user" class="btn btn-danger mb-5">Kembali</a>
                </form>
            </div>
            <div class="col-md-4">
                <?php
                $file_path = '../../../assets/uploads/' . $user['username'] . '/' . $pendaftar['nama'] . '_' . $pendaftar['tempat_lahir'] . '_' . $pendaftar['tanggal_lahir'] . '_bg_biru';
                $jpg_path = $file_path . '.jpg';
                $jpeg_path = $file_path . '.jpeg';
                ?>
                <img src="<?= $jpg_path ? $file_path . '.jpg' : $file_path . '.jpeg' ?>" class="img-fluid">
            </div>
        </div>

        <!-- End Content -->

    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../assets/profile/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/profile/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/profile/vendor/chart.js/chart.umd.js"></script>
    <script src="../../assets/profile/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/profile/vendor/quill/quill.js"></script>
    <script src="../../assets/profile/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/profile/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/profile/vendor/php-email-form/validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/profile/js/main.js"></script>

</body>

</html>