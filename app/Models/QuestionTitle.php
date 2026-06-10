<?php

namespace App\Models;

use Database\Factories\QuestionTitleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionTitle extends Model
{
    /** @use HasFactory<QuestionTitleFactory> */
    use HasFactory;

    protected $table = 'question_titles';

    protected $fillable = ['name'];

    public function skillTests(): HasMany
    {
        return $this->hasMany(SkillTest::class, 'question_title_id');
    }
}
