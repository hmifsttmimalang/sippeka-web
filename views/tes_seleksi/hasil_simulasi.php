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

<div class="container">
    <h1>Hasil Ujian</h1>
    <ol>
        <?php foreach ($questions as $question) : ?>
            <?php if (isset($userAnswers[$question['id']])) : ?>
                <?php
                $userAnswer = is_array($userAnswers[$question['id']]) ? $userAnswers[$question['id']] : explode(',', $userAnswers[$question['id']]);
                $isCorrect = isCorrectAnswer($userAnswer, $question['jawaban_benar']);
                ?>
                <li class="pertanyaan">
                    <p class="tanya"><?= $question['soal'] ?></p>
                    <p class="jawab">Jawaban Benar: <span class="benar"><?= htmlspecialchars($question['jawaban_benar']) ?></span></p>
                    <p class="jawab">Jawaban Anda:
                        <span class="<?= $isCorrect ? 'benar' : 'salah' ?>">
                            <?= implode(', ', array_map('htmlspecialchars', $userAnswer)) ?>
                        </span>
                    </p>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>

    </ol>
    <p>Jumlah Soal yang Benar: <?= htmlspecialchars($score) . ' / ' . count($questions) ?></p>

    <?php if ($scorePercentage >= 70 && $scorePercentage <= 100) : ?>
        <p class="alert alert-success">Nilai Anda <?= htmlspecialchars($scorePercentage) ?>, tingkatkan dan pertahankan</p>
    <?php else : ?>
        <p class="alert alert-danger">Nilai Anda <?= htmlspecialchars($scorePercentage) ?>, coba lagi!</p>
    <?php endif; ?>
</div>

<?php
function isCorrectAnswer($userAnswer, $correctAnswer)
{
    return in_array($correctAnswer, $userAnswer);
}
?>