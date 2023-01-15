<?php
namespace App\Http\Controllers\Frontend;
use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Category;
use App\Models\City;
use App\Models\city_location;
use App\Models\Corporate;
use App\Models\Country;
use App\Models\Faq;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Room;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscribe;
use App\Models\Visitor;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\ReferelMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $response;

    public function __construct(Response $response){
  
        $this->response = $response;
    }

    public function index(Request $request){
      $ip =  $request->ip();
    // //   dd($_SERVER);
      $visitor = Visitor::where('ip_address',$ip)->first();

      $browser=$_SERVER['HTTP_USER_AGENT'];

    //   dd($visitor);
      if(!$visitor){
          $visitors = new Visitor();
          $visitors->ip_address = $ip;
          $visitors->user_agent = $browser;
          $visitors->save();
      }else{
        $visitor->updated_at=now();
      }
       // SEO Meta
        SEOMeta(setting('app_name'), setting('home_description'), setting('home_keywords'));

        $popular_cities = City::query()
            ->with('country')
            ->withCount(['places' => function ($query) {
                $query->where('status', Place::STATUS_ACTIVE);
            }])
            ->where('status', Country::STATUS_ACTIVE)
            ->whereIn('id', [57,151,154,125,39,95,124,123,139,144,104,65,42,44,48,49,54,55,57,60,65,68])
            ->orderBy('slug','asc')
            ->get();
           
        $categories = [];

        $testimonials = Testimonial::query()
            ->where('status', Testimonial::STATUS_ACTIVE)
            ->paginate(2);

        $trending_places = Place::with(['categories', 'city','place_types', 'avgReview'])
            ->withCount(['reviews', 'wishList'])
            ->where('status', Place::STATUS_ACTIVE)
            ->where('top_rated',1)
            ->orderBy('id', 'desc')
            ->groupBy('places.id')
            ->limit(8)
            ->get();
            
      $banquet_places = Place::with(['categories', 'city','place_types', 'avgReview'])
            ->withCount(['reviews', 'wishList'])
            ->where('status', Place::STATUS_ACTIVE)
            ->where('place_type',json_encode(['42']))
            ->orderBy('id', 'desc')
            ->groupBy('places.id')
            ->limit(8)
            ->get();
            
            $nsn_resort = Place::with(['categories', 'city','place_types', 'avgReview'])
            ->withCount(['reviews', 'wishList'])
            ->where('status', Place::STATUS_ACTIVE)
            ->where('place_type',json_encode(['41']))
            ->orderBy('id', 'desc')
            ->groupBy('places.id')
            ->limit(8)
            ->get();
        $all_amnesties =  $trending_places->pluck('amenities')->toArray();   
             
        $amenities = Amenities::whereIn('id', $all_amnesties)
            ->get(['id', 'name', 'icon']);
 
        $template = setting('template', '01');
        
        $offerdis = '';
       $offertext ='';
     
       $PopofferImg = Setting::where('name', 'pop_offer_image')->first();
       $Popoffertext = Setting::where('name', 'pop_offer_text')->first();
       $PopofferNum = Setting::where('name', 'pop_offer')->first();
             $offer_image2 = Setting::where('name', 'offer_image2')->first();
                $offer_image3 = Setting::where('name', 'offer_image3')->first();
                   $offer_image4 = Setting::where('name', 'offer_image4')->first();
        return view("frontend.home.home_{$template}", [
            'popular_cities' => $popular_cities,
            'categories' => $categories,
            'trending_places' => $trending_places,
            'testimonials' => $testimonials,
            'amenities' => $amenities,
            'offerdis' => $offerdis,
            'offertext' => $offertext,
            'PopofferImg' => $PopofferImg,
            'Popoffertext' => $Popoffertext,
            'banquet_places' => $banquet_places,
            'nsn_resort' => $nsn_resort,
            'offer_image2' => $offer_image2,
            'offer_image3' => $offer_image3,
            'offer_image4' => $offer_image4,
            'PopofferNum' => $PopofferNum
        ]);
    }

    public function refer(){
          $total = ReferelMoney::where('user_id',Auth::id())->sum('price');
          $referl_money = ReferelMoney::where('user_id',Auth::id())->where('is_used',0)->sum('price');
              $used_money = ReferelMoney::where('user_id',Auth::id())->where('is_used',1)->sum('price');
       
        return view('frontend.page.refer', [
            'referl_money' => $referl_money,'used_money' => $used_money,'total' => $total
        ]);
    }

    public function pageContact(){
        
        return view('frontend.page.contact');
    }

    public function corporate(Request $request){
         $new = 'old';
      if($request->mobile){
           $new = new User;
          $new->phone_number = $request->mobile;
          $new->name = $request->company;
          $new->email = $request->email;
          $new->save();
          $user  = User::where('phone_number',$request->mobile)->orderBy('id','desc')->first();
          $add = new Corporate;
          $add->name = $request->name;
          $add->user_id = $user->id;
          $add->address     = $request->address;
          $add->company_name     = $request->city;
          $add->save();
          $new = 'new';
          
       $this->sendBookingMsg($request->mobile,$request->name, $request->address,$request->city);   
      }
        return view('frontend.page.corporate',[
            'new'=>$new,
        ]);
    }
    

    public function sendContact(Request $request){
        return back()->with('success', 'Thanks for contacting us.  Our team will get in touch with you soon!');
    }






    public function subscribe(Request $request){
            
            $model = new Subscribe();
            $model->email=$request->email;
            $model->phone=$request->phone;
            $model->event=$request->event;
            $model->type=$request->type;
            $model->name=$request->name;
            $model->save();
            if($request->type==0){
                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Thanks for for your query. we will get back to you as sson as possible',
                     
                 );
             
             return redirect()->back()->with($notification);
            }
                $message =  "Thanks for subscribing!  NSN hotels";
                     Mail::send('frontend.mail.sub',[
            
                'email' =>  $request->email,
              
               
            ], function ($message) use ($request) {
                  $email = $request->email;
                $message->to($email, "{$email}")->from('noreply@nsnhotels.com')->subject('Thanks for subscribing ' . 'Nsn Hotels ');
            });
                $notification=array(
                    'alert-type'=>'success',
                    'messege'=>'Thanks for subscribing!',
                     
                 );
             
             return redirect()->back()->with($notification);
          
        }
        



    public function copyImage($start,$end){
         $place=Post::where('id','>=',$start)->where('id','<=',$end)->get();
         foreach ($place as $key => $value) {
          $path= $this->uploadImage(getImageUrl($value->thumb),'',true);
          if($path!=null){
            $upPlace=Post::find($value->id);
            $upPlace->thumb=$path;
            $upPlace->save();
          }
          
                 }
    }


