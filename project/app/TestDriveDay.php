<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestDriveDay extends Model
{
    //
     protected $fillable = ['date_day','car_id'];
    
    public function testDriveHour(){
        return $this->hasMany('App\TestDriveHour');
    }

    public function scopeListDateDispo($query,$id)
    {
        return $query->where('car_id','=', $id);
    }

    public function scopeIdDate($query,$date,$car)
    {
        return $query->where('date_day','=', $date)->where('car_id','=', $car);
    }
}
