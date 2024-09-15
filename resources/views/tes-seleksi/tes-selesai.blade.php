@extends('layouts.respon-tes-app')

@section('title', 'Ujian Selesai')

@section('sudah_dikerjakan')
@vite('resources/css/selesai.css')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="icon-info">ℹ️</div>
        <div class="alert">
            <h4>Anda Sudah Mengerjakan Ujian</h4>
            <p>Anda sudah menyelesaikan ujian ini. Tidak diperbolehkan untuk mengakses atau mengerjakan kembali.</p>
        </div>
        <a href="{{ route('user', ['username' => auth()->user()->username]) }}" class="btn">Kembali ke Dashboard</a>
    </div>
@endsection
