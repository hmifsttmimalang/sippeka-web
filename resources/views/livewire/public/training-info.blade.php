<main class="main">
    <style>
        .section-title h2 {
            font-size: 32px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
        }
        .container-card {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('assets/user/img/bg_image_card.png') }}');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            padding: 40px 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
            margin-top: 40px;
        }
        .card-custom {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
            transition: 0.3s;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .card-custom:hover {
            transform: translateY(-10px);
        }
        .step-icon {
            font-size: 30px;
            margin-bottom: 15px;
            display: block;
        }
    </style>

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('assets/user/img/gambar_blk.jpeg') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Informasi Seputar Pendaftaran</h1>
                <p data-aos="fade-up" data-aos-delay="100">Informasi mencakup Jurusan, Tata Cara Pendaftaran dan Jadwal Tes</p>
                <img src="{{ asset('assets/user/img/informasi_pelatihan_fix.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section class="section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Jurusan Yang Tersedia</h2>
            <p>Data yang ditampilkan merupakan jurusan yang terbuka pada saat ini!</p>
        </div>

        <div class="container">
            <div class="table-responsive" data-aos="fade-up" data-aos-delay="100">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Jurusan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurusan as $key => $data)
                            <tr>
                                <td class="text-center">{{ $jurusan->firstItem() + $key }}</td>
                                <td class="fw-bold">{{ $data->nama_jurusan }}</td>
                                <td class="text-center">{{ $data->kuota }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $data->status === 'dibuka' ? 'bg-success' : ($data->status === 'penuh' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $statusList[$data->status] ?? 'Tutup' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Tidak ada jurusan yang tersedia saat ini</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $jurusan->links() }}
            </div>
        </div>
    </section>

    <!-- Jadwal Section -->
    <section class="section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Jadwal Tes</h2>
            <p>Jadwal tes pelatihan yang akan dilaksanakan mendatang!</p>
        </div>

        <div class="container">
            <div class="table-responsive" data-aos="fade-up" data-aos-delay="100">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Jurusan</th>
                            <th class="text-center">Tanggal Pelaksanaan</th>
                            <th class="text-center">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalTes as $index => $jadwal)
                            <tr>
                                <td class="text-center">{{ $jadwalTes->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $jadwal->jurusan->nama_jurusan }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($jadwal->tanggal_pelaksanaan)->translatedFormat('d F Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($jadwal->waktu_pelaksanaan)->format('H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Jadwal tes belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $jadwalTes->links() }}
            </div>
        </div>
    </section>

    <!-- Tata Cara Section -->
    <section class="section light-background pb-5">
        <div class="container">
            <div class="container-card text-center" data-aos="zoom-in">
                <h2 class="text-white mb-2">TATA CARA PENDAFTARAN</h2>
                <p class="text-white-50">CUKUP BEBERAPA LANGKAH MUDAH</p>

                <div class="row g-4 mt-4 px-3">
                    @php
                        $steps = [
                            ['1', 'Buat Akun', 'Klik tombol buat akun pada navigasi utama.', 'step_1.png'],
                            ['2', 'Isi Informasi', 'Masukkan nama, email, username dan password.', 'step_2.png'],
                            ['3', 'Profil & Berkas', 'Lengkapi biodata dan upload foto 4x6.', 'step_3.png'],
                            ['4', 'Registrasi Selesai', 'Anda akan masuk ke Dashboard untuk simulasi.', 'step_6.png'],
                        ];
                    @endphp

                    @foreach($steps as $step)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="card-custom text-dark">
                                <span class="step-icon">0{{ $step[0] }}</span>
                                <h5 class="fw-bold mb-3">{{ $step[1] }}</h5>
                                <p class="small text-muted mb-4">{{ $step[2] }}</p>
                                <img src="{{ asset('assets/user/img/' . $step[3]) }}" class="img-fluid rounded shadow-sm">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
