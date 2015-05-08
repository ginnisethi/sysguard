<?php

use Ifaniqbal\Sysguard\User;
use Ifaniqbal\Sysguard\Group;
use Ifaniqbal\Sysguard\Permission;
use Ifaniqbal\Sysguard\Menu;

class SysguardTest extends Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('vendor:publish');
    }

    protected function getPackageProviders()
    {
        return ['Ifaniqbal\Sysguard\SysguardServiceProvider'];
    }

    protected function getPackageAliases()
    {
        return [
            'Sysguard' => 'Ifaniqbal\Sysguard\SysguardFacade',
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
                    'driver' => 'sqlite',
                    'database' => ':memory:',
                    'prefix' => '',
                ),
            ),
        );
    }

    /**
     * Test Auth and Sysguard services.
     */
    public function testService()
    {
        Artisan::call('migrate');
        $this->assertEquals(true, Auth::guest());

        $user = User::create(
        [
            'name' => 'Ifan Iqbal',
            'email' => 'ifaniqbal.com@gmail.com',
            'password' => 'secret',
        ]);

        $group = Group::create(
        [
            'name' => 'admin',
        ]);

        $permission = Permission::create(
        [
            'route' => 'admin',
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

    /**
     * Test hierarchical menu that can be used in sidebar.
     */
    public function testHierarchicalMenu()
    {
        Artisan::call('migrate');

        $user = User::create([
            'name' => 'Ifan Iqbal',
            'email' => 'ifaniqbal.com@gmail.com',
            'password' => 'secret',
        ]);

        $group = Group::create([
            'name' => 'admin',
        ]);

        for ($i = 0; $i < 2; $i++) {
            $menu = Menu::create([
                'parent_id' => 0,
                'name' => 'Menu '.$i + 1,
                'order' => $i + 1,
                'enabled' => 1,
            ]);

            Menu::create([
                    'parent_id' => $menu->id,
                    'name' => 'Child 1',
                    'order' => 1,
                    'enabled' => 1,
                ]);

            Menu::create([
                    'parent_id' => $menu->id,
                    'name' => 'Child 2',
                    'order' => 2,
                    'enabled' => 1,
                ]);
        }

        $menus = Menu::get();
        $user->groups()->attach($group);
        $group->menus()->sync($menus);

        Auth::loginUsingId($user->id);

        $hierarchicalMenu = Sysguard::getHierarchicalMenu();

        $this->assertEquals(2, $hierarchicalMenu->count());
        $this->assertEquals(2, $hierarchicalMenu[0]->children->count());
        $this->assertEquals('Child 2', $hierarchicalMenu[0]->children[1]->name);
    }

    /**
     * Test effective menu and permission.
     */
    public function testEffectiveItems()
    {
        Artisan::call('migrate');

        $user = User::create([
            'name' => 'Ifan Iqbal',
            'email' => 'ifaniqbal.com@gmail.com',
            'password' => 'secret',
        ]);

        $group = Group::create([
            'name' => 'admin',
        ]);

        for ($i = 0; $i < 2; $i++) {
            $menu = Menu::create([
                'parent_id' => 0,
                'name' => 'Menu '.$i + 1,
                'order' => $i + 1,
                'enabled' => 1,
            ]);

            Menu::create([
                    'parent_id' => $menu->id,
                    'name' => 'Child 1',
                    'order' => 1,
                    'enabled' => 1,
                ]);

            Menu::create([
                    'parent_id' => $menu->id,
                    'name' => 'Child 2',
                    'order' => 2,
                    'enabled' => 1,
                ]);
        }

        for ($i = 0; $i < 4; $i++) {
            Permission::create([
                'route' => 'permission_'.$i + 1,
                'enabled' => 1,
            ]);
        }

        $menus = Menu::get();
        $permissions = Permission::get();
        $user->groups()->attach($group);
        $group->menus()->sync($menus);
        $group->permissions()->sync($permissions);

        Auth::loginUsingId($user->id);

        $this->assertEquals(6, Sysguard::getEffectiveMenu()->count());
        $this->assertEquals(4, Sysguard::getEffectivePermission()->count());
    }
}
