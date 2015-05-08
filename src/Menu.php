<?php

namespace Ifaniqbal\Sysguard;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['parent_id', 'name', 'url', 'icon', 'order', 'enabled'];

    public function groups()
    {
        return $this->belongsToMany('Ifaniqbal\Sysguard\Group');
    }

    public function parent()
    {
        return $this->belongsTo('Ifaniqbal\Sysguard\Menu', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Ifaniqbal\Sysguard\Menu', 'parent_id');
    }
}
