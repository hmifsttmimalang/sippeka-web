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
        $announcement = Announcement::first();

        if ($announcement) {
            $announcement->update(['scheduled_at' => $scheduledAt]);
        } else {
            $announcement = Announcement::create(['scheduled_at' => $scheduledAt]);
        }

        return $announcement;
    }
}
