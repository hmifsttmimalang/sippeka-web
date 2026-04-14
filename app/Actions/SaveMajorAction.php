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
        if ($id) {
            $major = Major::findOrFail($id);
            $major->update([
                'name' => $data['name'],
                'quota' => $data['quota'],
                'status' => $data['status'],
            ]);
        } else {
            $major = Major::create([
                'name' => $data['name'],
                'quota' => $data['quota'],
                'status' => $data['status'],
            ]);
        }

        return $major;
    }
}
