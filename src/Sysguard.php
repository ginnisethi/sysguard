<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Contracts\Auth\Guard as GuardContract;
use Illuminate\Routing\Router;

class Sysguard {

    private $auth;
    private $router;

    public function __construct(GuardContract $auth, Router $router)
    {
        $this->auth = $auth;
        $this->router = $router;
    }

    public function authorizeByRoute($route)
    {
        $activeGroup = $this->auth->user()->getActiveGroup();
        if ($activeGroup != null) {
            return $activeGroup->permissions()->where('route', $route)->exists();
        }
        
        return false;
    }

    public function authorize()
    {
        $route = $this->router->current()->getPath();
        return $this->authorizeByRoute($route);
    }

    public function effectiveMenus()
    {
    }

    public function effectivePermissions()
    {
    }

    public function hierarchicalMenu()
    {
    }

}
