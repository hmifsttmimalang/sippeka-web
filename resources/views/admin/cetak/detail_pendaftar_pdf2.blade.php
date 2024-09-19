<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta</title>
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
        .p-style p {
            margin: 0;
            padding: 0;
        }

        /* Pengaturan untuk judul besar */
        .heading {
            font-size: 16px;
            text-align: center;
            font-weight: bold;
        }

        .table-responsive {
            font-size: 12px; /* Sesuaikan ukuran font untuk tampilan yang lebih kecil */
        }

        .p-3 img {
            width: 100px; /* Ukuran logo */
            aspect-ratio: 1 / 1;
            object-fit: contain;
        }

        tr{
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
                    <img src="img/logo_jatim.svg" alt="Logo Jawa Timur">
                </div>
             </div>
             <!-- section 2 -->
             <div class="col-md-4">
                <div class="p-3 text-center p-style">
                    <p style="font-size: 16px;">
                       PEMERINTAH PROVINSI JAWA TIMUR<br>
                       DINAS TENAGA KERJA DAN TRANSMIGRASI
                    </p>
                    <p style="font-weight: bold; font-size: 14px;">
                        UPT BALAI LATIHAN KERJA SINGOSARI
                    </p>
                    <p style="font-size: 12px;">
                        Jl. Raya Singosari Telp. (0341) 458055 – Fax. 458512<br>
                        website: www.blkisingosari.com, e-mail: blki_sgs@yahoo.co.id<br>
                        SINGOSARI – 65153
                    </p>
                </div>
             </div>
        </div>

        <div style="border-top: 3px solid black; margin: 20px 0;"></div>

        <h2 class="text-center mb-4">Detail Pendaftar</h2>

        <div class="mb-4">
            <span class="badge bg-warning">Menunggu</span>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" cellspacing="0">
                <thead class="table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>Kacung Suryono S.H</td>
                        <td rowspan="8" align="center"><img src="img/logo_jatim.svg" style="width: 150px; height: 250px;" alt="" srcset=""></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>Ki Badak. No. 601, Pontianak Kalbar</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahr</th>
                        <td>27 April 1998</td>
                    </tr>
                    <tr>
                        <th>Keahlian</th>
                        <td>Mobile Developer</td>
                    </tr>
                    <tr>
                        <th>Nilai Tes Keahlian</th>
                        <td>45</td>
                    </tr>
                    <tr>
                        <th>Nilai Tes Wawancara</th>
                        <td>75</td>
                    </tr>
                    <tr>
                        <th>Rata-Rata</th>
                        <td>70</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>Gagal</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
