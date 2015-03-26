<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    public function users() {
        return $this->belongsToMany('Ifaniqbal\Sysguard\User');
    }

}
