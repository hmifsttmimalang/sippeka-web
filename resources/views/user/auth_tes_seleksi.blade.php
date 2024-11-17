@extends('layouts.user_app')

@section('title', 'Login Tes Seleksi | Sippeka User')

@section('content')
    <style>
        .position-relative .toggle-password {
            position: absolute;
            top: 50%;
            right: 20px;
            /* Jarak dari sisi kanan */
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #6c757d;
        }

        .position-relative .toggle-password:hover {
            color: #495057;
        }

        .position-relative .form-control {
            padding-right: 40px;
            /* Ruang untuk ikon */
        }

        .toggle-password {
            margin-top: 16px;
            /* Geser lebih jauh ke bawah */
        }
    </style>

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
                        <img src="{{ asset('storage/' . $pendaftar->foto_bg_biru) }}" alt="Profile" class="rounded-circle"
                            width="35" height="35">
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
                <a class="nav-link collapsed loadPage"
                    href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link loadPage"
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
            <h1>Tes Seleksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Tes Seleksi Peserta</li>
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
                        <h6 class="m-0 font-weight-bold text-primary"><b>Tes Seleksi Keahlian</b></h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger mt-3">* Masukkan Username atau Email dan Password untuk
                            masuk ke sesi tes Keahlian!
                        </p>

                        <form class="user"
                            action="{{ route('user.seleksi_login.store', ['username' => auth()->user()->username]) }}"
                            method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nilai_tes" class="form-label">Username atau Email</label>
                                <input type="text" name="identifier" class="form-control" id="nilai_tes"
                                    placeholder="Masukkan username atau email">
                            </div>

                            <br>
                            <div class="col-12 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control pr-5" id="password"
                                    placeholder="Masukkan password" required>
                                <i class="bi bi-eye-slash toggle-password position-absolute" id="togglePassword"></i>
                                <div class="invalid-feedback">Harap masukkan password!</div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.querySelector('#password');
            const togglePassword = document.querySelector('#togglePassword');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', () => {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // Change icon
                    togglePassword.classList.toggle('bi-eye');
                    togglePassword.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
@endsection
