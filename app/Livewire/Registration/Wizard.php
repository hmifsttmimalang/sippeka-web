<?php

namespace App\Livewire\Registration;

use App\Models\Registration;
use App\Models\Skill;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Wizard extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;
    public int $totalSteps = 4;

    // Step 1: Personal Info
    public string $nama = '';
    public string $tempat_lahir = '';
    public string $tanggal_lahir = '';
    public string $jenis_kelamin = '';
    public string $agama = '';
    public string $alamat = '';
    public string $telepon = '';

    // Step 2: Skill Selection
    public ?int $keahlian = null;

    // Step 3: Document Uploads
    public $foto_identitas;
    public $foto_ijazah;
    public $foto_bg_biru;

    public function mount(): void
    {
        $registration = Registration::where('user_id', auth()->id())->first();

        // Redirect if already registered and not rejected
        if ($registration) {
            if ($registration->verification_status === 'Rejected') {
                $this->nama = $registration->nama;
                $this->tempat_lahir = $registration->tempat_lahir;
                $this->tanggal_lahir = $registration->tanggal_lahir;
                $this->jenis_kelamin = $registration->jenis_kelamin;
                $this->agama = $registration->agama;
                $this->alamat = $registration->alamat;
                $this->telepon = $registration->telepon;
                $this->keahlian = $registration->keahlian;
                
                session()->flash('warning', 'Pendaftaran Anda sebelumnya ditolak. Catatan Admin: ' . $registration->verification_notes . '. Silakan perbaiki data Anda dan upload ulang dokumen Anda.');
            } else {
                redirect()->route('user.dashboard'); 
            }
        } else {
            $this->nama = auth()->user()->name ?? '';
        }
    }

    public function nextStep(): void
    {
        $this->validateCurrentStep();
        $this->currentStep++;
    }

    public function previousStep(): void
    {
        $this->currentStep--;
    }

    public function validateCurrentStep(): void
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required',
                'alamat' => 'required|string',
                'telepon' => 'required|string|max:15',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'keahlian' => 'required|exists:skills,id',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'foto_identitas' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
                'foto_ijazah' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
                'foto_bg_biru' => 'required|image|max:2048',
            ]);
        }
    }

    public function submit(): void
    {
        $this->validateCurrentStep();

        $username = auth()->user()->username;
        $folderPath = 'uploads/' . $username;

        // Ensure directory exists
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $namaSanitized = Str::slug($this->nama, '_');
        $tempatSanitized = Str::slug($this->tempat_lahir, '_');
        $tglFormat = date('d-m-Y', strtotime($this->tanggal_lahir));

        $filePaths = [];
        $files = [
            'foto_identitas' => $this->foto_identitas,
            'foto_ijazah' => $this->foto_ijazah,
            'foto_bg_biru' => $this->foto_bg_biru,
        ];

        foreach ($files as $key => $file) {
            $fileName = "{$namaSanitized}_{$tempatSanitized}_{$tglFormat}_{$key}." . $file->getClientOriginalExtension();
            $filePaths[$key] = $file->storeAs($folderPath, $fileName, 'public');
        }

        Registration::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'nama' => $this->nama,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'agama' => $this->agama,
                'alamat' => $this->alamat,
                'telepon' => $this->telepon,
                'keahlian' => $this->keahlian,
                'foto_identitas' => $filePaths['foto_identitas'],
                'foto_ijazah' => $filePaths['foto_ijazah'],
                'foto_bg_biru' => $filePaths['foto_bg_biru'],
                'verification_status' => 'Pending',
                'verification_notes' => null,
            ]
        );

        User::where('id', auth()->id())->update(['status_register' => 'terdaftar']);

        session()->flash('success', 'Pendaftaran berhasil dikirim! Silakan tunggu verifikasi admin.');
        redirect()->route('home');
    }

    public function render(): View
    {
        return view('livewire.registration.wizard', [
            'skills' => Skill::all(),
        ])->layout('layouts.pendaftaran_app', ['title' => 'Form Pendaftaran']);
    }
}
