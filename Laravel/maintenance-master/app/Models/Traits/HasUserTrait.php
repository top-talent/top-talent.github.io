<?php

namespace App\Models\Traits;

use App\Models\User;

trait HasUserTrait
{
    /**
     * The hasOne user trait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
