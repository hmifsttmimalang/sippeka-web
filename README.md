# Sistem Informasi Pendaftaran Pelatihan Kerja (Sippeka)

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-2.0.0-green.svg)
![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)

## Deskripsi

Sistem Informasi Pendaftaran Pelatihan Kerja (Sippeka) adalah aplikasi untuk mengelola pendaftaran peserta pelatihan kerja. Aplikasi ini telah dimigrasi ke Laravel 10 dengan database MySQL. Autentikasi dalam sistem ini menggunakan mekanisme kostum, tanpa menggunakan library Breeze.

## Daftar Isi

- [Pendahuluan](#pendahuluan)
- [Fitur](#fitur)
- [Instalasi](#instalasi)
- [Struktur Direktori](#struktur-direktori)
- [Penggunaan](#penggunaan)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## Pendahuluan

Aplikasi Sippeka mempermudah proses pendaftaran pelatihan kerja, dengan fitur pengelolaan data peserta, autentikasi admin dan user, serta laporan pendaftaran. Sistem ini telah di-upgrade menggunakan framework Laravel 10 dan database MySQL untuk performa dan skalabilitas yang lebih baik.

## Fitur

- Autentikasi pengguna kostum (Admin dan User)
- Pendaftaran peserta pelatihan
- Laporan pendaftaran dalam format PDF dan Excel
- Manajemen data peserta pelatihan
- Manajemen keahlian dan soal ujian seleksi

## Instalasi

### Prasyarat

- [Composer](https://getcomposer.org/)
- PHP 8.1 atau lebih baru
- MySQL 5.7 atau lebih baru
- [Node.js](https://nodejs.org/) dan npm

### Langkah-langkah Instalasi

1. **Clone Repository**

    ```bash
    git clone https://github.com/ardie069/sippeka_web.git
    ```

2. **Pindahkan Folder Proyek**

    Pindahkan folder proyek ke direktori server development (misalnya `laragon/www` atau folder server lokal Anda).

3. **Buat Database**

    Buat database baru di MySQL dengan nama `sippeka`.

4. **Sesuaikan Konfigurasi Database**

    Edit file `.env` dan sesuaikan konfigurasi database dengan detail MySQL Anda:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sippeka
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Instal Dependensi**

    Jalankan perintah berikut untuk menginstal semua dependensi PHP dan JavaScript:

    ```bash
    composer install
    npm install
    npm run dev
    ```

6. **Jalankan Migrasi Database**

    Jalankan migrasi untuk membuat tabel yang diperlukan:

    ```bash
    php artisan migrate
    ```

7. **Jalankan Proyek**

    Setelah semua konfigurasi selesai, jalankan server development:

    ```bash
    php artisan serve
    ```

    Akses proyek di browser melalui `http://localhost:8000`.

## Struktur Direktori

```plaintext
sippeka_web/
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── views/
│   ├── css/
│   ├── js/
├── routes/
├── storage/
├── tests/
├── .env
├── composer.json
└── package.json
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
