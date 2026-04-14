<?php

namespace App\Livewire\Admin;

use App\Actions\SaveAnnouncementAction;
use App\Models\Announcement;
use Carbon\Carbon;
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

    public function mount()
    {
        $this->loadAnnouncement();
    }

    public function loadAnnouncement()
    {
        $announcement = Announcement::first();
        if ($announcement) {
            $dt = Carbon::parse($announcement->scheduled_at);
            $this->date = $dt->format('Y-m-d');
            $this->time = $dt->format('H:i');
            $this->formattedScheduledAt = $dt->translatedFormat('d F Y H.i');
        } else {
            $this->formattedScheduledAt = 'Waktu belum ditentukan';
        }
    }

    public function save(SaveAnnouncementAction $saveAnnouncementAction)
    {
        $this->validate();

        $scheduledAt = $this->date.' '.$this->time;

        $saveAnnouncementAction->execute($scheduledAt);

        session()->flash('success', 'Waktu pengumuman berhasil diatur.');
        $this->loadAnnouncement();
    }

    public function render()
    {
        return view('livewire.admin.announcement-manager');
    }
}
