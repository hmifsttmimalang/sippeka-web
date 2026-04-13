<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    /**
     * Download the registration detail as PDF.
     */
    public function downloadRegistrationPdf(int $id)
    {
        $registration = Registration::with(['keahlian', 'user'])->findOrFail($id);
        
        // Pass data to blade template
        $pdf = Pdf::loadView('reports.registration-detail', [
            'reg' => $registration,
            'title' => 'Detail Pendaftaran Peserta - ' . $registration->nama
        ]);

        // Paper size: A4, Orientation: Portrait
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('pendaftaran_' . str_replace(' ', '_', strtolower($registration->nama)) . '.pdf');
    }
}
