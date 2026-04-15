<?php

namespace App\Actions\Admin\Questions;

use App\Models\Question;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportQuestionAction
{
    public function execute(string $filePath, int $testId): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $count = 0;

        for ($row = 2; $row <= $highestRow; $row++) {
            $questionValue = $worksheet->getCell('A'.$row)->getValue();
            if (empty($questionValue)) {
                continue;
            }

            $correctAnswer = strtolower(trim($worksheet->getCell('F'.$row)->getValue()));

            Question::create([
                'skill_test_id' => $testId,
                'question_text' => $questionValue,
                'option_a' => $worksheet->getCell('B'.$row)->getValue(),
                'option_b' => $worksheet->getCell('C'.$row)->getValue(),
                'option_c' => $worksheet->getCell('D'.$row)->getValue(),
                'option_d' => $worksheet->getCell('E'.$row)->getValue(),
                'correct_answer' => in_array($correctAnswer, ['a', 'b', 'c', 'd']) ? $correctAnswer : 'a',
            ]);

            $count++;
        }

        return $count;
    }
}
