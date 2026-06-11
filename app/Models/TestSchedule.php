<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSchedule extends Model
{
    use HasFactory;

    protected $table = 'test_schedules';

    protected $fillable = [
        'major_id',
        'test_date',
        'test_time',
    ];

    // Relasi dengan model Major
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
