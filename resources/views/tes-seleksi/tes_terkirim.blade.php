@extends('layouts.respon-tes-app')

@section('title', 'Ujian Selesai')

@section('terkirim')
    @vite('resources/css/terkirim.css')
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