// ajax search 

public function locationSearch(Request $request) {
$token=setting('goolge_map_api_key');
    $keyword =   $request->get('keyword');
    $address =str_replace(" ", "+", $keyword); ;
$url = "https://maps.google.com/maps/api/geocode/json?address=india&sensor=false&region=India&key=$token";
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
                    ->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->where('place_translations.name', 'like', '%' . $keyword . '%')
                    ->orwhere('places.slug', 'like', '%' . $keyword . '%');

if(isset($placess)){
$location = DB::table('places')->selectRaw('"" as hotel_id, "Select Address" AS name , places.slug, places.name, places.address,places.city_id,places.country_id, "3location" as type')
                    ->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')->
                    where(function ($q) use ($placess) {
foreach ($placess as $value) {
$q->orWhere('places.id',$value->hotel_id);
} })->orWhere('places.address', 'like', '%' . $keyword . '%');    
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
                        $names =$citiess->name.' &nbsp;   &nbsp;   &nbsp; &nbsp;   <br>     '. count($citiesssss)."  Properties";
                    $cities[0] = array("hotel_id" => "","name" =>$names,"slug" => "" ,"city_id" => $citiess->city_id ,"address" => "$names" ,"type" => "1city"); 
                    }
if(isset($placess)  && !$citiess){
   $name = $add;
    $names = count($placess)."  Properties";
                    $cities[0] = array("hotel_id" => "","name" =>$name,"slug" => "" ,"city_id" => "0" ,"address" => "$names" ,"type" => "3location");
}
                   

return $cities;

}



