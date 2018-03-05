<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Event\EventableController;
use App\Repositories\Asset\Repository as AssetRepository;
use Illuminate\Support\Facades\App;

class EventController extends EventableController
{
    /**
     * @var array
     */
    protected $routes = [
        'index'   => 'maintenance.assets.events.index',
        'create'  => 'maintenance.assets.events.create',
        'store'   => 'maintenance.assets.events.store',
        'show'    => 'maintenance.assets.events.show',
        'edit'    => 'maintenance.assets.events.edit',
        'update'  => 'maintenance.assets.events.update',
        'destroy' => 'maintenance.assets.events.destroy',
        'grid'    => 'maintenance.api.v1.assets.events.grid',
    ];

    /**
     * @return AssetRepository
     */
    protected function getEventableRepository()
    {
        return App::make(AssetRepository::class);
    }

    /**
     * @return string
     */
    protected function getEventableCalendarId()
    {
        return config('maintenance.site.calendars.assets');
    }
}
