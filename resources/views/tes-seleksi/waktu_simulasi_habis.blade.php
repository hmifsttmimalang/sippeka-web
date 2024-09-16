@extends('layouts.waktu_habis_app')

@section('title', 'Waktu Simulasi Habis')

@section('content')
    <div class="container">
        <div class="alert">
            <h4>Waktu Habis</h4>
            <p>Maaf, waktu untuk mengerjakan ujian simulasi telah habis. Silakan coba lagi!</p>
        </div>
        <a href="{{ route('user.simulasi', ['username' => auth()->user()->username]) }}" class="btn btn-primary">Kerjakan Ulang</a>
        <a href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}" class="btn btn-danger">Kembali ke Dashboard</a>
    </div>
@endsection
