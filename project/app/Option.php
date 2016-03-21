<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $fillable = ['id','name','description','category_id'];
    
    public function optionCar(){
        return $this->hasMany('App\OptionCar');
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function scopeListOptionCar($query,$id)
    {
        return $query->where('id', '=', $id);
    }
}
