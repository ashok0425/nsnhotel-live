<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Amenities;
use App\Models\Place;
use App\Models\Booking;
use App\Models\Room;
use App\Models\BookedRoom;
use App\Models\User;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;
use Request as  req;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class PlaceController extends Controller
{
    private $place;
    private $user;
    private $country;
    private $city;
    private $category;
    private $amenities;
    private $response;

    public function __construct(
        Place $place,
        User $user,
        Country $country,
        City $city,
        Category $category,
        Amenities $amenities,
        Response $response
    )
    {
        $this->place = $place;
        $this->user = $user;
        $this->country = $country;
        $this->city = $city;
        $this->category = $category;
        $this->amenities = $amenities;
        $this->response = $response;
    }

    public function list(Request $request)
    {
       if($request->ajax()) {
       
        $places=Place::join('place_translations','place_translations.place_id','places.id')->orderBy('id','desc')->select('places.*','place_translations.name as pname');

        if ($request->keyword) {
        $places=$places->where('place_translations.name','LIKE',"%$request->keyword%")->orwhere('address','LIKE',"%$request->keyword%");
         
        }

        if ($request->city) {
          $places=$places->where('city_id',"$request->city");


        }
    
        return FacadesDataTables::of($places)
          
        ->addColumn('thumb',function($row){
            return '<img class="place_list_thumb" src="'.getImageUrl($row->thumb).'" alt="page thumb">
            <button type="button" class="btn  btn-xs btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" id="add_review" data-id="'.$row->id.'">
            Add review
          </button>
          <p class="text-danger">
          '.count($row->reviews).' Reveiws
         </p>
            ';
        })
->addColumn('hotel',function($row){
  $input = preg_replace("/[^a-zA-Z]+/", " ",  $row->slug); 
  $html= '<strong class="py-0 my-0">'.$input.'</strong>';

  return $html;

})

->addColumn('address',function($row){
  $input = preg_replace("/[^a-zA-Z]+/", " ",  $row->slug); 
  $html= '<p class="py-0 my-0">'.$row->address.'</p>';

  return $html;

})

->addColumn('city',function($row){
  $html='';
  if (isset($row->city)) {
    $html.= '<p class="py-0 my-0">'.$row->city->name.'</p>';

  }

  return $html;

})

->addColumn('name',function($row){
  if(isset($row['user'])&&isset($row['user']['name'])){
        return  ' <p class="py-0 my-0">' . $row['user']['name'] . '</p>';
  }
  else{
    return 'N/A';
  }

})

->addColumn('phone',function($row){
  if(isset($row['user'])){
        return  ' <p class="py-0 my-0"><a href="tel:' . $row['user']['phone_number'] . '">' . $row['user']['phone_number'] . '</p>';
  }
  else{
    return 'N/A';
  }

})

->addColumn('email',function($row){
  if(isset($row['user'])){
        return  '<a href="email:' . $row['user']['email'] . '">' . $row['user']['email'] . '</p>';
  }
  else{
    return 'N/A';
  }

})

        ->addColumn('url',function($row){
            $html= '<span onclick="copy(this)" url="https://nsnhotels.com/hotels/'.$row->slug.'">copy url</span>';
            return $html;
        })

        ->editColumn('status',function($row){
          if( auth()->user()->isAgent()){
            $html='<a class="btn  btn-xs btn-warning place_edit" href="'.route('admin_place_add_rooms', $row->id).'">Add Booking</a>';
          }else{
           if($row->status === \App\Models\Place::STATUS_PENDING){
            $html=STATUS[$row->status];

           }
       else{
           $html='<input type="checkbox" class="js-switch place_status" name="status" data-id="'.$row->id.'" '.isChecked(1, $row->status).' />';
           
       }
      }
            return $html;
        })

        ->addColumn('price',function($row){
          if(isset($row['rooms']['onepersonprice'])){
          $html='<p>';
            if ($row['rooms']['onepersonprice']<1000){
              $html.=$row['rooms']['onepersonprice'];

            }
           elseif ($row['rooms']['onepersonprice']>1000
                &&$row['rooms']['onepersonprice']<2500){
                  $tax_amount=($row['rooms']['onepersonprice']*18)/100;
                  $html.=$row['rooms']['onepersonprice']+$tax_amount;
                  
                }else
                {
                $tax_amount=($row['rooms']['onepersonprice']*18)/100;
          $html.=  $row['rooms']['onepersonprice']+$tax_amount;

                }
              $html.='</p>';
            }
        

          else{
          $html=' <p>Pending</p>';
          }
          return $html;
        })

        

        ->addColumn('action',function($row){
          if( auth()->user()->isAgent()){
            $html="N/A";
          }else{
          $html='<a class="btn  btn-xs btn-warning place_edit" href="'.route('admin_place_edit_view', $row->id).'">Edit</a>
          <a class="btn  btn-xs btn-warning place_edit" href="'.route('admin_place_add_rooms', $row->id).'">Add Booking</a>
          <a class="btn  btn-xs btn-primary place_edit" href="'.route('admin_room_list',['hotel_id'=>$row->id]).'">Manage Rooms</a>

          <form action="'.route('admin_place_delete',$row->id).'" method="GET" class="mb-0 pb-0">';

      $html.='<button type="button" class="btn  btn-xs btn-danger  place_delete">Delete</button>
          </form>';
          if($row->status === \App\Models\Place::STATUS_PENDING){
          $html.='<button type="button" class="btn  btn-xs btn-success place_approve" data-id="'.$row->id.'">Approve</button>';
          }
        }
        

            return $html;
        }
        )
        ->rawColumns(['hotel','name','email','phone','address','city','thumb','url','action','status','price','detail'])
        ->make(true);
       }
       
   
       $cities =City::orderBy('slug','asc')->get();
       $categories = $this->category->getListAll(Category::TYPE_PLACE);
//       return $places;
        return view('admin.place.place_list', [
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }
    
    public function customSearch(Request $request)
    {
        if($request->ajax())
        {
             $query = $request->get('query');
              $query = str_replace(" ", "%", $query);
              $places = $this->place->SearchFilter($query); 
             // dd($places);
        return view('admin.place.pagination_data', compact('places'))->render();
        }
    }

    public function createView(Request $request)
    {
        $place = Place::find($request->id);
        $country_id = $place ? $place->country_id : false;
         $users  = User::query()
        ->where('is_partner', '1')
        ->get();
        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        $cities = $this->city->getListByCountry($country_id);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();

        return view('admin.place.place_create', compact('countries', 'cities', 'categories', 'place_types', 'amenities', 'place' ,'users'));
    }

   public function createRoom(Request $request)
    {
        $place = Place::find($request->id);
      
         $room = Room::where('hotel_id',$request->id)->first();
        $Bookings = "";
        $country_id = $place ? $place->country_id : false;
         $users  = User::query()
        ->where('is_partner', '1')
        ->get();
        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        $cities = $this->city->getListByCountry($country_id);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();
        if(isset($request['place_id'])){
         $users = User::where('phone_number',$request->phone)->first() ;
         $partner = User::where('id',$place->user_id)->first() ;

         if($users){
            $person = $users->id; 
         }else{
           $user = new User;
            $user->name = $request->name;
            $user->email = 'admin@mail.com';
            $user->phone_number = $request->phone;
            $user->password = bcrypt(123456);
            $user->save(); 
             $person = $user['id']; 
         }
         
         
              $place = Place::find($request->place_id);
         $newBooking = new Booking;
         $newBooking->user_id = $person;
          $newBooking->place_id = $request['place_id'];
  $newBooking->booking_start = $request['check_in'];
   $newBooking->booking_id = 'NSN'.rand (100000 , 999999);
                    $newBooking->booking_end = $request['check_out'];
                    $newBooking->amount = $request['price']; 
                    $newBooking->number_of_room = $request['rooms']; 
                    $newBooking->numbber_of_adult = $request['adult']; 
                      $newBooking->final_amount = $request['price'];
                        $newBooking->TotalPrice = $request['price'];
                        $newBooking->amount = $request['price'];
                        $newBooking->payment_type = $request['payment_type'];
                       $newBooking->is_paid  = 0;
                        $newBooking->booked_by  = Auth::user()->id;
                    $newBooking->status  = '2';
                     $newBooking['phone_number'] = $request->phone;
                     $newBooking->save();
                        $bookedRoom = new BookedRoom;
                        $bookedRoom['booking_id'] = $newBooking['booking_id'];
                        $bookedRoom['room_number'] = $request['rooms'];
                        $bookedRoom['guest_type'] =$request['adult'];
                          $bookedRoom['amount'] = $request['price'];
                            $bookedRoom['discount'] ='0';
                            $bookedRoom['final_amount'] = $request['price'];
                            $bookedRoom->save();
                            // dd($request['price']);
                $this->sendBookingMsg($request['phone'],$place->name,$request['check_in'],$request['check_out'],$request['adult'],$request['price'],$place->address,$request['payment_type']);
                $phone_number = "9958277997";
$this->sendBookingMsg($phone_number,$place->name,$request['check_in'],$request['check_out'],$request['adult'],$request['price'],$place->address,$request['payment_type']);
                            //  return redirect(route('admin_booking_list'))->with('success', ' Hotel Booking success!');
                             
                      
$checkout=$request['check_out'];
$checkin=$request['check_in'];
$amount=$request['price'];
$address=$place->address;
$name=$place->name;
$adult=$request['adult'];
$no_of_room=$request['rooms'];
$no_of_child=$request['children'];

$from  = Carbon::createFromFormat('Y-m-d', trim($checkin));
$to = Carbon::createFromFormat('Y-m-d', trim($checkout));

$number_of_night = $from->diffInDays($to);
       

$data="Hotel Name:$name, Check-in Date:$checkin 12pm onwards, Check-out Date:$checkout 11 am, Number of Rooms:$no_of_room, Number of Nights:$number_of_night, Number of Adult:-$adult, Number of Children:$no_of_child, Booking Amount:$amount, Hotel Address:$address";
$map='map';
$this->whatsapp_review('977'.$request['phone'], $request->name);
$this->whatsapp_review('91'.$request['phone'], $request->name);


        $this->whatsapp_booking('977'.$request['phone'],$request->name,$newBooking->id,$data);
        $this->whatsapp_booking('91'.$request['phone'],$request->name,$newBooking->id,$data);
        $this->whatsapp_booking('91'.$partner->phone_number,$place->name,$newBooking->id,$data);
        $this->whatsapp_booking('919958277997',$place->name,$newBooking->id,$data); 
        $this->sendBookingMsg($request['phone'],$place->name,$checkin,$checkout,$adult,$amount,$place->address,$newBooking->payment_type);
        return redirect(route('admin_booking_list'))->with('success', ' Hotel Booking Update  successFully!');
                            
        }
 

 
      
        return view('admin.place.room_create', compact('countries', 'cities', 'categories', 'place_types', 'amenities', 'place' ,'users','Bookings','room'));
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
   
    public function create(Request $request)
    { 
       
      try{
        $request['slug'] = getSlug($request, 'name');
         
        $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif,webp|max:10000',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'railway_station' => '',
            'bus_stop' => '',
            'airport' => '',
            'other_place' => '',
            'metro_station' => '',
            'shopping_complex' => ''
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = new Place();
      
        $model->fill($data);
        if ($model->save()) {

            return redirect(route('admin_place_list'))->with('success', 'Create Hotel success!');
        }
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    }

    public function update(Request $request)
    {   
        try{
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif,webp|max:10000',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'railway_station' => '',
            'bus_stop' => '',
            'airport' => '',
            'other_place' => '',
            'metro_station' => '',
               'o_u_s_to'  => '',
              'o_u_s_from'   => '',
               'top_rated'   => '',
            'shopping_complex' => ''
        ]);
        $data = $this->validate($request, $rule_factory);
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }
        $model = Place::find($request->place_id);
        $model->fill($data);
     
        if ($model->save()) {
            return redirect(route('admin_place_list'))->with('success', 'Update Hotel success!');
        }
        }
//catch exception
catch(Exception $e) {
  dd($e->getMessage());exit;
}
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Place::find($request->place_id);
        $model->fill($data)->save();

        return $this->response->formatResponse(200, $model, 'Update Hotel status success!');
    }

    public function destroy($id)
    {
        if($id)
        {
            Place::destroy($id);
            return redirect(route('admin_place_list'))->with('success','Hotel has been deleted successfully!');
        }
        else
        {
           return redirect(route('admin_place_list'))->with('success', 'Something Went Wrong');
        }
    }
     public function sendBookingMsg($phone,$hotel_name,$start_date,$end_date,$numberofadult,$booking_amount,$place_address,$booking_payment_type) {
        //Multiple mobiles numbers separated by comma
       
         $mobileNumber = '91'.$phone;
        $booking_id= "";
        $from  = Carbon::createFromFormat('Y-m-d', trim($start_date));
        $to = Carbon::createFromFormat('Y-m-d', trim($end_date));
$booking_id ="12";
        $number_of_night = $from->diffInDays($to);;
        $number_of_room = 1 ;
        $numberofadult = "-";

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
            dd($err);
        } else {
          
          $response;
        //   dd($response);
          
        }
    }
    
public function storereview(Request $request){

  $review=[];
  $review['user_id']=Auth::user()->id;
  $review['product_id']=$request->product_id;
  $review['rating']=$request->rating;
  $review['feedback']=$request->comment;
  $review['total_rev']=$request->total_rev;
  $review['avg_rev']=$request->avg_rev;

  // if ($request->hasFile('file')) {
  //     $thumb = $request->file('file');
  //     $thumb_file = $this->uploadImage($thumb, 'review');
  //     $review['image'] = $thumb_file;
  // }

 FacadesDB::table('hotel_reviews')->insert($review);
  return redirect()->back()->with('success', ' Hotel Booking Update  successFully!');
}


}