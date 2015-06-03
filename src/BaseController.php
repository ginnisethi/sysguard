<?php
namespace Ifaniqbal\Sysguard;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller {
    use ValidatesRequests;

    const PER_PAGE = 10;
    protected $perPage;
    protected $data;

    public function __construct()
    {
        $this->perPage = self::PER_PAGE;
        $this->data = array();
    }
}
