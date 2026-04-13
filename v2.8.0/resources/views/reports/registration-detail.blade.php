<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            color: #64748b;
            letter-spacing: 2px;
        }
        .section-title {
            background-color: #f8fafc;
            padding: 8px 15px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            margin-top: 20px;
            border-left: 4px solid #4f46e5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table td {
            padding: 8px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 30%;
            color: #64748b;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f0fdf4;
            color: #166534;
            border-radius: 5px;
            font-weight: bold;
            font-size: 10px;
        }
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            padding: 10px;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SIPPEKA ENTERPRISE</h1>
        <p>Sistem Informasi Pendaftaran dan Pelaksanaan Kursus Keahlian</p>
    </div>

    <div class="section-title">Informasi Peserta</div>
    <table>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>{{ $reg->nama }}</td>
        </tr>
        <tr>
            <td class="label">Username</td>
            <td>{{ $reg->user->username }}</td>
        </tr>
        <tr>
            <td class="label">TTL</td>
            <td>{{ $reg->tempat_lahir }}, {{ $reg->tanggal_lahir->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td>{{ $reg->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td class="label">Telepon / WA</td>
            <td>{{ $reg->telepon }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td>{{ $reg->alamat }}</td>
        </tr>
    </table>

    <div class="section-title">Program & Pelatihan</div>
    <table>
        <tr>
            <td class="label">Program Keahlian</td>
            <td><strong>{{ $reg->keahlian_rel->nama }}</strong></td>
        </tr>
        <tr>
            <td class="label">Tanggal Registrasi</td>
            <td>{{ $reg->created_at->format('d F Y') }}</td>
        </tr>
    </table>

    <div class="section-title">Hasil Evaluasi</div>
    <table>
        <tr>
            <td class="label">Nilai Seleksi (Technical)</td>
            <td>{{ number_format($reg->nilai_keahlian, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Nilai Wawancara (Soft-skill)</td>
            <td>{{ $reg->nilai_wawancara !== null ? number_format($reg->nilai_wawancara, 2) : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Rata-rata Akhir</td>
            <td>{{ $reg->average_score !== null ? number_format($reg->average_score, 2) : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Status Kelulusan</td>
            <td>
                <span class="status-badge">
                    {{ strtoupper($reg->status) }}
                </span>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dihasilkan secara otomatis oleh Sistem SIPPEKA pada {{ date('d-m-Y H:i:s') }}.<br>
        Dokumen ini merupakan hasil validasi resmi sistem evaluasi terpadu.
    </div>
</body>
</html>
