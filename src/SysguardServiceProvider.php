<?php

namespace Ifaniqbal\Sysguard;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;

class SysguardServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        \Auth::extend('sysguard', function ($app) {
            return new EloquentUserProvider(
                $app['hash'],
                $app['config']['auth.model']
            );
        });

        $this->publishes([
            __DIR__.'/migrations/' => $this->app->databasePath().'/migrations',
        ], 'migrations');

        $this->loadViewsFrom(__DIR__.'/views', 'sysguard');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('sysguard', function ($app) {
            return $app->make('\Ifaniqbal\Sysguard\Sysguard');
        });
    }
}
