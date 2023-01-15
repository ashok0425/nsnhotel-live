<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealHotel extends Model
{
    protected $table    = 'meal_hotels';
    protected $fillable = ['hotel_id', 'type', 'price', 'status'];

    public function place()
    {
        return $this->belongsTo(Place::class, 'hotel_id', 'id');
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'type', 'id');
    }
}
