<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Peserta</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10px;
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
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .text-left {
            text-align: left;
        }

        .badge {
            font-weight: bold;
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

    <div class="title">
        Pengumuman Hasil Seleksi Calon Peserta<br>
        Pelatihan Berbasis Kompetensi Keahlian
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Keahlian</th>
                <th width="50">Tes</th>
                <th width="50">Wawancara</th>
                <th width="50">Rata-rata</th>
                <th width="60">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $item->name }}</td>
                    <td class="text-left">{{ $item->address }}</td>
                    <td>{{ $item->skill->name ?? '-' }}</td>
                    <td>{{ number_format($item->skill_test_score, 1) }}</td>
                    <td>{{ $item->interview_score !== null ? number_format($item->interview_score, 1) : '-' }}</td>
                    <td>{{ $item->average_score !== null ? number_format($item->average_score, 1) : '-' }}</td>
                    <td>
                        <span class="badge">
                            @if ($item->average_score === null)
                                Processing
                            @elseif($item->average_score >= 70)
                                Passed
                            @else
                                Failed
                            @endif
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
