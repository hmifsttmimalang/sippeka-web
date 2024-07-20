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
                <a class="nav-link collapsed" href="./tes_seleksi">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Tes Seleksi</span>
                </a>
            </li>
            <!-- End Nilai Nav -->

            <li class="nav-item">
                <a class="nav-link" href="./edit_profile">
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
            <h1>Edit Profil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profil Peserta</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Content -->

        <div class="row">
            <div class="col-md-8">
                <form class="user">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap Anda...">
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir Anda...">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir Anda...">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="form-check">
                                <input type="radio" name="jenis_kelamin" value="L" class="form-check-input" id="laki">
                                <label for="laki" class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="jenis_kelamin" value="P" class="form-check-input" id="perempuan">
                                <label for="perempuan" class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="katholik">Katholik</option>
                                <option value="hindu">Hindu</option>
                                <option value="budha">Budha</option>
                                <option value="konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email Aktif Anda...">
                        </div>
                        <div class="col-md-6">
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" class="form-control" id="telepon" placeholder="No Telepon Anda...">
                        </div>
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
                    <a href="dashboard_user.php" class="btn btn-danger mb-5">Kembali</a>
                </form>
            </div>
            <div class="col-md-4">
                <img src="<?= MAIN_URL ?>assets/profile-user-layout/img/messages-3.jpg" alt="foto profil" class="img-fluid">

                <input type="file" name="gambar" class="form-control mt-2">
            </div>
        </div>

        <!-- End Content -->

    </main>
    <!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>