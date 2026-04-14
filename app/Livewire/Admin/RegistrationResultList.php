<?php

namespace App\Livewire\Admin;

use App\Models\Registration;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Data Peserta')]
class RegistrationResultList extends Component
{
    use WithAdminPagination;

    public string $search = '';

    protected $queryString = ['search'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $registrations = Registration::with('skill')
            ->select('registrations.*', DB::raw('((registrations.skill_test_score + registrations.interview_score) / 2) as average_score'))
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('average_score')
            ->paginate(10);

        return view('livewire.admin.registration-result-list', [
            'registrations' => $registrations,
        ]);
    }
}
