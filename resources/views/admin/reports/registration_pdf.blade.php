<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail Pendaftar</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        /* Header Container - Legacy Style */
        .header-container {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
            padding-top: 10px;
        }

        .img-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 70px;
        }

        .img-right {
            position: absolute;
            right: 0;
            top: 0;
            width: 90px;
        }

        .text-container {
            display: inline-block;
            width: 80%;
        }

        .text-container p {
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }

        .ph-1 {
            font-size: 14px;
            text-transform: uppercase;
        }

        .ph-2 {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 2px 0;
        }

        .ph-3 {
            font-size: 10px;
            margin-top: 5px;
        }

        .line-divider {
            border-top: 3px solid #000;
            margin: 10px 0;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 14px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td {
            padding: 8px;
            vertical-align: top;
        }

        .label {
            width: 35%;
            font-weight: bold;
        }

        .value {
            width: 65%;
        }

        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-top: 25px;
            font-size: 12px;
        }

        .footer {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <img src="{{ public_path('assets/admin/img/logo_jatim.png') }}" class="img-left" alt="Logo Jatim">
        <div class="text-container">
            <p class="ph-1">PEMERINTAH PROVINSI JAWA TIMUR</p>
            <p class="ph-1">DINAS TENAGA KERJA DAN TRANSMIGRASI</p>
            <p class="ph-2">UPT BALAI LATIHAN KERJA SINGOSARI</p>
            <p class="ph-3">
                Jl. Raya Singosari Telp. (0341) 458055 – Fax. 458512<br>
                Website: www.silastri.org | Email: blki_sgs@yahoo.co.id<br>
                SINGOSARI – 65153
            </p>
        </div>
        <img src="{{ public_path('assets/admin/img/logo_iso.png') }}" class="img-right" alt="Logo ISO">
    </div>

    <div class="line-divider"></div>

    <div class="title">BIODATA PENDAFTAR</div>

    <table>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="value">: {{ $registration->name }}</td>
        </tr>
        <tr>
            <td class="label">Tempat, Tanggal Lahir</td>
            <td class="value">: {{ $registration->place_of_birth }},
                {{ \Carbon\Carbon::parse($registration->date_of_birth)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td class="value">: {{ $registration->gender }}</td>
        </tr>
        <tr>
            <td class="label">Agama</td>
            <td class="value">: {{ $registration->religion }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="value">: {{ $registration->address }}</td>
        </tr>
        <tr>
            <td class="label">Nomor Telepon</td>
            <td class="value">: {{ $registration->phone }}</td>
        </tr>
        <tr>
            <td class="label">Program Keahlian</td>
            <td class="value">: {{ $registration->skill->name ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">HASIL SELEKSI</div>
    <table>
        <tr>
            <td class="label">Nilai Tes Keahlian</td>
            <td class="value">: {{ number_format($registration->skill_score, 1) }}</td>
        </tr>
        <tr>
            <td class="label">Nilai Wawancara</td>
            <td class="value">:
                {{ $registration->interview_score !== null ? number_format($registration->interview_score, 1) : 'Belum dinilai' }}
            </td>
        </tr>
        <tr>
            <td class="label">Nilai Rata-rata</td>
            <td class="value">:
                {{ $registration->average_score !== null ? number_format($registration->average_score, 1) : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Status Akhir</td>
            <td class="value">: {{ $registration->status }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Singosari, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-top: 70px; font-weight: bold; text-decoration: underline;">PANITIA SELEKSI</p>
    </div>

    <!-- Page 2: Lampiran (Legacy Parity) -->
    <div style="page-break-before: always;"></div>
    <div class="header-container">
        <img src="{{ public_path('assets/admin/img/logo_jatim.png') }}" class="img-left" alt="Logo Jatim">
        <div class="text-container">
            <p class="ph-1">PEMERINTAH PROVINSI JAWA TIMUR</p>
            <p class="ph-1">DINAS TENAGA KERJA DAN TRANSMIGRASI</p>
            <p class="ph-2">UPT BALAI LATIHAN KERJA SINGOSARI</p>
        </div>
        <img src="{{ public_path('assets/admin/img/logo_iso.png') }}" class="img-right" alt="Logo ISO">
    </div>
    <div class="line-divider"></div>

    <div class="title">LAMPIRAN DOKUMEN</div>

    <div style="text-align: center; margin-top: 20px;">
        <p style="font-weight: bold; margin-bottom: 10px;">1. FOTO IDENTITAS (KTP/KK)</p>
        @if ($registration->identity_document_path && file_exists(storage_path('app/public/' . $registration->identity_document_path)))
            <img src="{{ public_path('storage/' . $registration->identity_document_path) }}"
                style="max-width: 450px; max-height: 350px; border: 1px solid #ddd; padding: 5px;">
        @else
            <div style="padding: 50px; border: 1px dashed #ccc; color: #999;">Foto Identitas belum diunggah atau tidak
                ditemukan</div>
        @endif
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <p style="font-weight: bold; margin-bottom: 10px;">2. IJAZAH TERAKHIR</p>
        @if ($registration->certificate_document_path && file_exists(storage_path('app/public/' . $registration->certificate_document_path)))
            <img src="{{ public_path('storage/' . $registration->certificate_document_path) }}"
                style="max-width: 450px; max-height: 350px; border: 1px solid #ddd; padding: 5px;">
        @else
            <div style="padding: 50px; border: 1px dashed #ccc; color: #999;">Foto Ijazah belum diunggah atau tidak
                ditemukan</div>
        @endif
    </div>
</body>
</html>
