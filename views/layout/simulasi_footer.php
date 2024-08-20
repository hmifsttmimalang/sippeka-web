<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        var currentQuestion = 1;
        var totalQuestions = <?= count($questions) ?>;
        var questionId; // Define questionId as a global variable
        var questionStates = {};

        showQuestion(currentQuestion);

        // Hide all questions except the first one
        $('.question').hide();
        $('#question-1').show();

        // Add event listeners to navigation buttons
        $('#prev-question').click(function() {
            currentQuestion--;
            if (currentQuestion < 1) {
                currentQuestion = 1;
            }
            showQuestion(currentQuestion);
        });

        $('#next-question').click(function() {
            currentQuestion++;
            if (currentQuestion > totalQuestions) {
                currentQuestion = totalQuestions;
            }
            showQuestion(currentQuestion);
        });

        $('.question-nav button').click(function() {
            questionId = $(this).attr('id').replace('question-', '');
            currentQuestion = parseInt(questionId);
            showQuestion(currentQuestion);
        });

        function showQuestion(questionId) {
            $('.question').hide();
            $('#question-' + questionId).show();
            $('#current-question-number').text(questionId);

            // Restore the state of the current question's option buttons and nav buttons
            if (questionStates[questionId]) {
                var state = questionStates[questionId];
                $('.option-btn', '#question-' + questionId).each(function() {
                    if (state.optionBtns.includes($(this).text())) {
                        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                    } else {
                        $(this).removeClass('btn-primary').addClass('btn-outline-primary');
                    }
                });
                $('#question-' + questionId + '-nav').removeClass('btn-outline-primary').addClass(state.navButtonClass);
            }
        }

        // Initialize the questionStates object from localStorage
        // var questionStates = JSON.parse(localStorage.getItem('questionStates')) || {};
        var questionStates = {};

        $('.option-btn').on('click', function() {
            var questionId = $(this).closest('.question').attr('id').replace('question-', '');
            var navButton = $('#question-' + questionId + '-nav');
            var optionBtnsState = questionStates[questionId] || {
                optionBtns: [],
                navButtonClass: 'btn-outline-primary'
            };

            // Store the user's answer in the questionStates object
            var questionId = $(this).closest('.question').attr('id').replace('question-', '');
            var optionBtnsState = questionStates[questionId] || {
                optionBtns: [],
                navButtonClass: 'btn-outline-primary'
            };

            $('.option-btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).toggleClass('btn-primary btn-outline-primary');

            // Clear the optionBtns array when a new option is selected
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

            // Store the updated questionStates object in localStorage
            localStorage.setItem('questionStates', JSON.stringify(questionStates));
            updateBadgeCount();
        });

        // Initialize the badge count on page load
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
            e.preventDefault(); // Mencegah form default submission

            var userAnswers = {};
            $.each(questionStates, function(questionId, state) {
                userAnswers[questionId] = state.optionBtns;
            });

            console.log('User Answers before sending:', JSON.stringify(userAnswers));

            $.ajax({
                url: '/simulasi_peserta',
                method: 'post',
                data: {
                    userAnswers: JSON.stringify(userAnswers) // Pastikan ini adalah JSON string
                },
                dataType: 'json',
                success: function(response) {
                    window.location.href = '/hasil_simulasi'; // Redirect ke halaman hasil
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response:', xhr.responseText);
                    alert('Error: ' + error);
                }
            });
        });

        // Set the initial timer value
        var timerValue = 5400; // 1 hour, 30 minutes, 00 seconds in seconds
        var timerInterval;

        // Display the initial timer value
        $('#timer-text').text(formatTime(timerValue));

        // Start the timer when the page loads
        timerInterval = setInterval(function() {
            timerValue -= 1; // decrement by 1 seconds each time
            $('#timer-text').text(formatTime(timerValue));
            if (timerValue <= 0) {
                clearInterval(timerInterval);
                alert('Waktu habis!');
            }
        }, 1000); // decrement every 1000ms (1 second)

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