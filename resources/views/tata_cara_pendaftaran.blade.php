<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 Cara Jitu Memilih Jurusan Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-image: url('{{ asset('assets/user/img/bg_image_card.png') }}'); /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover; /* Mengatur agar gambar menutupi seluruh area */
            background-position: center; /* Memposisikan gambar di tengah */
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #dcdcdc;
            color: white; /* Mengubah warna teks agar lebih kontras dengan background */
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
</head>

<body>

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
                    <p>Masukkan informasi yang diperlukan seperti nama, email, username dan password. Lalu klik buat akun</p>
                    <img src="{{ asset('assets/user/img/step_2.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="icon">3️⃣</div>
                    <h3>Klik Tombol Username</h3>
                    <p>Anda akan diarahkan kembali ke halaman beranda, cari dan klik pada menu tombol username Anda.</p>
                    <img src="{{ asset('assets/user/img/step_3.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="icon">4️⃣</div>
                    <h3>Isi Form Registrasi</h3>
                    <p>Setelah masuk pada Form Registrasi, isi informasi yang dibutuhkan dan siapkan foto dengan ukuran 4x6. Jika selesai klik tombol Registrasi.</p>
                    <img src="{{ asset('assets/user/img/step_4.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="icon">5️⃣</div>
                    <h3>Klik Kembali Ke Halaman Utama</h3>
                    <p>Setelah mengisi dan klik tombol Registrasi, maka Anda akan diarahkan ke halaman Beranda lagi.</p>
                    <img src="{{ asset('assets/user/img/step_5.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="icon">6️⃣</div>
                    <h3>Klik Tombol Username Untuk Masuk</h3>
                    <p>Setelah berada di halaman beranda kembali, cari dan klik pada menu tombol username Anda lagi.</p>
                    <img src="{{ asset('assets/user/img/step_3.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="icon">7️⃣</div>
                    <h3>Berhasil Masuk Ke Dashboard</h3>
                    <p>Setelah menekan tombol username, maka Anda telah selesai melakukan proses mendaftar sebagai calon peserta. Disini anda bisa melakukan edit profil dan juga simulasi tes sebelum jadwal tes Anda dilaksanakan.</p>
                    <img src="{{ asset('assets/user/img/step_6.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
