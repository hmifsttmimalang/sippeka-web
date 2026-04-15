<?php

namespace App\Livewire\Student;

use App\Actions\UpdateProfileAction;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user_app')]
#[Title('Edit Profil')]
class EditProfile extends Component
{
    public User $user;

    public ?Registration $registration = null;

    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public function mount()
    {
        $this->user = Auth::user();
        $this->registration = Registration::where('user_id', $this->user->id)->first();

        // Security / Restriction Logic
        if ($this->registration && $this->registration->verification_status === 'Pending') {
            return redirect()->route('user.dashboard')->with('error', 'Edit profil dikunci saat dalam status Pending verifikasi.');
        }

        if ($this->registration && $this->registration->verification_status === 'Rejected') {
            return redirect()->route('registration.form')->with('warning', 'Pendaftaran Anda ditolak. Silakan perbaiki data melalui form ini.');
        }

        $this->name = $this->registration->name ?? $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile(UpdateProfileAction $updateProfileAction)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
        ]);

        $updateProfileAction->execute($this->user, [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render(): View
    {
        return view('livewire.student.edit-profile');
    }
}
