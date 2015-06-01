<?php
namespace Ifaniqbal\Sysguard;

use \View;
use \Input;
use \DB;

class GroupController extends BaseController {
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $groups = Group::orderBy('name')->paginate();
        return View::make('sysguard::resource.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $group = new Group;
        $menus = Menu::orderBy('name')->get();
        $permissions = Permission::orderBy('route')->get();
        return View::make('sysguard::resource.group.create', compact('group', 'menus', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        DB::transaction(function() use ($id)
        {
            $group = Group::create(Input::all());

            $menu_ids = Input::get('menu_ids')?: [];
            $group->menus()->sync($menu_ids);

            $permission_ids = Input::get('permission_ids')?: [];
            $group->permissions()->sync($permission_ids);
        });

        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $group = Group::with(array(
            'menus' => function($query){
                $query->orderBy('name');
            },
            'permissions' => function($query){
                $query->orderBy('route');
            },
        ))->findOrFail($id);
        return View::make('sysguard::resource.group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $group = Group::with(array(
            'menus' => function($query){
                $query->orderBy('name');
            },
            'permissions' => function($query){
                $query->orderBy('route');
            },
        ))->findOrFail($id);

        $menus = Menu::orderBy('name')->get();
        $permissions = Permission::orderBy('route')->get();

        return View::make('sysguard::resource.group.edit', compact('group', 'menus', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        DB::transaction(function() use ($id)
        {
            $group = Group::findOrFail($id);
            $group->update(Input::all());

            $menu_ids = Input::get('menu_ids')?: [];
            $group->menus()->sync($menu_ids);

            $permission_ids = Input::get('permission_ids')?: [];
            $group->permissions()->sync($permission_ids);
        });

        return redirect()->route('group.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect()->route('group.index');
    }

}
