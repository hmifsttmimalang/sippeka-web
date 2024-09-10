<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;

class AdminController extends Controller
{
    public function infoUser()
    {
        // Mengambil semua user dengan role user
        $users = User::where('role', 'user')->get();
        return view('admin.info-user', compact('users'));
    }

    public function indexKeahlian()
    {
        // Mengambil semua keahlian
        $keahlianList = Skill::all();
        return view('admin.keahlian.keahlian', compact('keahlianList'));
    }

    public function createKeahlian()
    {
        // Menampilkan form tambah keahlian
        return view('admin.keahlian.tambah-keahlian');
    }

    public function storeKeahlian(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan keahlian baru
        $skill = new Skill;
        $skill->nama = $validated['nama'];
        $skill->save();

        return redirect()->route('kelas_keahlian.index')->with('success', 'Keahlian berhasil ditambahkan');
    }

    public function editKeahlian($id)
    {
        // Mengambil data keahlian berdasarkan id
        $keahlian = Skill::findOrFail($id);
        return view('admin.keahlian.edit-keahlian', compact('keahlian'));
    }

    public function updateKeahlian(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Update keahlian
        $keahlian = Skill::findOrFail($id);
        $keahlian->nama = $validated['nama'];
        $keahlian->save();

        return redirect()->route('kelas_keahlian.index')->with('success', 'Keahlian berhasil diperbarui');
    }

    public function destroyKeahlian($id)
    {
        // Hapus keahlian
        $keahlian = Skill::findOrFail($id);
        $keahlian->delete();

        return redirect()->route('kelas_keahlian.index')->with('success', 'Keahlian berhasil dihapus');
    }
}
