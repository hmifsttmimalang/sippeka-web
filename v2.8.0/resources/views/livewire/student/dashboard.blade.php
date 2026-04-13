<div>
    @include('livewire.student.partials.header')
    @include('livewire.student.partials.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Active Test Sessions -->
                        <div class="col-12">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3 bg-white">
                                    <h6 class="m-0 font-weight-bold text-primary">Sesi Tes Tersedia</h6>
                                </div>
                                <div class="card-body mt-3">
                                    <div class="row">
                                        @forelse($activeSessions as $session)
                                            <div class="col-md-6 mb-3">
                                                <div class="card border-left-primary h-100 py-2 shadow-sm">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    {{ $session->test->category->nama }}
                                                                </div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $session->test->nama_tes }}</div>
                                                                <p class="text-muted small mt-2">
                                                                    <i class="bi bi-clock-history me-1"></i> 
                                                                    Selesai {{ \Carbon\Carbon::parse($session->waktu_selesai)->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="bi bi-journal-text fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            @if($user->status_register === 'verified')
                                                                <a href="{{ route('student.examination', ['sessionId' => $session->id]) }}" class="btn btn-primary btn-sm btn-block">
                                                                    Mulai Ujian
                                                                </a>
                                                            @else
                                                                <button disabled class="btn btn-secondary btn-sm btn-block disabled">
                                                                    Menunggu Verifikasi
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                                <p class="mt-3 text-muted">Belum ada sesi tes aktif untuk program Anda.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Status -->
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header py-3 bg-white">
                                    <h6 class="m-0 font-weight-bold text-primary">Status Pendaftaran</h6>
                                </div>
                                <div class="card-body py-4 text-center">
                                    @if($user->status_register === 'verified')
                                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold">Akun Terverifikasi</h4>
                                        <p class="text-muted">Selamat! Dokumen pendaftaran Anda telah disetujui. Anda dapat mengikuti ujian seleksi sesuai jadwal.</p>
                                    @elseif($user->status_register === 'terdaftar' || $user->status_register === 'pending')
                                        <i class="bi bi-hourglass-split text-warning" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold">Dalam Proses Verifikasi</h4>
                                        <p class="text-muted">Data pendaftaran Anda sedang ditinjau oleh tim admin. Harap tunggu hingga data Anda divalidasi.</p>
                                    @else
                                         <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold">Belum Terdaftar</h4>
                                        <a href="{{ route('pendaftaran.form') }}" class="btn btn-primary mt-2">Daftar Sekarang</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Data Diri Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3 bg-white">
                            <h6 class="m-0 font-weight-bold text-primary">Data Diri</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if($registration && $registration->foto_bg_biru)
                                    <img src="{{ asset('storage/' . $registration->foto_bg_biru) }}" alt="Foto Profil" class="img-fluid rounded border p-1" style="max-width: 150px;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center mx-auto rounded border" style="width: 150px; height: 180px;">
                                        <i class="bi bi-person text-secondary" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <h5 class="text-center font-weight-bold mb-4">{{ strtoupper($registration->nama ?? $user->name) }}</h5>
                            <ul class="list-group list-group-flush small">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Program</span>
                                    <span class="font-weight-bold text-end">{{ $registration->keahlian_rel->nama ?? '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">TTL</span>
                                    <span class="text-end">{{ $registration->tempat_lahir ?? '-' }}, {{ $registration ? date('d-m-Y', strtotime($registration->tanggal_lahir)) : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Email</span>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Telepon</span>
                                    <span>{{ $registration->telepon ?? '-' }}</span>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <a href="#" class="btn btn-outline-primary btn-sm btn-block">Edit Profil</a>
                            </div>
                        </div>
                    </div><!-- End Data Diri -->
                </div><!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
</div>
