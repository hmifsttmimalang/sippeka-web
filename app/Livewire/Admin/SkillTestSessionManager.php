<?php

namespace App\Livewire\Admin;

use App\Actions\SaveSkillTestSessionAction;
use App\Models\SkillTest;
use App\Models\SkillTestSession;
use App\Models\TestAttempt;
use App\Traits\WithAdminPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Sesi Tes Keahlian')]
class SkillTestSessionManager extends Component
{
    use WithAdminPagination;

    public $search = '';

    // Form properties
    public $name;

    public $skill_test_id;

    public $startTime;

    public $endTime;

    public $sessionType = 'Selection';

    public $editingId = null;

    public $showingModal = false;

    public $showingDetailModal = false;

    // View related
    public $selectedSession = null;

    public $detailAttempts = [];

    public $detailSearch = '';

    protected $queryString = ['search' => ['except' => '']];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'skill_test_id' => 'required|exists:skill_tests,id',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after:startTime',
            'sessionType' => 'required|in:Selection,Simulation',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->editingId = $id;

        if ($id) {
            $session = SkillTestSession::findOrFail($id);
            $this->name = $session->name;
            $this->skill_test_id = $session->skill_test_id;

            // Format for datetime-local input
            $this->startTime = date('Y-m-d\TH:i', strtotime($session->start_time));
            $this->endTime = date('Y-m-d\TH:i', strtotime($session->end_time));

            $this->sessionType = $session->session_type;
        } else {
            $this->reset(['name', 'skill_test_id', 'startTime', 'endTime', 'sessionType']);
            $this->sessionType = 'Selection';
        }

        $this->showingModal = true;
        $this->dispatch('show-form-modal');
    }

    public function closeModal()
    {
        $this->showingModal = false;
        $this->dispatch('hide-form-modal');
    }

    public function save(SaveSkillTestSessionAction $saveSkillTestSessionAction)
    {
        $this->validate();

        $saveSkillTestSessionAction->execute([
            'name' => $this->name,
            'skill_test_id' => $this->skill_test_id,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'session_type' => $this->sessionType,
        ], $this->editingId);

        session()->flash('success', $this->editingId ? 'Sesi tes berhasil diperbarui.' : 'Sesi tes berhasil ditambahkan.');

        $this->closeModal();
    }

    public function delete($id)
    {
        $session = SkillTestSession::findOrFail($id);
        $session->delete();
        session()->flash('success', 'Sesi tes berhasil dihapus.');
    }

    public function showDetail($id)
    {
        $this->selectedSession = SkillTestSession::with('skillTest')->findOrFail($id);
        $this->loadAttempts();
        $this->showingDetailModal = true;
        $this->dispatch('show-detail-modal');
    }

    public function closeDetail()
    {
        $this->showingDetailModal = false;
        $this->selectedSession = null;
        $this->dispatch('hide-detail-modal');
    }

    public function loadAttempts()
    {
        if ($this->selectedSession) {
            $query = TestAttempt::with(['registration.skill'])
                ->where('skill_test_session_id', $this->selectedSession->id);

            if ($this->detailSearch) {
                $query->whereHas('registration', function ($q) {
                    $q->where('name', 'like', '%'.$this->detailSearch.'%');
                });
            }

            $this->detailAttempts = $query->get();
        }
    }

    public function updatingDetailSearch()
    {
        $this->loadAttempts();
    }

    public function render()
    {
        $sessions = SkillTestSession::with('skillTest')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhereHas('skillTest', function ($q) {
                        $q->where('name', 'like', '%'.$this->search.'%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.skill-test-session-manager', [
            'sessions' => $sessions,
            'skillTests' => SkillTest::all(),
        ]);
    }
}
