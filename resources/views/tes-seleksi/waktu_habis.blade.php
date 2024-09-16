@extends('layouts.waktu_habis_app')

@section('title', 'Waktu Habis')

@section('content')
    <div class="container">
        <div class="alert">
            <h4>Waktu Habis</h4>
            <p>Maaf, waktu untuk mengerjakan ujian telah habis.</p>
        </div>
        <a href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
@endsection
