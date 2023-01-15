<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use App\HotelReview;
class Place extends Model  implements TranslatableContract
{
    use Translatable, HasJsonRelationships {
        Translatable::getAttribute insteadof HasJsonRelationships;
    }

    public $translatedAttributes = ['name', 'description'];

    protected $casts = [
        'category' => 'json',
        'place_type' => 'json',
       
        'amenities' => 'json',
      
        'gallery' => 'json',

        'user_id' => 'integer',
        'country_id' => 'integer',
        'city_id' => 'integer',
        'price_range' => 'integer',
        'lat' => 'double',
        'lng' => 'double',
        'booking_type' => 'integer',
        'status' => 'integer'
    ];

    protected $table = 'places';

    protected $fillable = [
        'user_id', 'country_id', 'city_id', 'category', 'place_type', 'slug', 'price_range',
        'amenities', 'address', 'lat', 'lng', 'email', 'phone_number', 'website',
        'thumb', 'gallery', 'video', 'booking_type', 'link_bookingcom', 'status', 'seo_title', 'seo_description','seo_keywords',
        'airport','railway_station','bus_stop','other_place','metro_station','shopping_complex','o_u_s_to','o_u_s_from','top_rated'
    ];

    protected $hidden = [];

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    const STATUS_DELETE = 4;

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
 public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function categories()
    {
        return $this->belongsToJson(Category::class, 'category');
    }

    public function list_amenities()
    {
        return $this->belongsToJson(Amenities::class, 'amenities');
    }

    public function place_types()
    {
        return $this->belongsToJson(PlaceType::class, 'place_type');
    }

    public function roomsData() {
        return $this->hasMany(Room::class,'hotel_id','id');
    }
 public function rooms() {
        return $this->hasOne(Room::class,'hotel_id','id');
    }
    public function reviews()
    {
        return $this->hasMany(HotelReview::class, 'product_id', 'id');
    }

    public function avgReview()
    {
        return $this->reviews()
            ->selectRaw('avg(rating) as aggregate, product_id')
            ->groupBy('product_id');
    }

    public function getAvgReviewAttribute()
    {
        if (!array_key_exists('avgReview', $this->relations)) {
            $this->load('avgReview');
        }
        $relation = $this->getRelation('avgReview')->first();
        return ($relation) ? $relation->aggregate : null;
    }

    public function wishList()
    {
        return $this->hasMany(Wishlist::class, 'place_id', 'id')->where('user_id', Auth::id());
    }


    public function getAll()
    {
        return self::query()
            ->with('city')
            ->get();
    }

    public function listByFilter($country_id, $city_id, $cat_id)
    {
        $places = self::query()
            ->with('city')
            ->with('categories')
            ->with('user')
             ->with('rooms')
            ->orderBy('id', 'desc');

        if ($country_id)
            $places->where('country_id', $country_id);

        if ($city_id)
            $places->where('city_id', $city_id);

        if ($cat_id)
            $places->where('category', 'like', '%' . $cat_id . '%');

        $places = $places->paginate();
    
        return $places;
    }
 public function listByFilters($country_id, $city_id, $cat_id,$hotel_name)
    {
        $places = self::query()
            ->with('city')
            ->with('categories')
            ->orderBy('id', 'desc');

        if ($country_id)
            $places->where('country_id', $country_id);

        if ($city_id)
            $places->where('city_id', $city_id);

        if ($cat_id)
            $places->where('category', 'like', '%' . $cat_id . '%');

      if ($hotel_name)
            $places->where('slug', 'like', '%' . $hotel_name . '%');
        $places = $places->paginate();
    
        return $places;
    }

    public function listByUserId($country_id, $city_id, $cat_id, $user_id)
    {
        $places = self::query()
            ->with('city')
            ->with('categories')
            ->orderBy('id', 'desc');

        if ($country_id)
            $places->where('country_id', $country_id);

        if ($city_id)
            $places->where('city_id', $city_id);

        if ($cat_id)
            $places->where('category', 'like', '%' . $cat_id . '%');

        if ($user_id)
            $places->where('user_id', $user_id);

        $places = $places->get();

        return $places;
    }
    

    public function getBySlug($slug, $with = [])
    {
        return self::query()
            ->with($with)
            ->withCount('wishList')
            ->where('slug', $slug)
            ->first();
    }
    
    public function SearchFilter($query)
    {
        if(! empty($query)){
        return self::query()
            ->with('city')
            ->with('categories')
            ->where('id', 'like', '%'.$query.'%')
            ->orWhere('slug', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->orwhereHas('city', function ($q) use ($query){
                $q->where('slug', 'like', '%'.$query.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate();
        }else{
             return self::query()
             ->with('city')
            ->with('categories')
            ->orderBy('id', 'desc')
            ->paginate();
        }
    }
  
}