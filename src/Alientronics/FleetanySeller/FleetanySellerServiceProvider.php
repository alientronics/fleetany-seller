<?php

namespace Alientronics\FleetanySeller;

use Illuminate\Support\ServiceProvider;

/**
 * Class FleetanySellerServiceProvider
 * @package Alientronics\FleetanySeller
 */
class FleetanySellerServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function boot()
    {
        $this->publishViews();
        
        $this->loadViewsFrom(__DIR__.'/../../views/', 'fleetany-seller');
        
        // Routes
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../../routes.php';
        }
    }
    
    /**
     * Publish the views files to the application views directory
     */
    public function publishViews()
    {
        $this->publishes([
            __DIR__ . '/../../views/' => base_path('/resources/views'),
        ], 'translations');
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
