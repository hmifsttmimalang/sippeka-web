<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class RegistrationList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterSkill = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterSkill' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterSkill(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $registrants = Registration::query()
            ->with('keahlian')
            ->when($this->search, function (Builder $query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterSkill, function (Builder $query) {
                $query->where('keahlian', $this->filterSkill);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.registration-list', [
            'registrants' => $registrants,
            'skills' => Skill::all(),
        ])->layout('layouts.admin_app', ['title' => 'Data Peserta Pendaftar']);
    }
}
