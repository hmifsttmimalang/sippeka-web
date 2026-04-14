<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $table = 'questions';
    protected $fillable = [
        'skill_test_id',
        'soal',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar'
    ];

    public function skillTest(): BelongsTo
    {
        return $this->belongsTo(SkillTest::class, 'skill_test_id');
    }
}
