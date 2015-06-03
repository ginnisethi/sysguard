<?php
namespace Ifaniqbal\Sysguard;

use \View;
use \Input;
use \DB;

class SysguardController extends BaseController {
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('sysguard::resource.sysguard.index');
    }
}
