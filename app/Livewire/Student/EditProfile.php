<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EditProfile extends Component
{
    public User $user;
    public ?Registration $registration = null;

    public $nama;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->user = auth()->user();
        $this->registration = Registration::where('user_id', $this->user->id)->first();

        // Security / Logic Restriksi
        if ($this->registration && $this->registration->verification_status === 'Pending') {
            return redirect()->route('user.dashboard')->with('error', 'Edit profil dikunci saat dalam status Pending verifikasi.');
        }

        $this->nama = $this->registration->nama ?? $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update User
        $userData = [
            'name' => $this->nama,
            'email' => $this->email,
        ];
        
        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }
        
        $this->user->update($userData);

        // Update Registration Name if exists
        if ($this->registration) {
            $this->registration->update(['nama' => $this->nama]);
        }

        session()->flash('success', 'Profil berhasil diperbarui.');
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.student.edit-profile')
            ->layout('layouts.user_app', ['title' => 'Edit Profil']);
    }
}
