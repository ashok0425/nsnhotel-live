<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
     protected $table = 'coupon';
     protected $fillable = ['coupon_name','link','coupon_value','thumb','coupon_percent','coupon_min','status'];

     const STATUS_ACTIVE = 1;
     const STATUS_DEACTIVE = 0;
}
