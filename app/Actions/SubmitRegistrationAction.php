<?php

namespace App\Actions;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubmitRegistrationAction
{
    /**
     * Submit a registration.
     */
    public function execute(User $user, array $data, array $files): Registration
    {
        $username = $user->username;
        $folderPath = 'uploads/'.$username;

        // Ensure directory exists
        if (! Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $nameSanitized = Str::slug($data['name'], '_');
        $placeSanitized = Str::slug($data['place_of_birth'], '_');
        $dateFormatted = date('d-m-Y', strtotime($data['date_of_birth']));

        $filePaths = [];
        foreach ($files as $key => $file) {
            $fileName = "{$nameSanitized}_{$placeSanitized}_{$dateFormatted}_{$key}.".$file->getClientOriginalExtension();
            $filePaths[$key] = $file->storeAs($folderPath, $fileName, 'public');
        }

        $registration = Registration::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $data['name'],
                'place_of_birth' => $data['place_of_birth'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'religion' => $data['religion'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'skill_id' => $data['skill_id'],
                'identity_document_path' => $filePaths['identity_document'] ?? null,
                'certificate_document_path' => $filePaths['certificate_document'] ?? null,
                'formal_photo_path' => $filePaths['formal_photo'] ?? null,
                'verification_status' => 'Pending',
                'verification_notes' => null,
            ]
        );

        $user->update(['registration_status' => 'registered']);

        return $registration;
    }
}
