<?php
namespace App;
use Zizaco\Entrust\EntrustRole;
class Role extends EntrustRole
{
    protected $fillable = ['id','name', 'display_name', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function scopegetDisplayNameRole($query,$display_name)
    {
        return $query->where('display_name','=', $display_name);
    }
}