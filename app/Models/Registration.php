<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'user_id',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'address',
        'phone',
        'skill_id',
        'identity_document_path',
        'certificate_document_path',
        'formal_photo_path',
        'skill_score',
        'interview_score',
        'verification_status',
        'verification_notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'skill_score' => 'float',
        'interview_score' => 'float',
    ];

    /**
     * Get the average score.
     */
    protected function averageScore(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->skill_score !== null && $this->interview_score !== null)
                ? ($this->skill_score + $this->interview_score) / 2
                : null,
        );
    }

    /**
     * Get the status based on average score.
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->skill_score === null) {
                    return 'Not Yet Tested';
                }

                if ($this->interview_score === null) {
                    return 'In Progress';
                }

                return $this->average_score >= 70 ? 'Passed' : 'Failed';
            },
        );
    }

    /**
     * Get the formatted birth date.
     */
    protected function formattedBirthDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date_of_birth ? $this->date_of_birth->translatedFormat('d F Y') : '-',
        );
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function testAttempts(): HasMany
    {
        return $this->hasMany(TestAttempt::class);
    }

    public function validateAge(): bool
    {
        if (! $this->date_of_birth) {
            return false;
        }

        $age = $this->date_of_birth->age;

        if ($age < 15 || $age >= 40) {
            throw new Exception('Anda harus berusia minimal 15 tahun dan maksimal 40 tahun untuk mendaftar!');
        }

        return true;
    }
}
