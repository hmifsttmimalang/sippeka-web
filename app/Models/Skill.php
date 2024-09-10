<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';
    protected $fillable = ['nama'];

    // Relasi satu ke banyak dengan model Registration
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
