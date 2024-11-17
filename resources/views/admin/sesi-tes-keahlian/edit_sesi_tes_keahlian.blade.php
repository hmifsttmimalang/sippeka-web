@extends('layouts.admin_app')

@section('title', 'Ubah Sesi Tes Keahlian | Admin Sippeka')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center loadPage"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link loadPage" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link loadPage" href="{{ route('admin.kelola_data') }}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Data Peserta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link loadPage" href="{{ route('admin.peserta') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Peserta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link loadPage" href="{{ route('admin.info_user') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Info User</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item ">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Keahlian</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item loadPage" href="{{ route('admin.mata_soal') }}">Mata Soal Keahlian</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.kelas_keahlian') }}">Kelas Keahlian</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.tes_keahlian') }}">Tes Keahlian</a>
                        <a class="collapse-item active loadPage" href="{{ route('admin.sesi_tes_keahlian') }}">Sesi Tes
                            Keahlian</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                    aria-controls="collapseThree">
                    <i class="fas fa-folder-plus"></i>
                    <span>Kelola Informasi</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item loadPage" href="{{ route('admin.info_jurusan') }}">Jurusan</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.jadwal_tes') }}">Jadwal Tes</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.pengumuman') }}">Atur Pengumuman</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.logout') }}" data-toggle="modal" data-target="#logoutModal">
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
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                                <a class="dropdown-item" href="{{ route('auth.logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
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

                    <!-- Button Kembali -->
                    <a href="{{ route('admin.sesi_tes_keahlian') }}"
                        class="btn btn-primary btn-sm mb-6 loadPage">Kembali</a>

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <div class="">
                                            <h1 class="h4 text-gray-900 mb-4">Edit Sesi Keahlian</h1>
                                        </div>
                                        <hr class="divider-sidebar">
                                        <form class="user"
                                            action="{{ route('admin.sesi_tes_keahlian.update', ['id' => $sesiTesKeahlian->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="nama_sesi">Nama Sesi</label>
                                                    <input type="text" name="nama_sesi" class="form-control"
                                                        id="nama_sesi"
                                                        value="{{ old('nama_sesi', $sesiTesKeahlian->nama_sesi) }}"
                                                        required>
                                                    <small class="text-danger">{{ $errors->first('nama_sesi') }}</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="skill_test_id">Tes Keahlian</label>
                                                    <select name="skill_test_id" id="skill_test_id" class="form-control">
                                                        <option value="">Pilih Tes Keahlian</option>
                                                        @foreach ($tesKeahlian as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $sesiTesKeahlian->skill_test_id ? 'selected' : '' }}>
                                                                {{ e($item->nama_tes) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <small
                                                        class="text-danger">{{ $errors->first('skill_test_id') }}</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-12">
                                                    <label for="waktu_mulai">Waktu Mulai</label>
                                                    <input type="datetime-local" class="form-control" name="waktu_mulai"
                                                        value="{{ $sesiTesKeahlian->waktu_mulai }}"
                                                        placeholder="Pilih waktu mulai" required>
                                                    <small class="text-danger">{{ $errors->first('waktu_mulai') }}</small>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <label for="waktu_selesai">Waktu Selesai</label>
                                                    <input type="datetime-local" class="form-control"
                                                        name="waktu_selesai"
                                                        value="{{ $sesiTesKeahlian->waktu_selesai }}"
                                                        placeholder="Pilih waktu selesai" required>
                                                    <small
                                                        class="text-danger">{{ $errors->first('waktu_selesai') }}</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-6 mb-3">
                                                    <label for="jenis_sesi">Jenis Sesi</label>
                                                    <select name="jenis_sesi" id="jenis_sesi" class="form-control">
                                                        <option value="">Pilih Jenis Sesi</option>
                                                        <option value="Simulasi"
                                                            {{ $sesiTesKeahlian->jenis_sesi == 'Simulasi' ? 'selected' : '' }}>
                                                            Simulasi</option>
                                                        <option value="Seleksi"
                                                            {{ $sesiTesKeahlian->jenis_sesi == 'Seleksi' ? 'selected' : '' }}>
                                                            Seleksi</option>
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('jenis_sesi') }}</small>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-ubah"
                                                data-id="{{ $sesiTesKeahlian->id }}"
                                                data-nama="{{ $sesiTesKeahlian->nama_sesi }}">
                                                Simpan
                                            </button>
                                            <button type="reset" class="btn btn-primary">
                                                Reset
                                            </button>
                                        </form>
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
@endsection
