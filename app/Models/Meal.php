<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
     protected $table = 'meals';
     protected $fillable = ['type','status'];

     const STATUS_ACTIVE = 1;
     const STATUS_DEACTIVE = 0;
}
