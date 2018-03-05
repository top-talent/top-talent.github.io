<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;

class Note extends Model
{
    use HasUserTrait;

    /**
     * The notes table.
     *
     * @var string
     */
    protected $table = 'notes';

    /**
     * The fillable note attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * The morphTo polymorphic relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function noteable()
    {
        return $this->morphTo();
    }
}
