<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Event\EventableController;
use App\Repositories\Inventory\Repository as InventoryRepository;
use Illuminate\Support\Facades\App;

class EventController extends EventableController
{
    /**
     * @var array
     */
    protected $routes = [
        'index'   => 'maintenance.inventory.events.index',
        'create'  => 'maintenance.inventory.events.create',
        'store'   => 'maintenance.inventory.events.store',
        'show'    => 'maintenance.inventory.events.show',
        'edit'    => 'maintenance.inventory.events.edit',
        'update'  => 'maintenance.inventory.events.update',
        'destroy' => 'maintenance.inventory.events.destroy',
        'grid'    => 'maintenance.api.v1.inventory.events.grid',
    ];

    /**
     * @return InventoryRepository
     */
    protected function getEventableRepository()
    {
        return App::make(InventoryRepository::class);
    }

    /**
     * @return string
     */
    protected function getEventableCalendarId()
    {
        return config('maintenance.site.calendars.inventories');
    }
}
