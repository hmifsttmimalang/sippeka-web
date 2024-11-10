<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Pengaturan halaman untuk ukuran A4 */
        @media print {
            @page {
                size: A4;
                /* Ukuran A4 */
                margin: 20mm;
                /* Margin untuk cetak */
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                /* Untuk memastikan warna dicetak */
            }
        }

        /* Menggunakan flexbox dan memastikan konten terpusat */
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
        }

        /* Mengatur posisi gambar agar tetap di kiri */
        .img-container {
            position: absolute;
            left: 0;
            margin-left: 20px;
            top: 25px;
        }

        .img2-container {
            position: absolute;
            right: 0;
            margin-right: 20px;
            top: 25px;
        }

        .text-container {
            text-align: center;
        }

        .p-light {
            font-weight: 500;
        }

        .p-style p {
            margin: 0;
            padding: 0;
        }

        .ph-1 {
            font-size: 16px;
        }

        .ph-2 {
            font-size: 20px;
            font-weight: bold;
        }

        .ph-3 {
            font-size: 14px;
        }

        /* Pengaturan tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            /* Ukuran font tabel */
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            /* Padding tabel */
            text-align: left;
            word-wrap: break-word;
            /* Membungkus teks panjang */
        }

        th {
            background-color: #f2f2f2;
            /* Warna latar belakang header tabel */
        }

        h1 {
            text-align: center;
            /* Memusatkan judul */
            font-size: 16px;
            /* Ukuran font judul */
        }

        span {
            display: block;
            text-align: center;
            /* Memusatkan teks status */
            font-weight: bold;
        }

        /* Pengaturan untuk judul besar */
        .table-responsive {
            font-size: 12px;
            /* Ukuran font yang lebih kecil untuk tabel */
            overflow-x: auto;
            /* Menghindari elemen tabel menyamping */
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header-container">
            <div class="img-container">
                <img src="{{ public_path('assets/admin/img/logo_jatim.png') }}" alt="Logo Jawa Timur" style="width: 70px; height: auto;">
            </div>
            <div class="text-container p-3 p-style">
                <p class="ph-1">
                    PEMERINTAH PROVINSI JAWA TIMUR<br>
                    DINAS TENAGA KERJA DAN TRANSMIGRASI
                </p>
                <p class="ph-2">
                    UPT BALAI LATIHAN KERJA SINGOSARI
                </p>
                <p class="ph-3">
                    Jl. Raya Singosari Telp. (0341) 458055 – Fax. 458512<br>
                    website: www.silastri.org, e-mail: blki_sgs@yahoo.co.id<br>
                    SINGOSARI – 65153
                </p>
            </div>
            <div class="img2-container">
                <img src="{{ public_path('assets/admin/img/logo_iso.png') }}" alt="Logo ISO" style="width: 100px;">
            </div>
        </div>

        <div style="border-top: 3px solid black; margin: 10px 0;"></div>

        <center>
            <h5 class="mb-1 fw-bold">
                PENGUMUMAN HASIL SELEKSI CALON PESERTA
                <br>
                PELATIHAN BERBASIS KOMPETENSI KEAHLIAN
            </h5>
            <br>
        </center>

        <table>
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">No</th>
                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                    <th style="text-align: center; vertical-align: middle;">Alamat</th>
                    <th style="text-align: center; vertical-align: middle;">Keahlian</th>
                    <th style="text-align: center; vertical-align: middle;">Nilai Tes Keahlian</th>
                    <th style="text-align: center; vertical-align: middle;">Nilai Tes Wawancara</th>
                    <th style="text-align: center; vertical-align: middle;">Rata-Rata</th>
                    <th style="text-align: center; vertical-align: middle;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listPendaftar as $item)
                    @php
                        $rataRata =
                            is_null($item->nilai_keahlian) || is_null($item->nilai_wawancara)
                                ? 'Sedang diproses'
                                : ($item->nilai_keahlian + $item->nilai_wawancara) / 2;
                    @endphp
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->keahlian_nama }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $item->nilai_keahlian ?? 'Sedang diproses' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $item->nilai_wawancara ?? 'Sedang diproses' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $rataRata }}</td>
                        <td>
                            @if ($rataRata === 'Sedang diproses')
                                <span>Sedang diproses</span>
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
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
