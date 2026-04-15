<?php

namespace App\Livewire\Admin;

use App\Actions\Admin\SaveAnnouncementAction;
use App\Services\Admin\AnnouncementService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin_app')]
#[Title('Atur Pengumuman')]
class AnnouncementManager extends Component
{
    public $date;

    public $time;

    public $formattedScheduledAt;

    protected $rules = [
        'date' => 'required|date',
        'time' => 'required',
    ];

    public function mount(AnnouncementService $service): void
    {
        $this->refreshData($service);
    }

    public function save(SaveAnnouncementAction $action, AnnouncementService $service): void
    {
        $this->validate();

        $scheduledAt = "{$this->date} {$this->time}";
        $action->execute($scheduledAt);

        session()->flash('success', 'Waktu pengumuman berhasil diatur.');

        $this->refreshData($service);
    }

    private function refreshData(AnnouncementService $service): void
    {
        $data = $service->getAnnouncementData();
        $this->date = $data['date'];
        $this->time = $data['time'];
        $this->formattedScheduledAt = $data['formatted'];
    }

    public function render(): View
    {
        return view('livewire.admin.announcement-manager');
    }
}
