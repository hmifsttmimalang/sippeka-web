<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillTest extends Model
{
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

    public function mataSoal() 
    {
        return $this->belongsTo(QuestionTitle::class);
    }

    public function keahlian() 
    {
        return $this->belongsTo(Skill::class);
    }

    public function questions() 
    {
        return $this->hasMany(Question::class);
    }

    public function sesiTesKeahlian()
    {
        return $this->belongsTo(SkillTestSession::class);
    }
}
