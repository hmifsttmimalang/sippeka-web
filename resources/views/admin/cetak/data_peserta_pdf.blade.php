<!DOCTYPE html>
<html>
<head>
    <title>Data Peserta</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Peserta</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Keahlian</th>
                <th>Nilai Tes Keahlian</th>
                <th>Nilai Tes Wawancara</th>
                <th>Rata-Rata</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listPendaftar as $item)
                @php
                    $rataRata = is_null($item->nilai_keahlian) || is_null($item->nilai_wawancara)
                        ? 'Sedang diproses'
                        : ($item->nilai_keahlian + $item->nilai_wawancara) / 2;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->keahlian_nama }}</td>
                    <td>{{ $item->nilai_keahlian ?? 'Sedang diproses' }}</td>
                    <td>{{ $item->nilai_wawancara ?? 'Sedang diproses' }}</td>
                    <td>{{ $rataRata }}</td>
                    <td>
                        @if ($rataRata === 'Sedang diproses')
                            <span>Sedang diproses</span>
                        @elseif ($rataRata <= 100 && $rataRata >= 70)
                            <span>Lulus</span>
                        @elseif ($rataRata < 70)
                            <span>Gagal</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
