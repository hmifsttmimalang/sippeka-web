@extends('layouts.admin_app')

@section('title', 'Detail Tes Keahlian | Admin Sippeka')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center loadPage" href="{{ route('admin.dashboard') }}">
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
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Keahlian</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item loadPage" href="{{ route('admin.mata_soal') }}">Mata Soal Keahlian</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.kelas_keahlian') }}">Kelas Keahlian</a>
                        <a class="collapse-item active loadPage" href="{{ route('admin.tes_keahlian') }}">Tes Keahlian</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.sesi_tes_keahlian') }}">Sesi Tes Keahlian</a>
                    </div>
                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-folder-plus"></i>
                    <span>Kelola Informasi</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item loadPage" href="">Jurusan</a>
                        <a class="collapse-item loadPage" href="">Tata Cara Pendafataran</a>
                        <a class="collapse-item loadPage" href="">Jadwal Tes</a>
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
                    <a href="{{ route('admin.tes_keahlian') }}" class="btn btn-primary btn-sm loadPage">Kembali</a>

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <div class="">
                                            <h1 class="h4 text-gray-900 mb-4">Detail Soal Keahlian</h1>
                                        </div>
                                        <hr class="divider-sidebar">
                                        <table class="table table-bordered table-hover right-align">
                                            <tr>
                                                <th>Nama Tes Keahlian</th>
                                                <td>Tes - {{ $tesKeahlian->nama_tes }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mata Soal</th>
                                                <td>{{ $tesKeahlian->mata_soal_nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Keahlian</th>
                                                <td>{{ $tesKeahlian->keahlian_nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Soal</th>
                                                <td>{{ $jumlahSoal }}</td>
                                            </tr>
                                            <tr>
                                                <th>Durasi (Menit)</th>
                                                <td>{{ $tesKeahlian->durasi_menit }} Menit</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <!-- Nested Row within Card Body -->
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div class="">
                                            <h1 class="h4 text-gray-900 mb-4">Soal Tes Keahlian</h1>
                                        </div>
                                        <hr class="divider-sidebar">
                                        <a href="{{ route('admin.soal.create', ['id' => $tesKeahlian->id]) }}"
                                            class="btn btn-primary mb-3 loadPage">Tambah</a>
                                        <a href="{{ route('admin.soal.import', ['id' => $tesKeahlian->id]) }}"
                                            class="btn btn-primary mb-3 loadPage">Import</a>
                                        @if ($soal->isNotEmpty())
                                            <table class="table table-bordered table-hover right-align">
                                                <thead class="thead-dark">
                                                    <tr style="text-align: center; vertical-align: middle;">
                                                        <th>No</th>
                                                        <th>Soal Tes Keahlian</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($soal as $index => $item)
                                                        <tr style="text-align: center; vertical-align: middle;">
                                                            <td>{{ $index + 1 + ($soal->currentPage() - 1) * $soal->perPage() }}
                                                            </td>
                                                            <td style="text-align: left;">{{ strip_tags($item->soal) }}
                                                                <hr class="sidebar-divider">
                                                                <div class="ml-3">
                                                                    <div>A. {{ strip_tags($item->pilihan_a) }}</div>
                                                                    <div>B. {{ strip_tags($item->pilihan_b) }}</div>
                                                                    <div>C. {{ strip_tags($item->pilihan_c) }}</div>
                                                                    <div>D. {{ strip_tags($item->pilihan_d) }}</div>
                                                                </div>
                                                                <hr class="sidebar-divider">
                                                                <div class="ml-3">
                                                                    <p>Jawaban yang benar: {{ $item->jawaban_benar }}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('admin.soal.delete', ['id' => $tesKeahlian->id, 'soal_id' => $item->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('admin.soal.edit', ['id' => $tesKeahlian->id, 'soal_id' => $item->id]) }}"
                                                                        class="btn btn-primary btn-sm loadPage">Ubah</a>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm btn-hapus-soal" data-id="{{ $item->id }}"
                                                                        data-nama="{{ $item->soal }}">Hapus</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <br>
                                            <!-- Pagination -->
                                            {{ $soal->links('vendor.pagination.pagination_custom') }}
                                        @else
                                            <h4 class="text-center mt-3">Tidak ada soal yang tersedia</h4>
                                        @endif
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
