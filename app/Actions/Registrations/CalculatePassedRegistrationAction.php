<?php

namespace App\Actions\Registrations;

use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class CalculatePassedRegistrationAction
{
    /**
     * Menghitung jumlah pendaftar yang lulus berdasarkan kriteria:
     * (skill_test_score + interview_score) / 2 >= 70.
     */
    public function execute(): int
    {
        return Registration::query()
            ->whereNotNull('skill_test_score')
            ->whereNotNull('interview_score')
            ->where(DB::raw('((skill_test_score + interview_score) / 2)'), '>=', 70)
            ->count();
    }
}
