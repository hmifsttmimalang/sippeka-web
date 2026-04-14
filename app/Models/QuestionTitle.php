<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionTitle extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionTitleFactory> */
    use HasFactory;

    protected $table = 'question_titles';
    protected $fillable = ['nama'];

    public function skillTests(): HasMany
    {
        return $this->hasMany(SkillTest::class, 'mata_soal');
    }
}
