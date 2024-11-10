$(document).ready(function () {
    let currentIndex = 0;
    const skillTestSessionId = $('input[name="skill_test_session_id"]').val();
    const questionIds = window.questionIds;
    const username = window.username;
    const csrfToken = window.csrfToken;

    // Ambil status jawaban dari localStorage saat halaman dimuat
    let questionStates = JSON.parse(localStorage.getItem('questionStates')) || {};

    // Pastikan semua pertanyaan disembunyikan terlebih dahulu
    $('.question').hide();

    if (questionIds.length > 0) {
        showQuestion(questionIds[currentIndex]);
    }

    // Navigasi soal sebelumnya
    $('#prev-question').click(function () {
        if (currentIndex > 0) {
            currentIndex--;
            showQuestion(questionIds[currentIndex]);
        }
    });

    // Navigasi soal selanjutnya
    $('#next-question').click(function () {
        if (currentIndex < questionIds.length - 1) {
            currentIndex++;
            showQuestion(questionIds[currentIndex]);
        }
    });

    $('.question-nav button').click(function () {
        const buttonId = $(this).attr('id');
        const questionId = buttonId.replace('question-', '').replace('-nav', '');
        showQuestion(parseInt(questionId));
    });

    function showQuestion(questionId) {
        $('.question').hide();
        $(`#question-${questionId}`).show();

        // Perbarui nomor soal saat ini jika diperlukan
        $('#current-question-number').text(questionId);

        // Terapkan status jawaban yang disimpan
        const state = questionStates[questionId] || {};
        const optionBtns = state.optionBtns || [];

        // Set status tombol navigasi
        const navButton = $(`#question-${questionId}-nav`);
        if (state.navButtonClass === 'btn-primary') {
            navButton.removeClass('btn-outline-primary').addClass('btn-primary');
        } else {
            navButton.removeClass('btn-primary').addClass('btn-outline-primary');
        }

        // Set status tombol jawaban
        $(`#question-${questionId} .option-btn`).each(function () {
            const btnText = $(this).text();
            if (optionBtns.includes(btnText)) {
                $(this).addClass('btn-primary').removeClass('btn-outline-primary');
            } else {
                $(this).removeClass('btn-primary').addClass('btn-outline-primary');
            }
        });
    }

    $('.option-btn').on('click', function () {
        const questionId = $(this).closest('.question').attr('id').replace('question-', '');
        const navButton = $(`#question-${questionId}-nav`);
        const optionBtnsState = questionStates[questionId] || {
            optionBtns: [],
            navButtonClass: 'btn-outline-primary'
        };

        // Nonaktifkan semua tombol untuk pertanyaan ini
        $(`#question-${questionId} .option-btn`).removeClass('btn-primary').addClass('btn-outline-primary');

        // Aktifkan tombol yang diklik
        $(this).toggleClass('btn-primary btn-outline-primary');

        // Perbarui status pilihan jawaban
        optionBtnsState.optionBtns = [];
        if ($(this).hasClass('btn-primary')) {
            optionBtnsState.optionBtns.push($(this).text());
            navButton.removeClass('btn-outline-primary').addClass('btn-primary');
            optionBtnsState.navButtonClass = 'btn-primary';
        } else {
            navButton.removeClass('btn-primary').addClass('btn-outline-primary');
            optionBtnsState.navButtonClass = 'btn-outline-primary';
        }

        // Simpan status pertanyaan
        questionStates[questionId] = optionBtnsState;

        // Simpan ke localStorage
        localStorage.setItem('questionStates', JSON.stringify(questionStates));
        updateBadgeCount();
    });

    function updateBadgeCount() {
        let completedCount = 0;
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

    document.querySelectorAll(".finish-test").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const form = this.closest("form");

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: "btn btn-danger",
                    confirmButton: "btn btn-primary",
                    actions: "swal2-button-space",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Apakah kamu ingin mengakhiri ujian?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        const userAnswers = {};

                        // Mengumpulkan jawaban dari questionStates
                        $.each(questionStates, function (questionId, state) {
                            // Hapus spasi dan newline dari jawaban
                            userAnswers[questionId] = (state.optionBtns || []).map(answer => answer.trim());
                        });

                        // Validasi jika userAnswers tidak kosong
                        if (Object.keys(userAnswers).length === 0) {
                            alert('Tidak ada jawaban yang dipilih.');
                            return;
                        }
                        
                        $.ajax({
                            url: `/${username}/seleksi`,
                            method: 'POST',
                            data: {
                                userAnswers: JSON.stringify(userAnswers), // Mengirim jawaban sebagai JSON string
                                skill_test_session_id: skillTestSessionId,
                                _token: csrfToken // Token CSRF
                            },
                            dataType: 'json',
                            success: function (response) {
                                // Hapus localStorage setelah jawaban dikirim
                                localStorage.removeItem('questionStates');

                                // Redirect ke halaman hasil setelah jawaban dikirim
                                window.location.href = `/${username}/seleksi-terkirim`;
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat mengirimkan jawaban. Silakan coba lagi.');
                            }
                        });
                    }
                });
        });
    });

    // Hitung selisih waktu
    let remainingTime = window.remainingTime;
    let timerInterval;

    // Format waktu untuk tampilan
    function formatTime(totalSeconds) {
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;
        return `${hours} jam, ${minutes} menit, ${padZero(seconds)} detik`;
    }

    function padZero(number) {
        return (number < 10 ? '0' : '') + number;
    }

    $(document).ready(function () {
        // Inisialisasi tampilan timer
        $('#timer-text').text(formatTime(remainingTime));

        // Mulai countdown
        timerInterval = setInterval(function () {
            remainingTime -= 1;
            $('#timer-text').text(formatTime(remainingTime));

            // Ketika waktu habis, redirect ke halaman 'waktu habis'
            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                window.location.href = `/${username}/waktu-seleksi-habis`;
            }
        }, 1000);
    });
});