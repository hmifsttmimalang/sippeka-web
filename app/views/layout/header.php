<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $data['title'] ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= MAIN_URL ?>assets/user-layout/img/logo.png" rel="icon">
  <link href="<?= MAIN_URL ?>assets/user-layout/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= MAIN_URL ?>assets/user-layout/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= MAIN_URL ?>assets/user-layout/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= MAIN_URL ?>assets/user-layout/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= MAIN_URL ?>assets/user-layout/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= MAIN_URL ?>assets/user-layout/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= MAIN_URL ?>assets/user-layout/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Jun 27 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="." class="logo d-flex align-items-center me-auto">
        <img src="<?= MAIN_URL ?>assets/user-layout/img/logo.png" alt="">
        <h1 class="sitename">SIPPEKA</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="./" class="active">Beranda</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#services">Services</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <?php if (isset( $_SESSION['username'])) : ?>
        <a class="" href="../home/dashboard_user"><?= htmlspecialchars( $_SESSION['username']) ?></a>
        <a class="btn-getstarted" href="<?= MAIN_URL ?>auth/logout">Keluar</a>
      <?php else: ?>
        <a class="btn-getstarted" href="<?= MAIN_URL ?>auth/login">Masuk</a>
        <a class="btn-getstarted" href="<?= MAIN_URL ?>auth/register">Daftar</a>
      <?php endif; ?>
    </div>
  </header>
