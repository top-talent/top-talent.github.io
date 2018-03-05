<?php

namespace App\Models\Traits;

trait HasScopeIdTrait
{
    /**
     * Allows all tables extending from the base model to be scoped by ID.
     *
     * @param object      $query
     * @param int /string $id
     *
     * @return object
     */
    public function scopeId($query, $id = null)
    {
        if (!is_null($id)) {
            $query->where('id', $id);
        }

        return $query;
    }
}
