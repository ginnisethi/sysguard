<?php

use Illuminate\Auth\EloquentUserProvider;
use Ifaniqbal\Sysguard\User;
use Ifaniqbal\Sysguard\Group;
use Ifaniqbal\Sysguard\Permission;

class SysguardTest extends Orchestra\Testbench\TestCase {
    
    public function setUp()
    {
        parent::setUp();
        Artisan::call('vendor:publish');
        Artisan::call('migrate');
    }

    protected function getPackageProviders()
    {
        return ['Ifaniqbal\Sysguard\SysguardServiceProvider'];
    }

    protected function getPackageAliases()
    {
        return [
            'Sysguard' => 'Ifaniqbal\Sysguard\SysguardFacade'
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']['auth.driver'] = 'sysguard';
        $app['config']['auth.model'] = 'Ifaniqbal\Sysguard\User';
        $app['config']['database'] = array(
            'default' => 'sqlite',
         
            'connections' => array(
                'sqlite' => array(
                    'driver'   => 'sqlite',
                    'database' => ':memory:',
                    'prefix'   => ''
                ),
            )
        );
    }

    /**
     * Test Auth and Sysguard services.
     */
    public function testService()
    {
        $this->assertEquals(true, Auth::guest());

        $user = User::create(
        [
            'name'      => 'Ifan Iqbal',
            'email'     => 'ifaniqbal.com@gmail.com',
            'password'  => 'secret'
        ]);

        $group = Group::create(
        [
            'name' => 'admin'
        ]);

        $permission = Permission::create(
        [
            'route' => 'admin'
        ]);

        $user->groups()->attach($group);
        $group->permissions()->attach($permission);

        Auth::loginUsingId(1);
        
        $this->assertEquals(true, Auth::check());
        $this->assertEquals('Ifan Iqbal', Auth::user()->name);

        $guard = Mockery::mock('Illuminate\Contracts\Auth\Guard');

        $guard->shouldReceive('user->getActiveGroup')
            ->andReturn($group);

        $router = Mockery::mock('Illuminate\Routing\Router');

        $router->shouldReceive('current->getPath')
            ->andReturn('admin');

        $sysguard = new \Ifaniqbal\Sysguard\Sysguard(
            $guard,
            $router
        );

        $this->assertEquals(true, $sysguard->authorize());
    }
}