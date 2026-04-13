<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillTest extends Model
{
    /** @use HasFactory<\Database\Factories\SkillTestFactory> */
    use HasFactory;

    protected $table = 'skill_tests';
    protected $fillable = [
        'nama_tes', 
        'mata_soal', 
        'keahlian', 
        'acak_soal', 
        'acak_jawaban', 
        'durasi_menit'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(QuestionTitle::class, 'mata_soal');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'keahlian');
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
