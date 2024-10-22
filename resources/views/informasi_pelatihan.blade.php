@extends('layouts.app')

@section('title', 'Halaman Informasi Pelatihan | Sippeka')

@section('content')
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }

            body {
                -webkit-print-color-adjust: exact;
                font-family: Arial, sans-serif;
            }

            .container {
                margin: 0;
            }

            .icon {
                font-size: 35px;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }

        h1 {
            color: #000000;
            font-weight: bold;
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #000000;
            font-weight: 700;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .container-card {
            background-image: url('{{ asset('assets/user/img/bg_image_card.png') }}');
            /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover;
            /* Mengatur agar gambar menutupi seluruh area */
            background-position: center;
            /* Memposisikan gambar di tengah */
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #dcdcdc;
            color: white;
            /* Mengubah warna teks agar lebih kontras dengan background */
        }

        .card h3 {
            color: #3498db;
            font-size: 20px;
            text-align: center;
            padding-top: 10px;
        }

        .card p {
            font-size: 14px;
            color: #000000;
            padding: 0 20px;
            text-align: justify;
        }

        .icon {
            text-align: center;
            font-size: 35px;
            padding: 10px 0;
            color: #f39c12;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #34495e;
        }

        .highlight {
            color: #000000;
        }

        .row {
            margin-bottom: 20px;
        }
    </style>
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="{{ asset('assets/user/img/gambar_blk.jpeg') }}" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Informasi Seputar Pendaftaran</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100">Informasi mencakup Jurusan, Tata Cara Pendaftaran dan Jadwal
                        Tes<br></p>
                    <img src="{{ asset('assets/user/img/informasi_pelatihan_fix.png') }}" class="img-fluid hero-img"
                        alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Jurusan Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="{{ asset('assets/user/img/hero-bg-light.webp') }}" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Jurusan Yang Tersedia</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Data yang ditampilkan merupakan jurusan yang terbuka pada
                        saat ini!<br></p>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('assets/user/img/jurusan_terbuka.png') }}" class="img-fluid hero-img"
                        style="border-radius: 10px;">
                </div>
            </div>

        </section>
        <!-- /Jurusan Section -->

        <!-- Jadwal Section -->
        <section id="hero" class="hero section">

            <div class="hero-bg">
                <img src="{{ asset('assets/user/img/hero-bg-light.webp') }}" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Jadwal Tes</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Data yang ditampilkan merupakan jadwal tes pelatihan yang
                        akan dilaksanakan mendatang!<br></p>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('assets/user/img/jadwal.png') }}" class="img-fluid hero-img"
                        style="border-radius: 10px;">
                </div>
            </div>
        </section>
        <!-- /Jadwal Section -->

        <!-- Tata Cara Pendaftaran Section -->
        <section id="hero" class="hero section">
            <div class="container-card">
                <h1 class="highlight">TATA CARA PENDAFTARAN BAGI CALON PESERTA</h1>
                <h2 class="section-title">CUKUP 4 LANGKAH</h2>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">1️⃣</div>
                            <h3>Buat Akun</h3>
                            <p class="text-center">Pada navigasi atau menu klik <br>tombol buat akun.</p>
                            <img src="{{ asset('assets/user/img/step_1.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">2️⃣</div>
                            <h3>Isi Informasi</h3>
                            <p>Masukkan informasi yang diperlukan seperti nama, email, username dan password. Lalu klik buat
                                akun</p>
                            <img src="{{ asset('assets/user/img/step_2.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">3️⃣</div>
                            <h3>Klik Tombol Username</h3>
                            <p>Anda akan diarahkan kembali ke halaman beranda, cari dan klik pada menu tombol username Anda.
                            </p>
                            <img src="{{ asset('assets/user/img/step_3.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">4️⃣</div>
                            <h3>Isi Form Registrasi</h3>
                            <p>Setelah masuk pada Form Registrasi, isi informasi yang dibutuhkan dan siapkan foto dengan
                                ukuran
                                4x6. Jika selesai klik tombol Registrasi.</p>
                            <img src="{{ asset('assets/user/img/step_4.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">5️⃣</div>
                            <h3>Klik Kembali Ke Halaman Utama</h3>
                            <p>Setelah mengisi dan klik tombol Registrasi, maka Anda akan diarahkan ke halaman Beranda lagi.
                            </p>
                            <img src="{{ asset('assets/user/img/step_5.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">6️⃣</div>
                            <h3>Klik Tombol Username Untuk Masuk</h3>
                            <p>Setelah berada di halaman beranda kembali, cari dan klik pada menu tombol username Anda lagi.
                            </p>
                            <img src="{{ asset('assets/user/img/step_3.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="icon">7️⃣</div>
                            <h3>Berhasil Masuk Ke Dashboard</h3>
                            <p>Setelah menekan tombol username, maka Anda telah selesai melakukan proses mendaftar sebagai
                                calon
                                peserta. Disini anda bisa melakukan edit profil dan juga simulasi tes sebelum jadwal tes
                                Anda
                                dilaksanakan.</p>
                            <img src="{{ asset('assets/user/img/step_6.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Tata Cara Pendaftaran Section -->

    </main>
@endsection
