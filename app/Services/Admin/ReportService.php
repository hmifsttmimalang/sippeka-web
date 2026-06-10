<?php

namespace App\Services\Admin;

use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDF;

class ReportService
{
    /**
     * Generate registration PDF.
     */
    public function generateRegistrationPdf(int $id): DomPDF
    {
        $registration = Registration::with(['skill', 'user'])->findOrFail($id);

        return Pdf::loadView('admin.reports.registration_pdf', [
            'registration' => $registration,
        ])->setPaper('a4', 'portrait');
    }

    /**
     * Generate participants PDF.
     */
    public function generateParticipantsPdf(): DomPDF
    {
        $registrations = Registration::with('skill')
            ->whereNotNull('skill_test_score')
            ->get()
            ->sortByDesc('average_score');

        return Pdf::loadView('admin.reports.participants_pdf', [
            'registrations' => $registrations,
        ])->setPaper('a4', 'portrait');
    }
}
