<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Validator;
use App\Commons\Response;
use App\Models\Place;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use App\Models\BookedRoom;
use Carbon\Carbon;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Amenities;

use App\Models\ReferelMoney;
use App\Models\Category;
use App\Models\Country;
use App\Models\Offer;
use App\Models\PlaceType;
use App\Models\Setting;
use App\Models\Review;
use App\Models\Wishlist;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\ValidatorTrait;

class BookingController extends Controller

{

    use ResponseTrait;
    private $request;
    private $response;
    private $city;
    

    public function __construct(Request $request, Response $response, City $city)
    {
        $this->response = $response;
        $this->request = $request;
        $this->city = $city;
    }
    

    public function allCity()
    {
        $city = City::query()
            ->with('country')
            ->withCount(['places' => function ($query) {
                $query->where('status', Place::STATUS_ACTIVE);
            }])
            ->get();
            
        $response = [
                        'error' => false,
                        'message' => 'Sucess',
                        'data' => $city,
                    ];
        return $this->responseOkay($response);

    }
    
    public function allOffers()
    {
        $offer = Offer::all();
            $offer_image1 = Setting::where('name', 'offer_image1')->first();
             $offer_image2 = Setting::where('name', 'offer_image2')->first();
                $offer_image3 = Setting::where('name', 'offer_image3')->first();
                   $offer_image4 = Setting::where('name', 'offer_image4')->first();
                   $offer[] = asset('uploads/'.$offer_image1->val);
                    $offer[] = asset('uploads/'.$offer_image2->val);
                     $offer[] = asset('uploads/'.$offer_image3->val);
                      $offer[] = asset('uploads/'.$offer_image4->val);
        $response = [
                        'error' => false,
                        'message' => 'Sucess',
                        'data' => $offer,
                    ];
        return $this->responseOkay($response);
    }


    public function homeHotel(Request $request)
    {
        $dataArr = array();
        $dataArr['city'] = array();
        $dataArr['offer'] = array();
        $dataArr['hotel'] = array();
        $dataArr['recomanded'] = array();
        $dataArr['toprated'] = array();
        $dataArr['similar'] = array();
         $dataArr['wallet_balance'] ="";
        $cityArr = array();
        $hotelArr = array();
        $recArr = array();
        $topArr = array();
        $recArr =array();
         $topArr1 = array();
        $roomArr1 = array();
        $roomArr2 = array();
        $citys = $request->city;
        $cities = City::where('status',1)->whereIn('id',[151,154,144,110,65,112,57,125])->orderByRaw('FIELD (id, ' . implode(', ', [151,154,144,110,65,112,57,125]) . ') ASC')->get();
        foreach ($cities as $city) 
        {
            $cityArr['id']  =$city['id'];
            $cityArr['cityname']  =$city['name'];
            $cityArr['image']  =$city['thumb'];
            $cityArr['status']  =$city['status'];
            $dataArr['city'][] = $cityArr;
        }
        
       
       $PopofferImg = Setting::where('name', 'pop_offer_image')->first();
       $Popoffertext = Setting::where('name', 'pop_offer_text')->first();
            $offerArr['id'] =1;
            $offerArr['offer_name'] =$Popoffertext->val;
            $offerArr['offer_desc'] = $Popoffertext->val;
            $offerArr['offer_image'] =  'uploads/'.$PopofferImg->val;
            $offerArr['offer_slug'] = $Popoffertext->val;
            $dataArr['offer'][] = $offerArr;   
        


        $hotels = Place::orderBy('created_at','DESC')->take(20)->get();

        foreach ($hotels as $hotel) 
        {
            $hotelArr['id'] = $hotel['id'];
            $hotelArr['user_id'] = $hotel['user_id'];
            $hotelArr['name'] = $hotel['name'];
            $hotelArr['image'] = $hotel['thumb'];
            $hotelArr['gallery'] = $hotel['gallery'];
            $hotelArr['latitude'] = $hotel['lat'];
            $hotelArr['longitude'] = $hotel['lng'];
            $hotelArr['state'] = $hotel['country_id'];
            $hotelArr['location'] = $hotel['address'];
            $hotelArr['description'] = $hotel['description'];
            $hotelArr['is_online'] = $hotel['status'];
            $hotelArr['rating'] = $hotel['rating'];

            $city = City::find($hotel['city_id']);

            $hotelArr['city'] = $city['name'];
           
            $rooms = Room::where('hotel_id',$hotel['id'])->get();

            foreach ($rooms as $room) 
            {
                $roomArr1['id'] = $room['id'];
                $roomArr1['name'] = $room['name'];
                $roomArr1['thumb'] = $room['thumb'];
                $roomArr1['gallery'] = $room['gallery'];
                $roomArr1['single_price'] = round($room['onepersonprice'], 2);
                $roomArr1['double_price'] = round($room['twopersonprice'], 2);
                $roomArr1['three_price'] = round($room['threepersonprice'], 2);
                $roomArr1['four_price'] = round($room['fourpersonprice'], 2);
                $roomArr1['hotel_id'] = $room['hotel_id'];
                $roomArr1['is_active'] = $room['status'];
                $roomArr1['single_discount'] = $room['single_discount'];
                $roomArr1['double_discount'] = $room['double_discount'];
                $roomArr1['three_discount'] = $room['three_discount'];
                $roomArr1['four_discount'] = $room['four_discount'];
            }
            if(count($rooms) > 0)
            {
                $hotelArr['room'] = $roomArr1;
                $dataArr['hotel'][] = $hotelArr;
            }
            else
            {
                $dataArr['hotel'];
            }
        }
        

        $recomanded = Place::orderBy('created_at','ASC')->take(20)->get();
        foreach ($recomanded as $recomnd) 
        {
            $recArr['id'] = $recomnd['id'];
            $recArr['user_id'] = $recomnd['user_id'];
            $recArr['name'] = $recomnd['name'];
            $recArr['image'] = $recomnd['thumb'];
            $recArr['gallery'] = $recomnd['gallery'];
            $recArr['latitude'] = $recomnd['lat'];
            $recArr['longitude'] = $recomnd['lng'];
            $recArr['state'] = $recomnd['country_id'];
            $recArr['location'] = $recomnd['address'];
            $recArr['description'] = $recomnd['description'];
            $recArr['is_online'] = $recomnd['status'];
            $recArr['rating'] = $recomnd['rating'];


            $city = City::find($recomnd['city_id']);
            $recArr['city'] = $city['name'];          
            $recRoom = Room::where('hotel_id',$recomnd['id'])->get();
            foreach ($recRoom as $recroom) 
            {
                $recArrroom['id'] = $recroom['id'];
                $recArrroom['name'] = $recroom['name'];
                $recArrroom['thumb'] = $recroom['thumb'];
                $recArrroom['gallery'] = $recroom['gallery'];
                $recArrroom['single_price'] = round($recroom['onepersonprice'], 2);
                $recArrroom['double_price'] = round($recroom['twopersonprice'], 2);
                $recArrroom['three_price'] = round($recroom['threepersonprice'], 2);
                $recArrroom['four_price'] = round($recroom['fourpersonprice'], 2);
                $recArrroom['hotel_id'] = $recroom['hotel_id'];
                $recArrroom['is_active'] = $recroom['status'];
                $recArrroom['single_discount'] = $recroom['single_discount'];
                $recArrroom['double_discount'] = $recroom['double_discount'];
                $recArrroom['three_discount'] = $recroom['three_discount'];
                $recArrroom['four_discount'] = $recroom['four_discount'];
                $recArrroom['before_discount_price'] = $recroom['before_discount_price'];
                $recArrroom['discount_percent'] = $recroom['discount_percent'];
                  
            }
            if(count($recRoom) > 0)
            {
                $recArr['room'] = $recArrroom;
                $dataArr['recomanded'][] = $recArr;
            }
            else
            {
                $dataArr['recomanded'];
            }
        }

        $topRated = Place::where('status',1)->orderBy('id','DESC')->take(20)->get();
      
        foreach ($topRated as $top) 
        {
              
            $topArr1['id'] = $top['id'];
            $topArr1['name'] = $top['name'];
            $topArr1['image'] = $top['thumb'];
            $topArr1['gallery'] = $top['gallery'];
            $topArr1['user_id'] = $top['user_id'];
            $topArr1['latitude'] = $top['lat'];
            $topArr1['longitude'] = $top['lng'];
            $topArr1['location'] = $top['address'];
            $topArr1['state'] = $top['country_id'];
            $topArr1['description'] = $top['description'];
            $topArr1['is_online'] = $top['status'];
            $topArr1['rating'] = $top['rating'];
            
            $city = City::find($top['city_id']);
            $topArr1['city'] = $city['name'];          
            $rooms1 = Room::where('hotel_id',$top['id'])->get();
            $roomArr2 = array();
            foreach ($rooms1 as $room1) 
            {
                $roomArr2['id'] = $room1['id'];
                $roomArr2['name'] = $room1['name'];
                $roomArr2['thumb'] = $room1['thumb'];
                $roomArr2['gallery'] = $room1['gallery'];
                $roomArr2['single_price'] = round($room1['onepersonprice'], 2);
                $roomArr2['double_price'] = round($room1['twopersonprice'], 2);
                $roomArr2['three_price'] = round($room1['threepersonprice'], 2);
                $roomArr2['four_price'] = round($room1['fourpersonprice'], 2);
                $roomArr2['hotel_id'] = $room1['hotel_id'];
                $roomArr2['is_active'] = $room1['status'];
                $roomArr2['single_discount'] = $room1['single_discount'];
                $roomArr2['double_discount'] = $room1['double_discount'];
                $roomArr2['three_discount'] = $room1['three_discount'];
                $roomArr2['four_discount'] = $room1['four_discount'];
                $roomArr2['before_discount_price'] = $room1['before_discount_price'];
                $roomArr2['discount_percent'] = $room1['discount_percent'];
               
            }
            if(count($rooms1) > 0)
            {
                $topArr1['room'] = $roomArr2;
                $dataArr['toprated'][] = $topArr1;
            }
            // else
            // {
            //     $dataArr['$topArr1'];
            // }
        }
    
         $similar = Place::where('address','like', '%'.$citys.'%')->where('status',1)->take(20)->get();
        foreach ($similar as $recomnd) 
        {
            $recArr['id'] = $recomnd['id'];
            $recArr['user_id'] = $recomnd['user_id'];
            $recArr['name'] = $recomnd['name'];
            $recArr['image'] = $recomnd['thumb'];
            $recArr['gallery'] = $recomnd['gallery'];
            $recArr['latitude'] = $recomnd['lat'];
            $recArr['longitude'] = $recomnd['lng'];
            $recArr['state'] = $recomnd['country_id'];
            $recArr['location'] = $recomnd['address'];
            $recArr['description'] = $recomnd['description'];
            $recArr['is_online'] = $recomnd['status'];
            $recArr['rating'] = $recomnd['rating'];


            $city = City::find($recomnd['city_id']);
            $recArr['city'] = $city['name'];          
            $recRoom1 = Room::where('hotel_id',$recomnd['id'])->get();
            foreach ($recRoom1 as $recroom) 
            {
                $recrooms1['id'] = $recroom['id'];
                $recrooms1['name'] = $recroom['name'];
                $recrooms1['thumb'] = $recroom['thumb'];
                $recrooms1['gallery'] = $recroom['gallery'];
                $recrooms1['single_price'] = round($recroom['onepersonprice'], 2);
                $recrooms1['double_price'] = round($recroom['twopersonprice'], 2);
                $recrooms1['three_price'] = round($recroom['threepersonprice'], 2);
                $recrooms1['four_price'] = round($recroom['fourpersonprice'], 2);
                $recrooms1['hotel_id'] = $recroom['hotel_id'];
                $recrooms1['is_active'] = $recroom['status'];
                $recrooms1['single_discount'] = $recroom['single_discount'];
                $recrooms1['double_discount'] = $recroom['double_discount'];
                $recrooms1['three_discount'] = $recroom['three_discount'];
                $recrooms1['four_discount'] = $recroom['four_discount'];
                $recrooms1['before_discount_price'] = $recroom['before_discount_price'];
                $recrooms1['discount_percent'] = $recroom['discount_percent'];
                  
            }
            if(count($recRoom1) > 0)
            {
                $recArr['room'] = $recrooms1;
                $dataArr['similar'][] = $recArr;
            }
            else
            {
                $dataArr['similar'];
            }
        }
        if(isset($request->user_id)){
             $referl_money = ReferelMoney::where('user_id',$request->user_id)->where('is_used',0)->sum('price');
             $dataArr['wallet_balance'] = $referl_money;
        }
   
        $response = [
            'error' => false,
            'message' => 'Sucess',
            'data' => $dataArr,
                    ];
        return $this->responseOkay($response);
    
    }
    
