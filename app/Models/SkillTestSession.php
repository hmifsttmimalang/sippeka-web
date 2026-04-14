<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillTestSession extends Model
{
    use HasFactory;

    protected $table = 'skill_test_sessions';
    protected $fillable = [
        'nama_sesi',
        'skill_test_id',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_sesi'
    ];

    public function skillTest()
    {
        return $this->belongsTo(SkillTest::class);
    }

    public function test()
    {
        return $this->belongsTo(SkillTest::class, 'skill_test_id');
    }

    public function testAttempts()
    {
        return $this->hasMany(TestAttempt::class);
    }
}
