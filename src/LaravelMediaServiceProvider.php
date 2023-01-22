<?php

namespace Tasmir\LaravelMedia;

use Illuminate\Support\ServiceProvider;

class LaravelMediaServiceProvider extends ServiceProvider
{
    public function boot() {

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravelmedia');
        $this->mergeConfigFrom(
            __DIR__.'/config/media.php', 'media'
        );

//        $this->publishes([
//            __DIR__.'/resources/assets' => public_path('vendor/laravelmedia'),
//        ], 'public');
    }

    public function register() {

    }

}
