<?php
namespace Ifaniqbal\Sysguard;

use \View;
use \Redirect;
use \Input;
use \Request;

class MenuController extends BaseController {

    public function index()
    {
        $this->data['items'] = Menu::orderBy('url')->paginate($this->perPage);
        View::share('data', $this->data);
        return View::make('sysguard:pages.menu.index');
    }

    public function manage()
    {
        $this->data['items'] = Menu::orderBy('url')->get();
        View::share('data', $this->data);
        return View::make('sysguard:pages.menu.manage');
    }

    public function detail($id)
    {
        $this->data['item'] = Menu::with('parent', 'children.children', 'groups')->find($id);
        $this->data['item']->group->sortBy('name');
        $this->data['item']->child->sortBy('order')->each(function($child){
            if ($child->child != null)
            {
                $child->child->sortBy('order');
            }
        });
        View::share('data', $this->data);
        return View::make('sysguard:pages.menu.detail');
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $this->data = array();
            $this->data['items'] = Menu::orderBy('url')->get();
            View::share('data', $this->data);
            return View::make('sysguard:pages.menu.create');
        }
        else if (Request::isMethod('post'))
        {
            $menu = Menu::create(Input::all());
            if (Input::get('parent_id') != 0)
            {
                $parent = Menu::find(Input::get('parent_id'));
                $menu->parent()->associate($parent);
                $menu->save();
            }
            return Redirect::to('menu/manage');
        }
    }

    public function update($id)
    {
        if (Request::isMethod('get'))
        {
            $this->data = array();
            $this->data['item'] = Menu::find($id);
            $this->data['items'] = Menu::where('id', '<>', $id)->get();
            View::share('data', $this->data);
            return View::make('sysguard:pages.menu.update');
        }
        else if (Request::isMethod('post'))
        {
            $menu = Menu::find($id);
            $menu->update(Input::all());
            if (Input::get('parent_id') != 0)
            {
                $parent = Menu::find(Input::get('parent_id'));
                $menu->parent()->associate($parent);
                $menu->save();
            }
            return Redirect::to('menu/detail/' . $id);
        }
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return Redirect::to('menu/manage');
    }
}
