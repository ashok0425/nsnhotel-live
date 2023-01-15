<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
     protected $table = 'faq';
     protected $fillable = ['type','status'];

     const STATUS_ACTIVE = 1;
     const STATUS_DEACTIVE = 0;
     
     public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}