public function pageSearchListing(Request $request,$slug=null) {
   
    if(isset($request->lat) && isset($request->lng) ){
        $latitude =   $request->lat;
$longitude =   $request->lng;
 }
    if((isset($latitude) && isset($longitude)) && !$request->has('hotel')){
        $city_locations = city_location::where('url',"https://www.nsnhotels.com/search-listing?location_search=&lat=$latitude&lng=$longitude")->first();
$city_name=$city_locations->location_name;
    }elseif($request->get('hotel')!=null){
$city_name=Place::find($request->hotel)->value('slug');
    }else{
        $city_names=City::find($request->city);
       $city_name= $city_names?$city_names->name:$request->search;
    }
  // storing data session for recent search section
  if(isset($request->search_filter)){
  $data[]=[
    'url'=>Request()->fullUrl(),
    'start_date'=>$request->check_in_field,
    'end_date'=>$request->check_out_field,
    'total_guest'=>$request->total_guest,
    'total_room'=>$request->total_room,
    'city_id'=>null,
    'city_name'=>$city_name?$city_name:$request->search,


];
 $sessiondata=session()->get('search_history');
    if(isset($sessiondata)&&count($sessiondata)>0){
       $sessiondata[]=[
        'url'=>Request()->fullUrl(),
        'start_date'=>$request->check_in_field,
        'end_date'=>$request->check_out_field,
        'total_guest'=>$request->total_guest,
        'total_room'=>$request->total_room,
        'city_id'=>null,
        'city_name'=>$city_name?$city_name:$request->search,

    ];
    session()->put('search_history',$sessiondata);
    }else{
        session()->put('search_history',$data);
    }

  }
    $cityname = "";
    $keyword = $request->keyword;
    $filter_category = $request->category;
    $filter_amenities = $request->amenities;
    $filter_place_type = $request->place_type;
    $filter_city = $request->city;
    
    // $cityname = $filter_city;
    
//   dd($request->slug);
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

$places = Place::select('places.*','places.id as place_id')->leftjoin('rooms as po', 'po.hotel_id', '=', 'places.id')->where('places.status', 1)->where('po.onepersonprice', '>', 0);

  

          $faq = [];
if((isset($latitude) && isset($longitude)) && !$request->has('hotel')){
$placess = Place::selectRaw("places.id as hotel_id, place_translations.name , places.slug, places.city_id,places.address, '2hotel' as type,( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) )* cos( radians( lng ) - radians(?)) + sin( radians(?) ) * sin( radians( lat ) ) )) AS distance", [$latitude, $longitude, $latitude])->leftJoin('place_translations' , 'place_translations.place_id', 'places.id')
        ->having("distance", "<", '2')
        ->orderBy("distance",'asc')->get();
  $mm =[];

  foreach ($placess as $value){
 array_push($mm,$value->hotel_id);
}

$places->WhereIn('places.id',$mm);


$latitude1 = (float)$latitude;
$longitude2 = (float)$longitude;
// echo $latitude1; 
// echo $longitude2; die;
$city_locations = city_location::where('url',"https://www.nsnhotels.com/search-listing?location_search=&lat=$latitude&lng=$longitude")->first();
$subcity = $city_locations->location_name;
// echo $city_locations;die;
$cityidname = City::where('id',$city_locations->city_id)->first();
$cityidname = $cityidname->slug;

$cityname = $subcity;
$cityname.=", ";
$cityname.=$cityidname;
        
}
if(isset($filter_hotel)){
    $places->Where('places.id',$filter_hotel);
    
    }
if(isset($request->slug) ){
$city = City::query()
                ->where('slug',$request->slug)
                ->first();
          
                if(isset($city)){
                     $filter_city = $city->id;
                $request->city = $city->id;
                $cityname = $city->name;
                }
                
               
             
}

if ($filter_city) {

        if(is_array($filter_city)){
            
            //  dd($filter_city);
             $places->whereIn('places.city_id', $filter_city); 
             $cityname = City::query()
                ->where('slug', $filter_city)
                ->first();
                    $faq = Faq::where('city_id',$filter_city)->get();
                  
                $cityname = $city->name;
        }
        else if(is_numeric($filter_city)){
           $places->where('places.city_id', $filter_city); 

           $cityname1 = City::query()
                ->where('id', $filter_city)
                ->first();
               
                $cityname = $cityname1->name;
                $faq = Faq::where('city_id',$cityname1->id)->get();
                // $places->orwhere('places.city_id', $cityname1->id);  
        }
        else{
           
            $city = City::query()
                ->where('slug', $filter_city)
                ->first();
                 
                $cityname = $city->name;
            $faq = Faq::where('city_id',$city->id)->get();
             $places->where('places.city_id', $city->id);  
        }
       
    }
    


    if($request->budget){
        $price=explode(',',$request->budget);
$places=$places->whereBetween('onepersonprice',$price);
    }


    $places=$places->paginate(12);
    // if($slug!=null){
    //     $city_id=DB::table('cities')->where('slug',$slug)->value('id');
    //     $places=Place::where('city_id',$city_id)->paginate(12);
    // }

    $template = setting('template', '01');



    return view("frontend.search.search_{$template}", [
        // 'city_locations' => $city_locations,
        // 'url_make' => $url_make,
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
        'faq' =>$faq,
    ]);
}



