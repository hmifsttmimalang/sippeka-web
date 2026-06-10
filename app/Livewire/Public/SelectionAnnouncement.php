<?php

namespace App\Livewire\Public;

use App\Models\Announcement;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.info_app')]
#[Title('Pengumuman Hasil Seleksi')]
class SelectionAnnouncement extends Component
{
    use WithPagination;

    public function render(): View
    {
        $announcement = Announcement::first();
        $announcementTime = $announcement ? $announcement->scheduled_at : null;
        $isPassed = $announcementTime ? Carbon::parse($announcementTime)->isPast() : false;

        $registrations = Registration::query()
            ->with('skill')
            ->orderByRaw('COALESCE((skill_test_score + interview_score) / 2, 0) DESC')
            ->paginate(15);

        return view('livewire.public.selection-announcement', [
            'announcementTime' => $announcementTime,
            'isPassed' => $isPassed,
            'registrations' => $registrations,
        ]);
    }
}
