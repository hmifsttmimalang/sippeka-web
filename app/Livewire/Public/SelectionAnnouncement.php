<?php

namespace App\Livewire\Public;

use App\Models\Registration;
use App\Models\Pengumuman;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class SelectionAnnouncement extends Component
{
    use WithPagination;

    public function render(): View
    {
        $pengumuman = Pengumuman::first();
        $pengumumanWaktu = $pengumuman ? $pengumuman->tanggal_waktu : null;
        $isPassed = $pengumumanWaktu ? \Carbon\Carbon::parse($pengumumanWaktu)->isPast() : false;
        
        $listPendaftar = Registration::query()
            ->with('skill')
            ->orderByRaw('COALESCE((nilai_keahlian + nilai_wawancara) / 2, 0) DESC')
            ->paginate(15);

        return view('livewire.public.selection-announcement', [
            'pengumumanWaktu' => $pengumumanWaktu,
            'isPassed' => $isPassed,
            'listPendaftar' => $listPendaftar
        ])->layout('layouts.info_app', ['title' => 'Pengumuman Hasil Seleksi']);
    }
}
