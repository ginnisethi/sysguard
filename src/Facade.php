<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Support\Facades\Facade;

class Sysguard extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sysguard';
    }

}
