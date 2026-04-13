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

            @if($registration && $registration->verification_status === 'Pending')
                <div class="alert alert-warning border-0 shadow-sm" role="alert">
                    <h5 class="alert-heading font-weight-bold"><i class="bi bi-info-circle me-2"></i> Verifikasi Berkas Sedang Berlangsung</h5>
                    <p class="mb-0">Data pendaftaran dan dokumen Anda sedang dalam tahap peninjauan oleh admin. Selama masa ini, fitur ujian dan ubah profil dinonaktifkan. Harap mengecek halaman ini secara berkala.</p>
                </div>
            @elseif($registration && $registration->verification_status === 'Rejected')
                <div class="alert alert-danger border-0 shadow-sm" role="alert">
                    <h5 class="alert-heading font-weight-bold"><i class="bi bi-exclamation-triangle me-2"></i> Verifikasi Berkas Ditolak</h5>
                    <p>Mohon maaf, berkas pendaftaran Anda belum disetujui. Catatan dari Admin:</p>
                    <div class="p-3 bg-white rounded text-danger border border-danger mb-2">
                        <strong>"{{ $registration->verification_notes ?? 'Tidak ada detail catatan.' }}"</strong>
                    </div>
                    <p class="mb-0">Silakan melengkapi kekurangan/kesalahan data pada menu <strong>Edit Profil</strong> agar dapat divalidasi kembali.</p>
                </div>
            @elseif($registration && $registration->verification_status === 'Approved')
                <div class="alert alert-success border-0 shadow-sm" role="alert">
                    <h5 class="alert-heading font-weight-bold"><i class="bi bi-check-circle me-2"></i> Berkas Disetujui</h5>
                    <p class="mb-0">Data Anda telah tervalidasi. Anda kini bisa mengikuti Ujian Seleksi maupun Simulasi pada sesi yang tersedia.</p>
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
                                                            @if($registration && $registration->verification_status === 'Approved')
                                                                <a href="{{ route('student.examination', ['sessionId' => $session->id]) }}" class="btn btn-primary btn-sm btn-block">
                                                                    Mulai Ujian
                                                                </a>
                                                            @elseif($registration && $registration->verification_status === 'Rejected')
                                                                <button disabled class="btn btn-danger btn-sm btn-block disabled">
                                                                    Perbaiki Berkas Dulu
                                                                </button>
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
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3 bg-white">
                                    <h6 class="m-0 font-weight-bold text-primary">Status Pendaftaran</h6>
                                </div>
                                <div class="card-body py-4 text-center">
                                    @if($registration && $registration->verification_status === 'Approved')
                                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold text-slate-900">Akun Terverifikasi</h4>
                                        <p class="text-muted small px-lg-5">Selamat! Dokumen pendaftaran Anda telah disetujui. Anda dapat mengikuti ujian seleksi pada sesi yang tersedia di bawah.</p>
                                    @elseif($registration && $registration->verification_status === 'Rejected')
                                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold text-slate-900">Berkas Ditolak</h4>
                                        <p class="text-muted small px-lg-5">Silakan cek pesan Admin pada alert merah di atas, dan perbarui kelengkapan dokumen Anda melalui menu Edit Profil.</p>
                                    @elseif($registration && $registration->verification_status === 'Pending')
                                        <i class="bi bi-hourglass-split text-warning" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold text-slate-900">Dalam Proses Verifikasi</h4>
                                        <p class="text-muted small px-lg-5">Data pendaftaran Anda sedang ditinjau oleh tim admin. Harap tunggu hingga data Anda divalidasi sebelum bisa mengikuti ujian.</p>
                                    @else
                                         <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 font-weight-bold text-slate-900">Belum Terdaftar</h4>
                                        <a href="{{ route('pendaftaran.form') }}" class="btn btn-primary mt-2">Daftar Sekarang</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Hasil Penilaian (Legacy Feature) -->
                        <div class="col-12 mb-4">
                            <div @class([
                                'card shadow-sm border-0 overflow-hidden',
                                'bg-white' => !$showAnnouncement,
                                'bg-emerald-50' => $showAnnouncement && $statusSeleksi === 'Lulus',
                                'bg-rose-50' => $showAnnouncement && $statusSeleksi === 'Tidak Lulus',
                                'bg-slate-50' => $showAnnouncement && $statusSeleksi === 'Sedang Diproses'
                            ])>
                                <div class="card-header py-3 bg-transparent border-0">
                                    <h6 class="m-0 font-weight-bold text-primary text-uppercase tracking-wider" style="font-size: 0.75rem;">Hasil Seleksi & Pengumuman</h6>
                                </div>
                                <div class="card-body py-5 text-center">
                                    @if (!$showAnnouncement)
                                        <div class="space-y-4">
                                            <div class="w-20 h-20 bg-amber-50 rounded-full flex items-center justify-center mx-auto text-amber-500 mb-4">
                                                <i class="bi bi-clock-history" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <h4 class="font-weight-bold text-slate-900">Proses Penilaian</h4>
                                            <p class="text-muted small mt-2">Terima kasih telah mengikuti seleksi tes keahlian di SIPPEKA. Pengumuman hasil akan dirilis pada:</p>
                                            <div class="mt-4 badge bg-primary px-4 py-2 rounded-pill font-weight-bold" style="font-size: 1rem;">
                                                {{ $formattedAnnouncementDate ?? 'Segera Diumumkan' }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="space-y-4">
                                            @if ($statusSeleksi === 'Sedang Diproses')
                                                <i class="bi bi-arrow-repeat text-warning spin" style="font-size: 4rem;"></i>
                                                <h4 class="mt-3 font-weight-bold text-slate-900">Sedang Diproses</h4>
                                                <p class="text-muted small">Nilai Anda sedang dikalkulasi oleh sistem. Silakan muat ulang halaman beberapa saat lagi.</p>
                                            @elseif ($statusSeleksi === 'Lulus')
                                                <div class="w-24 h-24 bg-emerald-500 rounded-full flex items-center justify-center mx-auto text-white mb-4 shadow-lg shadow-emerald-200">
                                                    <i class="bi bi-award" style="font-size: 3rem;"></i>
                                                </div>
                                                <h2 class="font-weight-bold text-emerald-900">SELAMAT! ANDA LOLOS</h2>
                                                <p class="text-emerald-700/80 small px-lg-5 mt-2">Anda dinyatakan **Lulus** seleksi pelatihan di SIPPEKA Balai UPT Singosari. Silakan lakukan daftar ulang ke kantor pusat sesuai jadwal yang diinstruksikan.</p>
                                                <div class="mt-4 p-3 bg-emerald-100/50 rounded-3xl inline-block border border-emerald-200 px-5">
                                                    <span class="text-xs text-emerald-600 font-weight-bold uppercase mb-1 d-block tracking-widest">Skor Akhir</span>
                                                    <span class="text-3xl font-black text-emerald-700">{{ number_format($rataRata, 1) }}</span>
                                                </div>
                                            @elseif ($statusSeleksi === 'Tidak Lulus')
                                                <div class="w-24 h-24 bg-rose-500 rounded-full flex items-center justify-center mx-auto text-white mb-4 shadow-lg shadow-rose-200">
                                                    <i class="bi bi-x-lg" style="font-size: 3rem;"></i>
                                                </div>
                                                <h4 class="font-weight-bold text-rose-900">BELUM LOLOS</h4>
                                                <p class="text-rose-700/80 small px-lg-5 mt-2">Terima kasih telah berpartisipasi. Sayangnya, nilai Anda belum memenuhi ambang batas kelulusan. Jangan menyerah dan silakan coba lagi di periode pendaftaran berikutnya.</p>
                                                <div class="mt-4 p-3 bg-rose-100/50 rounded-3xl inline-block border border-rose-200 px-5">
                                                    <span class="text-xs text-rose-600 font-weight-bold uppercase mb-1 d-block tracking-widest">Skor Akhir</span>
                                                    <span class="text-3xl font-black text-rose-700">{{ number_format($rataRata, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-0 pb-4">
                                     <marquee class="font-weight-bold text-primary small uppercase tracking-widest">SIPPEKA BALAI UPT SINGOSARI - MELAYANI DENGAN HATI - TEKNOLOGI UNTUK MASYARAKAT</marquee>
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
                                @if($registration && $registration->verification_status === 'Pending')
                                    <button disabled class="btn btn-outline-secondary btn-sm btn-block disabled" title="Sedang divalidasi admin">Edit Profil Terkunci</button>
                                @else
                                    <a href="{{ route('student.edit_profile') }}" class="btn btn-outline-primary btn-sm btn-block">Edit Profil</a>
                                @endif
                            </div>
                        </div>
                    </div><!-- End Data Diri -->
                </div><!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
</div>
