@extends('layouts.admin-app')

@section('title', 'Detail Pendaftar | Admin Sippeka')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="/admin/kelola_data">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Data Peserta</span>
                </a>
            </li>


            <li class="nav-item ">
                <a class="nav-link" href="/admin/peserta">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Peserta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/info_user">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Info User</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item ">
                <a class="nav-link" href="/admin/kelola_data" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Keahlian</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/admin/mata_soal_keahlian">Mata Soal Keahlian</a>
                        <a class="collapse-item" href="/admin/kelas_keahlian">Kelas Keahlian</a>
                        <a class="collapse-item" href="/admin/tes_keahlian">Tes Keahlian</a>
                        <a class="collapse-item" href="/admin/sesi_tes_keahlian">Sesi Tes Keahlian</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="/logout" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/admin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Detail Pendaftar</h1>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><b>DATA DIRI</b></h6>

                                    <div class="card-body mt-3">
                                        <div class="col-auto text-center">
                                            <img src="{{ asset('storage/' . $pendaftar->foto_bg_biru) }}"
                                                alt="Foto Profil Background Biru" class="img-fluid rounded-circle"
                                                style="width: 200px" alt="menunggu">
                                        </div>
                                        <br>
                                        <h5 class="text-center card-title"><b>
                                                {{ strtoupper($pendaftar->nama) }}
                                            </b>
                                        </h5>

                                        <ul class="list-group">
                                            <?php
                                            // function bulan_indo($month)
                                            // {
                                            //     $indonesianMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            //     return $indonesianMonths[$month - 1]; // subtract 1 because array indices start at 0
                                            // }
                                            ?>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Tempat,
                                                    Tangal Lahir</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    {{ $pendaftar->tempat_lahir }}, {{ $pendaftar->tanggal_lahir }}
                                                </h6>
                                            </li>

                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Jenis
                                                    Kelamin</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    {{ $pendaftar->jenis_kelamin }}
                                                </h6>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Agama</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    {{ $pendaftar->agama }}
                                                </h6>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Alamat</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    {{ $pendaftar->alamat }}
                                                </h6>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Email</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    {{ $pendaftar->user->email }}
                                                </h6>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Telepon</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    {{ $pendaftar->telepon }}
                                                </h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><b>DATA NILAI PESERTA</b></h6>

                                    <div class="card-body mt-3">
                                        <div class="alert alert-info">
                                            Data peserta belum divalidasi
                                        </div>
                                        <br>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Nilai Tes
                                                    Keahlian</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                </h6>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Nilai Tes
                                                    Wawancara</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                </h6>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-1"
                                                    style="color: black; font-weight: bold; text-align: left;">Nilai
                                                    Rata-Rata</h6>
                                                <h6 class="mb-0" style="color: black; text-align: left;">
                                                    <?php
                                                    // if (is_null($userPendaftar['nilai_keahlian']) || is_null($userPendaftar['nilai_wawancara'])) {
                                                    //     $rataRata = null;
                                                    // } else {
                                                    //     $rataRata = ($userPendaftar['nilai_keahlian'] + $userPendaftar['nilai_wawancara']) / 2;
                                                    // }
                                                    ?>
                                                </h6>
                                            </li>
                                        </ul>

                                        <span class="badge badge-warning mt-3"
                                            style="display:block; height:30px; line-height:25px;">Sedang
                                            diproses</span>
                                        <span class="badge badge-success mt-3"
                                            style="display:block; height:30px; line-height:25px;">Lulus</span>
                                        <span class="badge badge-danger mt-3"
                                            style="display:block; height:30px; line-height:25px;">Gagal</span>

                                        <button type="button" class="btn btn-primary mt-3 btn-block" data-toggle="modal"
                                            data-target="#modalvalidasi">
                                            Validasi Data Peserta
                                        </button>

                                        <!-- Modal-->
                                        <div class="modal fade" id="modalvalidasi" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Penilaian Wawancara
                                                            Peserta</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="/admin/kelola_data/detail_pendaftar/{{ $pendaftar->user_id }}">
                                                            <div class="mb-3">
                                                                <label for="nilai-wawancara" class="col-form-label">Nilai
                                                                    Wawancara:</label>
                                                                <input type="text" class="form-control"
                                                                    id="nilai_wawancara" name="nilai_wawancara"
                                                                    value="">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit">Validasi</button>
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Batal</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

    </div>
@endsection
