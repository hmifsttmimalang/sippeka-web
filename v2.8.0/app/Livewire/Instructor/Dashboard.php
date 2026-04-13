<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public int $totalPendaftar = 0;
    public int $pendaftarLolos = 0;
    public float $progressPendaftar = 0;
    public float $progressLolos = 0;
    public $listPendaftarBaru;

    public function mount(): void
    {
        // Total Pendaftar
        $this->totalPendaftar = Registration::count();

        // Calculate Lolos based on Legacy Logic: (nilai_keahlian + nilai_wawancara) / 2 >= 70
        $this->pendaftarLolos = Registration::whereRaw('(nilai_keahlian + nilai_wawancara) / 2 >= 70')->count();

        // Progress Pendaftar (100% if > 0)
        $this->progressPendaftar = $this->totalPendaftar > 0 ? 100 : 0;

        // Progress Lolos Percentage
        $this->progressLolos = $this->totalPendaftar > 0 
            ? ($this->pendaftarLolos / $this->totalPendaftar) * 100 
            : 0;

        // Latest Registrations within 24 Hours
        $this->listPendaftarBaru = Registration::latest()
            ->with('skill')
            ->where('created_at', '>=', now()->subDay())
            ->take(10)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.instructor.dashboard')
            ->layout('layouts.instruktur_app', ['header' => 'Instructor Dashboard']);
    }
}
