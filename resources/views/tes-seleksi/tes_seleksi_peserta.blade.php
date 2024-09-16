@extends('layouts.seleksi-app')

@section('title', 'Ujian Seleksi')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Kolom Soal -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="question-container">
                            <div class="d-flex justify-content-between mb-3">
                                <h5>Soal No. <span id="current-question-number">1</span></h5>
                                <span class="badge badge-info mb-2 timer" id="timer"
                                    style="height:30px; line-height:25px;">
                                    <i class="bi bi-clock-fill"></i>
                                    <span id="timer-text">1 jam 30 menit 00 detik</span>
                                </span>
                            </div>
                            <hr class="sidebar-divider">

                            <!-- Looping Soal -->
                            <?php $currentQuestion = 1; ?>
                            @foreach ($questions as $question)
                                <div id="question-{{ $question->id }}" class="question"
                                    style="display: {{ $currentQuestion == $question['id'] ? 'block' : 'none' }}">
                                    <p><strong>{!! $question->soal !!}</strong></p>
                                    <div class="mb-3">
                                        <div class="question-option-container d-flex align-items-center">
                                            <button class="btn btn-outline-primary option-btn">A</button>
                                            <span class="mx-2">{!! $question->pilihan_a !!}</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="question-option-container d-flex align-items-center">
                                            <button class="btn btn-outline-primary option-btn">B</button>
                                            <span class="mx-2">{!! $question->pilihan_b !!}</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="question-option-container d-flex align-items-center">
                                            <button class="btn btn-outline-primary option-btn">C</button>
                                            <span class="mx-2">{!! $question->pilihan_c !!}</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="question-option-container d-flex align-items-center">
                                            <button class="btn btn-outline-primary option-btn">D</button>
                                            <span class="mx-2">{!! $question->pilihan_d !!}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <hr class="sidebar-divider">
                            <!-- Navigasi Soal -->
                            <div class="navigation-buttons d-flex justify-content-between">
                                <button class="btn btn-secondary" id="prev-question">Sebelumnya</button>
                                <button class="btn btn-secondary" id="next-question">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Navigasi -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Soal Dikerjakan Badge -->
                        <div class="mb-3 text-center">
                            <span class="badge badge-success mb-2" id="completed-badge"
                                style="height: 30px; line-height: 25px;">
                                0 Dikerjakan
                            </span>
                        </div>
                        <hr class="sidebar-divider">
                        <!-- Navigasi Soal -->
                        <div class="question-nav mb-3 text-center">
                            <?php $i = 1; foreach ($questions as $item) : ?>
                            <button class="btn btn-outline-primary question-nav-btn"
                                id="question-<?= $item['id'] ?>-nav"><?= $i++ ?></button>
                            <?php endforeach; ?>
                        </div>
                        <hr class="sidebar-divider">
                        <!-- Tombol Akhiri Ujian -->
                        <form action="{{ route('kirim_jawaban_seleksi', ['username' => auth()->user()->username]) }}"
                            method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="userAnswers" value='<?= json_encode([]) ?>'>
                            <button class="btn btn-danger btn-block" id="finish-test">Akhiri Ujian</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection