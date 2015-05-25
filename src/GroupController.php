<?php
namespace Ifaniqbal\Sysguard;

use \View;
use \Redirect;
use \Input;
use \Request;

class GroupController extends BaseController {

    public function index()
    {
        $this->data['items'] = Group::orderBy('name')->paginate($this->perPage);
        View::share('data', $this->data);
        return View::make('sysguard:pages.group.index');
    }

    public function manage()
    {
        $this->data['items'] = Group::orderBy('name')->get();
        View::share('data', $this->data);
        return View::make('sysguard:pages.group.manage');
    }

    public function detail($id)
    {
        $this->data['item'] = Group::with(array(
            'menus' => function($query){
                $query->orderBy('name');
            },
            'permissions' => function($query){
                $query->orderBy('route');
            },
        ))->find($id);
        View::share('data', $this->data);
        return View::make('sysguard:pages.group.detail');
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $this->data = array();
            $this->data['menus'] = Menu::orderBy('name')->get();
            $this->data['permissions'] = Permission::orderBy('route')->get();
            View::share('data', $this->data);
            return View::make('sysguard:pages.group.create');
        }
        else if (Request::isMethod('post'))
        {
            $group = Group::create(Input::all());
            $menu_ids = Input::get('menu_ids');
            if ($menu_ids == null)
            {
                $menu_ids = array();
            }
            $group->menu()->sync($menu_ids);

            $permission_ids = Input::get('permission_ids');
            if ($permission_ids == null)
            {
                $permission_ids = array();
            }
            $group->permission()->sync($permission_ids);
            return Redirect::to('group/manage');
        }
    }

    public function update($id)
    {
        if (Request::isMethod('get'))
        {
            $this->data = array();
            $this->data['item'] = Group::with(array(
                'menus' => function($query){
                    $query->orderBy('name');
                },
                'permissions' => function($query){
                    $query->orderBy('route');
                },
            ))->find($id);
            $this->data['menus'] = Menu::orderBy('name')->get();
            $this->data['permissions'] = Permission::orderBy('route')->get();
            View::share('data', $this->data);
            return View::make('sysguard:pages.group.update');
        }
        else if (Request::isMethod('post'))
        {
            $group = Group::find($id);
            $group->update(Input::all());
            $menu_ids = Input::get('menu_ids');
            if ($menu_ids == null)
            {
                $menu_ids = array();
            }
            $group->menu()->sync($menu_ids);

            $permission_ids = Input::get('permission_ids');
            if ($permission_ids == null)
            {
                $permission_ids = array();
            }
            $group->permission()->sync($permission_ids);
            return Redirect::to('group/detail/' . $id);
        }
    }

    public function delete($id)
    {
        $group = Group::find($id);
        $group->delete();
        return Redirect::to('group/manage');
    }
}
