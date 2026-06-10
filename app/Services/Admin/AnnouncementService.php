<?php

namespace App\Services\Admin;

use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementService
{
    /**
     * Get the announcement data in a Carbon instance.
     *
     * @return array
     *
     * @retval array{
     *      'date' => string
     *      'time' => string
     *      'formatted' => string
     * }
     */
    public function getAnnouncementData(): array
    {
        $announcement = Announcement::first();

        if (!$announcement) {
            return [
                'date' => '',
                'time' => '',
                'formatted' => 'Waktu belum ditentukan',
            ];
        }

        $dt = Carbon::parse($announcement->scheduled_at);

        return [
            'date' => $dt->format('Y-m-d'),
            'time' => $dt->format('H:i'),
            'formatted' => $dt->translatedFormat('d F Y H.i'),
        ];
    }
}
