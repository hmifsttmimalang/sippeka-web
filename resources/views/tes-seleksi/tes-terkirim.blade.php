@extends('layouts.respon-tes-app')

@section('title', 'Ujian Selesai')

@section('terkirim')
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

        .icon-success {
            font-size: 3rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 1.5rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            border: 1px solid #c3e6cb;
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
@endsection

@section('content')
    <div class="container">
        <div class="icon-success">✔️</div>
        <div class="alert">
            <h4>Ujian Selesai</h4>
            <p>Ujian telah selesai Anda kerjakan, dan hasil jawaban Anda telah terkirim dengan sukses.</p>
        </div>
        <a href="{{ route('user', ['username' => auth()->user()->username]) }}" class="btn">Kembali ke Dashboard</a>
    </div>
@endsection
