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
        $this->package('ifaniqbal/sysguard', 'ifaniqbal/sysguard');
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
        $this->app['sysguard'] = $this->app->share(function($app)
        {
            return new $this->app->make('Ifaniqbal\Sysguard\Sysguard');
        });

        $this->app->alias('sysguard', 'Ifaniqbal\Sysguard\Sysguard');
    }

}
