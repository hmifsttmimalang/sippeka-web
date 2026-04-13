<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTes extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan_id',
        'tanggal_pelaksanaan',
        'waktu_pelaksanaan',
    ];

    // Relasi dengan model Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
