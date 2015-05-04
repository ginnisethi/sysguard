<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    public function users() {
        return $this->belongsToMany('Ifaniqbal\Sysguard\User');
    }

    public function menus() {
        return $this->belongsToMany('Ifaniqbal\Sysguard\Menu');
    }

    public function permissions() {
        return $this->belongsToMany('Ifaniqbal\Sysguard\Permission');
    }

}
