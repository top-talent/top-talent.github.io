<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Support\ServiceProvider;
use Orchestra\Support\Facades\Decorator;

class DecoratorServiceProvider extends ServiceProvider
{
    /**
     * Register the decorator macros.
     */
    public function boot()
    {
        Decorator::macro('comment', function (Comment $comment, array $actions) {
            return view('components.comment', compact('comment', 'actions'));
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
