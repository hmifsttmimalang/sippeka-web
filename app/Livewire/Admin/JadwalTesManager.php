<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\JadwalTes;
use App\Models\Jurusan;
use App\Traits\WithAdminPagination;

#[Layout('layouts.admin_app')]
#[Title('Kelola Jadwal Tes')]
class JadwalTesManager extends Component
{
    use WithAdminPagination;

    public $jurusan_id, $tanggal_pelaksanaan, $waktu_pelaksanaan, $selected_id;
    public $isEditing = false;

    protected $rules = [
        'jurusan_id' => 'required|exists:jurusans,id',
        'tanggal_pelaksanaan' => 'required|date',
        'waktu_pelaksanaan' => 'required'
    ];

    public function render()
    {
        $jadwalTes = JadwalTes::with('jurusan')->paginate(10);
        $jurusans = Jurusan::all();

        return view('livewire.admin.jadwal-tes-manager', [
            'jadwalTes' => $jadwalTes,
            'jurusans' => $jurusans
        ]);
}

    public function resetFields()
    {
        $this->jurusan_id = '';
        $this->tanggal_pelaksanaan = '';
        $this->waktu_pelaksanaan = '';
        $this->selected_id = null;
        $this->isEditing = false;
    }

    public function store()
    {
        $this->validate();

        JadwalTes::create([
            'jurusan_id' => $this->jurusan_id,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan,
            'waktu_pelaksanaan' => $this->waktu_pelaksanaan,
        ]);

        session()->flash('success', 'Jadwal tes berhasil ditambahkan.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $jadwal = JadwalTes::findOrFail($id);
        $this->selected_id = $id;
        $this->jurusan_id = $jadwal->jurusan_id;
        $this->tanggal_pelaksanaan = $jadwal->tanggal_pelaksanaan;
        $this->waktu_pelaksanaan = $jadwal->waktu_pelaksanaan;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $jadwal = JadwalTes::findOrFail($this->selected_id);
        $jadwal->update([
            'jurusan_id' => $this->jurusan_id,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan,
            'waktu_pelaksanaan' => $this->waktu_pelaksanaan,
        ]);

        session()->flash('success', 'Jadwal tes berhasil diperbarui.');
        $this->resetFields();
    }

    public function delete($id)
    {
        JadwalTes::find($id)->delete();
        session()->flash('success', 'Jadwal tes berhasil dihapus.');
    }
}
