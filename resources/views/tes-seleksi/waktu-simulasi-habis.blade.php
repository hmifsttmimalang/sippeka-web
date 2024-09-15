@extends('layouts.waktu-habis-app')

@section('title', 'Waktu Simulasi Habis')

@section('content')
    <div class="container">
        <div class="alert">
            <h4>Waktu Habis</h4>
            <p>Maaf, waktu untuk mengerjakan ujian simulasi telah habis. Silakan coba lagi!</p>
        </div>
        <a href="{{ route('simulasi_peserta', ['username' => auth()->user()->username]) }}" class="btn btn-primary">Kerjakan Ulang</a>
        <a href="{{ route('user', ['username' => auth()->user()->username]) }}" class="btn btn-danger">Kembali ke Dashboard</a>
    </div>
@endsection
