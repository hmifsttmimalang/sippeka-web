<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Skill;
use App\Models\User;
use App\Models\TestAttempt;
use Exception;
use Carbon\Carbon;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'user_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'telepon',
        'keahlian',
        'foto_identitas',
        'foto_ijazah',
        'foto_bg_biru',
        'nilai_keahlian',
        'nilai_wawancara',
        'verification_status',
        'verification_notes'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'nilai_keahlian' => 'float',
        'nilai_wawancara' => 'float',
    ];

    /**
     * Get the average score.
     */
    protected function averageScore(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->nilai_keahlian !== null && $this->nilai_wawancara !== null)
                ? ($this->nilai_keahlian + $this->nilai_wawancara) / 2
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
                if ($this->nilai_keahlian === null) {
                    return 'Belum Mengikuti Tes';
                }
                
                if ($this->nilai_wawancara === null) {
                    return 'Sedang Diproses';
                }

                return $this->average_score >= 70 ? 'Lulus' : 'Gagal';
            },
        );
    }

    /**
     * Get the formatted birth date.
     */
    protected function formattedBirthDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_lahir ? $this->tanggal_lahir->translatedFormat('d F Y') : '-',
        );
    }

    public function keahlian_rel(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'keahlian');
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
        if (!$this->tanggal_lahir) {
            return false;
        }

        $age = $this->tanggal_lahir->age;

        if ($age < 15 || $age >= 40) {
            throw new Exception('Anda harus berusia minimal 15 tahun dan maksimal 40 tahun untuk mendaftar!');
        }

        return true;
    }
}
