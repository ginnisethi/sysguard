<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    public function groups() {
        return $this->belongsToMany('Ifaniqbal\Sysguard\Group');
    }
}
