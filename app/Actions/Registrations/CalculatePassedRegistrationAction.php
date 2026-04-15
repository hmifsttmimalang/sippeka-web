<?php

namespace App\Actions\Registrations;

use App\Models\Registration;

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
            ->whereRaw('((skill_test_score + interview_score) / 2) >= 70')
            ->count();
    }
}
