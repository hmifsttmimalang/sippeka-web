<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        }

        .text-container {
            text-align: center;
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

        /* Pengaturan untuk tabel detail */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Mengatur ukuran gambar di dalam tabel */
        .table img {
            display: block;
            margin: auto;
            max-width: 150px;
            height: auto;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    {{-- halaman 1 --}}
    <div class="container">
        <!-- Header -->
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
        </div>

        <div style="border-top: 3px solid black; margin: 10px 0;"></div>

        <center>
            <h5 class="mb-1 fw-bold">
                DETAIL PENDAFTAR
            </h5>
            <br><br>
        </center>

        <!-- Tabel Detail Pendaftar -->
        <center>
            <img src="{{ public_path('storage/' . $pendaftar->foto_bg_biru) }}" alt="Foto Background Biru {{ $pendaftar->nama }}" style="width: 200px; height: auto;">
        </center>
        <br><br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pendaftar->nama }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pendaftar->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td>{{ $pendaftar->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $formatted_date }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>{{ $pendaftar->agama }}</td>
                    </tr>
                    <tr>
                        <th>Keahlian</th>
                        <td>{{ $pendaftar->keahlian_nama }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Tes Keahlian</th>
                        <td>{{ $pendaftar->nilai_keahlian ?? 'Sedang diproses' }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Tes Wawancara</th>
                        <td>{{ $pendaftar->nilai_wawancara ?? 'Sedang diproses' }}</td>
                    </tr>
                    <tr>
                        <th>Rata-Rata</th>
                        <td>{{ $rataRata ? $rataRata : 'Sedang diproses' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $status }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="page-break"></div>

    {{-- halaman 2 --}}
    <div class="container">
        <!-- Header -->
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
        </div>

        <div style="border-top: 3px solid black; margin: 10px 0;"></div>

        <center>
            <h5 class="mb-1 fw-bold">
                LAMPIRAN
            </h5>
            <br><br>
        </center>

        <!-- Tabel Detail Pendaftar -->
        <p>Foto Identitas</p>
        <center>
            <img src="{{ public_path('storage/' . $pendaftar->foto_identitas) }}" alt="Foto Identitas {{ $pendaftar->nama }}" style="width: 200px; height: auto;">
        </center>
        <p>Foto Ijazah</p>
        <center>
            <img src="{{ public_path('storage/' . $pendaftar->foto_ijazah) }}" alt="Foto Ijazah {{ $pendaftar->nama }}" style="width: 200px; height: auto;">
        </center>
        <br><br>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
