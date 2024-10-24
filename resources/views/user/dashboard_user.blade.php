@extends('layouts.user_app')

@section('title', auth()->user()->username . ' | Sippeka User')

@section('content')
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/profile/img/logo_jatim.png') }}" alt="">
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
                        <img src="{{ asset('storage/' . $pendaftar->foto_bg_biru) }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $pendaftar->nama }}</span>
                    </a>
                    <!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->username }}</h6>
                            <span>Peserta</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center loadPage"
                                href="{{ route('user.edit_profil', ['username' => auth()->user()->username]) }}">
                                <i class="bi bi-person"></i>
                                <span>Edit Profil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('auth.logout') }}"
                                data-bs-toggle="modal" data-bs-target="#logoutModal">
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
                <a class="nav-link loadPage" href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed loadPage"
                    href="{{ route('user.seleksi_login', ['username' => auth()->user()->username]) }}">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Tes Seleksi</span>
                </a>
            </li>
            <!-- End Nilai Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed loadPage"
                    href="{{ route('user.edit_profil', ['username' => auth()->user()->username]) }}">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Edit Profil</span>
                </a>
            </li>
            <!-- End Edit Profil Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('auth.logout') }}" data-bs-toggle="modal"
                    data-bs-target="#logoutModal">
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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Content -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><b>SIMULASI TES SELEKSI</b></h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger mt-3">* Masukkan Username atau Email dan Password
                            untuk mencoba proses simulasi tes keahlian
                        </p>
                        <form class="user" method="post"
                            action="{{ route('user.simulasi_login', ['username' => auth()->user()->username]) }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="identifier">Username atau Email </label>
                                <input type="text" name="identifier" class="form-control" id="nilai_tes"
                                    placeholder="Masukkan username atau email">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Password </label>
                                <input type="password" name="password" class="form-control" id="nilai_interview"
                                    placeholder="Masukkan password">
                            </div>
                            <br>
                            <div class="text-right" style="text-align: end;">
                                <button type="submit" name="simpan" class="btn btn-primary">Masuk</button>
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
                                <img src="{{ asset('storage/' . $pendaftar->foto_bg_biru) }}"
                                    alt="Foto Profil Background Biru" class="img-fluid rounded-circle"
                                    style="width: 200px" alt="menunggu">
                            </div>
                            <div class="text-right" style="text-align: end;">
                                <a href="{{ route('user.edit_profil', ['username' => auth()->user()->username]) }}"
                                    class="btn btn-warning btn-sm loadPage">Edit Profil</a>
                            </div>
                            <h5 class="text-center card-title"><b><?= strtoupper($pendaftar->nama) ?></b></h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Tempat,
                                        Tangal Lahir</h6>
                                    <h6 class="mb-0" style="color: black; text-align: left;">
                                        {{ $pendaftar->tempat_lahir }}, {{ $formatted_date }}
                                    </h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Jenis
                                        Kelamin</h6>
                                    <h6 class="mb-0" style="color: black; text-align: left;">
                                        <?= $pendaftar->jenis_kelamin ?></h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Agama
                                    </h6>
                                    <h6 class="mb-0" style="color: black; text-align: left;"><?= $pendaftar->agama ?>
                                    </h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Alamat
                                    </h6>
                                    <h6 class="mb-0" style="color: black; text-align: left;">
                                        <?= $pendaftar->alamat ?></h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Email
                                    </h6>
                                    <h6 class="mb-0" style="color: black; text-align: left;"><?= $user->email ?></h6>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1" style="color: black; font-weight: bold; text-align: left;">Telepon
                                    </h6>
                                    <h6 class="mb-0" style="color: black; text-align: left;">
                                        <?= $pendaftar->telepon ?></h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Penilaian -->
            @if ($showAnnouncement)
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                @if ($status === 'Sedang Diproses')
                                    <b>PENGUMUMAN HASIL SELEKSI</b>
                                @elseif ($status === 'Lulus')
                                    <b>ANDA LOLOS</b>
                                @elseif ($status === 'Tidak Lulus')
                                    <b>ANDA TIDAK LOLOS</b>
                                @endif
                            </h6>
                        </div>
                        <div class="card-body mt-4 text-center">
                            <h5 class="card-title mb-3">Proses Penilaian</h5>
                            <div class="col-auto">
                                @if ($status === 'Sedang Diproses')
                                    <i class="fa-solid fa-spinner text-warning" style="font-size: 90px;"></i>
                                    <p class="card-text mt-3">
                                        Terima Kasih telah melaksanakan tes keahlian di SIPPEKA Singasari. Pengumuman pada
                                        tanggal:
                                    </p>
                                @elseif ($status === 'Lulus')
                                    <i class="fa-regular fa-circle-check text-success" style="font-size: 90px;"></i>
                                    <p class="card-text mt-3">
                                        Selamat anda lolos seleksi pelatihan pekerja SIPPEKA BALAI UPT SINGASARI. Silahkan
                                        lakukan daftar ulang.
                                    </p>
                                @elseif ($status === 'Tidak Lulus')
                                    <i class="fa-solid fa-xmark text-danger" style="font-size: 90px;"></i>
                                    <p class="card-text mt-3">
                                        Anda belum lolos. Terima kasih telah mengikuti tes dengan baik. Silahkan coba lagi
                                        di kesempatan berikutnya.
                                    </p>
                                @endif
                                <span class="badge bg-danger" style="font-size: 18px;">
                                    {{ $formattedAnnouncementDate }}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <marquee style="font-weight:bold;">SIPPEKA BALAI UPT SINGOSARI</marquee>
                        </div>
                    </div>
                </div>
            @else
                @if ($announcementMessage)
                    <div class="alert alert-info" role="alert">
                        {{ $announcementMessage }}
                    </div>
                @endif
            @endif
        </div>
        <!-- End Content -->

    </main>
    <!-- End #main -->
@endsection
