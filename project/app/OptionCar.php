<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionCar extends Model
{   
     protected $fillable = ['car_id','option_id','option_price'];
    
     
    public function option(){
        return $this->belongsToMany('App\Option');
    }
    
    public function cars(){
        return $this->belongsToMany('App\Car');
    }

    public function scopeIdCar($query,$id)
    {
        return $query->where('car_id', '=', $id);
    }

    public function quotationOption(){
        return $this->hasMany('App\QuotationOption');
    }
}
