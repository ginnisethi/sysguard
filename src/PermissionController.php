<?php
namespace Ifaniqbal\Sysguard;

use Illuminate\Http\Request;
use \View;
use \Redirect;
use \Input;
use \DB;

class PermissionController extends BaseController {

    protected $rules = [
        'route' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('route')->paginate();
        return View::make('sysguard::resource.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permission = new Permission;
        $permissions = Permission::orderBy('route')->get();
        return View::make('sysguard::resource.permission.create', compact('permissions', 'permission'));
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
            $permission = Permission::create(Input::all());
        });

        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $permission = Permission::with('groups')->findOrFail($id);
        $permission->groups->sortBy('route');
        $permissions = Permission::orderBy('route')->get();
        return View::make('sysguard::resource.permission.show', compact('permission', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $permissions = Permission::whereNotIn('id', [$id])->get();
        return View::make('sysguard::resource.permission.edit', compact('permission', 'permissions'));
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
            $permission = Permission::findOrFail($id);
            $input = Input::all();
            $input['enabled'] = Input::has('enabled');
            $permission->update($input);
        });

        return redirect()->route('permission.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permission.index');
    }
}
