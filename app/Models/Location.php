<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
     protected $table = 'city_location';
   
     
     public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}