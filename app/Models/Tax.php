<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
     protected $table = 'tax';
     protected $fillable = ['price_min','price_max','percentage'];

     const STATUS_ACTIVE = 1;
     const STATUS_DEACTIVE = 0;
}
