<?php

namespace App\Livewire\Public;

use App\Models\Jurusan;
use App\Models\JadwalTes;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class TrainingInfo extends Component
{
    use WithPagination;

    public function render(): View
    {
        $statusList = [
            'dibuka' => 'Tersedia',
            'penuh' => 'Penuh',
            'tutup' => 'Tutup'
        ];

        return view('livewire.public.training-info', [
            'jurusan' => Jurusan::whereIn('status', ['dibuka', 'penuh'])->paginate(5, ['*'], 'jurusanPage'),
            'jadwalTes' => JadwalTes::with('jurusan')->latest()->paginate(5, ['*'], 'jadwalPage'),
            'statusList' => $statusList
        ])->layout('layouts.info_app', ['title' => 'Informasi Pelatihan']);
    }
}
