<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Traits\WithAdminPagination;
use App\Models\SkillTestSession;
use App\Models\SkillTest;
use App\Models\TestAttempt;

#[Layout('layouts.admin_app')]
#[Title('Sesi Tes Keahlian')]
class SkillTestSessionManager extends Component
{
    use WithAdminPagination;

    public $search = '';

    // Form properties
    public $nama_sesi;
    public $skill_test_id;
    public $waktu_mulai;
    public $waktu_selesai;
    public $jenis_sesi = 'Seleksi';

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
            'nama_sesi' => 'required|string|max:255',
            'skill_test_id' => 'required|exists:skill_tests,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'jenis_sesi' => 'required|in:Seleksi,Simulasi',
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
            $this->nama_sesi = $session->nama_sesi;
            $this->skill_test_id = $session->skill_test_id;

            // Format for datetime-local input
            $this->waktu_mulai = date('Y-m-d\TH:i', strtotime($session->waktu_mulai));
            $this->waktu_selesai = date('Y-m-d\TH:i', strtotime($session->waktu_selesai));

            $this->jenis_sesi = $session->jenis_sesi;
        } else {
            $this->reset(['nama_sesi', 'skill_test_id', 'waktu_mulai', 'waktu_selesai', 'jenis_sesi']);
            $this->jenis_sesi = 'Seleksi';
        }

        $this->showingModal = true;
        $this->dispatch('show-form-modal');
    }

    public function closeModal()
    {
        $this->showingModal = false;
        $this->dispatch('hide-form-modal');
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $session = SkillTestSession::findOrFail($this->editingId);
            $session->update([
                'nama_sesi' => $this->nama_sesi,
                'skill_test_id' => $this->skill_test_id,
                'waktu_mulai' => $this->waktu_mulai,
                'waktu_selesai' => $this->waktu_selesai,
                'jenis_sesi' => $this->jenis_sesi,
            ]);
            session()->flash('success', 'Sesi tes berhasil diperbarui.');
        } else {
            SkillTestSession::create([
                'nama_sesi' => $this->nama_sesi,
                'skill_test_id' => $this->skill_test_id,
                'waktu_mulai' => $this->waktu_mulai,
                'waktu_selesai' => $this->waktu_selesai,
                'jenis_sesi' => $this->jenis_sesi,
            ]);
            session()->flash('success', 'Sesi tes berhasil ditambahkan.');
        }

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
                    $q->where('nama', 'like', '%' . $this->detailSearch . '%');
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
                $query->where('nama_sesi', 'like', '%' . $this->search . '%')
                    ->orWhereHas('skillTest', function ($q) {
                        $q->where('nama_tes', 'like', '%' . $this->search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.skill-test-session-manager', [
            'sessions' => $sessions,
            'skillTests' => SkillTest::all()
        ]);
}
}
