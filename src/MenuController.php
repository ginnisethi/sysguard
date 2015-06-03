<?php
namespace Ifaniqbal\Sysguard;

use Illuminate\Http\Request;
use \View;
use \Redirect;
use \Input;
use \DB;

class MenuController extends BaseController {

    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'url' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $menus = Menu::orderBy('url')->paginate();
        return View::make('sysguard::resource.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $menu = new Menu;
        $menus = Menu::orderBy('url')->get();
        return View::make('sysguard::resource.menu.create', compact('menus', 'menu'));
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
            $menu = Menu::create(Input::all());
            if (Input::get('parent_id') != 0)
            {
                $parent = Menu::find(Input::get('parent_id'));
                $menu->parent()->associate($parent);
                $menu->save();
            }
        });

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $menu = Menu::with('parent', 'children.children', 'groups')->findOrFail($id);
        $menu->groups->sortBy('name');
        $menu->children->sortBy('order')->each(function($child){
            if ($child->child != null)
            {
                $child->child->sortBy('order');
            }
        });
        $menus = Menu::orderBy('url')->get();
        return View::make('sysguard::resource.menu.show', compact('menu', 'menus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::whereNotIn('id', [$id])->get();
        return View::make('sysguard::resource.menu.edit', compact('menu', 'menus'));
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
            $menu = Menu::findOrFail($id);
            $input = Input::all();
            $input['enabled'] = Input::has('enabled');
            $menu->update($input);

            if (Input::get('parent_id') != 0)
            {
                $parent = Menu::findOrFail(Input::get('parent_id'));
                $menu->parent()->associate($parent);
                $menu->save();
            }
        });

        return redirect()->route('menu.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index');
    }
}
