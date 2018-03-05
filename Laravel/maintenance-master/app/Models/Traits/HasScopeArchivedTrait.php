<?php

namespace App\Models\Traits;

trait HasScopeArchivedTrait
{
    /**
     * Scopes a query to show only soft deleted records.
     *
     * @param mixed $query
     * @param bool  $archived
     *
     * @return mixed
     */
    public function scopeArchived($query, $archived = false)
    {
        if ($archived) {
            $query->onlyTrashed();
        }

        return $query;
    }
}
