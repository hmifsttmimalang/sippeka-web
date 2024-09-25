@extends('layouts.admin_app')

@section('title', 'Tes Keahlian | Admin Sippeka')

@section('content')
    <style>
        .swal2-button-space .swal2-confirm {
            margin-left: 10px;
            /* Tambahkan jarak antara tombol cancel dan confirm */
        }

        .swal2-button-space .swal2-cancel {
            margin-right: 10px;
            /* Tambahkan jarak antara confirm dan cancel */
        }
    </style>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" id="loadPage" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-text mx-3">Admin SIPPEKA</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" id="loadPage" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item ">
                <a class="nav-link" id="loadPage" href="{{ route('admin.kelola_data') }}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Data Peserta</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" id="loadPage" href="{{ route('admin.peserta') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Peserta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="loadPage" href="{{ route('admin.info_user') }}">
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
                        <a class="collapse-item" id="loadPage" href="{{ route('admin.mata_soal') }}">Mata Soal Keahlian</a>
                        <a class="collapse-item" id="loadPage" href="{{ route('admin.kelas_keahlian') }}">Kelas Keahlian</a>
                        <a class="collapse-item active" id="loadPage" href="{{ route('admin.tes_keahlian') }}">Tes Keahlian</a>
                        <a class="collapse-item" id="loadPage" href="{{ route('admin.sesi_tes_keahlian') }}">Sesi Tes Keahlian</a>
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-3 text-gray-800 ">Tes Keahlian</h1>

                    <!-- Button Add Data -->
                    <div class="d-flex justify-content-left">
                        <div></div>
                        <form action="" class="form-inline my-2 my-lg-0">
                            <a href="{{ route('admin.tes_keahlian.create') }}"
                                class="btn btn-primary btn-sm mr-sm-4 mb-4">Tambah</a>
                        </form>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($tesKeahlian->isNotEmpty())
                        <!-- Search Bar -->
                        <div class="d-flex justify-content-between">
                            <div></div>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2 mb-4" type="search" placeholder="Search"
                                    aria-label="Search">
                            </form>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center; vertical-align: middle;">
                                        <th>No</th>
                                        <th>Nama Tes Keahlian</th>
                                        <th>Mata Keahlian</th>
                                        <th>Kelas Keahlian</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($tesKeahlian as $index => $item)
                                            <tr style="text-align: center; vertical-align: middle;">
                                                <td>{{ $index + 1 + ($tesKeahlian->currentPage() - 1) * $tesKeahlian->perPage() }}
                                                </td>
                                                <td style="text-align: left;">Tes - {{ $item->nama_tes }}</td>
                                                <td style="text-align: left;">{{ $item->mata_soal_nama }}</td>
                                                <td style="text-align: left;">{{ $item->keahlian_nama }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.tes_keahlian.delete', ['id' => $item->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.ujian.detail', ['id' => $item->id]) }}"
                                                            class="btn btn-secondary btn-sm">Lihat</a>
                                                        <a href="{{ route('admin.tes_keahlian.edit', ['id' => $item->id]) }}"
                                                            class="btn btn-primary btn-sm">Ubah</a>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm" id="btn-hapus" data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_tes }}">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <br>
                                <!-- Pagination -->
                                {{ $tesKeahlian->links('vendor.pagination.pagination_custom') }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-center mt-2">Tidak ada tes yang tersedia</h3>
                    @endif
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll("#btn-hapus").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const form = this.closest("form");

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: "btn btn-primary",
                        confirmButton: "btn btn-danger",
                        actions: "swal2-button-space",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Apakah kamu ingin menghapus data ini?",
                        text: `ID: ${id} - Nama Tes: ${nama}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Iya",
                        cancelButtonText: "Tidak",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil dihapus!",
                                    icon: "success",
                                })
                                .then(() => {
                                    form.submit();
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Data tidak jadi dihapus!",
                                icon: "error",
                            });
                        }
                    });
            });
        });
    </script>
@endsection
