<?php

namespace App\Models\Traits;

use App\Models\Note;

trait HasNotesTrait
{
    /**
     * The morphToMany notes relationship allowing any model to contain notes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }
}
