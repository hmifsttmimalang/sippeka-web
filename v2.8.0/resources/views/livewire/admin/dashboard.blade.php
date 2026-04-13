<div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('livewire.admin.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('livewire.admin.partials.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
                    <div class="row">

                        <!-- Card Pendaftar Masuk -->
                        <div class="col-md-6">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h3 font-weight-bold text-info text-uppercase mb-1">
                                                Pendaftar Masuk
                                            </div>
                                            <div class="h5 mt-3 font-weight-bold">
                                                {{ $totalPendaftar }} Orang
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{ $progressPendaftar }}%"
                                                            aria-valuenow="{{ $progressPendaftar }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300" style="font-size: 90px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Pendaftar Lolos Seleksi -->
                        <div class="col-md-6">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h3 font-weight-bold text-success text-uppercase mb-1">
                                                Lolos Seleksi
                                            </div>
                                            <div class="h5 mt-3 font-weight-bold">
                                                {{ $pendaftarLolos }} Orang
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $progressLolos }}%"
                                                            aria-valuenow="{{ $progressLolos }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300" style="font-size: 90px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3">

                    <h2 class="text-gray-800">Data Pendaftar Baru</h2>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($listPendaftarBaru->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mt-3">
                                        <thead class="thead-dark">
                                            <tr style="text-align: center; vertical-align: middle;">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Keahlian</th>
                                                <th>Waktu Mendaftar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listPendaftarBaru as $index => $item)
                                                <tr style="text-align: center; vertical-align: middle;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td style="text-align: left;">{{ $item->nama }}</td>
                                                    <td>{{ $item->skill->nama ?? 'Umum' }}</td>
                                                    <td>{{ $item->created_at->translatedFormat('d F Y H.i') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h4 class="text-center mt-4 text-gray-400">Tidak ada pendaftar baru dalam 24 jam
                                    terakhir</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
