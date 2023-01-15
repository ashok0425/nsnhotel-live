<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookedRoom extends Model
{
    protected $table = 'booked_room';
    protected $fillable = ['booking_id','room_number','guest_type','no_of_days','amount','discount','final_amount'];
}
