<?
require_once '../../controllers/AuthController.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIPPEKA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/user/img/silastri/logo_jatim.png" rel="icon">
    <link href="assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/user/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/user/css/main.css" rel="stylesheet">

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

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="assets/user/img/silastri/logo_jatim.png" alt="">
                <h1 class="sitename">SIPPEKA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#services">Services</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php if (isset($_SESSION['user'])) : ?>
                <a class="btn-getstarted" href="/user"><?= $_SESSION['user']['username'] ?></a>
                <a class="btn-getstarted" href="/logout">Keluar</a>
            <?php else : ?>
                <a class="btn-getstarted" href="/login">Masuk</a>
                <a class="btn-getstarted" href="/register">Buat Akun</a>
            <?php endif; ?>
        </div>
    </header>