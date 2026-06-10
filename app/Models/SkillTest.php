<?php

namespace App\Models;

use Database\Factories\SkillTestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillTest extends Model
{
    /** @use HasFactory<SkillTestFactory> */
    use HasFactory;

    protected $table = 'skill_tests';

    protected $fillable = [
        'name',
        'question_title_id',
        'skill_id',
        'shuffle_questions',
        'shuffle_answers',
        'duration_minutes',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(QuestionTitle::class, 'question_title_id');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'skill_test_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SkillTestSession::class, 'skill_test_id');
    }
}
