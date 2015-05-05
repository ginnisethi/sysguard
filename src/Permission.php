<?php namespace Ifaniqbal\Sysguard;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected $fillable = ['route', 'enabled'];

    public function groups() {
        return $this->belongsToMany('Ifaniqbal\Sysguard\Group');
    }
}
