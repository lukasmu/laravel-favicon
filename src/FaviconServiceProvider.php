<?php

namespace LukasMu\Favicon;

use Illuminate\Support\ServiceProvider;
use LukasMu\Favicon\Console\Commands\FaviconCacheCommand;
use LukasMu\Favicon\Console\Commands\FaviconClearCommand;
use LukasMu\Favicon\Facades\Favicon;

class FaviconServiceProvider extends ServiceProvider
{
    /**
     * Register the package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/favicon.php', 'favicon');

        $this->app->singleton(Favicon::class, FaviconService::class);
    }

    /**
     * Bootstrap the package services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'favicon');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/favicon.php' => $this->app->configPath('favicon.php'),
            ], 'config');
            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/laravel-favicon'),
            ], 'views');

            $this->commands([
                FaviconCacheCommand::class,
                FaviconClearCommand::class,
            ]);

            $this->optimizes(
                optimize: 'favicon:cache',
                clear: 'favicon:clear',
            );
        }
    }
}
