<?php

namespace LukasMu\Favicon;

use Illuminate\Support\ServiceProvider;

class FaviconServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        // Loading the routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Loading the views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'favicon');

        if ($this->app->runningInConsole()) {
            // Publishing the config
            $this->publishes([
                __DIR__.'/../config/favicon.php' => config_path('favicon.php'),
            ], 'config');
            // Publishing the views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-favicon'),
            ], 'views');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Merging the config
        $this->mergeConfigFrom(__DIR__.'/../config/favicon.php', 'favicon');
    }
}
