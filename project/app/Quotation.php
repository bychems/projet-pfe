<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['id','options','total_price','id_car','id_customer'];
}
