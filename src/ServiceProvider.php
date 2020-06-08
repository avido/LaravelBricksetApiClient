<?php
namespace Avido\LaravelBricksetApiClient;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('brickset-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'brickset-api');

        // Register the main class to use with the facade
        $this->app->singleton(BricksetApiClient::class, function () {
            return new BricksetApiClient();
        });
    }
}
