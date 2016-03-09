<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $fillable = ['name','description','category_id'];
    
    public function optionCar(){
        return $this->hasMany('App\OptionCar');
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
}
