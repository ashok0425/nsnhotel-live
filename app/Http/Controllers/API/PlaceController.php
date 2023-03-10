<?php

namespace App\Http\Controllers\API;


use App\Commons\Response;
use App\HotelReview;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Category;
use App\Models\City;
use App\Models\city_location;
use App\Models\Country;
use App\Models\Faq;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PlaceController extends Controller
{
    private $place;
    private $country;
    private $city;
    private $category;
    private $amenities;
    private $response;

    public function __construct(Place $place, Country $country, City $city, Category $category, Amenities $amenities, Response $response)
    {
        $this->place = $place;
        $this->country = $country;
        $this->city = $city;
        $this->category = $category;
        $this->amenities = $amenities;
        $this->response = $response;
    }

    public function placeBycity($id)
    {
       $places= Place::join('rooms','rooms.hotel_id','places.id')->select('places.*','rooms.onepersonprice as price','rooms.discount_percent','city_translations.name as city_name')->where('rooms.onepersonprice','!=',null)->join('cities','places.city_id','cities.id')->join('city_translations','city_translations.city_id','cities.id')->orderBy('price','asc')->where('places.city_id',$id)->where('rating','>=',3)->get();
        return $this->success_response('Data ',$places);
    }


    public function PlaceBytype($id,$is_toprated=null)
    {
       $places=Place::join('rooms','rooms.hotel_id','places.id')->select('places.*','rooms.onepersonprice as price','rooms.discount_percent','city_translations.name as city_name')->where('rooms.onepersonprice','!=',null)->join('cities','places.city_id','cities.id')->join('city_translations','city_translations.city_id','cities.id')->where('rating','>=',3)->orderBy('price','asc');
       if(isset($is_toprated)&&$is_toprated==1){
        $places=$places->where('top_rated',1)->where('rating','>=',4);
       }else{
        $places=$places->where('place_type',json_encode([$id]));
       }
       $places= $places->limit(10)->get();
        return $this->success_response('Data fetched',$places,200);
    }

    public function detail($id)
    {
        $place = Place::find($id);
        if (!$place) abort(404);
        $rooms = Room::where('hotel_id',$id)->get();    

        $amenities = Amenities::query()
            ->whereIn('id', $place->amenities ? $place->amenities : [])
            ->get(['id', 'name', 'icon']);

            $reviews=DB::table('hotel_reviews')->where('product_id',$id)->join('users','users.id','hotel_reviews.user_id')->select('hotel_reviews.*','users.name','users.avatar','users.id as uid')->orderBy('hotel_reviews.id','desc')->get();
            $avg=DB::table('hotel_reviews')->where('product_id',$id)->avg('rating');
            $avg1=DB::table('hotel_reviews')->where('product_id',$id)->where('rating',1)->avg('rating');
            $avg2=DB::table('hotel_reviews')->where('product_id',$id)->where('rating',2)->avg('rating');
            $avg3=DB::table('hotel_reviews')->where('product_id',$id)->where('rating',3)->avg('rating');
            $avg4=DB::table('hotel_reviews')->where('product_id',$id)->where('rating',4)->avg('rating');
            $avg5=DB::table('hotel_reviews')->where('product_id',$id)->where('rating',5)->avg('rating');
            

        $similar_places = Place::query()
            ->with('place_types')
            ->with('avgReview')
            ->withCount('reviews')
            ->withCount('wishList')
            ->where('city_id', $place->city_id)
            ->where('id', '<>', $place->id);
        foreach ($place->category as $cat_id):
            $similar_places->where('category', 'like', "%{$cat_id}%");
        endforeach;
        $similar_places = $similar_places->limit(4)->get();

        return $this->response->formatResponse(200, [
            'place' => $place,
            'rooms' => $rooms,
            'amenities' => $amenities,
            'reviews' => $reviews,
            'avg_rating' => $avg,
            'avg_rating1' => $avg1,
            'avg_rating2' => $avg2,
            'avg_rating3' => $avg3,
            'avg_rating4' => $avg4,
            'avg_rating5' => $avg5


        ]);
    }

    public function search(Request $request)
    {
        $cityname = "";
        $keyword = $request->keyword;
        $filter_category = $request->category;
        $filter_amenities = $request->amenities;
        $filter_place_type = $request->place_type;
        $filter_city = $request->city;
        
        // $cityname = $filter_city;
        
        $filter_search = $request->search;
if($request->get('hotel')){
         $filter_hotel = $request->get('hotel') ;
}
        $categories = Category::where('type', Category::TYPE_PLACE)->get();

        $place_types = PlaceType::query()
            ->get();

        $amenities = Amenities::query()
            ->get();

        $cities = City::query()
            ->get();

$places = Place::select('places.*','places.id as place_id')->where('places.status', 1)->where('rooms.onepersonprice', '>', 0)->join('cities','places.city_id','cities.id')
->select("places.*","rooms.onepersonprice as price")->leftjoin('rooms','rooms.hotel_id','places.id');
if(isset($keyword)){
    $places=$places->where('places.name', 'LIKE',"%{$keyword}%")->orwhere('places.slug','LIKE',"%{$keyword}%")->orwhere('cities.slug','LIKE',"%{$keyword}%");
}
        if(isset($request->lat) && isset($request->lng)){
               $latitude =   $request->lat;
      $longitude =   $request->lng;
       
    $placess = Place::selectRaw("places.* , rooms.onepersonprice as price , places.slug, places.city_id,places.address, '2hotel' as type,( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) )* cos( radians( lng ) - radians(?)) + sin( radians(?) ) * sin( radians( lat ) ) )) AS distance", [$latitude, $longitude, $latitude])->leftJoin('rooms' , 'rooms.hotel_id', 'places.id')
    ->having("distance", "<", '2')
    ->orderBy("distance",'asc')->get();
$data=[
    'cityname' => $cityname,
    'keyword' => $keyword,
    'places' => $placess,
    'categories' => $categories,
    'place_types' => $place_types,
    'amenities' => $amenities,
    'cities' => $cities,
    'filter_category' => $filter_category,
    'filter_amenities' => $filter_amenities,
    'filter_place_type' => $filter_place_type,
    'filter_city' => $request->city,
];

return $this->success_response('Fetched Data',$data);
            
}
        $places = $places->get();
        $data=[
            'cityname' => $cityname,
            'keyword' => $keyword,
            'places' => $places,
            'categories' => $categories,
            'place_types' => $place_types,
            'amenities' => $amenities,
            'cities' => $cities,
            'filter_category' => $filter_category,
            'filter_amenities' => $filter_amenities,
            'filter_place_type' => $filter_place_type,
            'filter_city' => $request->city,
        ];

        return $this->success_response('Fetched Data',$data);
    }

    


    public function addPlaceToWishlist(Request $request)
    {
        $user = $this->getUserByApiToken($request);
        $request['user_id'] = $user->id;

        $data = $this->validate($request, [
            'user_id' => 'required',
            'place_id' => 'required',
        ]);

        $have_wishlist = Wishlist::query()
            ->where('user_id', $data['user_id'])
            ->where('place_id', $data['place_id'])
            ->exists();

        if (!$have_wishlist) {
            $wislist = new Wishlist();
            $wislist->fill($data)->save();
            return $this->response->formatResponse(200, [], "success");
        } else {
            return $this->response->formatResponse(208, [], "This place is already in your wishlist!");
        }
    }

    public function removePlaceFromWishlist(Request $request)
    {
        $user = $this->getUserByApiToken($request);
        $request['user_id'] = $user->id;

        $data = $this->validate($request, [
            'user_id' => 'required',
            'place_id' => 'required',
        ]);

        Wishlist::query()
            ->where('user_id', $data['user_id'])
            ->where('place_id', $data['place_id'])
            ->delete();

        return $this->response->formatResponse(200, [], "success");
    }




    public function locationSearch(Request $request) {
    $keyword =   $request->get('keyword');
         
    $places = DB::table('places')->selectRaw('places.id as hotel_id, place_translations.name , places.slug, places.name, places.address,places.city_id,places.country_id, "2hotel" as type')->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->where('place_translations.name', 'like', '%' . $keyword . '%');

    $citiess = DB::table('cities')->selectRaw('"" as hotel_id, city_translations.name , cities.slug, cities.id as city_id, "" as address, "1city" as type')
             ->leftJoin('city_translations' , 'city_translations.city_id', 'cities.id')
             ->where('city_translations.name', 'like', '%' . $keyword . '%')
             ->orderBy('type', 'asc')
             ->limit(1)
             ->first();
              $citiesssss = DB::table('cities')->selectRaw('"" as hotel_id, city_translations.name , cities.slug,cities.location,cities.country_id, cities.id as city_id, "" as address, "1city" as type')
             ->leftJoin('city_translations' , 'city_translations.city_id', 'cities.id')
             ->where('city_translations.name', 'like', '%' . $keyword . '%')
             ->orwhere('city_location.location_name', 'like', '%' . $keyword . '%')
             ->union($places)
             // ->union($location)
             ->orderBy('type', 'asc')
             ->get();

$cities = DB::table('cities')->selectRaw('"" as hotel_id, city_translations.name, city_location.location_name,city_location.url , cities.slug, cities.id as city_id, "" as address, "1city" as type')
             ->leftJoin('city_translations' , 'city_translations.city_id', 'cities.id')
             ->leftJoin('city_location' , 'city_location.city_id', 'cities.id')
             ->where('city_translations.name', 'like', '%' . $keyword . '%')
             ->union($places)
             // ->union($location)
             ->orderBy('type', 'asc')
             ->limit(30)
             ->get();
          



             if(count($cities)<=0){
                 $c = DB::table('city_location')->select('location_name as name','city_id','url',"type as type","location_name as location_name","location_name as address","location_name as slug"  )
                 ->where('location_name', 'LIKE', '%' . "$keyword" . '%')
                 ->get();
return $this->success_response("feteched", $c);

             }

             if(isset($citiess)){
            $count=Place::where('city_id',$citiess->city_id)->get()->count();

                 $name = $citiess->name;
                 $names =$citiess->name.' &nbsp;   &nbsp;   &nbsp; &nbsp;   <br>     '. $count."  Properties";
             $cities[0] = array("hotel_id" => "","name" =>$names,"slug" => "" ,"city_id" => $citiess->city_id ,"address" => "$names" ,"type" => "1city"); 
             }
if(isset($placess)  && !$citiess){
    return $this->success_response("feteched", $cities);

//    $name = $add;
$names = count($placess)."  Properties";
             $cities[0] = array("hotel_id" => "","name" =>$name,"slug" => "" ,"city_id" => "0" ,"address" => "$names" ,"type" => "3location");
}

  


return $this->success_response("feteched", $cities);
    }






    public function nearbyplace(Request $request,$radius = 8000)
    {
        $latitude = $request->lat;
        $longitude = $request->lng;
     
        $places = Place::query()
        ->selectRaw("places.id,place_id,places.user_id,city_translations.name as cityname,place_translations.name,places.slug,address,places.lat,places.lng,places.status,places.city_id,places.country_id,place_translations.description,places.thumb,amenities,( 6371000 * acos( cos( radians(?) ) * cos( radians( places.lat ) ) * cos( radians( places.lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( places.lat ) ) )) AS distances",[$latitude, $longitude, $latitude])
        ->select("places.*","city_translations.name as city_name","hotel_reviews.avg_rating","hotel_reviews.rating_count","rooms.onepersonprice as price","rooms.discount_percent")
        ->leftjoin(DB::raw("(SELECT avg(rating) as avg_rating,hotel_reviews.product_id,count(*) as rating_count FROM hotel_reviews ) as hotel_reviews"),function($join){
              $join->on("hotel_reviews.product_id","=","places.id");
        })->join('cities','places.city_id','cities.id')->join('city_translations','city_translations.city_id','cities.id')
        ->join('rooms','rooms.hotel_id','places.id')
        ->limit(8)
        ->get();
            
        $data = [
            'places' => $places
        ];

        return $this->success_response('NearBy hotel fetched', $data);
    }









}