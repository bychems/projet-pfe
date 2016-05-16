<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationOption extends Model
{
    //
    protected $fillable = ['quotation_id','option_car_id','option_price'];

    public function optionCar(){
        return $this->belongsToMany('App\OptionCar');
    }

    public function quotations(){
        return $this->belongsToMany('App\Quotation');
    }
}
