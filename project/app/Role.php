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
}