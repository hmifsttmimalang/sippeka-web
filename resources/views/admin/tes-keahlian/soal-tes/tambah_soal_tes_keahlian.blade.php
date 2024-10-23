@extends('layouts.admin_app')

@section('title', 'Tambah Soal Tes Keahlian | Admin Sippeka')

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

            <li class="nav-item">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-folder-plus"></i>
                    <span>Kelola Informasi</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item loadPage" href="{{ route('admin.info_jurusan') }}">Jurusan</a>
                        <a class="collapse-item loadPage" href="{{ route('admin.jadwal_tes') }}">Jadwal Tes</a>
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
                                    src="../../../../assets/admin/img/undraw_profile.svg">
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
                    <!-- Button Kembali -->
                    <a href="{{ route('admin.ujian.detail', ['id' => $tesKeahlian->id]) }}"
                        class="btn btn-primary btn-sm loadPage">Kembali</a>
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <div class="">
                                            <h1 class="h4 text-gray-900 mb-4">Tambah Soal Tes Keahlian</h1>
                                        </div>
                                        <hr class="divider-sidebar">
                                        <form action="{{ route('admin.soal.store', ['id' => $tesKeahlian->id]) }}"
                                            method="post">
                                            <table class="table table-bordered table-hover right-align">
                                                @csrf
                                                @method('POST')
                                                <tr>
                                                    <td>
                                                        <label for="soal">
                                                            <b>Soal</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div id="editor"></div>
                                                        <input type="hidden" name="soal" id="soal_hidden" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="pilihan_a">
                                                            <b>Pilihan A.</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div id="editor1"></div>
                                                        <input type="hidden" name="pilihan_a" id="pilihan_a_hidden" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="pilihan_b">
                                                            <b>Pilihan B.</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div id="editor2"></div>
                                                        <input type="hidden" name="pilihan_b" id="pilihan_b_hidden" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="pilihan_c">
                                                            <b>Pilihan C.</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div id="editor3"></div>
                                                        <input type="hidden" name="pilihan_c" id="pilihan_c_hidden" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="pilihan_d">
                                                            <b>Pilihan D.</b>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div id="editor4"></div>
                                                        <input type="hidden" name="pilihan_d" id="pilihan_d_hidden" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td for="jawaban_benar"><b>Jawaban Benar</b></td>
                                                    <td>
                                                        <select name="jawaban_benar" id="jawaban_benar"
                                                            class="form-control">
                                                            <option value="">Pilih Jawaban</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                            <button type="button" class="btn btn-primary btn-tambah-soal">
                                                Simpan
                                            </button>
                                            <a href="" class="btn btn-primary">
                                                Reset
                                            </a>
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

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        const quill1 = new Quill('#editor1', {
            theme: 'snow'
        });
        const quill2 = new Quill('#editor2', {
            theme: 'snow'
        });
        const quill3 = new Quill('#editor3', {
            theme: 'snow'
        });
        const quill4 = new Quill('#editor4', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            const html = quill.root.innerHTML;
            document.getElementById('soal_hidden').value = html;
        });

        quill1.on('text-change', function() {
            const html = quill1.root.innerHTML;
            document.getElementById('pilihan_a_hidden').value = html;
        });

        quill2.on('text-change', function() {
            const html = quill2.root.innerHTML;
            document.getElementById('pilihan_b_hidden').value = html;
        });

        quill3.on('text-change', function() {
            const html = quill3.root.innerHTML;
            document.getElementById('pilihan_c_hidden').value = html;
        });

        quill4.on('text-change', function() {
            const html = quill4.root.innerHTML;
            document.getElementById('pilihan_d_hidden').value = html;
        });
    </script>
@endsection
