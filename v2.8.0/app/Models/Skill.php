<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';
    protected $fillable = ['nama'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function skillTests()
    {
        return $this->hasMany(SkillTest::class);
    }
}
