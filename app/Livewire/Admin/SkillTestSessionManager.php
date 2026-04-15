<?php

namespace App\Livewire\Admin;

use App\Actions\SaveSkillTestSessionAction;
use App\Models\SkillTestSession;
use App\Services\Admin\SessionService;
use App\Traits\WithAdminPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Sesi Tes Keahlian')]
class SkillTestSessionManager extends Component
{
    use WithAdminPagination;

    public $search = '';
    public $name, $skill_test_id, $startTime, $endTime, $sessionType = 'Selection';
    public $editingId = null;
    public $showingModal = false, $showingDetailModal = false;

    public $selectedSession = null;
    public $detailSearch = '';

    protected $queryString = ['search' => ['except' => '']];

    protected $rules = [
        'name' => 'required|string|max:255',
        'skill_test_id' => 'required|exists:skill_tests,id',
        'startTime' => 'required|date',
        'endTime' => 'required|date|after:startTime',
        'sessionType' => 'required|in:Selection,Simulation',
    ];

    public function openModal($id = null)
    {
        $this->resetErrorBag();
        $this->editingId = $id;

        if ($id) {
            $session = SkillTestSession::findOrFail($id);
            $this->fill($session->toArray());
            $this->startTime = date('Y-m-d\TH:i', strtotime($session->start_time));
            $this->endTime = date('Y-m-d\TH:i', strtotime($session->end_time));
        } else {
            $this->reset(['name', 'skill_test_id', 'startTime', 'endTime']);
            $this->sessionType = 'Selection';
        }

        $this->showingModal = true;
    }

    public function save(SaveSkillTestSessionAction $action)
    {
        $this->validate();
        $action->execute($this->pull(), $this->editingId);

        session()->flash('success', 'Sesi aman tersimpan!');
        $this->closeModal();
    }

    public function delete($id, SessionService $service)
    {
        try {
            $service->deleteSession($id);
            session()->flash('success', 'Sesi dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    // Detail Modal Logic
    public function showDetail($id)
    {
        $this->selectedSession = SkillTestSession::with('skillTest')->findOrFail($id);
        $this->showingDetailModal = true;
    }

    public function render(SessionService $service): View
    {
        // Ambil data attempt buat modal detail kalau modalnya kebuka
        $detailAttempts = $this->showingDetailModal
            ? $service->getSessionAttempts($this->selectedSession->id, $this->detailSearch)
            : collect();

        return view('livewire.admin.skill-test-session-manager', [
            'sessions' => $service->getPaginatedSessions($this->search),
            'skillTests' => \App\Models\SkillTest::all(),
            'detailAttempts' => $detailAttempts
        ]);
    }

    public function closeModal()
    {
        $this->reset(['showingModal', 'showingDetailModal', 'editingId', 'selectedSession', 'detailSearch']);
    }
}