    public function searchByLocation(Request $request,$radius = 110000)
    {
        $response = array();
        $hotelArr = array();
        $dataArr = array();
        $validator = Validator::make($request->all(),
        [
            'latitude' => ['bail', 'required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['bail', 'required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ],
        [
            'latitude.required' => 'Latitude is required to find your hotels.',
            'longitude.required' => 'Longitude is required to find your hotels.',
            'latitude.regex' => 'Latitude is of incorrect format.',
            'longitude.regex' => 'Longitude is of incorrect format.'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 0,
                    'message' => $validator->errors()->first(),
                    'hotels' => null
                ]
            );
        }
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $results = [];
        $conditions = [
            ['latitude', '!=', 0],
            ['longitude', '!=', 0],
        ];
        if(isset($request->city)){
             $city = City::where('slug',$request->city);
           $restaurants = DB::table('places')->selectRaw("places.id,place_id,user_id,place_translations.name,places.slug,address,rating ,lat, lng,status,city_id,country_id,place_translations.description,thumb,gallery,( 6371000 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) )) AS distance", [$latitude, $longitude, $latitude])
        ->having("city_id",$city['id'])
        ->orderBy("distance",'asc')
        ->join('place_translations','place_translations.place_id','places.id')
        ->get();  
        }
        else{
          $restaurants = DB::table('places')->selectRaw("places.id,place_id,user_id,place_translations.name,places.slug,address,rating ,lat, lng,status,city_id,country_id,place_translations.description,thumb,gallery,( 6371000 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) )) AS distance", [$latitude, $longitude, $latitude])
        ->having("distance", "<=", $radius)
        ->orderBy("distance",'asc')
        ->join('place_translations','place_translations.place_id','places.id')
        ->get();   
        }
       
    
        if(count($restaurants)>0)
        {
            foreach ($restaurants as $hotel) 
            {
                $hotelArr['id'] = $hotel->id;
                $hotelArr['name'] = $hotel->name;
                $hotelArr['user_id'] = $hotel->user_id;
                $hotelArr['latitude'] = $hotel->lat;
                $hotelArr['longitude'] = $hotel->lng;
                $hotelArr['location'] = $hotel->address;
                $hotelArr['state'] = $hotel->country_id;
                $hotelArr['description'] = $hotel->description;
                $hotelArr['image'] = $hotel->thumb;
                $hotelArr['gallery'] = $hotel->gallery;
                $hotelArr['is_online'] = $hotel->status;
                $hotelArr['rating'] = $hotel->rating;
                $city = City::find($hotel->city_id);
                $hotelArr['city'] = $city->name;
                $rooms = Room::where('hotel_id',$hotel->id)->first();

                if(isset($rooms))
                {
                    $hotelArr['room'] = $rooms;
                    $dataArr['hotel'][] = $hotelArr;
                }
                else
                {
                    $dataArr;
                }
                
            }        
           
            $response = [
                'error' => false,
                'message' => 'Success',
                'data' => $dataArr,  
            ];
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Hotel(s) not found',
                'data' => null,  
            ];
        }
        return $this->responseOkay($response);
    }

    public function allHotels(Request $request)
    {

        $response = array();
        $dataArr = array();
        $hotelArr = array();
        $dataArr['hotel'] = array();
        if($request->has('city'))
        {
            $data = $request->all();
            $cities = City::where('slug',$data['city'])->get();

            if(count($cities) > 0)
            {
                foreach ($cities as $city) 
                {
                    $hotels = Place::where('city_id',$city['id'])->get();
                    foreach ($hotels as $hotel) 
                    {
                        $hotelArr['id'] = $hotel['id'];
                        $hotelArr['name'] = $hotel['name'];
                        $hotelArr['image'] = $hotel['thumb'];
                        $hotelArr['user_id'] = $hotel['user_id'];
                        $hotelArr['latitude'] = $hotel['lat'];
                        $hotelArr['longitude'] = $hotel['lng'];
                        $hotelArr['location'] = $hotel['address'];
                        $hotelArr['rating'] = $hotel['rating'];
                        $hotelArr['state'] = $hotel['country_id'];
                        $hotelArr['description'] = $hotel['description'];
                        $hotelArr['is_online'] = $hotel['status'];

                        $city = City::find($hotel['city_id']);
                        $hotelArr['city'] = $city['name'];
                        $rooms = Room::where('hotel_id',$hotel['id'])->first();
                       
                        if(isset($rooms))
                        {
                            $hotelArr['room'] = $rooms;
                            $dataArr['hotel'][] = $hotelArr;
                        }
                        else
                        {
                            $dataArr['hotel'];
                        }
                    }
                }
                if(count($hotels) > 0 )
                {

                    $response = [
                            'error' => false,
                            'message' => 'Succes',
                            'data' => $dataArr,
                        ];
                }
                else
                {
                     $response = [
                            'error' => true,
                            'message' => 'Hotels not found',
                            'data' => null,
                        ];
                }
            }
            else
            {
                $response = [
                            'error' => true,
                            'message' => 'City not found',
                            'data' => null,
                        ];  
            }   
        }
        else
        {
            $response = [
                        'error' => true,
                        'message' => 'Please choose location',
                        'data' => null,
                    ];
        }
        return $this->responseOkay($response);
    }
    
     public function viewtopRated(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'option' => 'required',
        ]);
        $topArr = array();
        $roomArr2 = array();
        $data = $request->all();
        $dataArr['top'] = array();
        $recArr = array();
        $dataArr2['recomanded'] = array();
        $response = array();
        
        if($data)
        {
            $topRated = Place::orderBy('created_at','DESC')->take(10)->get();
            
           
                $topRated = Place::orderBy('created_at','DESC')->take(10)->get();
            
            foreach ($topRated as $top) 
                {
                    $topArr['id'] = $top['id'];
                    $topArr['name'] = $top['name'];
                    $topArr['user_id'] = $top['user_id'];
                    $topArr['latitude'] = $top['lat'];
                    $topArr['longitude'] = $top['lng'];
                    $topArr['state'] = $top['country_id'];
                    $topArr['location'] = $top['address'];
                    $topArr['description'] = $top['description'];
                    $topArr['image'] = $top['thumb'];
                    $topArr['is_online'] = $top['status'];

                    $city = City::find($top['city_id']);
                    $topArr['city'] = $city['name'];          
                    $rooms1 = Room::where('hotel_id',$top['id'])->first();
                  
                        $roomArr2['room_id'] = $rooms1['id'];
                        $roomArr2['single_price'] = round($rooms1['onepersonprice'], 2);
                        $roomArr2['double_price'] = round($rooms1['twopersonprice'], 2);
                        $roomArr2['three_price'] = round($rooms1['threepersonprice'], 2);
                        $roomArr2['four_price'] = round($rooms1['fourpersonprice'], 2);
                        $roomArr2['hotel_id'] = $top['id'];
                        $roomArr2['is_active'] = $rooms1['status'];
                       
                    
                        $topArr['room'] = $roomArr2;
                        $dataArr['top'][] = $topArr;
                    
                }
                $response = [
                        'error' => false,
                        'message' => 'Success',
                        'data' => $dataArr
                    ];
            

        }
        else
        {
            $response = [
                    'error' => true,
                    'message' =>'Please select option',
                    'data'=>null
                ];
        }
         return $this->responseOkay($response);
    }
    
     public function roomDetails(Request $request)
    {
        $response = array();
        $validator = Validator::make($request->all(),[
            'hotel_id' =>'required',
            'room_number' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $roomArr = array();
            $roomArr['category'] = array();
            $roomArr['facility'] = array();
            $roomArr['image'] = array();
            $imageArr = array();
 

            $room = Room::where('hotel_id',$data['hotel_id'])->where('id',$data['room_number'])->first();
            $hotel = Place::find($room['hotel_id']);
            if(isset($room))
            {
                
                $roomArr['id'] = $room['id'];
                $roomArr['room_type'] = $room['name'];
                $roomArr['single_price'] = round($room['onepersonprice']);
                $roomArr['double_price'] = round($room['twopersonprice']);
                $roomArr['three_price'] = round($room['threepersonprice']);
                $roomArr['four_price'] = round($room['fourpersonprice']);
                $roomArr['is_active'] = $room['status'];
                $roomArr['gallery'] = $hotel['gallery'];
                 $roomArr['image'] = $hotel['gallery'];
                
                $roomArr['single_discount'] = round($room['single_discount']); 
                $roomArr['double_discount'] = round($room['double_discount']); 
                $roomArr['three_discount'] = round($room['three_discount']);
                $roomArr['four_discount'] = round($room['four_discount']);
                
                
                
                $catRooms = Room::where('hotel_id',$data['hotel_id'])->where('is_booked',null)->get();
                $catArr2 = array();
                $catArr = array();
                $newCat = array();
                $category = array();
                
                foreach ($catRooms as $k => $catRoom) 
                {  
                    
                    if(count($category) < 1)
                    {
                        $catArr['room_type'] = $catRoom['name'];
                        $catArr['hotel_id'] = $data['hotel_id'];
                        $catArr['room_number'] = $catRoom['id'];
                        $catArr['single_price'] = $catRoom['onepersonprice'];
                        $catArr['single_discount'] = $catRoom['single_discount'];
                        $catArr['images'] = $hotel['gallery'];;
                        $category[$k] = $catRoom['room_type'];
                        
                        $catArr2[] = $catArr;
                    }
                    else if(count($category) > 0)
                    {
                     
                            if(!in_array($catRoom['room_type'],$category))
                            {
                                $catArr['room_type'] = $catRoom['name'];
                                $catArr['hotel_id'] = $data['hotel_id'];
                                $catArr['room_number'] = $catRoom['id'];
                                $catArr['single_price'] = $catRoom['onepersonprice'];
                                $catArr['single_discount'] = $catRoom['single_discount'];
                                
                                $catArr['images'] = $hotel['gallery'];;
                                $category[$k] = $catRoom['room_type'];
                                
                                $catArr2[] = $catArr;
                            }
                        }
                    }
            
                $category = array();
                $roomArr['category'] = $catArr2;
                
                $roomArr['typeRoom'] = Room::where('name',$room['room_type'])->where('hotel_id',$data['hotel_id'])->select('id')->get();
                $roomArr['hotel_id'] = $hotel['id'];
                $roomArr['hotel_name'] = $hotel['name'];
                $roomArr['latitude'] = $hotel['lat'];
                $roomArr['longitude'] = $hotel['lng'];
                $roomArr['description'] = $hotel['description'];
                $roomArr['is_online'] = $hotel['status'];
                $city = City::find($hotel['city_id']);
                $roomArr['city'] = $city['name'];
                $roomArr['location'] = $hotel['address'];
                $roomArr['rating'] = $hotel['rating'];
   if(isset($room['amenities'])){
               $facilitys = Amenities::whereIn('id',$room['amenities'])
                ->get(['id', 'name', 'icon']);
                
                $roomArr['facility']= $facilitys;    
   }
   else{
       $roomArr['facility']= array();    
   }
    
             
                
            
                
                $response = [
                    'error' => false,
                    'message' => 'Success',
                    'data' => $roomArr,
                ];
            }
        else
            {
                $response = [
                    'error' => false,
                    'message' => 'Room not found',
                    'data' => null,
                ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'data' => null,
            ];
        }
        return $this->responseOkay($response);
    }
    
    
     public function referWallet(Request $request)
    {
     $referl_money = ReferelMoney::where('user_id',$request->id)->where('is_used',0)->sum('price');
     return $this->success('Wallet Balance',$referl_money);
    }


    public function bookRoom(Request $request)
    {
        $response  = array();
        $validator = Validator::make($request->all(),
        [
          'amount' => 'required'
        ]);
        $booking = new Booking;
        $validate = $booking->verifyBooking($validator);
        if($validate) 
        {
            return $this->responseOkay($validate); 
        }
        $data = $request->all();
          if(isset($data['booking_id'])){
                 $booking = Booking::where('booking_id',$data['booking_id'])->first();
               $booking['final_amount'] = $data['amount'];
                $booking['amount'] = $data['final_amount'];
                if(isset($data['wallet']))
                    {
                        $booking['wallet'] = $data['wallet'];
                    }
               if(isset($data['coupon_code']))
                    {
                        $booking['coupon_code'] = $data['coupon_code'];
                         $booking['discount'] = $data['discount'];
                    }
                
                $booking->save();
                $response = [
                        'error' => false,
                        'message' => "Booking Successfully updated",
                        'data' =>  $booking,
                    ];
        }
        else if(isset($data['customer_id']))
        {
            $roomNumbers = explode(',', $data['room_number']);
            $guestTypes = explode(',', $data['list_of_guest']);
            $room = Room::whereIn('id',$roomNumbers)->where('hotel_id',$data['hotel_id'])->where('status',1)->where('is_booked',null)->get();
            $a = 0;
            if($a == 0 )
            {           
                $paymentCustomer = User::find($data['customer_id']);    
                $paymentbooking = new Booking;
                $payment = $paymentbooking->makePayment($data);
                if($data['payment_type'] == 1)
                {
                    $total = 0;
                    $taxammount = 0;
                    $newBooking = new Booking;
                    $newBooking->place_id = $data['hotel_id'];
                    if(!$data['customer_id'])
                    {
                        $newBooking->user_id = $customer['id'];
                    }
                    else
                    {
                        $newBooking->user_id = $data['customer_id'];
                    }
                    $newBooking->booking_start = $data['booking_start_date'];
                    $newBooking->booking_end = $data['booking_end_date'];
                    $newBooking->amount = $data['amount']/100; 
                    $newBooking->number_of_room = $data['no_of_rooms']; 
                    $newBooking->numbber_of_adult = $data['list_of_guest']; 
                    if(isset($data['discount']))
                    {
                        $newBooking->final_amount = ($data['amount'] - $data['discount']);
                    }
                    else
                    {
                        $newBooking->final_amount = $data['amount']/100;
                    }
                    $newBooking->booking_id = 'NSN'.rand (100000 , 999999);
                     if(isset($data['coupon_code']))
                    {
                        $newBooking->coupon_code = $data['coupon_code'];
                    }
                    $newBooking->is_paid  = 0;
                    $newBooking->status  = '2';
                    if($payment['razorpay_order_id'] != null)
                    {
                        $newBooking->razorpay_order_id  = $payment['razorpay_order_id'];
                    }
                    
                    if($data['mobile'])
                    {
    
                        $newBooking['phone_number'] = $data['mobile'];
                    }
                    if(isset($data['wallet'])){
                              $newBooking['wallet'] = $data['wallet'];
                           
                        }
                   
                    $newBooking->save();
                    
                    foreach ($roomNumbers as $k => $roomData) 
                    {
                        $bookedRoom = new BookedRoom;
                        $findRoom = Room::where('id',$roomData)->where('hotel_id',$data['hotel_id'])->first();
                        $bookedRoom['booking_id'] = $newBooking['booking_id'];
                        $bookedRoom['room_number'] = $data['no_of_rooms'];
                        $bookedRoom['guest_type'] = $data['list_of_guest'];
                        
                       
                        $bookedRoom['no_of_days'] = $data['no_of_days'];
                        if($guestTypes[$k] == 4)
                        {
                            $bookedRoom['amount'] = $findRoom['fourpersonprice']/100;
                            $bookedRoom['discount'] = $findRoom['four_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['fourpersonprice'] - $findRoom['four_discount']); 
                        } 
                        if($guestTypes[$k] == 3)
                        {
                            $bookedRoom['amount'] = $findRoom['threepersonprice'];
                            $bookedRoom['discount'] = $findRoom['three_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['threepersonprice'] - $findRoom['three_discount']); 
                        } 
                        if($guestTypes[$k] == 2)
                        {
                            $bookedRoom['amount'] = $findRoom['twopersonprice'];
                            $bookedRoom['discount'] = $findRoom['double_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['twopersonprice'] - $findRoom['double_discount']); 
                        } 
                        if($guestTypes[$k] == 1)
                        {
                            $bookedRoom['amount'] = $findRoom['onepersonprice'];
                            $bookedRoom['discount'] = $findRoom['single_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['onepersonprice'] - $findRoom['single_discount']); 
                        }
                          $bookedRoom['amount'] = $data['amount']/100;
                            $bookedRoom['discount'] = 0;
                            $bookedRoom['final_amount'] = $data['amount']/100;
                        
                        $bookedRoom->save();
    
                    }
                    $response = [
                        'error' => false,
                        'message' => "Booking Successfully",
                        'data' => $newBooking,
                    ];
                }
                if($data['payment_type'] == 0)
                {
                    $total = 0;
                    $taxammount = 0;
                    $newBooking = new Booking;
                    $newBooking->place_id = $data['hotel_id'];
                    $newBooking->user_id = $data['customer_id'];
                    $newBooking->booking_start = $data['booking_start_date'];
                    $newBooking->booking_end = $data['booking_end_date'];
                    $newBooking->amount = $data['amount']/100; 
                     $newBooking->payment_type = 'offline'; 
                         $newBooking->number_of_room = $data['no_of_rooms']; 
                    $newBooking->numbber_of_adult = $data['list_of_guest']; 
                    if(isset($data['discount']))
                    {
                        $newBooking->final_amount = ($data['amount'] - $data['discount']);
                    }
                    else
                    {
                        $newBooking->final_amount = $data['amount']/100;
                    }
                     if(isset($data['coupon_code']))
                    {
                        $newBooking->coupon_code = $data['coupon_code'];
                    }
                    $newBooking->booking_id = 'NSN'.rand (100000 , 999999);
                    
                    $newBooking->is_paid  = 0;
                    $newBooking->status  = '1';
                    if($payment['razorpay_order_id'] != null)
                    {
                        $newBooking->razorpay_order_id  = $payment['razorpay_order_id'];
                    }
                    
                     if($data['mobile'])
                    {
    
                        $newBooking['phone_number'] = $data['mobile'];
                    }
                   
                    $newBooking->save();
                    foreach ($roomNumbers as $k => $roomData) 
                    {
                        $bookedRoom = new BookedRoom;
                        $findRoom = Room::where('id',$roomData)->where('hotel_id',$data['hotel_id'])->first();
                        $bookedRoom['booking_id'] = $newBooking['booking_id'];
                        $bookedRoom['room_number'] =  $data['no_of_rooms'];
                        $bookedRoom['guest_type'] = $data['list_of_guest'];
                        $bookedRoom['no_of_days'] = $data['no_of_days'];
                        if($guestTypes[$k] == 4)
                        {
                            $bookedRoom['amount'] = $findRoom['fourpersonprice'];
                            $bookedRoom['discount'] = $findRoom['four_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['fourpersonprice'] - $findRoom['four_discount']); 
                        } 
                        if($guestTypes[$k] == 3)
                        {
                            $bookedRoom['amount'] = $findRoom['threepersonprice'];
                            $bookedRoom['discount'] = $findRoom['three_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['threepersonprice'] - $findRoom['three_discount']); 
                        } 
                        if($guestTypes[$k] == 2)
                        {
                            $bookedRoom['amount'] = $findRoom['twopersonprice'];
                            $bookedRoom['discount'] = $findRoom['double_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['twopersonprice'] - $findRoom['double_discount']); 
                        } 
                        if($guestTypes[$k] == 1)
                        {
                            $bookedRoom['amount'] = $findRoom['onepersonprice'];
                            $bookedRoom['discount'] = $findRoom['single_discount'];
                            $bookedRoom['final_amount'] = ($findRoom['onepersonprice'] - $findRoom['single_discount']); 
                        }
                          $bookedRoom['amount'] = $data['amount']/100;
                                                      $bookedRoom['discount'] = 0;
                                                      $bookedRoom['final_amount'] = $data['amount']/100;
                        $bookedRoom->save();
    
                        $makebookedRoom = Room::where('id',$roomData)->where('hotel_id',$data['hotel_id'])->first();
                        if( $makebookedRoom){
                               $makebookedRoom['is_booked'] = 1;
                        $makebookedRoom->save(); 
                        }
                     
                    }
                    $hName = Place::find($data['hotel_id']);
                    $customer = User::find($data['customer_id']);
                    // $message = "Your booking has been done for the ".$hName['name']." hotel, for ".$data['no_of_days']." days, and total amount payable is Rs ".$data['amount'] .PHP_EOL." Your booking id is ".$newBooking['booking_id'].". ".PHP_EOL." Thanks for choosing NEW STAY NEST (NSN Hotel)";
                    // $this->sendBookingMsg($message,$number);
                    
                    //$this->sendBookingMsg($phone,$place->name,$start_date,$end_date,$numberofadult,$booking->amount,$place->address,$booking->payment_type);
                    ;
                    // echo $data['mobile'].$hName['name'].$data['booking_start_date'].$data['booking_end_date'].$data['list_of_guest'].$data['amount'].$hName['address'].$data['payment_type'];exit;
            $this->sendBookingMsge($data['mobile'],$hName['name'],$data['booking_start_date'],$data['booking_end_date'],$data['list_of_guest'],$data['amount']/100,$hName['name'],'confirm');
               $mobile_pn = "9958277997";
                      $this->sendBookingMsge($mobile_pn,$hName['name'],$data['booking_start_date'],$data['booking_end_date'],$data['list_of_guest'],$data['amount']/100,$hName['name'],'confirm');
                    $response = [
                        'error' => false,
                        'message' => "Booking Successfully",
                        'data' => $newBooking,
                    ]; 
                }
            }
            else if(count($room) < count($roomNumbers))
            {
                $response = [
                    'error' => true,
                    'message' => 'Only '.count($room).' room found want to continue',
                    'data' => null,
                ];   
            }
            else
            {
                $response = [
                    'error' => true,
                    'message' => 'Room not found',
                    'data' => null,
                ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => "Something went wrong"
            ];            
        }
        return $this->responseOkay($response);
    }
    
    
    
     public function bookingStatusByCustomer(Request $request)
    {
        $response = array();
        $booing = array();
        $curbkngArr = array();  
        $bookdArr = array();
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $curBookings = Booking::where('user_id',$data['customer_id'])->where('status','1')->orderBy('created_at', 'desc')->get();
            if(count($curBookings) > 0)
            {
                foreach ($curBookings as $curBooking) 
                {
                    if(isset($curBooking['numbber_of_adult'])){
                      $adult =   $curBooking['numbber_of_adult'];
                    }
                    else{
                           $adult =   0;
                    }
                    if(isset($curBooking['number_of_room'])){
                        $rooms = $curBooking['number_of_room'];
                    }
                    else{
                         $rooms =0;
                    }
                    
                    $curbkngArr['id'] = $curBooking['id'];
                    $curbkngArr['booking_id'] = $curBooking['booking_id'];
                    $curbkngArr['customer_id'] = $curBooking['user_id'];
                    $curbkngArr['booking_start_date']= $curBooking['booking_start'];
                    $curbkngArr['booking_end_date'] = $curBooking['booking_end'];
                    $checinArr['check_in'] = $curBooking['check_in'];
                    $checinArr['check_out'] = $curBooking['check_out'];
                    $curbkngArr['number_of_adult'] = $adult;
                       $curbkngArr['number_of_room'] = $rooms;
                  
                    $booked = BookedRoom::where('booking_id',$curBooking['booking_id'])->get();
                    foreach($booked as $k=> $bookingroom)
                    {
                        $room = Room::where('id',$bookingroom['room_number'])->where('hotel_id',$curBooking['place_id'])->first();
                        $bookdArr['room_number'] = $bookingroom['room_number'];
                        $bookdArr['guest_type'] = $bookingroom['guest_type'];
                        $bookdArr['no_of_days'] = $bookingroom['no_of_days'];
                        $bookdArr['room_type'] = 'classic';
                        $curbkngArr['booked'][$k] = $bookdArr;
                    }
                    
                    $hotel = Place::find($curBooking['place_id']);
                    
                    $curbkngArr['hotel_name'] = $hotel['name'];
                    $curbkngArr['hotel_id'] = $hotel['id'];
                    $curbkngArr['latitude'] = $hotel['lat'];
                    $curbkngArr['longitude'] = $hotel['lng'];
                    $curbkngArr['location'] = $hotel['address'];
                    $curbkngArr['hotel_phone'] = $hotel['phone_number'];
                    $curbkngArr['amount'] = $curBooking['amount'];
                    $curbkngArr['discount'] = $curBooking['discount'];
                    $curbkngArr['tax'] = $curBooking['tax'];
                    $curbkngArr['final_amount'] = $curBooking['final_amount'];
                    $curbkngArr['payment_mode'] = $curBooking['payment_type'];
                    $curbkngArr['is_paid'] = $curBooking['is_paid'];
                    $curbkngArr['current_status'] = $curBooking['status'];
                    $curbkngArr['rating'] = $curBooking['rating'];
                    $curbkngArr['cancel_reason'] = $curBooking['cancel_reason'];
                    
                    $hPhone = User::find($data['customer_id']);
                     
                    $curbkngArr['name'] = $hPhone['name'];
                    $curbkngArr['phone'] = $hPhone['phone_number'];
                    $booking['current_booking'][] = $curbkngArr;
                    
                }      
                $response = [
                            'error' => false,
                            'message' => 'Sucess',
                            'data' => $booking,
                        ];
            }
            else
            {
                $response = [
                            'error' => true,
                            'message' => 'Data not found',
                            'data' => null,
                        ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data'=>'',
            ];
        }
        return $this->responseOkay($response);
    }
    
     public function checkoutStatusByCustomer(Request $request)
    {
        $booking = array();
        $checkoutArr = array();
        $bookdArr = array();
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $checkOuts= Booking::where('user_id',$data['customer_id'])->where('check_out',1)->orderBy('created_at', 'desc')->where('check_in',1)->get();
            
       
            if(count($checkOuts) > 0)
            {
                foreach ($checkOuts as $checkOut) 
                {
                    $checkoutArr['id'] = $checkOut['id'];
                    $checkoutArr['booking_id'] = $checkOut['booking_id'];
                    $checkoutArr['customer_id'] = $checkOut['user_id'];
                    $checkoutArr['booking_start_date'] = $checkOut['booking_start'];
                    $checkoutArr['booking_end_date'] = $checkOut['booking_end'];
                    $checkoutArr['check_in'] = $checkOut['check_in'];
                    $checkoutArr['check_out'] = $checkOut['check_out'];
                    $checkoutArr['hotel_id'] = $checkOut['place_id'];
                    $checkoutArr['number_of_adult'] = $checkOut['numbber_of_adult'];
                    $booked = BookedRoom::where('booking_id',$checkOut['booking_id'])->get();
                    foreach($booked as $k => $bookingroom)
                    {
                        $room = Room::where('id',$bookingroom['room_number'])->where('hotel_id',$checkOut['place_id'])->first();
                        $bookdArr['room_number'] = $bookingroom['room_number'];
                        $bookdArr['guest_type'] = $bookingroom['guest_type'];
                        $bookdArr['no_of_days'] = $bookingroom['no_of_days'];
                        $bookdArr['room_type'] = 'classic';
                        $checkoutArr['booked'][$k] = $bookdArr;
                    }
                    
                    $hotel = Place::find($checkOut['place_id']);
                  
                    $checkoutArr['hotel_name'] = $hotel['name'];
                    $checkoutArr['hotel_id'] = $hotel['id'];
                    $checkoutArr['latitude'] = $hotel['lat'];
                    $checkoutArr['longitude'] = $hotel['lng'];
                    $checkoutArr['location'] = $hotel['address'];

                    $hPhone = User::find($hotel['user_id']);
                 
                    $checkoutArr['hotel_phone'] = $hPhone['phone_number'];

                    $checkoutArr['room_number'] = $checkOut['id'];
                    $checkoutArr['amount'] = $checkOut['amount'];
                    $checkoutArr['tax'] = $checkOut['tax'];
                    $checkoutArr['discount'] = $checkOut['discount'];
                    $checkoutArr['final_amount'] = $checkOut['final_amount'];
                    $checkoutArr['payment_mode'] = $checkOut['payment_type'];
                    $checkoutArr['is_paid'] = $checkOut['is_paid'];
                    $checkoutArr['current_status'] = $checkOut['status'];
                   
                    $checkoutArr['cancel_reason'] = $checkOut['cancel_reason'];
                    
                    
                    $checkoutArr['name'] = $checkOut['name'];
                    $checkoutArr['phone_number'] = $checkOut['phone_number'];
                    $booking['check_out'][]= $checkoutArr;
                }
                $response = [
                            'error' => false,
                            'message' => 'Sucess',
                            'data' => $booking,
                        ];
            }
            else
            {
                $response = [
                            'error' => true,
                            'message' => 'Data not found',
                            'data' => null,
                        ];   
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data'=>null,
            ];
        }
        return $this->responseOkay($response);
    }
    
    public function checkinStatusByCustomer(Request $request)
    {

        $booking = array();
        $checinArr = array();
        $bookdArr = array();
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $checkIns = Booking::where('user_id',$data['customer_id'])->where('check_in',1)->orderBy('created_at', 'desc')->where('check_out',null)->get();
            if(count($checkIns) >0)
            {
                foreach ($checkIns as $checkIn) 
                {
                    $checinArr['id'] = $checkIn['id'];
                    $checinArr['user_id'] = $checkIn['user_id'];
                    $checinArr['booking_start_date'] = $checkIn['booking_start'];
                    $checinArr['booking_end_date'] = $checkIn['booking_end'];
                    $checinArr['check_in'] = $checkIn['check_in'];
                    $checinArr['check_out'] = $checkIn['check_out'];
                    $booked = BookedRoom::where('booking_id',$checkIn['booking_id'])->get();
                    foreach($booked as $k => $bookingroom)
                    {
                        $room = Room::where('id',$bookingroom['room_number'])->where('hotel_id',$checkIn['hotel_id'])->first();
                        $bookdArr['room_number'] = $bookingroom['room_number'];
                        $bookdArr['guest_type'] = $bookingroom['guest_type'];
                        $bookdArr['no_of_days'] = $bookingroom['no_of_days'];
                        $bookdArr['room_type'] = 'classic';
                        $checinArr['booked'][$k] = $bookdArr;
                    }
                    $hotel = Place::find($checkIn['place_id']);
                
                    $checinArr['hotel_name'] = $hotel['name'];
                    $checinArr['hotel_id'] = $hotel['id'];
                    $checinArr['latitude'] = $hotel['lat'];
                    $checinArr['longitude'] = $hotel['lng'];
                    $checinArr['location'] = $hotel['address'];
                    $hPhone = User::find($hotel['user_id']);
                    $checinArr['hotel_phone'] = $hPhone['phone_number'];
                    $checinArr['room_number'] = $checkIn['id'];
                    $checinArr['amount'] = $checkIn['amount'];
                    $checinArr['discount'] = $checkIn['discount'];
                    $checinArr['final_amount'] = $checkIn['final_amount'];
                    $checinArr['payment_mode'] = $checkIn['payment_mode'];
                    $checinArr['is_paid'] = $checkIn['status'];
                    $checinArr['current_status'] = $checkIn['current_status'];
                    $checinArr['cancel_reason'] = $checkIn['cancel_reason'];
                    $checinArr['custname2'] = $hPhone['name'];
                    $checinArr['phone'] = $hPhone['phone_number'];
                    $booking['check_in'][]= $checinArr;
                }
                
                  
        
                $response = [
                            'error' => false,
                            'message' => 'Sucess',
                            'data' => $booking,
                        ];
            }
            else
            {
                $response = [
                            'error' => true,
                            'message' => 'Data not found',
                            'data' => null,
                        ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data'=>'',
            ];
        }
        return $this->responseOkay($response);
    }
    public function sendBookingMsge($phone,$hotel_name,$start_date,$end_date,$numberofadult,$booking_amount,$place_address,$booking_payment_type) {
        //Multiple mobiles numbers separated by comma
        $mobileNumber = '91'.$phone;
        
        $booking_id= "";
        $from  = Carbon::createFromFormat('Y-m-d', trim($start_date));
        $to = Carbon::createFromFormat('Y-m-d', trim($end_date));

        $number_of_night = $from->diffInDays($to);;
        $number_of_room = 1 ;

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"62d13e16277b4c61454c0bc4\",\n \"mobiles\": \"".$mobileNumber."\",\n  \"Booking ID\": \"".$booking_id."\",\n \"Hotel Name\": \"".$hotel_name."\",\n \"Check-in Date\": \"".$start_date."\",\n  \"Check-out Date\": \"".$end_date."\",\n \"Number of Rooms\": \"".$number_of_room."\",\n  \"Number of Nights\": \"".$number_of_night."\",\n \"Number of Guests\": \"".$numberofadult."\",\n  \"Booking Amount\": \"".$booking_amount."\",\n \"Payment Mode\": \"".$booking_payment_type."\"\n \n}",
          CURLOPT_HTTPHEADER => array(
            "authkey: 365824AD62HRzVQS611a22d5P1",
            "content-type: application/JSON"
          ),
        ));
 
        $response = curl_exec($curl);
       
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
           
            "cURL Error #:" . $err;
        } else {
          
          $response;
          
        }
    }
   
    public function cancleStatusByCustomer(Request $request)
    {
        $booking = array();
        $cancelArr = array();
        $bookdArr = array();
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $cancles = Booking::where('user_id',$data['customer_id'])->orderBy('created_at', 'desc')->where('status','0')->get();
            if(count($cancles) > 0)
            {
                foreach ($cancles as $cancle) 
                {
                    $cancelArr['id'] = $cancle['id'];
                    $cancelArr['booking_id'] = $cancle['booking_id'];
                    $cancelArr['customer_id'] = $cancle['user_id'];
                    $cancelArr['booking_start_date'] = $cancle['booking_start'];
                    $cancelArr['booking_end_date'] = $cancle['booking_end'];
                    $cancelArr['check_in'] = $cancle['check_in'];
                    $cancelArr['check_out'] = $cancle['check_out'];
                    
                    $booked = BookedRoom::where('booking_id',$cancle['booking_id'])->get();
                    //  $room = Room::where('id',$booked['room_number'])->where('hotel_id',$cancle['place_id'])->first();
                    //     $bookdArr['room_number'] = $booked['room_number'];
                    //     $bookdArr['guest_type'] = $booked['guest_type'];
                    //     $bookdArr['no_of_days'] = $booked['no_of_days'];
                    //     $bookdArr['room_type'] = 'classic';
                    //     $cancelArr['booked'][] = $bookdArr;
                     foreach($booked as $k => $bookingroom)
                    {
                        $room = Room::where('id',$bookingroom['room_number'])->where('hotel_id',$cancle['hotel_id'])->first();
                        $bookdArr['room_number'] = $bookingroom['room_number'];
                        $bookdArr['guest_type'] = $bookingroom['guest_type'];
                        $bookdArr['no_of_days'] = $bookingroom['no_of_days'];
                        $bookdArr['room_type'] = 'classic';
                        $checinArr['booked'][$k] = $bookdArr;
                    }
                    
                    $hotel = Place::find($cancle['place_id']);
                   
                    
                    $cancelArr['hotel_name'] = $hotel['name'];
                    $cancelArr['hotel_id'] = $hotel['id'];
                    $cancelArr['latitude'] = $hotel['lat'];
                    $cancelArr['longitude'] = $hotel['lng'];
                    $cancelArr['location'] = $hotel['address'];
                   
                    $hPhone = User::find($hotel['user_id']);
                    
                    $cancelArr['hotel_phone'] = $hPhone['phone_number'];
                    
                    $cancelArr['room_number'] = $cancle['id'];
                    
                    $cancelArr['amount'] = $cancle['amount'];
                    $cancelArr['discount'] = $cancle['discount'];
                    $cancelArr['tax'] = $cancle['tax'];
                    $cancelArr['final_amount'] = $cancle['final_amount'];
                    $cancelArr['payment_mode'] = $cancle['payment_type'];
                    $cancelArr['is_paid'] = $cancle['status'];
                    $cancelArr['current_status'] = $cancle['current_status'];
                    $cancelArr['cancel_reason'] = $cancle['cancel_reason'];
                    $cancelArr['rating'] = $cancle['rating'];
                    $cancelArr['custname'] = $hPhone['name'];
                    $cancelArr['phone'] = $hPhone['phone_number'];
                    $booking['cancel'][]= $cancelArr;
                    
                    
            }
            $response = [
                            'error' => false,
                            'message' => 'Sucess',
                            'data' => $booking,
                        ];
            }
            else
            {
                $response = [
                            'error' => true,
                            'message' => 'Data not found',
                            'data' => null,
                        ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data'=>'',
            ];
        }
        return $this->responseOkay($response);
    }
    
    
    
    
    
    public function makeBookingCancel(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
               'hotel_id' =>'required',
               'customer_id' => 'required',
               'booking_id' => 'required',
               'reason' => 'required',
            ]);
        $data = $request->all();
        if($data)
        {
            $booking = Booking::where('booking_id',$data['booking_id'])->where('place_id',$data['hotel_id'])->where('user_id',$data['customer_id'])->first();
            if($booking)
            {
                $booking['status'] = '0';
                $booking['cancel_reason'] = $data['reason'];
                $booking->save();
                
                $bookedRooms = BookedRoom::where('booking_id',$data['booking_id'])->get();
                foreach ($bookedRooms as $bookedroom) {
                    $room = Room::where('id',$bookedroom['room_number'])->where('hotel_id',$data['hotel_id'])->first();
                    $room->is_booked = null;
                    $room->save();
                }
                $hotel = Place::find($data['hotel_id']);
                $customer = User::find($data['customer_id']);
                
                // $message = "Your booking has been cancelled with reference the booking id ".$data['booking_id']." Dated ".$booking['booking_start_date']." - ".$booking['booking_end_date'].PHP_EOL." Thanks for choosing NEW STAY NEST (NSN Hotel)";
                // $this->sendBookingMsg($message,$customer['phone']);
                
                $response = [
                    'error' => false,
                    'message' => 'Success',
                    'data' => $booking,
                ]; 
            }
            else
            {
                $response = [
                    'error' => true,
                    'message' => 'Given information is not valid',
                    'data' => null,
                ];
            }
            return $this->responseOkay($response);
        }
        else
        {
            $response = [
                    'error' => true,
                    'message' => 'Something went wrong',
                    'data' => null,
                ];
            return $this->responseOkay($response);
        }
    }
    
     public function saveRating(Request $request)
    {
        $response = array();
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required',
            'hotel_id' => 'required',
            'rating' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $rating = new Review;
            $rating['place_id'] = $data['hotel_id'];
            $rating['user_id'] = $data['customer_id'];
            $rating['score'] = $data['rating'];
            if(isset($data['comment']))
            {
                $rating['comment'] = $data['comment'];
            }
            $rating->save();
            
            $response = [
                'error' => false,
                'message' => 'success',
                'data' => $rating,
            ];

        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
            ];
        }    
        return $this->responseOkay($response);
    }


    public function paymentStatus(Request $request)
    {
        $response = array();
  
        $data = $request->all();
     
        $customer = User::find($data['customer_id']);
       
        if($customer)
        {
            //$customer->payment_status = $data['payment_status'];
            //$customer->save();
            
            if($data['payment_status'] != null)
            {
                $booking = Booking::where('booking_id',$data['booking_id'])->first();
                $booking['status']='1';
                $booking['is_paid']= 1;
                $booking['payment_type']= "Online";
                $booking->save();
                
                $bookingRooms = BookedRoom::where('booking_id',$data['booking_id'])->get();
                foreach($bookingRooms as $bookedRoom)
                {
                    $room = Room::where('hotel_id',$booking['hotel_id'])->where('id',$bookedRoom['room_number'])->first();
                    $room['is_booked'] = 1;
                    $room->save();
                }
                $hName = Place::find($booking['place_id']);
                $nod = BookedRoom::where('booking_id',$data['booking_id'])->first();
                if($booking['phone_number'] != null)
                {
                    $number = $booking['phone_number'];    
                }
                else
                {
                    $number = $customer['phone_number'];
                }
                // $message = "Your booking has been done for the ".$hName['name']." hotel, for ".$nod['no_of_days']." days, and total amount payable is Rs ".$booking['final_amount'] .PHP_EOL." Your booking id is ".$booking['booking_id'].". ".PHP_EOL." Thanks for choosing NEW STAY NEST (NSN Hotel)";
                // $this->sendBookingMsg($message,$number);
                
                $response = [
                    'error' => false,
                    'message' => 'Booking Done'
                ];
            }
            else if($data['payment_status'] == null)
            {
                $response = [
                    'error' => true,
                    'message' => 'Booking Not Done'
                ];
            }
            else
            {
                $response = [
                    'error' => true,
                    'message' => 'Something went wrong'
                ];   
            }
        }
        else
        {
            $response = [
                'error' =>true,
                'message'=>'something went wrong'
            ];
        }
        
        return $this->responseOkay($response);
    }
    
    
    
    
    
    public function viewAllBookingDeatils(Request $request)
    {
        $response = array();
        $validator = Validator::make($request->all(),[
            'customer_id' =>'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $bookingArr = array();
            $finalArr = array();
            

            $bookings = Booking::where('customer_id',$data['customer_id'])->get();
            if(count($bookings) > 0)
            {
                foreach ($bookings as $booking) 
                {
                    $bookingArr['id'] = $booking['id'];
                    $bookingArr['booking_id'] = $booking['booking_id'];
                    $bookingArr['customer_id'] = $booking['customer_id'];
                    $bookingArr['booking_start_date'] = $booking['booking_start_date'];
                    $bookingArr['booking_end_date'] = $booking['booking_end_date'];
                    $bookingArr['check_in'] = $booking['check_in'];
                    $bookingArr['check_out'] = $booking['check_out'];
                    $bookdArr = array();
                    $booked = BookedRoom::where('booking_id',$booking['booking_id'])->get();
                    foreach($booked as $k => $bookingroom)
                    {
                        $room = Room::where('room_number',$bookingroom['room_number'])->where('hotel_id',$booking['hotel_id'])->first();
                        $bookdArr['room_number'] = $bookingroom['room_number'];
                        $bookdArr['guest_type'] = $bookingroom['guest_type'];
                        $bookdArr['no_of_days'] = $bookingroom['no_of_days'];
                        $bookdArr['room_type'] = $room['room_type'];
                        $bookingArr['booked'][$k] = $bookdArr;
                    }
                   
                    $hotel = Place::find($booking['hotel_id']);
                    $bookingArr['hotel_name'] = $hotel['name'];
                    $bookingArr['hotel_id'] = $hotel['id'];
                    $bookingArr['latitude'] = $hotel['lat'];
                    $bookingArr['longitude'] = $hotel['longitude'];
                    $bookingArr['location'] = $hotel['location'];
                    $bookingArr['is_online'] = $hotel['is_online'];
                    $hPhone = User::find($hotel['user_id']);
                    $bookingArr['hotel_phone'] = $hPhone['phone'];
                    $bookingArr['room_number'] = $booking['room_number'];
                    $bookingArr['amount'] = $booking['amount'];
                    $bookingArr['discount'] = $booking['discount'];
                    $bookingArr['final_amount'] = $booking['final_amount'];
                    $bookingArr['payment_mode'] = $booking['payment_mode'];
                    $bookingArr['is_paid'] = $booking['is_paid'];
                    $bookingArr['current_status'] = $booking['current_status'];
                    $bookingArr['updated_status'] = $booking['updated_status'];
                    $bookingArr['feedback'] = $booking['feedback'];
                    $bookingArr['custname2'] = $booking['custname2'];
                    $bookingArr['phone'] = $booking['phone'];
                    $bookingArr['cancel_reason'] = $booking['cancel_reason'];
                    $bookingArr['custname2'] = $booking['custname2'];
                    $bookingArr['phone'] = $booking['phone'];
                    $finalArr['details'][] = $bookingArr; 
                }
            
                $response = [
                    'error' => false,
                    'message' => 'success',
                    'data' => $finalArr,
                ];
            }
            else
            {
                $response = [
                    'error' => true,
                    'message' =>'Booking not found',
                    'data' =>null
                    ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data' => null,
            ];
        }
        return $this->responseOkay($response);
    }

   

    public function makeChekin(Request $request)
    {
        $response = array();
        $validator = Validator::make($request->all(),[
            'booking_id' => 'required',
            'id_proof_name' => 'required',
            'id_proof_image' => 'required',
        ]);

        $user = Auth::user();
        $data = $request->all();
        if($data)
        {
            
            if($user['type'] == 5)
            {
                $booking = Booking::where('booking_id',$data['booking_id'])->where('updated_status',null)->where('check_in',null)->first();
                if(isset($booking))
                {
                    $reception = Reception::where('user_id',$user['id'])->first();
                    $currentDate = date('Y-m-d h:i:s');
                    $booking->check_in = 1;
                    $file = $data['id_proof_image'];
                    $path = public_path('/uploads');
                    $fnn = "CI-".rand().'.'.$file->getClientOriginalExtension();
                    $file->move($path, $fnn);
                    $booking->check_in_date = $currentDate;
                    $booking->id_proof_name = $data['id_proof_name'];
                    $booking->id_proof_image = $fnn;
                    $booking->reception_id = $reception['id'];
                    if(isset($data['is_paid']))
                    {
                        $booking->is_paid = $data['is_paid'];
                    }
                    $booking->save();
                    $response = [
                        'error' => false,
                        'message' => 'Check in successfull',
                        'data' => $booking,
                    ];
                }
                else
                {
                    $response = [
                        'error' => true,
                        'message' => 'Unabel to find booking either booking is canceled or check in',
                        'data' => null,
                    ];
                }
            }
            else
            {
                $response = [
                    'error' => true,
                    'message' => 'Login user is not reception',
                    'data' => null,
                ];
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data' => null,
            ];
        }
        return $this->responseOkay($response);
    }

    public function makeChekOut(Request $request)
    {
        $response = array();
        $validator = Validator::make($request->all(),[
            'booking_id' => 'required',
        ]);
        $data = $request->all();
        $user = Auth::user();
        if($user['type'] == 5)
        {    
            $booking = Booking::where('booking_id',$data['booking_id'])->where('check_in',1)->where('updated_status',null)->first();
            if(isset($booking))
            {
                if($booking['is_paid'] == 1)
                {
                    $currentDate = date('Y-m-d h:i:s');
                    $booking->check_out_date = $currentDate;
                    $booking->check_out = 1;
                    $booking->updated_status = 'checkout';
                    if(isset($data['feedback']))
                    {
                        $booking->feedback = $data['feedback'];
                    }
                    if(isset($data['rating']))
                    {
                        $booking->rating = $data['rating'];
                    }
                    $booking->save();
                    $bookedRooms = BookedRoom::where('booking_id',$data['booking_id'])->get();
                    foreach ($bookedRooms as $bookedRoom) {
                        $room = Room::where('room_number',$bookedRoom['room_number'])->where('hotel_id',$booking['hotel_id'])->first();
                        
                        $room->save();
                    }
                    $response = [
                            'error' => false,
                            'message' => 'Checkout Successfull',
                            'data' => $booking,
                        ];
                }
                else
                {
                    $response = [
                            'error' => false,
                            'message' => 'Payment not received',
                            'data' => $booking,
                        ];   
                }
            }
            else
            {
                $response = [
                        'error' => true,
                        'message' => 'Something went wrong',
                        'data' => null,
                    ];
            }
        }
        else
        {
            $response = [
                        'error' => true,
                        'message' => 'Login user is not reception',
                        'data' => null,
                    ];
        }
        return $this->responseOkay($response);
    }
    
    
    
    public function sendBookingMsg($phone,$hotel_name,$start_date,$end_date,$numberofadult,$booking_amount,$place_address,$booking_payment_type) {
        //Multiple mobiles numbers separated by comma
        $mobileNumber = '91'.$phone;
        $booking_id= "";
        $from  = Carbon::createFromFormat('Y-m-d', trim($start_date));
        $to = Carbon::createFromFormat('Y-m-d', trim($end_date));

        $number_of_night = $from->diffInDays($to);;
        $number_of_room = 1 ;

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"611fe916d25e4d68da3d14fc\",\n \"mobiles\": \"".$mobileNumber."\",\n  \"Booking ID\": \"".$booking_id."\",\n \"Hotel Name\": \"".$hotel_name."\",\n \"Check-in Date\": \"".$start_date."\",\n  \"Check-out Date\": \"".$end_date."\",\n \"Number of Rooms\": \"".$number_of_room."\",\n  \"Number of Nights\": \"".$number_of_night."\",\n \"Number of Guests\": \"".$numberofadult."\",\n  \"Booking Amount\": \"".$booking_amount."\",\n \"Payment Mode\": \"".$booking_payment_type."\"\n \n}",
          CURLOPT_HTTPHEADER => array(
            "authkey: 365824AD62HRzVQS611a22d5P1",
            "content-type: application/JSON"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            "cURL Error #:" . $err;
        } else {
          
          $response;
          
        }
    }
    
    public function getallHotels(Request $request)
    {
         $response = array();
        $hotelArr = array();
        $finalArr = array();
        $validator = Validator::make($request->all(),[
            'partner_id' => 'required',
        ]);
        $data = $request->all();
        if($data)
        {
            $hotels = Hotel::where('partner_id',$data['partner_id'])->get();
            if(count($hotels)>0)
            {

                foreach ($hotels as $hotel) 
                {
                    $hotelArr['id'] = $hotel['id'];
                    $hotelArr['hotel_id'] = $hotel['hotel_id'];
                    $hotelArr['partner_id'] = $hotel['partner_id'];
                    $hotelArr['name'] = $hotel['name'];
                    $hotelArr['user_id'] = $hotel['user_id'];
                    $hotelArr['latitude'] = $hotel['latitude'];
                    $hotelArr['longitude'] = $hotel['longitude'];
                    $hotelArr['state'] = $hotel['state'];
                    $hotelArr['city'] = $hotel['city'];
                    $hotelArr['location'] = $hotel['location'];
                    $hotelArr['rating'] = $hotel['rating'];
                    $hotelArr['is_online'] = $hotel['is_online'];
                    $hotelArr['early_check_in'] = $hotel->early_check_in;
                    $hotelArr['late_check_out'] = $hotel->late_check_out;
                    $hotelArr['description'] = $hotel['description'];
                    $user = User::find($hotel['user_id']);
                    $hotelArr['email'] = $user['email'];
                    $hotelArr['phone'] = $user['phone'];
                    $finalArr[] = $hotelArr;
                }
                $response = [
                    'error' => false,
                    'message' => 'success',
                    'data' => $finalArr,
                ];   
            }
            else
            {
                $response = [
                    'error' => false,
                    'message' => 'success',
                    'data' => null,
                ];   
            }
        }
        else
        {
            $response = [
                'error' => true,
                'message' => 'Something went wrong',
                'data' => null,
            ];
        }
        return $this->responseOkay($response);
    }
    
   
    
    public function viewOffer(Request $request)
    {
        $response = array();
        $dataArr = array();
        $offerArr = array();
        $validator = Validator::make($request->all(),[
            'id' => 'required',
        ]);
        $today = date('Y-m-d');
        $data = $request->all();
        if($data)
        {
            $offer = Offer::where('id',$data['id'])->where('offer_start_date','<=',$today)->where('offer_end_date','>=',$today)->first();
            if(isset($offer))
            {
                $offerArr['id'] = $offer['id'];
                $offerArr['offername'] = $offer['offername'];
                $offerArr['offerdesc'] = $offer['offerdesc'];
                $offerArr['image'] = $offer['image'];
                $hotel = Hotel::find($offer['hotel_id']);
                $offerArr['hotel_name'] = $hotel['name'];
                $offerArr['hotel_id'] = $hotel['id'];
                $offerArr['room_id'] = $offer['room_id'];
                $offerArr['state_id'] = $offer['state_id'];
                $city = City::find($offer['city_id']);
                $offerArr['city_id'] = $city['cityname'];
                $offerArr['offer_slug'] = $offer['offer_slug'];
                // $dataArr['offer'][] = $offerArr;   
        
                $response = [
                    'error' =>false,
                    'message' => 'success',
                    'data' => $offerArr,
                ];
            }
            else
            {
                $response = [
                        'error' => true,
                        'message' => 'Offer not found',
                        'data' => null
                    ];
            }
        }
        else
        {
            $response = [
                        'error' => true,
                        'message' => 'Something went wrong',
                        'data' => null
                    ];
        }
        return $this->responseOkay($response);
    }
    
    public function locationSearch(Request $request) {

        $keyword            =   $request->get('keyword');
        $address =str_replace(" ", "+", $keyword); ;
$url = "https://maps.google.com/maps/api/geocode/json?address=Nepal&sensor=false&region=India&key=AIzaSyBhUo6qphOQSK0rjDXr1pU0EdOGHu_CMP0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$response_a = json_decode($response);
if(isset($response_a->results[0]->geometry->location->lat)){
$latitude = $response_a->results[0]->geometry->location->lat; 
Session::put('latitude', $latitude);
}

if(isset($response_a->results[0]->geometry->location->lng)){
    $add = $response_a->results[0]->formatted_address;
$longitude = $response_a->results[0]->geometry->location->lng;
Session::put('longitude',$longitude);
}
 $explode = explode(" ",$keyword);
// $explode = "";

if(isset($latitude) && isset($longitude)){
   $placess = Place::selectRaw("places.id as hotel_id, place_translations.name , places.slug, places.city_id,places.address, '2hotel' as type,( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) )* cos( radians( lng ) - radians(?)) + sin( radians(?) ) * sin( radians( lat ) ) )) AS distance", [$latitude, $longitude, $latitude])->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')
            ->having("distance", "<", '2')
            ->orderBy("distance",'asc')->get();
            
}
            
        $places = DB::table('places')->selectRaw('places.id as hotel_id, place_translations.name , places.slug, places.name, places.address,places.city_id,places.country_id, "2hotel" as type')
                        ->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->where('place_translations.name', 'like', '%' . $keyword . '%');
        // $location = DB::table('places')->selectRaw('places.id as hotel_id, place_translations.name , places.slug, places.city_id, places.address, "3location" as type')
        //                 ->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->Where('places.address', 'like', '%%' . $keyword . '%%');
      
  if(isset($placess)){
  $location = DB::table('places')->selectRaw('"" as hotel_id, "Select Address" AS name , places.slug, places.name, places.address,places.city_id,places.country_id, "3location" as type')
                        ->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->
                        where(function ($q) use ($placess) {
  foreach ($placess as $value) {
    $q->orWhere('places.id',$value->hotel_id);
  } })->orWhere('places.address', 'like', '%%' . $keyword . '%%');    
  }
  else{
      $location = DB::table('places')->selectRaw('places.id as hotel_id, place_translations.name , places.slug, places.city_id,places.city_id,places.country_id, places.address, "3location" as type')
                        ->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->Where('places.address', 'like', '%%' . $keyword . '%%');
  }


  $subcity = DB::table('city_location')->selectRaw('"" as hotel_id, city_location.location_name , cities.slug, cities.id as city_id, "" as address, "1city" as type')->join('cities','cities.id','city_location.city_id');
           
               $citiess = DB::table('cities')->selectRaw('"" as hotel_id, city_translations.name , cities.slug, cities.id as city_id, "" as address, "1city" as type')
                        ->leftJoin('city_translations' , 'city_translations.city_id', 'cities.id')
                        ->where('city_translations.name', 'like', '%' . $keyword . '%')
                        ->orderBy('type', 'asc')
                        ->limit(1)
                        ->first();
                         $citiesssss = DB::table('cities')->selectRaw('"" as hotel_id, city_translations.name , cities.slug,cities.location,cities.country_id, cities.id as city_id, "" as address, "1city" as type')
                        ->leftJoin('city_translations' , 'city_translations.city_id', 'cities.id')
                        ->where('city_translations.name', 'like', '%' . $keyword . '%')
                        ->union($places)
                        ->union($location)
                        ->orderBy('type', 'asc')
                        ->get();

        $cities = DB::table('cities')->selectRaw('"" as hotel_id, city_translations.name, city_location.location_name,city_location.url , cities.slug, cities.id as city_id, "" as address, "1city" as type')
                        ->leftJoin('city_translations' , 'city_translations.city_id', 'cities.id')
                        ->leftJoin('city_location' , 'city_location.city_id', 'cities.id')
                        ->where('city_translations.name', 'like', '%' . $keyword . '%')
                        ->union($places)
                        ->union($location)
                        ->orderBy('type', 'asc')
                        ->limit(30)
                        ->get();                    
                        if(count($cities)<=0){
                            $citie = DB::table('city_location')->select('location_name','city_id','url' )
                            ->where('location_name', 'like', '%' . $keyword . '%')
                            ->limit(30)
                            ->get();
                            return $citie;
                        }





                        if(isset($citiess)){
                            $name = $citiess->name;
                            $names =$citiess->name.' Properties'.count($citiesssss)."  ";
                        $cities[0] = array("hotel_id" => "","name" =>$names,"slug" => "" ,"city_id" => $citiess->city_id ,"address" => "$names" ,"type" => "1city"); 
                        }
 if(isset($placess)  && !$citiess){
       $name = $add;
        $names = count($placess)."  Properties";
                        $cities[0] = array("hotel_id" => "","name" =>$name,"slug" => "" ,"city_id" => "0" ,"address" => "$names" ,"type" => "3location");
 }
                       

return $cities;

    }
   
}
