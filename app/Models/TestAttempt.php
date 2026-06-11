<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'skill_test_session_id',
        'status',
        'answers',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    // Relasi ke model Registration
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    // Relasi ke model SkillTestSession
    public function skillTestSession()
    {
        return $this->belongsTo(SkillTestSession::class);
    }
}
