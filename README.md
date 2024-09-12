# Sistem Informasi Pendaftaran Pelatihan Kerja (Sippeka)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-2.0.0-green.svg)

## Deskripsi

Sistem Informasi Pendaftaran Pelatihan Kerja adalah sebuah aplikasi yang digunakan
untuk melakukan pendaftaran pelatihan kerja bagi peserta yang ingin mengikuti
pelatihan kerja. Aplikasi ini telah dimigrasi ke Laravel 10 dengan menggunakan database MySQL. Otentikasi pengguna dilakukan dengan sistem kustom sendiri dan tidak menggunakan npm JavaScript, mengikuti dokumentasi lama.

## Daftar Isi

- [Pendahuluan](#pendahuluan)
- [Fitur](#fitur)
- [Instalasi](#instalasi)
- [Struktur Direktori](#struktur-direktori)
- [Penggunaan](#penggunaan)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## Pendahuluan

Sistem Informasi Pendaftaran Pelatihan Kerja adalah sebuah aplikasi yang digunakan
untuk melakukan pendaftaran pelatihan kerja bagi peserta. Aplikasi ini dibangun dengan Laravel 10 dan menggunakan database MySQL. Otentikasi pengguna dilakukan dengan sistem kustom dan tidak menggunakan npm JavaScript.

## Fitur

- Autentikasi pengguna (Admin dan User) dengan sistem kustom
- Pendaftaran peserta pelatihan
- Laporan pendaftaran
- Manajemen data peserta

## Instalasi

### Prasyarat

- [Laravel 10](https://laravel.com/docs/10.x)
- MySQL 5.7 atau lebih baru
- PHP 8.0 atau lebih baru
- Composer (untuk mengelola dependensi Laravel)

### Langkah-langkah Instalasi

1. **Clone Repository**

    ```bash
    git clone https://github.com/ardie069/sippeka_web.git
    ```

2. **Pindahkan Folder Proyek**

    Pindahkan folder proyek ke direktori `www` di Laragon.

    ```bash
    mv sippeka_web path/to/Laragon/www/sippeka_web
    ```

3. **Instalasi Dependensi**

    Masuk ke direktori proyek dan instal dependensi menggunakan Composer.

    ```bash
    cd path/to/Laragon/www/sippeka_web
    composer install
    ```

4. **Buat Database**

    Buat database baru di phpMyAdmin dengan nama `data_sippeka` (untuk nama database bebas).

5. **Import Database**

    Import file `data_sippeka.sql` yang ada di folder `database` ke dalam database tersebut.

6. **Konfigurasi Environment**

    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.

    ```bash
    cp .env.example .env
    ```

    Edit file `.env` dan ubah konfigurasi database:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=data_sippeka
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. **Generate Kunci Aplikasi**

    Jalankan perintah untuk menghasilkan kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

8. **Jalankan Migrasi**

    Jalankan migrasi untuk membuat tabel-tabel yang diperlukan di database:

    ```bash
    php artisan migrate
    ```

9. **Jalankan Proyek**

    Buka browser dan akses `http://localhost/sippeka_web/`.

## Struktur Direktori

```plaintext
    sippeka_web/
    ├── app/
    │   ├── Console/
    │   ├── Exceptions/
    │   ├── Http/
    │   ├── Models/
    │   ├── Providers/
    │   └── Services/
    ├── bootstrap/
    ├── config/
    ├── database/
    │   ├── factories/
    │   ├── migrations/
    │   └── seeders/
    ├── public/
    │   ├── assets/
    │   ├── css/
    │   ├── js/
    │   ├── uploads/
    │   └── index.php
    ├── resources/
    │   ├── lang/
    │   └── views/
    ├── routes/
    ├── storage/
    ├── tests/
    ├── .env
    ├── .gitignore
    ├── artisan
    ├── composer.json
    ├── composer.lock
    └── phpunit.xml
```

## Penggunaan

### Admin

1. **Login**: Masuk sebagai admin menggunakan kredensial yang telah dibuat di database.
2. **Menu**: Menu yang tersedia di halaman admin.
3. **Data Peserta**: Menampilkan data peserta yang telah terdaftar.
4. **Kelola Data**: Menampilkan tampilan dan mengelola data seperti akun dan peserta.
5. **Kategori keahlian**: Membuat Kategori keahlian agar user yang mendaftar dapat memilih sesuai minat pada formulir pendaftaran.
6. **Soal**: Membuat soal tes keahlian untuk ditampilkan pada halaman ujian seleksi pada user.
7. **Laporan**: Membuat laporan pendaftaran dalam format PDF atau Excel.

### User

1. **Login**: Masuk sebagai peserta menggunakan kredensial yang telah dibuat di database.
2. **Buat Akun**: Membuat akun untuk verifikasi peserta sebagai pendaftar.
3. **Home**: Menu yang tersedia di halaman user.
4. **Pendaftaran**: Mendaftar sebagai peserta pelatihan melalui formulir pendaftaran.
5. **Dashboard User**: Tampilan akun user.
6. **Tes Simulasi**: Tampilan ujian simulasi.
7. **Tes Seleksi**: Tampilan ujian seleksi peserta.

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

Proyek ini dilisensikan di bawah Lisensi MIT. Untuk informasi lebih lanjut, lihat file [LICENSE](LICENSE).

---

MIT License

Hak Cipta (c) 2024 Ardiansyah, Adi Chandra Isro' Salsabila

Dengan ini diberikan izin, tanpa biaya, kepada siapa saja yang memperoleh salinan perangkat lunak ini dan file dokumentasi terkait (\"Perangkat Lunak\"), untuk berurusan dalam Perangkat Lunak tanpa batasan, termasuk tanpa batasan hak untuk menggunakan, menyalin, mengubah, menggabungkan, menerbitkan, mendistribusikan, memberikan lisensi, dan/atau menjual salinan Perangkat Lunak, serta untuk mengizinkan orang yang kepadanya Perangkat Lunak disediakan melakukannya, dengan syarat berikut:

Pernyataan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam semua salinan atau bagian penting dari Perangkat Lunak.

PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, TERSURAT MAUPUN TERSIRAT, TERMASUK NAMUN TIDAK TERBATAS PADA JAMINAN DIPERDAGANGKAN, KESESUAIAN UNTUK TUJUAN TERTENTU DAN BEBAS DARI PELANGGARAN. DALAM HAL APA PUN PEMEGANG HAK CIPTA ATAU PEMEGANG LISENSI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU KEWAJIBAN LAINNYA, BAIK DALAM TINDAKAN KONTRAK, KERUGIAN ATAU LAINNYA, YANG TIMBUL DARI, KELUAR DARI ATAU BERHUBUNGAN DENGAN PERANGKAT LUNAK ATAU PENGGUNAAN ATAU TRANSAKSI LAIN DALAM PERANGKAT LUNAK.
