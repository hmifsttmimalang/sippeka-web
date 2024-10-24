@extends('layouts.info_app')

@section('title', 'Halaman Informasi Pelatihan | Sippeka')

@section('content')
    <style>
        .hidden {
            display: none;
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
                    <h1 data-aos="fade-up">Pengumuman Hasil Seleksi</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100">Informasi mencakup nilai tes ujian dan tes wawancara serta
                        status seleksi.<br></p>
                    <img src="{{ asset('assets/user/img/pengumuman_icon.png') }}" class="img-fluid hero-img" alt=""
                        data-aos="zoom-out" data-aos-delay="300">
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
                    @if ($pengumumanWaktu)
                        @php
                            $waktuSekarang = now();
                            $pengumumanWaktuFormatted = \Carbon\Carbon::parse($pengumumanWaktu)->format('d F Y H:i:s'); // Format tanggal dan waktu
                        @endphp

                        <div id="countdown"></div>
                        <div id="announcementMessage"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover hidden" id="resultTable">
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
                                                <td>{{ $rataRata ? $rataRata : 'Sedang diproses' }}</td>
                                                <td>
                                                    @if (is_null($rataRata))
                                                        <span class="badge badge-warning">Sedang diproses</span>
                                                    @elseif ($rataRata <= 100 && $rataRata >= 70)
                                                        <span>Lulus</span>
                                                    @elseif ($rataRata < 70)
                                                        <span>Gagal</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <!-- Pagination -->
                                <div class="pagination-container hidden" id="paginationContainer">
                                    {{ $listPendaftar->links('vendor.pagination.pagination_custom') }}
                                </div>
                            @else
                                <p>Pengumuman masih diproses</p>
                    @endif
                </div>
            </div>
            </div>
            </div>
        </section>
        <!-- /Pengumuman Section -->

    </main>

    <script>
        let pengumuman = new Date("{{ $pengumumanWaktu }}").getTime(); // Mengambil waktu dari Laravel

        // Cek apakah pengumuman berisi tanggal yang valid
        if (new Date(pengumuman).getTime()) {
            let countdownDate = new Date(pengumuman).getTime();

            // Menampilkan pesan pengumuman yang akan datang
            let announcementDate = new Date(pengumuman).toLocaleString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: false, // Menggunakan format 24 jam
            });

            document.getElementById('announcementMessage').innerHTML = 'Pengumuman akan ditampilkan pada: ' +
                announcementDate;

            let countdownFunction = setInterval(function() {
                let now = new Date().getTime();
                let distance = countdownDate - now;

                // Hitung waktu yang tersisa
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('countdown').innerHTML = days + 'd ' + hours + 'h ' +
                    minutes + 'm ' + seconds + 's ';

                // Jika waktu telah habis
                if (distance < 0) {
                    clearInterval(countdownFunction);
                    document.getElementById('countdown').innerHTML = ' ';

                    // Menampilkan tabel hasil
                    document.getElementById('resultTable').classList.remove('hidden');

                    // Menampilkan pagination
                    document.getElementById('paginationContainer').classList.remove('hidden');

                    // Menghapus tulisan di announcementMessage
                    document.getElementById('announcementMessage').innerHTML = '';
                }
            }, 1000);
        }
    </script>
@endsection
