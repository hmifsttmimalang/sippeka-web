<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Pengumuman;
use Carbon\Carbon;

#[Layout('layouts.admin_app')]
#[Title('Atur Pengumuman')]
class AnnouncementManager extends Component
{
    public $tanggal, $waktu, $formattedDate;

    protected $rules = [
        'tanggal' => 'required|date',
        'waktu' => 'required'
    ];

    public function mount()
    {
        $this->loadPengumuman();
    }

    public function loadPengumuman()
    {
        $pengumuman = Pengumuman::first();
        if ($pengumuman) {
            $dt = Carbon::parse($pengumuman->tanggal_waktu);
            $this->tanggal = $dt->format('Y-m-d');
            $this->waktu = $dt->format('H:i');
            $this->formattedDate = $dt->translatedFormat('d F Y H.i');
        } else {
            $this->formattedDate = 'Waktu belum ditentukan';
        }
    }

    public function save()
    {
        $this->validate();

        $tanggal_waktu = $this->tanggal . ' ' . $this->waktu;
        
        $pengumuman = Pengumuman::first();
        if ($pengumuman) {
            $pengumuman->update(['tanggal_waktu' => $tanggal_waktu]);
        } else {
            Pengumuman::create(['tanggal_waktu' => $tanggal_waktu]);
        }

        session()->flash('success', 'Waktu pengumuman berhasil diatur.');
        $this->loadPengumuman();
    }

    public function render()
    {
        return view('livewire.admin.announcement-manager');
    }
}
