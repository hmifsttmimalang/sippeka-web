<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Skill;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function downloadRegistrationPdf($id)
    {
        $pendaftar = Registration::with(['skill', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.reports.registration_pdf', [
            'pendaftar' => $pendaftar,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('detail_pendaftar_' . $id . '.pdf');
    }

    public function downloadParticipantsPdf()
    {
        $listPendaftar = Registration::with('skill')
            ->whereNotNull('nilai_keahlian')
            ->get()
            ->map(function ($reg) {
                $reg->rata_rata = ($reg->nilai_keahlian !== null && $reg->nilai_wawancara !== null)
                    ? ($reg->nilai_keahlian + $reg->nilai_wawancara) / 2
                    : null;
                return $reg;
            })
            ->sortByDesc('rata_rata');

        $pdf = Pdf::loadView('admin.reports.participants_pdf', [
            'listPendaftar' => $listPendaftar,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('data_peserta_keseluruhan.pdf');
    }
}
