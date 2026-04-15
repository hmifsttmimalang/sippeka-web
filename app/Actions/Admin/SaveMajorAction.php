<?php

namespace App\Actions\Admin;

use App\Models\Major;

class SaveMajorAction
{
    public function execute(array $data, ?int $id = null): Major
    {
        return Major::updateOrCreate(['id' => $id], $data);
    }
}
