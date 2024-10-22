@extends('layouts.app')

@section('title', 'Halaman Informasi Pelatihan | Sippeka')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('assets/user/img/gambar_blk.jpeg') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Pengumuman Hasil Seleksi</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">Informasi mencakup nilai tes ujian dan tes wawancara serta status seleksi.<br></p>
                <img src="{{ asset('assets/user/img/pengumuman_icon.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>

    </section>
    <!-- /Hero Section -->

    <!-- Pengumuman Section -->
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
    <!-- /Pengumuman Section -->

</main>
@endsection
