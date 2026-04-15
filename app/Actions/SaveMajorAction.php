<?php

namespace App\Actions;

use App\Models\Major;

class SaveMajorAction
{
    /**
     * Create or update a major.
     */
    public function execute(array $data, ?int $id = null): Major
    {
        return Major::updateOrCreate(['id' => $id], $data);
    }
}
