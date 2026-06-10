<?php

namespace App\Actions\Student;

use App\Models\User;
use App\Services\Student\SelectionSessionService;

class StartSkillTestSelectionAction
{
    public function __construct(private SelectionSessionService $selectionSessionService) {}

    /**
     * @return array{status: string, message?: string}
     */
    public function execute(User $user): array
    {
        return $this->selectionSessionService->start($user);
    }
}
