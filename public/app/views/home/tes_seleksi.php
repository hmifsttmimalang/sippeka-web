<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="./index" class="logo d-flex align-items-center">
                <img src="<?= MAIN_URL ?>assets/profile-user-layout/img/main_logo.png" alt="">
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
                        <img src="<?= MAIN_URL ?>assets/profile-user-layout/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Nama Peserta</span>
                    </a>
                    <!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Username</h6>
                            <span>Peserta</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="./edit_profile">
                                <i class="bi bi-person"></i>
                                <span>Edit Profil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../auth/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->

    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="./dashboard_user">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link" href="./tes_seleksi">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Tes Seleksi</span>
                </a>
            </li>
            <!-- End Nilai Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="./edit_profile">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Edit Profil</span>
                </a>
            </li>
            <!-- End Edit Profil Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="../auth/logout" data-modal="modal" data-target="#logoutModal">
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
            <h1>Tes Seleksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Tes Seleksi Peserta</li>
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
                        <h6 class="m-0 font-weight-bold text-primary"><b>Tes Seleksi Keahlian</b></h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger mt-3">* Masukkan Username atau Email dan Password untuk
                            masuk ke sesi tes Keahlian!
                        </p>
                        <form class="user">

                            <div class="form-group">
                                <label for="nilai_tes">Username atau Email</label>
                                <input type="text" name="nilai_tes" class="form-control" id="nilai_tes" placeholder="Masukkan username atau email">
                            </div>

                            <br>
                            <div class="form-group">
                                <label for="nilai_interview">Password</label>
                                <input type="text" name="nilai_interview" class="form-control" id="nilai_interview" placeholder="Masukkan password">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Masuk</button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><b>Tes Seleksi Psikologi</b></h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger mt-3">* Masukkan Username atau Email dan Password untuk
                            masuk ke sesi tes Psikologi!</p>
                        <form class="user">

                            <div class="form-group">
                                <label for="nilai_tes">Username atau Email</label>
                                <input type="text" name="nilai_tes" class="form-control" id="nilai_tes" placeholder="Masukkan username atau email">
                            </div>

                            <br>
                            <div class="form-group">
                                <label for="nilai_interview">Password</label>
                                <input type="text" name="nilai_interview" class="form-control" id="nilai_interview" placeholder="Masukkan Password">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Masuk</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Content -->

    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>