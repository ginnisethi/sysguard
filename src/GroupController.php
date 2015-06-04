<?php
namespace Ifaniqbal\Sysguard;

use Illuminate\Http\Request;
use \View;
use \Input;
use \DB;

class GroupController extends BaseController {
    
    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'level' => 'required|numeric',
    ];

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
        $groupMenus = [];
        $groupPermissions = [];
        $menus = Menu::orderBy('name')->get()->lists('name', 'id');
        $permissions = Permission::orderBy('route')->lists('route', 'id');
        return View::make('sysguard::resource.group.create', compact('group', 'menus', 'permissions', 'groupMenus', 'groupPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        DB::transaction(function()
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
        
        $groupMenus = $group->menus->lists('id');
        $groupPermissions = $group->permissions->lists('id');
        $menus = $group->menus->lists('name', 'id');
        $permissions = $group->permissions->lists('route', 'id');

        return View::make('sysguard::resource.group.show', compact('group', 'menus', 'permissions', 'groupMenus', 'groupPermissions'));
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

        $menus = Menu::orderBy('name')->get()->lists('name', 'id');
        $permissions = Permission::orderBy('route')->get()->lists('route', 'id');;
        $groupMenus = $group->menus->lists('id');
        $groupPermissions = $group->permissions->lists('id');

        return View::make('sysguard::resource.group.edit', compact('group', 'menus', 'permissions', 'groupMenus', 'groupPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);

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
