<?php
namespace Ifaniqbal\Sysguard;

use \Illuminate\Routing\Controller;

class BaseController extends Controller {

    const PER_PAGE = 10;
    protected $perPage;
    protected $data;

    public function __construct()
    {
        $this->perPage = self::PER_PAGE;
        $this->data = array();
    }
}
