<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['finition','icon_finition','consommation','picture','video','basic_price','test_drive','model_id'];
    
    public function optioncars(){
        return $this->hasMany('App\OptionCar');
    }
    
     public function testDriveDay(){
        return $this->hasMany('App\TestDriveDay');
    }

    public function scopeListCarsTestDrive($query)
    {
        return $query->where('test_drive','=', 1);
    }

    public function modele(){
        return $this->belongsTo('App\Modele');
    }
    
}
