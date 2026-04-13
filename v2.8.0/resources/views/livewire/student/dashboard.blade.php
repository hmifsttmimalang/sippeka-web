<div>
    @include('livewire.student.partials.header')
    @include('livewire.student.partials.sidebar')

    <style>
        .premium-card-result {
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            animation: slideUpFade 0.7s ease-out;
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .result-icon-container {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .result-icon-container.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .result-icon-container.danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .result-icon-container.pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        }

        .result-icon-container i {
            color: white;
            font-size: 3rem;
        }

        .score-pill {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            padding: 1.5rem 3rem;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .status-title {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .bg-lulus { background: linear-gradient(180deg, #f0fdf4 0%, #ffffff 100%); }
        .bg-gagal { background: linear-gradient(180deg, #fef2f2 0%, #ffffff 100%); }
        .bg-proses { background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); }
    </style>

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
                                        {{-- Active & Finished Sessions --}}
                                        @foreach($activeSessions as $session)
                                            <div class="col-md-6 mb-3">
                                                <div @class([
                                                    'card h-100 py-2 shadow-sm border-left-primary' => $session->jenis_sesi === 'Seleksi',
                                                    'card h-100 py-2 shadow-sm border-left-info' => $session->jenis_sesi === 'Simulasi',
                                                ])>
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div @class([
                                                                    'text-xs font-weight-bold text-uppercase mb-1',
                                                                    'text-primary' => $session->jenis_sesi === 'Seleksi',
                                                                    'text-info' => $session->jenis_sesi === 'Simulasi',
                                                                ])>
                                                                    {{ $session->jenis_sesi }} - {{ $session->test->category->nama }}
                                                                </div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $session->test->nama_tes }}</div>
                                                                <p class="text-muted small mt-2 mb-0">
                                                                    <i class="bi bi-clock-history me-1 text-danger"></i> 
                                                                    @if($session->student_status === 'finished')
                                                                       Selesai pada {{ \Carbon\Carbon::parse($session->waktu_selesai)->translatedFormat('H:i') }}
                                                                    @else
                                                                       Berakhir pada {{ \Carbon\Carbon::parse($session->waktu_selesai)->translatedFormat('d F, H:i') }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                @if($session->student_status === 'finished')
                                                                   <span class="badge bg-success small">Selesai</span>
                                                                @else
                                                                   <span class="badge bg-primary small">Aktif</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            @if($session->student_status === 'finished')
                                                               <button disabled class="btn btn-secondary btn-sm w-100 disabled">
                                                                   <i class="bi bi-check-all me-1"></i> Sudah Dikerjakan
                                                               </button>
                                                            @elseif($registration && $registration->verification_status === 'Approved')
                                                                <a href="{{ route('student.examination', ['sessionId' => $session->id]) }}" 
                                                                   class="btn @if($session->jenis_sesi === 'Seleksi') btn-primary @else btn-info text-white @endif btn-sm w-100 font-weight-bold">
                                                                    Mulai {{ $session->jenis_sesi }}
                                                                </a>
                                                            @else
                                                                <button disabled class="btn btn-secondary btn-sm w-100 disabled">
                                                                    Menunggu Verifikasi
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Upcoming Sessions --}}
                                        @foreach($upcomingSessions as $session)
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 py-2 shadow-sm border-left-secondary bg-light">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center opacity-75">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                                    {{ $session->jenis_sesi }} - {{ $session->test->category->nama }}
                                                                </div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-600">{{ $session->test->nama_tes }}</div>
                                                                <p class="text-muted extra-small mt-2 mb-0 italic">
                                                                    <i class="bi bi-calendar-event me-1"></i> 
                                                                    Mulai {{ \Carbon\Carbon::parse($session->waktu_mulai)->translatedFormat('d F, H:i') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <span class="badge bg-secondary small">Mendatang</span>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button disabled class="btn btn-outline-secondary btn-sm w-100 disabled">
                                                                Belum Dimulai
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Late / Missed Sessions --}}
                                        @foreach($lateSessions as $session)
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 py-2 shadow-sm border-left-danger bg-light">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center opacity-75">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                                    {{ $session->jenis_sesi }} - {{ $session->test->category->nama }}
                                                                </div>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-500">{{ $session->test->nama_tes }}</div>
                                                                <p class="text-danger extra-small mt-2 mb-0 italic">
                                                                    <i class="bi bi-exclamation-circle me-1"></i> 
                                                                    Sesi Berakhir pada {{ \Carbon\Carbon::parse($session->waktu_selesai)->translatedFormat('H:i') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <span class="badge bg-danger small">Terlambat</span>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button disabled class="btn btn-outline-danger btn-sm w-100 disabled">
                                                                Sesi Telah Berakhir
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($activeSessions->isEmpty() && $upcomingSessions->isEmpty() && $lateSessions->isEmpty())
                                            <div class="col-12 text-center py-5">
                                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                                <p class="mt-3 text-muted">Belum ada sesi tes aktif maupun mendatang untuk program Anda.</p>
                                            </div>
                                        @endif
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

                        <!-- Hasil Penilaian (Premium Redesign) -->
                        <div class="col-12 mb-4">
                            <div @class([
                                'card shadow-sm border-0 premium-card-result',
                                'bg-proses' => !$showAnnouncement,
                                'bg-lulus' => $showAnnouncement && $statusSeleksi === 'Lulus',
                                'bg-gagal' => $showAnnouncement && $statusSeleksi === 'Tidak Lulus',
                                'bg-proses' => $showAnnouncement && $statusSeleksi === 'Sedang Diproses'
                            ])>
                                <div class="card-header py-3 bg-transparent border-0 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary text-uppercase tracking-widest" style="font-size: 0.7rem;">Hasil Seleksi & Pengumuman</h6>
                                    @if($showAnnouncement)
                                        <span class="badge rounded-pill @if($statusSeleksi === 'Lulus') bg-success @else bg-danger @endif">OFFICIAL</span>
                                    @endif
                                </div>
                                <div class="card-body py-5 text-center">
                                    @if (!$showAnnouncement)
                                        <div class="space-y-4">
                                            <div class="result-icon-container pending">
                                                <i class="bi bi-hourglass-top"></i>
                                            </div>
                                            <h4 class="font-weight-bold text-dark">Proses Penilaian</h4>
                                            <p class="text-muted px-lg-5 small mt-2">Terima kasih telah mengikuti seleksi tes keahlian di SIPPEKA. Saat ini hasil pengerjaan Anda sedang ditinjau oleh tim Panitia Seleksi.</p>
                                            <div class="mt-4 badge bg-primary px-4 py-2 rounded-pill font-weight-bold shadow-sm" style="font-size: 0.9rem;">
                                                Pengumuman: {{ $formattedAnnouncementDate ?? 'Segera' }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="space-y-4">
                                            @if ($statusSeleksi === 'Sedang Diproses')
                                                <div class="result-icon-container pending">
                                                    <i class="bi bi-arrow-repeat spin"></i>
                                                </div>
                                                <h4 class="status-title text-warning">Sedang Diproses</h4>
                                                <p class="text-muted small px-lg-5">Nilai Anda sedang dikalkulasi oleh sistem. Silakan muat ulang halaman beberapa saat lagi.</p>
                                            @elseif ($statusSeleksi === 'Lulus')
                                                <div class="result-icon-container success">
                                                    <i class="bi bi-award-fill"></i>
                                                </div>
                                                <h2 class="status-title text-success">SELAMAT! ANDA LOLOS</h2>
                                                <p class="text-muted px-lg-5 mb-4">Anda dinyatakan <strong>Lulus</strong> seleksi pelatihan di SIPPEKA Balai UPT Singosari. Silakan lakukan daftar ulang ke kantor pusat sesuai jadwal yang diinstruksikan.</p>
                                                
                                                <div class="score-pill">
                                                    <span class="text-muted font-weight-bold uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 2px;">SKOR AKHIR</span>
                                                    <span class="text-4xl font-black text-success" style="font-size: 3rem; line-height: 1;">{{ number_format($rataRata, 1) }}</span>
                                                </div>
                                            @elseif ($statusSeleksi === 'Tidak Lulus')
                                                <div class="result-icon-container danger">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </div>
                                                <h4 class="status-title text-danger">BELUM LOLOS</h4>
                                                <p class="text-muted px-lg-5 mb-4">Terima kasih atas partisipasi Anda. Sayangnya, akumulasi nilai Anda belum memenuhi ambang batas kelulusan untuk periode ini. Tetap semangat!</p>
                                                
                                                <div class="score-pill">
                                                    <span class="text-muted font-weight-bold uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 2px;">SKOR AKHIR</span>
                                                    <span class="text-4xl font-black text-danger" style="font-size: 3rem; line-height: 1;">{{ number_format($rataRata, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-0 pb-4">
                                     <marquee class="font-weight-bold text-primary small uppercase tracking-widest opacity-50">SIPPEKA BALAI UPT SINGOSARI - MELAYANI DENGAN HATI - TEKNOLOGI UNTUK MASYARAKAT</marquee>
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
                                    <span class="font-weight-bold text-end">{{ $registration->skill->nama ?? '-' }}</span>
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
