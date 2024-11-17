# Sistem Informasi Pendaftaran Pelatihan Kerja (Sippeka)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
  <img src="https://img.shields.io/badge/license-Apache%202.0-red.svg" alt="License: Apache 2.0">
  <img src="https://img.shields.io/badge/version-2.6.0-green.svg" alt="Version: 2.6.0">
</p>

## Deskripsi

Sistem Informasi Pendaftaran Pelatihan Kerja (Sippeka) adalah aplikasi yang digunakan untuk memfasilitasi proses pendaftaran pelatihan kerja bagi mahasiswa. Aplikasi ini dibangun menggunakan **Laravel 10** dengan **MySQL** sebagai basis datanya. Proyek ini **tidak menggunakan Vite JS** melainkan mengandalkan pengelolaan file statis seperti JS dan CSS secara manual yang disimpan di direktori `/public`. Aplikasi ini juga mendukung unggahan file seperti foto, yang disimpan di direktori `/uploads`.

## Daftar Isi

- [Pendahuluan](#pendahuluan)
- [Fitur](#fitur)
- [Instalasi](#instalasi)
- [Struktur Direktori](#struktur-direktori)
- [Penggunaan](#penggunaan)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## Pendahuluan

Sistem Informasi Pendaftaran Pelatihan Kerja adalah aplikasi untuk pendaftaran pelatihan kerja bagi siswa jenjang SMA/SMK/sederajat. Proyek ini menggunakan Laravel 10, MySQL, dan Vite JS. Otentikasi pengguna diimplementasikan secara kustom, tidak menggunakan library Breeze.

## Fitur

- Otentikasi pengguna (Admin, User dan Instruktur) dengan sistem kustom
- Pendaftaran peserta pelatihan
- Tampilan hasil pengumuman peserta yang ditampilkan sesuai waktu yang ditentukan
- Laporan pendaftaran dalam format PDF
- Manajemen data peserta pelatihan
- Unggah file foto yang disimpan pada direktori `/uploads`

## Instalasi

### Prasyarat

- [Laragon](https://laragon.org/download/) atau [XAMPP](https://www.apachefriends.org/download.html)
- PHP 8.2.12 atau lebih baru
- MySQL 5.7 atau lebih baru
- Laravel 10

### Langkah-langkah Instalasi

1. **Clone Repository**

    ```bash
    git clone https://github.com/hmifsttmimalang/sippeka-web.git
    ```

2. **Pindahkan Folder Proyek**

    Pindahkan folder proyek ke direktori `www` di Laragon.

    ```bash
    mv sippeka-web path/to/Laragon/www/sippeka-web
    ```

    Jika menggunakan XAMPP, maka pindahkan folder proyek ke direktori `htdocs` di XAMPP.

    ```bash
    mv sippeka-web path/to/XAMPP/htdocs/sippeka-web
    ```

3. **Instalasi Dependensi**

    Masuk ke direktori proyek dan jalankan:

    ```bash
    cd sippeka-web
    composer install
    ```

4. **Buat Database**

    Buat database baru di phpMyAdmin dengan nama `data_sippeka` (atau nama yang sesuai).

5. **Import Database**

    Import file `data_sippeka.sql` yang ada di folder `database` ke dalam database tersebut.

6. **Konfigurasi Environment**

    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=data_sippeka
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. **Generate Key**

    Jalankan perintah berikut untuk menghasilkan kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

8. **Jalankan Proyek**

    Jalankan server Laravel:

    ```bash
    php artisan serve
    ```

    Buka browser dan akses `http://localhost:8000/`.

## Struktur Direktori

```plaintext
    sippeka-web/
    ├── app/
    │   ├── Console/
    │   ├── Exceptions/
    │   ├── Http/
    │   │   ├── Controllers/
    │   │   └── Middleware/
    │   ├── Models/
    │   └── Providers/
    ├── bootstrap/
    ├── config/
    ├── database/
    │   ├── migrations/
    │   └── seeds/
    ├── public/
    │   ├── assets/
    │   │   ├── admin/
    │   │   ├── css/
    │   │   ├── js/
    │   │   ├── profile/
    │   │   └── user/
    │   └── storage/
    │       └── uploads/
    │           ├── foto_ktp.jpg
    │           ├── foto_ijazah.jpg
    │           ├── foto_background_biru.jpg
    │           └── foto_kk.jpg
    ├── resources/
    │   ├── css/
    │   ├── js/
    │   └── views/
    ├── routes/
    ├── storage/
    ├── tests/
    ├── .env
    ├── .gitignore
    ├── artisan
    ├── composer.json
    ├── package.json
    ├── phpunit.xml
    └── vite.config.js
```

## Penggunaan

### Admin

1. **Login**: Masuk sebagai admin menggunakan kredensial yang telah dibuat di database.
2. **Menu Admin**: Menavigasi berbagai menu utama yang menyediakan akses untuk pengelolaan data peserta, laporan, dan soal tes.
3. **Data Peserta**: Menampilkan tabel data peserta yang telah mendaftar melalui formulir pendaftaran. Data ini termasuk nilai peserta dan dapat dicetak atau diunduh dalam format PDF untuk keperluan administrasi.
4. **Kelola Data**: Memvalidasi pendaftaran peserta dan mengelola data peserta, termasuk mengisi nilai wawancara selama proses seleksi wawancara.
5. **Kelola Kategori keahlian**: Menambahkan dan memperbarui kategori keahlian yang tersedia, agar peserta dapat memilih bidang yang sesuai dengan minat mereka saat pendaftaran.
6. **Membuat Soal Tes**: Menyusun soal-soal ujian seleksi pelatihan sesuai dengan kategori keahlian yang telah ditentukan.
7. **Impor Soal Tes**: Mengimpor soal-soal tes dari file Excel yang telah disiapkan sebelumnya, untuk mempermudah dan mempercepat pengisian bank soal.
8. **Laporan**: Membuat laporan pendaftaran dan hasil seleksi peserta pelatihan dalam format PDF untuk dokumentasi dan evaluasi.
9. **Informasi Pelatihan**: Menampilkan dan mengirim informasi jurusan sesuai kuota yang disediakan dan ditampilkan pada halaman utama.
10. **Informasi Jadwal Tes**: Menampilkan dan memberikan informasi jadwal pelaksanaan tes yang ditampilkan pada halaman utama.
11. **Pengaturan Waktu Pengumuman**: Mengatur waktu untuk menampilkan hasil penilaian akhir peserta berdasarkan tanggal dan waktu yang ditentukan.

### User

1. **Login**: Masuk sebagai peserta menggunakan kredensial yang telah dibuat di database.
2. **Buat Akun**: Membuat akun untuk verifikasi peserta sebagai pendaftar.
3. **Home**: Menu yang tersedia di halaman user.
4. **Pendaftaran**: Mendaftar sebagai peserta pelatihan melalui formulir pendaftaran.
5. **Dashboard User**: Tampilan akun user.
6. **Tes Simulasi**: Tampilan ujian simulasi.
7. **Tes Seleksi**: Tampilan ujian seleksi peserta.
8. **Melihat Jadwal**: Meninjau jadwal tes yang telah diatur oleh Admin.

### Instruktur

1. **Login**: Masuk sebagai instruktur menggunakan kredensial yang telah dibuat di database.
2. **Validasi Wawancara**: Mengelola dan memvalidasi hasil wawancara peserta pelatihan.

## Kontribusi

Silakan ikuti panduan kontribusi berikut jika Anda ingin berkontribusi pada proyek ini:

1. **Fork Repository**: Fork repository ini.
2. **Clone Repository**: Clone repository yang telah di-fork ke perangkat Anda.
3. **Buat Branch**: Buat branch baru untuk menambahkan fitur atau memperbaiki fitur tersebut.

    ```bash
    git checkout -b nama-branch
    ```

4. **Lakukan Perubahan**: Lakukan perubahan yang Anda inginkan.
5. **Commit Perubahan**: Commit perubahan yang telah Anda lakukan dan berikan pesan yang jelas.

    ```bash
    git commit -m "Deskripsi perubahan"
    ```

6. **Push Perubahan**: Push branch ke repository forked Anda.

    ```bash
    git push origin nama-branch
    ```

7. **Buat Pull Request**: Ajukan pull request dan jelaskan perubahan yang Anda buat.

## Lisensi

Proyek ini dilisensikan di bawah Lisensi Apache-2.0. Untuk informasi lebih lanjut, lihat file [LICENSE](LICENSE).
