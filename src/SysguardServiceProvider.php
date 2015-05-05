<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Application;

class SysguardServiceProvider extends ServiceProvider {

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        \Auth::extend('sysguard', function($app)
        {
            return new EloquentUserProvider(
                $app['hash'],
                $app['config']['auth.model']
            );
        });

        $this->publishes([
            __DIR__.'/migrations/' => $this->app->databasePath().'/migrations'
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sysguard', function($app)
        {
            return $app->make('\Ifaniqbal\Sysguard\Sysguard');
        });
    }

}
