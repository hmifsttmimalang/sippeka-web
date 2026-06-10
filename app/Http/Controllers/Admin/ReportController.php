<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ReportService;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function __construct(
        private ReportService $reportService
    ) {}

    public function downloadRegistrationPdf($id): Response
    {
        $pdf = $this->reportService->generateRegistrationPdf($id);

        return $pdf->download('detail_pendaftar_'.$id.'.pdf');
    }

    public function downloadParticipantsPdf(): Response
    {
        $pdf = $this->reportService->generateParticipantsPdf();

        return $pdf->download('data_peserta_keseluruhan.pdf');
    }
}
