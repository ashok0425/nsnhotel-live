<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    protected $fillable = [
        'date', 'price_one_person', 'price_two_person', 'price_three_person', 'discount_percentage', 'hotel_id', 'room_id'
    ];
}
