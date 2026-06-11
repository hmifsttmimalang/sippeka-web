<?php

namespace App\Livewire\Public;

use App\Models\Major;
use App\Models\TestSchedule;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.info_app')]
#[Title('Informasi Pelatihan')]
class TrainingInfo extends Component
{
    use WithPagination;

    public function render(): View
    {
        $statusList = [
            'open' => 'Tersedia',
            'full' => 'Penuh',
            'closed' => 'Tutup',
        ];

        $majors = Major::whereIn('status', ['open', 'full'])->paginate(5, ['*'], 'majorPage');
        $testSchedules = TestSchedule::with('major')->latest()->paginate(5, ['*'], 'schedulePage');

        return view('livewire.public.training-info', [
            'majors' => $majors,
            'testSchedules' => $testSchedules,
            'statusList' => $statusList,
        ]);
    }
}
