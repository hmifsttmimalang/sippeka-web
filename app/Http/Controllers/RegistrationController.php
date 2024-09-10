<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'telepon' => 'required',
            'foto_ktp' => 'required',
            'foto_ijazah' => 'required',
            'foto_bg_biru' => 'required',
            'foto_kk' => 'required',
            // Validasi lainnya
        ]);

        $pendaftaran = new Registration();
        if (!$pendaftaran->validateTanggalLahir($request->tanggal_lahir)) {
            return redirect()->back()->withErrors('Tanggal lahir tidak valid.');
        }

        Registration::create($request->all());

        return redirect()->route('pendaftaran.index');
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Registration::find($id);

        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index');
    }

    public function destroy($id)
    {
        Registration::find($id)->delete();

        return redirect()->route('pendaftaran.index');
    }
}
