<?php

namespace App;

use App\Models\Place;
use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'product_id');
    }
}
