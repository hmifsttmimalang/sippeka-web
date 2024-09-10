<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;
use Exception;

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
        'foto_ktp',
        'foto_ijazah',
        'foto_bg_biru',
        'foto_kk',
        'nilai_keahlian',
        'nilai_wawancara'
    ];

    public function keahlian()
    {
        return $this->belongsTo(Skill::class);
    }

    public function validateTanggalLahir($tanggal_lahir)
    {
        $dateOfBirth = new \DateTime($tanggal_lahir);
        $today = new \DateTime();
        $age = $today->diff($dateOfBirth)->y;

        if ($age < 17 || $age >= 40) {
            throw new Exception('Anda harus berusia minimal 17 tahun dan maksimal 40 tahun untuk mendaftar!');
        }

        return true;
    }

    public function saveTesKeahlian($user_id, $nilai_keahlian)
    {
        $this->where('user_id', $user_id)->update(['nilai_keahlian' => $nilai_keahlian]);
    }

    public function getNilaiTesKeahlian($user_id)
    {
        return $this->where('user_id', $user_id)->value('nilai_keahlian');
    }

    public function saveTesWawancara($user_id, $nilai_wawancara)
    {
        $this->where('user_id', $user_id)->update(['nilai_wawancara' => $nilai_wawancara]);
    }

    public function deleteRegistration($id)
    {
        $this->find($id)->delete();
    }
}
