<?php
namespace Ifaniqbal\Sysguard;

use \View;
use \Redirect;
use \Input;
use \Request;
use \Session;
use \Auth;

class UserController extends BaseController {

    public function index()
    {
        $this->data['items'] = User::paginate($this->perPage);
        View::share('data', $this->data);
        return View::make('sysguard::pages.user.index');
    }

    public function manage()
    {
        if (Session::has('latest')) {
            $this->data['items'] = User::latest()->get();
            Session::flash('message_title', 'Berhasil!');
            Session::flash('message', 'Data pengguna berhasil ditambahkan.');
        } else {
            $this->data['items'] = User::get();
        }
        View::share('data', $this->data);
        return View::make('sysguard::pages.user.manage');
    }

    public function detail($id = null)
    {
        if ($id == null)
        {
            $id = Auth::user()->id;
        }
        $this->data['item'] = User::with('groups')->find($id);
        View::share('data', $this->data);
        return View::make('sysguard::pages.user.detail');
    }

    public function savePhoto(User &$user, &$message = [])
    {
        if(Input::hasFile('img_path'))
        {
            $maxWidth = 400;
            $maxHeight = 600;
            $file = Input::file('img_path');
            $extension = strtolower($file->getClientOriginalExtension());
            list($width, $height) = getimagesize($file);

            if (($width > $maxWidth) || ($height > $maxHeight)) {
                array_push($message, 'Resolusi foto melebihi ' . $maxWidth .  ' x ' . $maxHeight . '.');
            } 
            if ($extension != 'png' && $extension != 'jpg' && $extension && 'jpeg') {
                array_push($message, 'Extensi berkas foto yang diperbolehkan adalah .png, .jpg, dan .jpeg');
            } else {
                $user->save();
                $filename = $user->id . "." . $extension;
                $destination = public_path() . '/uploads/photo/';
                $uploadSuccess = $file->move($destination, $filename);

                $user->img_path = '/uploads/photo/' . $filename;
                $user->save();
            }
        }

        return $message;
    }

    public function saveGroups(User &$user, &$message = [])
    {
        if ($user->exists() && is_array($group_ids = Input::get('group_ids'))) {
            $user->groups()->sync($group_ids);
            return true;
        } else {
            array_push($message, 'Pengguna harus terdaftar minimal di satu grup.');
            return false;
        }
    }

    public function create()
    {
        if (Request::isMethod('get'))
        {
            $this->data = array();
            $this->data['groups'] = Group::get();
            View::share('data', $this->data);
            return View::make('sysguard::pages.user.create');
        }
        else if (Request::isMethod('post'))
        {
            $user = new User(Input::all());
            $message = [];
            
            $this->savePhoto($user, $message);

            $this->saveGroups($user, $message);

            if (count($message) > 0) {
                return Redirect::back()
                    ->withMessageTitle('Data Tidak Valid')
                    ->withMessage($message);
            }

            return Redirect::to('user/manage')->withLatest(true);
        }
    }

    public function update($id = null)
    {
        if ($id == null)
        {
            $id = Auth::id();
        }

        if (Request::isMethod('get'))
        {
            $this->data = array();
            $this->data['item'] = User::with('groups')->find($id);
            $this->data['groups'] = Group::get();
            View::share('data', $this->data);
            return View::make('sysguard::pages.user.update');
        }
        else if (Request::isMethod('post'))
        {
            $user = User::find($id);
            $exceptions = [];
            $message = [];
            $this->savePhoto($user, $message);

            if (count($message) > 0)
            {
                array_push($exceptions, 'img_path');
            }

            if (Auth::user()->isAdmin()) {
                $this->saveGroups($user, $message);
            } else {
                array_push($exceptions, 'enabled');
            }

            if (count($message) > 0)
            {
                return Redirect::back()
                    ->withMessageTitle('Data Tidak Valid')
                    ->withMessage($message);
            }

            $user->update(Input::except($exceptions));

            return Redirect::to('user/detail/' . $id);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect::to('user/manage');
    }

    public function changePassword($id)
    {
        if (Request::isMethod('get'))
        {
            return View::make('sysguard::pages.user.change_password');
        }
        else if (Request::isMethod('post'))
        {
            $user = User::find($id);
            $this->data = Input::all();
            if ($this->data['password'] == $user->password)
            {
                if ($this->data['new_password'] == $this->data['confirm_password'])
                {
                    $user->password = $this->data['new_password'];
                    $user->save();
                }
            }

            return Redirect::to('user/detail/' . $id);
        }
    }

    public function changeRole()
    {
        if (Auth::check()) {
            Auth::user()->setGroupRoleId(Input::get('group_id'));
        }
        return Redirect::to('/');
    }
}
