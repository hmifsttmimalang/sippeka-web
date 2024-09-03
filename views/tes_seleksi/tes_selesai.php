<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Sudah Dikerjakan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.375rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .icon-info {
            font-size: 3rem;
            color: #17a2b8;
            margin-bottom: 1rem;
        }
        .alert {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 1.5rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            border: 1px solid #bee5eb;
        }
        .alert h4 {
            margin-top: 0;
            font-size: 1.75rem;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            color: #ffffff;
            background-color: #007bff;
            border: 1px solid #007bff;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon-info">ℹ️</div>
        <div class="alert">
            <h4>Anda Sudah Mengerjakan Ujian</h4>
            <p>Anda sudah menyelesaikan ujian ini. Tidak diperbolehkan untuk mengakses atau mengerjakan kembali.</p>
        </div>
        <a href="/user" class="btn">Kembali ke Dashboard</a>
    </div>
</body>
</html>