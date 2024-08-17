<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .pertanyaan {
        margin-bottom: 20px;
    }

    .pertanyaan .tanya {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .pertanyaan .jawab {
        margin-bottom: 10px;
    }

    .benar {
        color: #0f0;
    }

    .salah {
        color: #f00;
    }
</style>

<?php
$score = 0;
$userAnswers = $_SESSION['userAnswers'];

foreach ($questions as $question) {
    $userAnswer = $userAnswers[$question['id']];
    if (in_array($question['jawaban_benar'], $userAnswer)) {
        $score++;
    }
}


?>

<div class="container">
    <h1>Hasil Ujian</h1>

    <ol>
        <?php foreach ($questions as $question) : ?>
            <?php $userAnswer = $userAnswers[$question['id']]; ?>
            <li class="pertanyaan">
                <p class="tanya"><?= $question['soal'] ?></p>
                <p class="jawab">Jawaban Benar: <span class="benar"><?= $question['jawaban_benar'] ?></span></p>
                <?php if (isCorrectAnswer($userAnswer, $question['jawaban_benar'])) : ?>
                    <p class="jawab">Jawaban Anda: <span class="benar"><?= implode(', ', $userAnswer) ?></span></p>
                <?php else : ?>
                    <p class="jawab">Jawaban Anda: <span class="salah"><?= implode(', ', $userAnswer) ?></span></p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
    <p>Skor: <?= $score . ' / ' . count($questions) ?></p>

    <?php if ($score >= (count($questions) * 0.7)) : ?>
        <p class="alert alert-success">Selamat! Anda telah lulus ujian dengan skor <?= $score ?></p>
    <?php else : ?>
        <p class="alert alert-danger">Maaf, Anda belum lulus ujian. Skor Anda adalah <?= $score ?> Silakan mencoba lagi!</p>
    <?php endif; ?>
</div>

<?php
function isCorrectAnswer($userAnswer, $correctAnswer) {
    return in_array($correctAnswer, $userAnswer);
}
?>