<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestDriveHour extends Model
{
    //
     protected $fillable = ['hour','state','customer_id','day_id'];
    
    public function testDriveDay(){
        return $this->belongsTo('App\TestDriveDay');
    }
    
     public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function scopeListHeureIndispo($query,$date)
    {
        return $query->where('day_id','=', $date)->where('state','=','Active');
    }


}
