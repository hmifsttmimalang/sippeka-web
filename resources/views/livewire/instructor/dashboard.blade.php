<div>
    <div id="wrapper">
        <!-- Sidebar -->
        @include('livewire.instructor.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('livewire.instructor.partials.topbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Dashboard Instruktur</h1>
                    
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
                                                {{ $totalRegistrations }} Orang
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{ $registrationProgress }}%"
                                                            aria-valuenow="{{ $registrationProgress }}" aria-valuemin="0"
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
                                                {{ $passedRegistrations }} Orang
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $passRateProgress }}%"
                                                            aria-valuenow="{{ $passRateProgress }}" aria-valuemin="0"
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

                    <h2 class="h4 text-gray-800 font-weight-bold">Data Pendaftar Baru (24 Jam Terakhir)</h2>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($latestEvaluations->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mt-3">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Keahlian</th>
                                            <th>Waktu Mendaftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestEvaluations as $registration)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-left font-weight-bold">{{ $registration->name }}</td>
                                                <td>{{ $registration->skill->name ?? 'Umum' }}</td>
                                                <td>{{ $registration->created_at->translatedFormat('d F Y H.i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="text-center mt-5">
                                    <img src="{{ asset('assets/admin/img/undraw_no_data.svg') }}" style="width: 200px; opacity: 0.5;">
                                    <h4 class="mt-4 text-gray-400">Belum ada pendaftar baru</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
