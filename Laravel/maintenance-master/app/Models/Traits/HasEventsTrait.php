<?php

namespace App\Models\Traits;

use App\Models\Event;

trait HasEventsTrait
{
    /**
     * The morphToMany events relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function events()
    {
        return $this->morphToMany(Event::class, 'eventable');
    }
}
