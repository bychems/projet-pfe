<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestDriveHour extends Model
{
    //
     protected $fillable = ['hour','customer_id','day_id'];
    
    public function testDriveDay(){
        return $this->belongsTo('App\TestDriveDay');
    }
    
     public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
