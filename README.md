# Sistem Informasi Pendaftaran Pelatihan Kerja
![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.0-green.svg)

## Deskripsi
Sistem Informasi Pendaftaran Pelatihan Kerja adalah sebuah aplikasi yang digunakan
untuk melakukan pendaftaran pelatihan kerja bagi mahasiswa yang ingin mengikuti
pelatihan kerja. Aplikasi ini dibuat dengan menggunakan bahasa pemrograman
PHP native yang menggunakan konsep Model Controller View (MVC) dan MySQL dengan Web Server XAMPP.

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
untuk melakukan pendaftaran pelatihan kerja bagi mahasiswa yang ingin mengikuti
pelatihan kerja. Aplikasi ini dibuat dengan menggunakan bahasa pemrograman
PHP native yang menggunakan konsep Model Controller View (MVC) dan MySQL dengan Web Server XAMPP.

## Fitur

- Autentikasi pengguna (Admin dan User)
- Pendaftaran peserta pelatihan
- Laporan pendaftaran
- Manajemen data peserta

## Instalasi

### Prasyarat

- [XAMPP](https://www.apachefriends.org/download.html)
- PHP 7.4 atau lebih baru
- MySQL 5.7 atau lebih baru

### Langkah-langkah Instalasi

1. **Clone Repository**

    ```bash
    git clone https://github.com/ardie069/app_web.git
    ```

2. **Pindahkan Folder Proyek**

    Pindahkan folder proyek ke direktori `htdocs` di XAMPP.

    ```bash
    mv app_web path/to/xampp/htdocs/app_web
    ```

3. **Buat Database**

    Buat database baru di phpMyAdmin dengan nama `data_sippeka` (untuk nama database bebas).

4. **Import Database**

    Import file `data_sippeka.sql` yang ada di folder `database` ke dalam database tersebut.

5. **Konfigurasi Database**

    Ubah file `config/database.php` dan sesuaikan dengan konfigurasi MySQL Anda.

    ```php
    <?php
    
    
    ```


6. **Jalankan Proyek**

    Buka browser dan akses `http://localhost/app_web/`.

    ## Struktur Direktori

    ```plaintext



## Penggunaan

### Admin

1. **Login**: Masuk sebagai admin menggunakan kredensial yang telah dibuat di database.
2. **Menu**: Menu yang tersedia di halaman admin.
3. **Data Peserta**: Menampilkan data peserta yang telah terdaftar.
4. **Kelola Data**: Menampilkan tampilan dan mengelola data seperti akun dan peserta.
5. **Laporan**: Membuat laporan pendaftaran dalam format PDF atau Excel.

### User

1. **Login**: Masuk sebagai peserta menggunakan kredensial yang telah dibuat di database.
2. **Buat Akun**: Membuat akun untuk verifikasi peserta sebagai pendaftar.
3. **Home**: Menu yang tersedia di halaman user.
4. **Pendaftaran**: Mendaftar sebagai peserta pelatihan melalui formulir pendaftaran.

## Kontribusi

Silakan ikuti panduan kontribusi berikut jika Anda ingin berkontribusi pada proyek ini:

1. **Fork Repository**: Fork repository ini.
2. **Clone Repository**: Clone repository yang telah di-fork ke perangkat Anda.
3. **Buat Branch**: Buat branch baru untuk menambahkan fitur atau memperbaiki fitur tersebut.

    ```bash
    git checkout -b nama-branch

4. **Lakukan Perubahan**: Lakukan perubahan yang Anda inginkan.
5. **Commit Perubahan**: Commit perubahan yang telah Anda lakukan dan berikan pesan yang jelas.

    ```bash
    git commit -m "Deskripsi perubahan"

6. **Push Perubahan**: Push branch ke repository forked Anda.

    ```bash
    git push origin nama-branch

7. **Buat Pull Request**: Ajukan pull request dan jelaskan perubahan yang Anda buat.

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Untuk informasi lebih lanjut, lihat file [LICENSE](LICENSE).

---

MIT License

Hak Cipta (c) 2024 Ardiansyah, Adi Chandra Isro' Salsabilla

Dengan ini diberikan izin, tanpa biaya, kepada siapa saja yang memperoleh salinan perangkat lunak ini dan file dokumentasi terkait (\"Perangkat Lunak\"), untuk berurusan dalam Perangkat Lunak tanpa batasan, termasuk tanpa batasan hak untuk menggunakan, menyalin, mengubah, menggabungkan, menerbitkan, mendistribusikan, memberikan lisensi, dan/atau menjual salinan Perangkat Lunak, serta untuk mengizinkan orang yang kepadanya Perangkat Lunak disediakan melakukannya, dengan syarat berikut:

Pernyataan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam semua salinan atau bagian penting dari Perangkat Lunak.

PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, TERSURAT MAUPUN TERSIRAT, TERMASUK NAMUN TIDAK TERBATAS PADA JAMINAN DIPERDAGANGKAN, KESESUAIAN UNTUK TUJUAN TERTENTU DAN BEBAS DARI PELANGGARAN. DALAM HAL APA PUN PEMEGANG HAK CIPTA ATAU PEMEGANG LISENSI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU KEWAJIBAN LAINNYA, BAIK DALAM TINDAKAN KONTRAK, KERUGIAN ATAU LAINNYA, YANG TIMBUL DARI, KELUAR DARI ATAU BERHUBUNGAN DENGAN PERANGKAT LUNAK ATAU PENGGUNAAN ATAU TRANSAKSI LAIN DALAM PERANGKAT LUNAK.