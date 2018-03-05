<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Services\ConfigService;
use Illuminate\Support\Facades\App;

class Notification extends Model
{
    use HasUserTrait;

    /**
     * The notifications table.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The fillable notification attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'notifiable_id',
        'notifiable_type',
        'message',
        'link',
        'read',
    ];

    /**
     * The morphTo relationship allowing all models to have notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Returns an html icon class of the type of
     * notification by retrieving it from the configuration file.
     *
     * @return string|null
     */
    public function getIconAttribute()
    {
        $class = $this->attributes['notifiable_type'];

        /*
         * Resolve the configuration service from the IoC since
         * we don't want to override the Notification models constructor
         * to inject the service
         */
        $config = App::make(ConfigService::class);

        // Make sure we have an instance of the ConfigService returned by the IoC
        if ($config instanceof ConfigService) {
            $icon = $config->setPrefix('maintenance')->get("notifications.icons.$class");

            // Return the models notification icon if it's found
            if (is_string($icon) && !empty($icon)) {
                return $icon;
            }

            /*
             * Looks like the notification icon could not be
             * found, we'll return the default notification icon
             */
            $defaultIcon = $config->setPrefix('maintenance')->get('notifications.icons.default');

            return $defaultIcon;
        }

        return;
    }
}
