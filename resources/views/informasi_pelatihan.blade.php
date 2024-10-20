@extends('layouts.app')

@section('title', 'Halaman Utama | Sippeka')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('assets/user/img/gambar_blk.jpeg') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Informasi Seputar Pendaftaran</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">Informasi mencakup Jurusan, Tata Cara Pendaftaran dan Jadwal Tes<br></p>
                <img src="{{ asset('assets/user/img/informasi_pelatihan_fix.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
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
                <p data-aos="fade-up" data-aos-delay="100">Data yang ditampilkan merupakan jurusan yang terbuka pada saat ini!<br></p>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('assets/user/img/jurusan_terbuka.png') }}" class="img-fluid hero-img" style="border-radius: 10px;">
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
                <p data-aos="fade-up" data-aos-delay="100">Data yang ditampilkan merupakan jadwal tes pelatihan yang akan dilaksanakan mendatang!<br></p>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('assets/user/img/jadwal.png') }}" class="img-fluid hero-img" style="border-radius: 10px;">
            </div>
        </div>

    </section>
    <!-- /Jadwal Section -->

    <!-- Tata Cara Pendaftaran Section -->
    <section id="hero" class="hero section">

        <div class="hero-bg">
            <img src="{{ asset('assets/user/img/hero-bg-light.webp') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Tata Cara Pendaftaran</h1>
                <p data-aos="fade-up" data-aos-delay="100">Tata Cara Pendaftaran peserta untuk mengikuti seleksi tes!<br></p>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('assets/user/img/tata_cara_pendaftaran.png') }}" class="img-fluid hero-img" style="border-radius: 10px;">
            </div>
        </div>

    </section>
    <!-- /Tata Cara Pendaftaran Section -->

</main>
@endsection
