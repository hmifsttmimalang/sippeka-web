@extends('layouts.admin_app')

@section('title', 'Peserta | Admin Sippeka')

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

            <li class="nav-item active">
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
                        <a class="collapse-item loadPage" href="{{ route('admin.sesi_tes_keahlian') }}">Sesi Tes
                            Keahlian</a>
                    </div>
                </div>
            </li>

            <li class="nav-item ">
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-3 text-gray-800 ">Data Peserta</h1>

                    @if ($listPendaftar->isNotEmpty())
                        <a href="{{ route('admin.peserta.cetak') }}" class="btn btn-warning btn-sm mb-3">Cetak Data
                            Peserta</a>

                        <div class="d-flex justify-content-between">
                            <div></div>
                            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('admin.peserta') }}">
                                <input class="form-control mr-sm-2 mb-4" type="search" name="search"
                                    placeholder="Cari Nama Peserta" aria-label="Search" value="{{ request('search') }}">
                                <button class="btn btn-primary mb-4" type="submit">Cari</button>
                            </form>
                        </div>

                        @if ($search)
                            <p>Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong></p>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr style="text-align: center; vertical-align: middle;">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Keahlian</th>
                                            <th>Nilai Tes Keahlian</th>
                                            <th>Nilai Tes Wawancara</th>
                                            <th>Rata-Rata</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listPendaftar as $index => $item)
                                            @php
                                                $rataRata =
                                                    is_null($item->nilai_keahlian) || is_null($item->nilai_wawancara)
                                                        ? null
                                                        : ($item->nilai_keahlian + $item->nilai_wawancara) / 2;
                                            @endphp
                                            <tr style="text-align: center; vertical-align: middle;">
                                                <td>{{ $index + 1 + ($listPendaftar->currentPage() - 1) * $listPendaftar->perPage() }}
                                                </td>
                                                <td style="text-align: left;">{{ $item->nama }}</td>
                                                <td style="text-align: left;">{{ $item->alamat }}</td>
                                                <td style="text-align: left;">{{ $item->keahlian_nama }}</td>
                                                <td>{{ $item->nilai_keahlian ?? 'Sedang diproses' }}</td>
                                                <td>{{ $item->nilai_wawancara ?? 'Sedang diproses' }}</td>
                                                <td>
                                                    {{ $rataRata ? $rataRata : 'Sedang diproses' }}
                                                </td>
                                                <td>
                                                    @if (is_null($rataRata))
                                                        <span class="badge badge-warning">Sedang diproses</span>
                                                    @elseif ($rataRata <= 100 && $rataRata >= 70)
                                                        <span class="badge badge-success">Lulus</span>
                                                    @elseif ($rataRata < 70)
                                                        <span class="badge badge-danger">Gagal</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.detail_peserta.cetak', ['user_id' => $item->user_id]) }}"
                                                        class="btn btn-warning btn-sm">Cetak</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <br>
                                <!-- Pagination -->
                                {{ $listPendaftar->links('vendor.pagination.pagination_custom') }}
                            @else
                                @if ($search)
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <form class="form-inline my-2 my-lg-0" method="GET"
                                            action="{{ route('admin.peserta') }}">
                                            <input class="form-control mr-sm-2 mb-4" type="search" name="search"
                                                placeholder="Cari Nama Peserta" aria-label="Search"
                                                value="{{ request('search') }}">
                                            <button class="btn btn-primary mb-4" type="submit">Cari</button>
                                        </form>
                                    </div>

                                    <h3 class="text-center mt-5">Tidak ada nama peserta yang sesuai dengan pencarian.</h3>
                                @else
                                    <h3 class="text-center mt-5">Tidak ada peserta yang terdaftar</h3>
                                @endif
                    @endif

                    {{-- Peserta Top 50 --}}
                    {{-- @if ($top50->isNotEmpty())
                        <a href="{{ route('admin.peserta.cetak') }}" class="btn btn-warning btn-sm mb-3">Cetak Data
                            Peserta</a>
                        <h3 class="text-center">Top 50 Peserta</h3>
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Keahlian</th>
                                    <th>Nilai Tes Keahlian</th>
                                    <th>Nilai Tes Wawancara</th>
                                    <th>Rata-Rata</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top50 as $index => $item)
                                    @php
                                        $rataRata =
                                            $item->nilai_keahlian && $item->nilai_wawancara
                                                ? ($item->nilai_keahlian + $item->nilai_wawancara) / 2
                                                : null;
                                    @endphp
                                    <tr style="text-align: center; vertical-align: middle;">
                                        <td>{{ $index + 1 }}</td>
                                        <td style="text-align: left;">{{ $item->nama }}</td>
                                        <td style="text-align: left;">{{ $item->alamat }}</td>
                                        <td style="text-align: left;">{{ $item->keahlian_nama }}</td>
                                        <td>{{ $item->nilai_keahlian ?? 'Sedang diproses' }}</td>
                                        <td>{{ $item->nilai_wawancara ?? 'Sedang diproses' }}</td>
                                        <td>{{ $rataRata ?? 'Sedang diproses' }}</td>
                                        <td>
                                            @if (is_null($rataRata))
                                                <span class="badge badge-warning">Sedang diproses</span>
                                            @elseif ($rataRata >= 70)
                                                <span class="badge badge-success">Lulus</span>
                                            @else
                                                <span class="badge badge-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.detail_peserta.cetak', ['user_id' => $item->user_id]) }}"
                                                class="btn btn-warning btn-sm">Cetak</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3 class="text-center mt-5">Tidak ada peserta</h3>
                    @endif --}}

                    {{-- Peserta di luar 50 besar --}}
                    {{-- @if ($outside50->isNotEmpty())
                        <h3 class="text-center mt-5">Peserta di Luar 50 Besar</h3>
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr style="text-align: center; vertical-align: middle;">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Keahlian</th>
                                    <th>Nilai Tes Keahlian</th>
                                    <th>Nilai Tes Wawancara</th>
                                    <th>Rata-Rata</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outside50 as $index => $item)
                                    @php
                                        $rataRata =
                                            $item->nilai_keahlian && $item->nilai_wawancara
                                                ? ($item->nilai_keahlian + $item->nilai_wawancara) / 2
                                                : null;
                                    @endphp
                                    <tr style="text-align: center; vertical-align: middle;">
                                        <td>{{ $index + 1 + ($outside50->currentPage() - 1) * $outside50->perPage() }}</td>
                                        <td style="text-align: left;">{{ $item->nama }}</td>
                                        <td style="text-align: left;">{{ $item->alamat }}</td>
                                        <td style="text-align: left;">{{ $item->keahlian_nama }}</td>
                                        <td>{{ $item->nilai_keahlian ?? 'Sedang diproses' }}</td>
                                        <td>{{ $item->nilai_wawancara ?? 'Sedang diproses' }}</td>
                                        <td>{{ $rataRata ?? 'Sedang diproses' }}</td>
                                        <td>
                                            @if (is_null($rataRata))
                                                <span class="badge badge-warning">Sedang diproses</span>
                                            @else
                                                <span class="badge badge-danger">Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.detail_peserta.cetak', ['user_id' => $item->user_id]) }}"
                                                class="btn btn-warning btn-sm">Cetak</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $outside50->links('vendor.pagination.pagination_custom') }}
                    @else
                        <h3 class="text-center mt-5">Tidak ada peserta di luar 50 besar</h3>
                    @endif --}}
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
