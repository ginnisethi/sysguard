<?php

namespace Ifaniqbal\Sysguard;

use Illuminate\Contracts\Auth\Guard as GuardContract;
use Illuminate\Routing\Router;

class Sysguard
{
    private $auth;

    private $router;

    private $effectiveMenu = null;
    private $hierarchicalMenu = null;

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

    public function getEffectiveMenu()
    {
        return $this->auth->user()
            ->getActiveGroup()
            ->menus()
            ->where('enabled', 1)
            ->get();
    }

    public function getEffectivePermission()
    {
        return $this->auth->user()
            ->getActiveGroup()
            ->permissions()
            ->where('enabled', 1)
            ->get();
    }

    public function getHierarchicalMenu()
    {
        if ($this->hierarchicalMenu == null) {
            $activeGroup = $this->auth->user()->getActiveGroup();

            $hierarchicalMenu = [];
            if ($activeGroup != null) {
                $hierarchicalMenu = $activeGroup->menus()
                    ->with(['children' => function ($query) {
                            $query->orderBy('order');
                        }, ])
                    ->where('parent_id', 0)
                    ->where('enabled', 1)
                    ->orderBy('order')
                    ->get();
            }

            $this->hierarchicalMenu = $hierarchicalMenu;
        }

        return $this->hierarchicalMenu;
    }
}
