<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Registration;
use App\Traits\WithAdminPagination;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin_app')]
#[Title('Data Peserta')]
class PesertaList extends Component
{
    use WithAdminPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $listPendaftar = Registration::with('skill')
            ->select('registrations.*', DB::raw('((registrations.nilai_keahlian + registrations.nilai_wawancara) / 2) as rata_rata'))
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('rata_rata')
            ->paginate(10);

        return view('livewire.admin.peserta-list', [
            'listPendaftar' => $listPendaftar,
        ]);
}
}
