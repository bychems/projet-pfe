<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['id','option_list','total_price','id_car','id_customer'];

    public function quotationOptions(){
        return $this->hasMany('App\QuotationOption');
    }

}
