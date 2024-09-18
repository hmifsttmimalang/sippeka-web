<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Pengaturan halaman untuk ukuran A4 */
        @media print {
            @page {
                size: A4; /* Ukuran A4 */
                margin: 20mm; /* Margin untuk cetak */
            }
            body {
                margin: 0;
                -webkit-print-color-adjust: exact; /* Untuk memastikan warna dicetak */
            }
        }

        /* Pengaturan CSS biasa */
        .p-light {
            margin-left: -100px;
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
        }

        .p-light .ph-3 {
            font-size: 14px;
        }

        /* Pengaturan untuk judul besar */

        .table-responsive {
            font-size: 14px; /* Sesuaikan ukuran font untuk tampilan yang lebih kecil */
        }

        .p-3 img {
            width: 100px; /* Ukuran logo */
        }

        .tr-1, .tr-2, .tr-3, .tr-4 {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container my-5">

        <div class="row">
            <!-- section 1 -->
             <div class="col-md-4">
                <div class="p-3">
                    <img src="{{ asset('assets/admin/img/logo_jatim.png') }}" alt="Logo Jawa Timur">
                </div>
             </div>
             <!-- section 2 -->
             <div class="col-md-6 p-light">
                <div class="p-3 text-center p-style">
                    <p class="ph-1">
                       PEMERINTAH PROVINSI JAWA TIMUR<br>
                       DINAS TENAGA KERJA DAN TRANSMIGRASI
                    </p>
                    <p class="ph-2 fw-bold">
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

        <div style="border-top: 3px solid black; margin: 20px 0;"></div>

        <h5 class="text-center mb-4 fw-bold">
            PENGUMUMAN HASIL SELEKSI CALON PESERTA 
            <br>
            PELATIHAN BERBASIS KOMPETENSI KEAHLIAN
        </h2>
        <div class="table-responsive text-center">
            <table class="table table-bordered" style="font-weight: 400;">
                <thead class="table-bordered">
                    <tr class="tr-1">
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
                    <!-- Data peserta -->
                    <tr class="tr-2">
                        <td>1</td>
                        <td>Sigit Rendang</td>
                        <td>Jl. Candi Panggung</td>
                        <td>Web Development</td>
                        <td>80</td>
                        <td>75</td>
                        <td>77.5</td>
                        <td><span class="badge bg-success">Lulus</span></td>
                    </tr>
                    <tr class="tr-3">
                        <td>2</td>
                        <td>Farhan Kebab</td>
                        <td>Jl. Candi Jago</td>
                        <td>Android Development</td>
                        <td>85</td>
                        <td>80</td>
                        <td>82.5</td>
                        <td><span class="badge bg-success">Lulus</span></td>
                    </tr>
                    <tr class="tr-4">
                        <td>3</td>
                        <td>Farhad Abbas</td>
                        <td>Jl. Suhat No. 7</td>
                        <td>IT Security</td>
                        <td>90</td>
                        <td>88</td>
                        <td>89.0</td>
                        <td><span class="badge bg-success">Lulus</span></td>
                    </tr>
                    <!-- Anda bisa menambahkan data lain di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
