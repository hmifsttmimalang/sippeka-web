<?php

namespace App\Actions\Registration;

use App\Models\Registration;
use App\Models\User;
use App\Services\Registration\RegistrationSubmissionService;

class SubmitRegistrationAction
{
    public function __construct(private RegistrationSubmissionService $registrationSubmissionService) {}

    public function execute(User $user, array $data, array $files): Registration
    {
        return $this->registrationSubmissionService->submit($user, $data, $files);
    }
}
