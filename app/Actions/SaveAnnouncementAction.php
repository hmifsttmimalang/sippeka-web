<?php

namespace App\Actions;

use App\Models\Announcement;

class SaveAnnouncementAction
{
    /**
     * Save or update the announcement time.
     */
    public function execute(string $scheduledAt): Announcement
    {
        return Announcement::updateOrCreate(
            [],
            ['scheduled_at' => $scheduledAt]
        );
    }
}