public function banquote(){
    return view('frontend.banquote');
}

public function subCity(Request $request){
    $keyword = $request->search;

    $cities = DB::table('city_location')->where('city_id',$request->id);

    if (isset($keyword)) {
        $cities->where('location_name', 'LIKE',"%{$keyword}%");
    }

    $cities = $cities->get();
    $data='';
foreach ($cities as $key => $value) {
$data.='<a class="cla" href="'.$value->url.'">'.$value->location_name.'</a><br>';
}
    return $data;
}







public function popularLocation(){
    return view('frontend.home.partials.popular_location');
}


public function sendBookingMsg($phone,$name,$add,$city) {
    //Multiple mobiles numbers separated by comma
    $mobileNumber = '91'.$phone;
    

  

    $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"6251822cfd28550635051635\",\n \"mobiles\": \"".$mobileNumber."\",\n \"Name\": \"".$name."\",\n  \"State\": \"".$city."\",\n \"City\": \"".$city."\",\n \"SPOC Name\": \"".$add."\",\n  \"Office Address\": \"".$add."\",\n \"dlt_template_id\": \"1207164544419203857\" \n}",
      CURLOPT_HTTPHEADER => array(
        "authkey: 365824AD62HRzVQS611a22d5P1",
        "content-type: application/JSON"
      ),
    ));

    $response = curl_exec($curl);
  
    $err = curl_error($curl);

    curl_close($curl);
// dd($response);
    if ($err) {
       
        "cURL Error #:" . $err;
        exit;
    } else {
      
      $response;
      
    }
    //  dd($response);
}


public function ajaxSearch(Request $request){
   


    $price=explode(',',$request->price_filter);
      
    $places="SELECT FORMAT(AVG(hotel_reviews.rating),0) AS avg,places.city_id,places.id,places.status,places.place_type,rooms.onepersonprice FROM places LEFT JOIN hotel_reviews ON hotel_reviews.product_id=places.id  LEFT JOIN rooms ON rooms.hotel_id=places.id GROUP BY places.id  HAVING places.status=1  ";

        
    if(isset($request->price_filter) && $request->price_filter!=null){
        $places .= " AND rooms.onepersonprice BETWEEN $price[0] AND $price[1]  ";
            } 
    
            if(isset($request->star)&&$request->star!=null){
                $star=$request->star;
                $places .= "AND   avg IN ($star) ";
            } 
            if(isset($request->city_id)&&$request->city_id!=null){
                $city_id=$request->city_id;
                $places .= "  AND   places.city_id = $city_id ";


            } 
    
            if(isset($request->place_type) && $request->place_type!=null){
                $place_type=$request->place_type;
                $places .= "AND   place_type LIKE  '%$place_type%'";
            } 
    
$places.=" limit 60";
        $places=DB::select($places);
        $arr=[];
        foreach($places as $value){
            $arr[]=$value->id;
        }
        $amenities = Amenities::query()
        ->get();  

        $placess=Place::whereIn('id',$arr)->get();
      
   
        return view('frontend.search.ajaxsearch',compact('placess','amenities'));
    }
// }


}
