<?php
namespace Ifaniqbal\Sysguard;

use Illuminate\Http\Request;
use \View;
use \Input;
use \Auth;
use \DB;

class UserController extends BaseController {

    protected $rules = [
        'name' => 'required',
        'password' => 'required|min:5',
        'email' => 'required|email',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['items'] = User::paginate($this->perPage);
        View::share('data', $this->data);
        return View::make('sysguard::resource.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = new User;
        $userGroups = [];
        $groups = Group::get()->lists('name', 'id');
        return View::make('sysguard::resource.user.create', compact('user', 'groups', 'userGroups'));
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
            $user = User::create(Input::all());

            $group_ids = Input::get('group_ids')?: [];
            $user->groups()->sync($group_ids);
        });

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::with('groups')->findOrFail($id);
        $userGroups = $user->groups->lists('id');
        $groups = $user->groups->lists('name', 'id');
        return View::make('sysguard::resource.user.show', compact('user', 'groups', 'userGroups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::with('groups')->findOrFail($id);
        $userGroups = $user->groups->lists('id');
        $groups = Group::get()->lists('name', 'id');
        return View::make('sysguard::resource.user.edit', compact('user', 'groups', 'userGroups'));
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
            $user = User::findOrFail($id);
            $user->update(Input::all());

            $group_ids = Input::get('group_ids')?: [];
            $user->groups()->sync($group_ids);
        });
        
        return redirect()->route('user.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }

    public function changeRole()
    {
        if (Auth::check()) {
            Auth::user()->setGroupRoleId(Input::get('group_id'));
        }
        return redirect('/');
    }
}
