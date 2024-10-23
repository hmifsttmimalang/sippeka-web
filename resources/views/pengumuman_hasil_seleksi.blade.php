@extends('layouts.info_app')

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
                <h1 data-aos="fade-up">Hasil peserta</h1>
                <p data-aos="fade-up" data-aos-delay="100">Hasil pengumuman peserta<br></p>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                {{-- <img src="{{ asset('assets/user/img/jurusan_terbuka.png') }}" class="img-fluid hero-img" style="border-radius: 10px;"> --}}

                @if ($listPendaftar->isNotEmpty())
                {{-- <a href="{{ route('admin.peserta.cetak') }}" class="btn btn-warning btn-sm mb-3">Cetak Data
                    Peserta</a> --}}

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
                                    {{-- <th>Aksi</th> --}}
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
                                                {{-- <span class="badge badge-success">Lulus</span> --}}
                                                <span>Lulus</span>
                                            @elseif ($rataRata < 70)
                                                {{-- <span class="badge badge-danger">Gagal</span> --}}
                                                <span>Gagal</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('admin.detail_peserta.cetak', ['user_id' => $item->user_id]) }}"
                                                class="btn btn-warning btn-sm">Cetak</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <!-- Pagination -->
                        {{ $listPendaftar->links('vendor.pagination.pagination_custom') }}
            @endif
            </div>
        </div>
    </section>
    <!-- /Pengumuman Section -->

</main>
@endsection
