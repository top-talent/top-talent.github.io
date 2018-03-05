<?php

namespace App\Http\Controllers;

use App\Repositories\LocationRepository;

class LocationController extends NestedSetController
{
    /**
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;

        $this->resource = 'Location';

        $this->routes = [
            'index'       => 'maintenance.locations.index',
            'create'      => 'maintenance.locations.create',
            'create-node' => 'maintenance.locations.nodes.create',
            'store'       => 'maintenance.locations.store',
            'edit'        => 'maintenance.locations.edit',
            'update'      => 'maintenance.locations.update',
            'destroy'     => 'maintenance.locations.destroy',
            'grid'        => 'maintenance.api.v1.locations.grid',
            'move'        => 'maintenance.api.v1.locations.move',
        ];
    }
}
