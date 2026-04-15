<?php

namespace App\Livewire\Admin;

use App\Services\Admin\RankingService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Data Peserta')]
class RegistrationResultList extends Component
{
    use WithAdminPagination;

    public string $search = '';

    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(RankingService $rankingService): View
    {
        return view('livewire.admin.registration-result-list', [
            'registrations' => $rankingService->getPaginatedRankings($this->search),
        ]);
    }
}
