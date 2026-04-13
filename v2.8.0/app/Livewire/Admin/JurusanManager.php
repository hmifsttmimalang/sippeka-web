<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Jurusan;
use Livewire\WithPagination;

class JurusanManager extends Component
{
    use WithPagination;

    public $nama_jurusan, $kuota, $status = 'dibuka', $jurusan_id;
    public $isEditing = false;
    public $search = '';

    protected $rules = [
        'nama_jurusan' => 'required|string|max:255',
        'kuota' => 'required|integer|min:0',
        'status' => 'required|in:dibuka,ditutup'
    ];

    public function render()
    {
        $jurusans = Jurusan::where('nama_jurusan', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.jurusan-manager', [
            'jurusans' => $jurusans
        ])->layout('layouts.admin_app', ['title' => 'Kelola Jurusan']);
    }

    public function resetFields()
    {
        $this->nama_jurusan = '';
        $this->kuota = '';
        $this->status = 'dibuka';
        $this->jurusan_id = null;
        $this->isEditing = false;
    }

    public function store()
    {
        $this->validate();

        Jurusan::create([
            'nama_jurusan' => $this->nama_jurusan,
            'kuota' => $this->kuota,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Jurusan berhasil ditambahkan.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $this->jurusan_id = $id;
        $this->nama_jurusan = $jurusan->nama_jurusan;
        $this->kuota = $jurusan->kuota;
        $this->status = $jurusan->status;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $jurusan = Jurusan::findOrFail($this->jurusan_id);
        $jurusan->update([
            'nama_jurusan' => $this->nama_jurusan,
            'kuota' => $this->kuota,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Jurusan berhasil diperbarui.');
        $this->resetFields();
    }

    public function delete($id)
    {
        Jurusan::find($id)->delete();
        session()->flash('success', 'Jurusan berhasil dihapus.');
    }
}
