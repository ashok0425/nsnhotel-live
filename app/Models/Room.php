<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Room extends Model implements TranslatableContract
{

    use Translatable;

    public $translatedAttributes = ['name'];

    protected $table = 'rooms';

    protected $casts = [
        
        'gallery' => 'json',
        'amenities' => 'json'
    ];

    protected $guarded = [
        'id'
    ];

    protected $hidden = [];

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;


    public function list_amenities()
    {
        return $this->belongsToJson(Amenities::class, 'amenities');
    }

    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'hotel_id');
    }

    public function getListByHotel($hotel_id)
    {
        $rooms = self::query();
        if ($hotel_id) {
            $rooms->where('hotel_id', $hotel_id);
        }
        $rooms = $rooms->orderBy('created_at', 'desc')->get();
        return $rooms;
    }  

    public function RoomTrans()
    {
        return $this->hasOne(RoomTranslation::class, 'room_id', 'id');
    }
}
