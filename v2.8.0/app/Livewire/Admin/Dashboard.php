<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class Dashboard extends Component
{
    public int $totalPendaftar = 0;
    public int $pendaftarLolos = 0;
    public float $progressLolos = 0;
    public Collection $pendaftarBaru;

    public function mount(): void
    {
        $this->totalPendaftar = Registration::count();
        $this->pendaftarLolos = Registration::all()->filter(fn($r) => $r->status === 'Lulus')->count();
        
        $this->pendaftarBaru = Registration::with('keahlian')
            ->latest()
            ->take(10)
            ->get();

        $this->progressLolos = $this->totalPendaftar > 0 
            ? ($this->pendaftarLolos / $this->totalPendaftar) * 100 
            : 0;
    }

    public function render(): View
    {
        return view('livewire.admin.dashboard')
            ->layout('components.layouts.admin', ['header' => 'Dashboard']);
    }
}
