<?php
namespace Ifaniqbal\Sysguard;

use \View;
use \Input;
use \Auth;

class UserController extends BaseController {

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
        $groups = Group::get();
        return View::make('sysguard::resource.user.create', compact('user', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        User::create(Input::all());
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
        return View::make('sysguard::resource.user.show', compact('user'));
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
        $groups = Group::get();
        return View::make('sysguard::resource.user.edit', compact('user', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::findOrFail($id);
        $user->update(Input::all());

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
