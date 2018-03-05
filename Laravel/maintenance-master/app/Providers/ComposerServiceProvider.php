<?php

namespace App\Providers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * The view composers to register.
     *
     * @var array
     */
    protected $composers = [
        //
    ];

    /**
     * Registers view composers during boot.
     *
     * @param Factory $view
     */
    public function boot(Factory $view)
    {
        foreach ($this->composers as $callback => $views) {
            $view->composer($views, $callback);
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
