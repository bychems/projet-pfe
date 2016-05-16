<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    protected $fillable = ['version'];

    public function scopeGetVersions($query)
    {
        return $query->where('id','=', 1);
    }
}
