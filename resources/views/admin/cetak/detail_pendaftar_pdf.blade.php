<!DOCTYPE html>
<html>
<head>
    <title>Detail Pendaftar</title>
    <style>
        /* Tambahkan gaya CSS di sini jika perlu */
    </style>
</head>
<body>
    <h1>Detail Pendaftar</h1>

    <img src="{{ public_path('storage/' . $pendaftar->foto_bg_biru) }}" alt="Foto Profil Background Biru"
        class="img-fluid rounded-circle" style="width: 200px" alt="menunggu">

    <p><strong>Nama:</strong> {{ $pendaftar->nama }}</p>
    <p><strong>Alamat:</strong> {{ $pendaftar->alamat }}</p>
    <p><strong>Tanggal Lahir:</strong> {{ $formatted_date }}</p>
    <p><strong>Keahlian:</strong> {{ $pendaftar->keahlian_nama }}</p>
    <p><strong>Nilai Tes Keahlian:</strong> {{ $pendaftar->nilai_keahlian ?? 'Sedang diproses' }}</p>
    <p><strong>Nilai Tes Wawancara:</strong> {{ $pendaftar->nilai_wawancara ?? 'Sedang diproses' }}</p>
    <p><strong>Rata-Rata:</strong> {{ $rataRata ? $rataRata : 'Sedang diproses' }}</p>
    <p><strong>Status:</strong> {{ $status }}</p>
</body>
</html>
