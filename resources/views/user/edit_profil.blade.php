@extends('layouts.user_app')

@section('title', 'Login Tes Seleksi | Sippeka User')

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
                            <a class="dropdown-item d-flex align-items-center"
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
                <a class="nav-link collapsed"
                    href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed"
                    href="{{ route('user.seleksi_login', ['username' => auth()->user()->username]) }}">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Tes Seleksi</span>
                </a>
            </li>
            <!-- End Nilai Nav -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.edit_profil', ['username' => auth()->user()->username]) }}">
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
                <form class="user" method="post"
                    action="{{ route('user.update_profil', ['username' => auth()->user()->username]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST') <!-- Laravel akan menganggap ini sebagai POST request -->

                    <!-- Input fields seperti yang Anda tunjukkan sebelumnya -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            value="{{ old('nama', $pendaftar->nama) }}">
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                                value="{{ old('tempat_lahir', $pendaftar->tempat_lahir) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                value="{{ old('tanggal_lahir', date('Y-m-d', strtotime($pendaftar->tanggal_lahir))) }}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="form-check">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-check-input"
                                    id="laki"
                                    {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }}>
                                <label for="laki" class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-check-input"
                                    id="perempuan"
                                    {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}>
                                <label for="perempuan" class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                @php
                                    $agama_options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                                @endphp
                                @foreach ($agama_options as $option)
                                    <option value="{{ $option }}"
                                        {{ old('agama', $pendaftar->agama) == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $pendaftar->alamat) }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon"
                            value="{{ old('telepon', $pendaftar->telepon) }}">
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Email Aktif Anda..." value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Masukkan Password Anda...">
                        </div>
                        <div class="col-md-6">
                            <label for="ulangi_password">Ulangi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="ulangi_password" placeholder="Ulangi Password Anda...">
                        </div>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary mb-5">Ubah</button>
                    <a href="{{ route('user.edit_profil', ['username' => auth()->user()->username]) }}"
                        class="btn btn-danger mb-5">Kembali</a>
                </form>

            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $pendaftar->foto_bg_biru) }}" class="img-fluid">
            </div>
        </div>

        <!-- End Content -->

    </main>
@endsection
