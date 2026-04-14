<?php

namespace App\Traits;

use Livewire\WithPagination;

trait WithAdminPagination
{
    use WithPagination;

    /**
     * Get the view that will be used for rendering pagination links.
     */
    public function paginationView(): string
    {
        return 'admin.pagination';
    }
}
