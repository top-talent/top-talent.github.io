<?php

namespace App\Models\Traits;

use App\Models\Notification;

trait HasNotificationsTrait
{
    /**
     * Allows all models extending from BaseModel to have notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
