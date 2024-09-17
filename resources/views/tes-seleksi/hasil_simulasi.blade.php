@extends('layouts.respon_tes_app')

@section('title', 'Hasil Simulasi')

@section('hasil_simulasi')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite('resources/css/hasil_simulasi.css')
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Hasil Simulasi Ujian</h1>
        <hr>
        <center>
            <a href="{{ route('user.dashboard', ['username' => auth()->user()->username]) }}" class="btn btn-danger">Kembali
                ke Dashboard</a>
            <a href="{{ route('user.simulasi', ['username' => auth()->user()->username]) }}" class="btn btn-primary">Kerjakan
                Ulang</a>
        </center>
        <hr>
        <strong>
            <p class="text-center">Riwayat soal yang dikerjakan</p>
        </strong>
        <ol>
            @foreach ($questions as $question)
                @if (isset($userAnswers[$question->id]))
                    @php
                        // Ambil jawaban pengguna
                        $userAnswer = is_array($userAnswers[$question->id])
                            ? $userAnswers[$question->id]
                            : explode(',', $userAnswers[$question->id]);

                        // Pastikan ada jawaban benar yang didefinisikan untuk pertanyaan ini
                        $correctAnswerExists = isset($question->jawaban_benar);

                        // Cek apakah jawaban pengguna benar
                        $isCorrect = $correctAnswerExists && in_array($question->jawaban_benar, $userAnswer);

                        // Bersihkan elemen HTML dari jawaban
                        $choices = [
                            'A' => strip_tags($question->pilihan_a ?? ''),
                            'B' => strip_tags($question->pilihan_b ?? ''),
                            'C' => strip_tags($question->pilihan_c ?? ''),
                            'D' => strip_tags($question->pilihan_d ?? ''),
                        ];

                        // Menyusun tampilan jawaban Anda dengan keterangan lengkap
                        $userAnswerText = array_map(function ($answer) use ($choices) {
                            return isset($choices[$answer]) ? $answer . '. ' . $choices[$answer] : $answer;
                        }, $userAnswer);

                        // Menyusun tampilan jawaban benar dengan keterangan lengkap, jika ada
                        $correctAnswerText = $correctAnswerExists
                            ? $question->jawaban_benar . '. ' . $choices[$question->jawaban_benar]
                            : 'Tidak ada jawaban benar yang ditentukan.';
                    @endphp
                    <li class="pertanyaan">
                        <p class="tanya">{!! $question->soal !!}</p>
                        <p class="jawab">Jawaban Benar: <span class="benar">{{ $correctAnswerText }}</span></p>
                        <p class="jawab">Jawaban Anda:
                            <span class="{{ $isCorrect ? 'benar' : 'salah' }}">
                                {{ implode(', ', $userAnswerText) }}
                            </span>
                        </p>
                    </li>
                @endif
            @endforeach
        </ol>
        <hr>
        <p class="text-center">{{ $score }} dari {{ count($questions) }} soal yang benar</p>

        @if ($scorePercentage >= 70 && $scorePercentage <= 100)
            <p class="alert alert-success">Nilai Anda {{ $scorePercentage }}, tingkatkan dan pertahankan!</p>
        @else
            <p class="alert alert-danger">Nilai Anda {{ $scorePercentage }}, coba lagi!</p>
        @endif
    </div>
@endsection
