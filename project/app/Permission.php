<?php
namespace App;
use Zizaco\Entrust\EntrustPermission;
class Permission extends EntrustPermission
{
    protected $fillable = ['id','name', 'display_name', 'description'];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function scopegetDisplayNamePermission($query,$display_name)
    {
        return $query->where('display_name','=', $display_name);
    }
}