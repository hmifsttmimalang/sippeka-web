<?php

namespace App\Livewire\Registration;

use App\Actions\Registration\SubmitRegistrationAction;
use App\Models\Registration;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.registration_app')]
#[Title('Form Pendaftaran')]
class Wizard extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;

    public int $totalSteps = 4;

    // Step 1: Personal Info
    public string $name = '';

    public string $place_of_birth = '';

    public string $date_of_birth = '';

    public string $gender = '';

    public string $religion = '';

    public string $address = '';

    public string $phone = '';

    // Step 2: Skill Selection
    public ?int $skill_id = null;

    // Step 3: Document Uploads
    public $identity_document;

    public $certificate_document;

    public $formal_photo;

    public function mount(): void
    {
        $registration = Registration::where('user_id', Auth::id())->first();

        // Redirect if already registered and not rejected
        if ($registration) {
            if ($registration->verification_status === 'Rejected') {
                $this->name = $registration->name;
                $this->place_of_birth = $registration->place_of_birth;
                $this->date_of_birth = $registration->date_of_birth;
                $this->gender = $registration->gender;
                $this->religion = $registration->religion;
                $this->address = $registration->address;
                $this->phone = $registration->phone;
                $this->skill_id = $registration->skill_id;

                session()->flash('warning', 'Pendaftaran Anda sebelumnya ditolak. Catatan Admin: '.$registration->verification_notes.'. Silakan perbaiki data Anda dan upload ulang dokumen Anda.');
            } else {
                redirect()->route('user.dashboard');
            }
        } else {
            $this->name = Auth::user()->name ?? '';
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
                'name' => 'required|string|max:255',
                'place_of_birth' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:Male,Female',
                'religion' => 'required',
                'address' => 'required|string',
                'phone' => 'required|string|max:15',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'skill_id' => 'required|exists:skills,id',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'identity_document' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
                'certificate_document' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
                'formal_photo' => 'required|image|max:2048',
            ]);
        }
    }

    public function submit(SubmitRegistrationAction $action): void
    {
        $this->validateCurrentStep();

        $action->execute(
            Auth::user(),
            [
                'name' => $this->name,
                'place_of_birth' => $this->place_of_birth,
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender,
                'religion' => $this->religion,
                'address' => $this->address,
                'phone' => $this->phone,
                'skill_id' => $this->skill_id,
            ],
            [
                'identity_document' => $this->identity_document,
                'certificate_document' => $this->certificate_document,
                'formal_photo' => $this->formal_photo,
            ]
        );

        session()->flash('success', 'Pendaftaran berhasil dikirim! Silakan tunggu verifikasi admin.');
        redirect()->route('home');
    }

    public function render(): View
    {
        return view('livewire.registration.wizard', [
            'skills' => Skill::all(),
        ]);
    }
}
