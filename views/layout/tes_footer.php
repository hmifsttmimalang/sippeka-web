<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        var currentIndex = 0;
        var questionIds = <?= json_encode(array_column($questions, 'id')); ?>;

        // Pastikan semua pertanyaan disembunyikan terlebih dahulu
        $('.question').hide();

        if (questionIds.length > 0) {
            showQuestion(questionIds[currentIndex]);
        }

        // Temukan soal pertama yang sesuai dengan `tes_keahlian_id`
        var firstQuestionId = '<?= isset($questions[0]['id']) ? $questions[0]['id'] : '' ?>';

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
            $('#question-' + questionId).show();
            $('#current-question-number').text(questionIds.indexOf(questionId) + 1);
        }

        // Inisialisasi state pertanyaan
        var questionStates = {};

        $('.option-btn').on('click', function() {
            var questionId = $(this).closest('.question').attr('id').replace('question-', '');
            var navButton = $('#question-' + questionId + '-nav');
            var optionBtnsState = questionStates[questionId] || {
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

        var completedCount = 0;
        updateBadgeCount();

        function updateBadgeCount() {
            completedCount = 0;
            for (var questionId in questionStates) {
                if (questionStates.hasOwnProperty(questionId)) {
                    var state = questionStates[questionId];
                    if (state.navButtonClass === 'btn-primary') {
                        completedCount++;
                    }
                }
            }
            $('#completed-badge').text(completedCount + ' Dikerjakan');
        }

        $('#finish-test').click(function(e) {
            e.preventDefault();
            var userAnswers = {};
            $.each(questionStates, function(questionId, state) {
                userAnswers[questionId] = state.optionBtns;
            });

            $.ajax({
                url: '/seleksi_peserta',
                method: 'post',
                data: {
                    userAnswers: JSON.stringify(userAnswers)
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        console.log('Skor:', response.score);
                        console.log('Persentase Skor:', response.scorePercentage, '%');
                    } else {
                        console.error('Error:', response.message);
                    }
                    alert('Ujian terkirim');
                    window.location.href = '/user';
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Error: ' + error);
                }
            });
        });

        var remainingTime = <?= $remainingSeconds ?>;
        var timerValue = remainingTime;
        var timerInterval;

        $('#timer-text').text(formatTime(timerValue));

        timerInterval = setInterval(function() {
            timerValue -= 1;
            $('#timer-text').text(formatTime(timerValue));
            if (timerValue <= 0) {
                clearInterval(timerInterval);
                alert('Waktu habis!');
                window.location.href = '/waktu_habis';
            }
        }, 1000);

        function formatTime(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var seconds = seconds % 60;
            return hours + ' jam, ' + minutes + ' menit, ' + padZero(seconds) + ' detik';
        }

        function padZero(number) {
            return (number < 10 ? '0' : '') + number;
        }
    });
</script>
</body>

</html>