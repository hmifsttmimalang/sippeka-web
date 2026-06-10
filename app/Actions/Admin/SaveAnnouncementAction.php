<?php

namespace App\Actions\Admin;

use App\Models\Announcement;

class SaveAnnouncementAction
{
    public function execute(string $scheduledAt): Announcement
    {
        return Announcement::updateOrCreate([], ['scheduled_at' => $scheduledAt]);
    }
}
