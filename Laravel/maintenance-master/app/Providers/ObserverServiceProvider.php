<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * The model observers.
     *
     * @var array
     */
    protected $observers = [
        \App\Models\Inventory::class      => \App\Models\Observers\InventoryObserver::class,
        \App\Models\InventoryStock::class => \App\Models\Observers\InventoryStockObserver::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->observers as $model => $observer) {
            $model::observe(new $observer());
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
