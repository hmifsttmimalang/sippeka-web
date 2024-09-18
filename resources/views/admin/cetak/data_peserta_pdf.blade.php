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

        /* Pengaturan flexbox untuk gambar dan teks */
        .header-container {
            display: flex;
            align-items: center;
            /* Menyelaraskan item di tengah secara vertikal */
            justify-content: space-between;
            /* Menyelaraskan item dengan jarak merata di sepanjang baris */
            margin-bottom: 20px;
        }

        .img-container {
            flex: 0 0 auto;
            /* Ukuran gambar tetap */
        }

        .img-container img {
            width: 80px;
            /* Ukuran gambar yang lebih kecil */
            height: auto;
            /* Mempertahankan rasio aspek gambar */
        }

        .text-container {
            flex: 1;
            /* Mengambil sisa ruang yang tersedia */
            text-align: center;
            /* Memusatkan teks secara horizontal */
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

        .p-light {
            font-weight: 500;
        }

        .p-style p {
            margin: 0;
            padding: 0;
        }

        .p-light .ph-1 {
            font-size: 16px;
        }

        .p-light .ph-2 {
            font-size: 20px;
            font-weight: bold;
            /* Menambah ketebalan font */
        }

        .p-light .ph-3 {
            font-size: 14px;
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
                <img src="{{ public_path('assets/admin/img/logo_jatim.png') }}" alt="Logo Jawa Timur">
            </div>
            <div class="text-container">
                <div class="p-3 p-style">
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
            </div>
        </div>

        <div style="border-top: 3px solid black; margin: 15px 0;"></div>

        <center>
            <h5 class="mb-2 fw-bold">
                PENGUMUMAN HASIL SELEKSI CALON PESERTA
                <br>
                PELATIHAN BERBASIS KOMPETENSI KEAHLIAN
            </h5>
        </center>

        <table>
            <thead>
                <tr>
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
                @foreach ($listPendaftar as $item)
                    @php
                        $rataRata =
                            is_null($item->nilai_keahlian) || is_null($item->nilai_wawancara)
                                ? 'Sedang diproses'
                                : ($item->nilai_keahlian + $item->nilai_wawancara) / 2;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->keahlian_nama }}</td>
                        <td>{{ $item->nilai_keahlian ?? 'Sedang diproses' }}</td>
                        <td>{{ $item->nilai_wawancara ?? 'Sedang diproses' }}</td>
                        <td>{{ $rataRata }}</td>
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
