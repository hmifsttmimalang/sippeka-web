@extends('layouts.simulasi-app')

@section('title', 'Ujian Simulasi')

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
                        <form action="{{ route('kirim_jawaban_simulasi', ['username' => auth()->user()->username]) }}"
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentIndex = 0;
            const questionIds = <?= json_encode($questions->pluck('id')->toArray()) ?>;
            const username = '<?= auth()->user()->username ?>'; // Ambil username dari Laravel

            // Pastikan semua pertanyaan disembunyikan terlebih dahulu
            $('.question').hide();

            if (questionIds.length > 0) {
                showQuestion(questionIds[currentIndex]);
            }

            // Temukan soal pertama yang sesuai dengan `tes_keahlian_id`
            const firstQuestionId = "<?= isset($questions[0]['id']) ? $questions[0]['id'] : '' ?>";

            // Navigasi soal sebelumnya
            $('#prev-question').click(function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    showQuestion(questionIds[currentIndex]);
                }
            });

            // Navigasi soal selanjutnya
            $('#next-question').click(function() {
                if (currentIndex < questionIds.length - 1) {
                    currentIndex++;
                    showQuestion(questionIds[currentIndex]);
                }
            });

            $('.question-nav button').click(function() {
                questionId = $(this).attr('id').replace('question-', '');
                currentQuestion = parseInt(questionId);
                showQuestion(currentQuestion);
            });

            function showQuestion(questionId) {
                $('.question').hide();
                $(`#question-${questionId}`).show();
                $('#current-question-number').text(questionIds.indexOf(questionId) + 1);
            }

            // Inisialisasi state pertanyaan
            const questionStates = {};

            $('.option-btn').on('click', function() {
                const questionId = $(this).closest('.question').attr('id').replace('question-', '');
                const navButton = $('#question-' + questionId + '-nav');
                const optionBtnsState = questionStates[questionId] || {
                    optionBtns: [],
                    navButtonClass: 'btn-outline-primary'
                };

                $('.option-btn').removeClass('btn-primary').addClass('btn-outline-primary');
                $(this).toggleClass('btn-primary btn-outline-primary');

                optionBtnsState.optionBtns = [];

                if ($(this).hasClass('btn-primary')) {
                    optionBtnsState.optionBtns.push($(this).text());
                    navButton.removeClass('btn-outline-primary').addClass('btn-primary');
                    optionBtnsState.navButtonClass = 'btn-primary';
                } else {
                    navButton.removeClass('btn-primary').addClass('btn-outline-primary');
                    optionBtnsState.navButtonClass = 'btn-outline-primary';
                }

                questionStates[questionId] = optionBtnsState;

                localStorage.setItem('questionStates', JSON.stringify(questionStates));
                updateBadgeCount();
            });

            let completedCount = 0;
            updateBadgeCount();

            function updateBadgeCount() {
                completedCount = 0;
                for (const questionId in questionStates) {
                    if (questionStates.hasOwnProperty(questionId)) {
                        const state = questionStates[questionId];
                        if (state.navButtonClass === 'btn-primary') {
                            completedCount++;
                        }
                    }
                }
                $('#completed-badge').text(`${completedCount} Dikerjakan`);
            }

            $('#finish-test').click(function(e) {
                e.preventDefault();
                const userAnswers = {};
                $.each(questionStates, function(questionId, state) {
                    userAnswers[questionId] = state.optionBtns;
                });
                $.ajax({
                    url: `/${username}/simulasi`,
                    method: 'POST',
                    data: {
                        userAnswers: JSON.stringify(
                            userAnswers), // Mengirim jawaban sebagai JSON string
                        _token: '<?= csrf_token() ?>' // Jangan lupa menambahkan token CSRF
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Redirect ke halaman hasil setelah jawaban dikirim
                        window.location.href = `/${username}/hasil_simulasi`;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Error: ' + error);
                    }
                });
            });

            let timerValue = 5400;
            let timerInterval;

            $('#timer-text').text(formatTime(timerValue));

            timerInterval = setInterval(function() {
                timerValue -= 1;
                $('#timer-text').text(formatTime(timerValue));
                if (timerValue <= 0) {
                    clearInterval(timerInterval);
                    window.location.href = `/${username}/waktu_simulasi_habis`;
                }
            }, 1000);

            function formatTime(totalSeconds) {
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;
                return `${hours} jam, ${minutes} menit, ${padZero(seconds)} detik`;
            }

            function padZero(number) {
                return (number < 10 ? '0' : '') + number;
            }
        });
    </script>
@endsection
