<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;

class Comment extends Model
{
    use HasUserTrait;

    /**
     * The comments table.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The fillable update attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
    ];
}
