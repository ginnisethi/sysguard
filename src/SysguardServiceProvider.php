<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Support\ServiceProvider;

class SysguardServiceProvider extends ServiceProvider {

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSysguard();
    }

    /**
     * Register Sysguard
     * 
     * @return void
     */
    protected function registerSysguard()
    {
        $this->app->bind('\Illuminate\Contracts\Auth\UserProvider', '\Ifaniqbal\Sysguard\SentryUserProvider');

        $this->app['sysguard'] = $this->app->share(function($app)
        {
            return new $this->app->make('Ifaniqbal\Sysguard\Sysguard');
        });

        $this->app->alias('sysguard', 'Ifaniqbal\Sysguard\Sysguard');
    }

}
