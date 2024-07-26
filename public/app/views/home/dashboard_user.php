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
        <a class="nav-link " href="./dashboard_user">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
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
                <form class="user">

                    <div class="form-group">
                        <label for="nilai_tes">Username atau Email </label>
                        <input type="text" name="nilai_tes" class="form-control" id="nilai_tes" 
                        placeholder="example@gmail.com">
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="nilai_interview">Password </label>
                        <input type="text" name="nilai_interview" class="form-control" id="nilai_interview" 
                        placeholder="Admin#1234">
                    </div>

                    <br>
                    <div class="text-right" style="text-align: end;">
                        <button type="submit" name="simpan" class="btn btn-primary">Masuk</button>
                        <a href="dashboard_user.php" class="btn btn-danger">Kembali</a>
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
                        <img src="<?= MAIN_URL ?>assets/profile-user-layout/img/messages-3.jpg" alt="fotoprofil" class="img-fluid rounded-circle"
                        style="width: 200px" alt="menunggu">
                    </div>

                        <div class="text-right" style="text-align: end;">
                            <a href="edit_profil.php" class="btn btn-warning btn-sm">Edit Profil</a>
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
                            Terima Kasih telah melakukan pendaftaran di SIPPEKA Singosari. Pengumuman pada tanggal :
                        </p>
                        <span class="badge bg-danger" style="font-size: 18px;">15 Agustus 2024</span>
                    </div>
                </div>
                <div class="card-footer">
                    <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGOSARI</marquee>
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
                        Selamat anda lolos seleksi pelatihan pekerja SIPPEKA BALAI UPT SINGOSARI. Silahkan lakukan daftar ulang.
                    </p>
                    <span class="badge bg-danger" style="font-size: 18px;">15 Agustus 2024</span>
                </div>
            </div>
            <div class="card-footer">
                <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGOSARI</marquee>
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
                <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGOSARI</marquee>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" jika ingin mengakhiri sesi ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="../auth/logout">Keluar</a>
                </div>
            </div>
        </div>
    </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  