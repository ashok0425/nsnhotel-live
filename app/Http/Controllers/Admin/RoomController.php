<?php
namespace App\Http\Controllers\Admin;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Calendar;
use App\Models\Place;
use App\Models\Room;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    private $place;
    private $amenities;
    private $room;
    private $response;

    public function __construct(
        Place $place,
        Room $room,
        Amenities $amenities,
        Response $response
    ) {
        $this->place     = $place;
        $this->room      = $room;
        $this->amenities = $amenities;
        $this->response  = $response;
    }

    function list(Request $request, $hotel_id) {
        $rooms = $this->room->getListByHotel($hotel_id);

        return view('admin.room.room_list', [

            'rooms'    => $rooms,
            'hotel_id' => $hotel_id,
        ]);

    }

    public function createView(Request $request, $hotel_id)
    {
        $param_country_id = $request->country_id;
        $param_city_id    = $request->city_id;
        $param_cat_id     = $request->category_id;

        $hotels = $this->place->listByFilter($param_country_id, $param_city_id, $param_cat_id);

        $rooms     = Room::find($request->id);
        $amenities = $this->amenities->getListAll();
        return view('admin.room.room_create', [
            'hotel_id'  => $hotel_id,
            'rooms'     => $rooms,
            'amenities' => $amenities,
            'hotels'    => $hotels,
        ]);
    }

    public function create(Request $request, $hotel_id)
    {
        $request['hotel_id'] = $hotel_id;
        // $request['slug']     = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'hotel_id'         => '',
            '%name%'           => '',
            'slug'             => '',
            'hourlyprice'      => '',
            'onepersonprice'   => 'required',
            'twopersonprice'   => 'required_with:threepersonprice',
            'threepersonprice' => 'required_with:fourpersonprice',
            'fourpersonprice'  => '',
            'number'           => '',
            'beds'             => '',
            'size'             => '',
            'adults'           => '',
            'children'         => '',
            'amenities'        => '',
            'gallery'          => '',
            'before_discount_price'  => '',
            'discount_percent'           => '',
            'thumb'            => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('thumb')) {
            $thumb         = $request->file('thumb');
            $thumb_file    = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = new Room();
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('admin_room_list', ['hotel_id' => $hotel_id]))->with('success', 'Create room success!');
        }

    }

    public function update(Request $request, $room_id)
    {
        $request['room_id'] = $room_id;
        $request['slug']    = getSlug($request, 'name');
        $rule_factory       = RuleFactory::make([
            'hotel_id'         => '',
            '%name%'           => '',
            'slug'             => '',
            'hourlyprice'      => '',
            'onepersonprice'   => '',
            'twopersonprice'   => '',
            'threepersonprice' => '',
            'fourpersonprice'  => '',
            'number'           => '',
            'beds'             => '',
            'size'             => '',
            'adults'           => '',
            'children'         => '',
            'amenities'        => '',
            'gallery'          => '',
            'before_discount_price'  => '',
            'discount_percent'           => '',
             'o_u_s_to'           => '',
              'o_u_s_from'           => '',
            'thumb'            => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('thumb')) {
            $thumb         = $request->file('thumb');
            $thumb_file    = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = Room::find($request->room_id);
        $model->fill($data);
        if ($model->save()) {
            return back()->with('success', 'Update room success!');
        }
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Place::find($request->place_id);
        $model->fill($data)->save();

        return $this->response->formatResponse(200, $model, 'Update room status success!');
    }

    public function destroy($id)
    {
        Room::destroy($id);
        return back()->with('success', 'Delete room success!');
    }

    public function add_calendar(Request $request, $type, $room_id)
    {
        try {
              $hotel = Room::find($room_id);
                $hotel->hotel_id;
               
            if ($request->date) {
                $datas = $request->All();
              
                $i = 0;
                foreach ($datas['date'] as $date) {
                    if(isset($request->calender_id[$i])){
                    $model                      =  Calendar::find($request->calender_id[$i]); 
                    }
                    else{
                    $model                      = new Calendar(); 
                    }
                    $model->hotel_id            = $request->hotel_id;
                    $model->room_id             = $room_id;
                    $model->date                = $request->date[$i];
                    $model->price_one_person    = $request->price_one_person[$i];
                    $model->discount_percentage = $request->discount_percentage[$i];
                    $model->price_two_person    = $request->price_two_person[$i];
                    $model->price_three_person  = $request->price_three_person[$i];
                    $model->save();
                    $i++;
                }
            }
            
            if ($type == 0) {
                  $month      = date('m');
                $year      = date('Y');
                $date              = date('Y-m-d');
               $db_data =   Calendar::where('hotel_id',$hotel->hotel_id)->whereMonth('date', '=', $month)->groupBy('date')->get();

                $maxDays           = date('t');
                $currentDayOfMonth = date('j');
                $totaldays         = $maxDays - $currentDayOfMonth;
            } else if ($type == 1) {
                $date      = date('Y-m-d', strtotime(' first day of +1 months'));
                $month      = date('m', strtotime(' first day of +1 months'));
                $year      = date('Y', strtotime(' first day of +1 months'));
                  $db_data =   Calendar::whereYear('date', '=', $year)
              ->whereMonth('date', '=', $month)
              ->get();
                $totaldays = date('t', strtotime('+1 months'));
            } else if ($type == 2) {
                 $month      = date('m', strtotime(' first day of +2 months'));
                $year      = date('Y', strtotime(' first day of +2 months'));
                $date      = date('Y-m-d', strtotime(' first day of +2 months'));
                  $db_data =   Calendar::whereYear('date', '=', $year)
              ->whereMonth('date', '=', $month)
              ->get();
                $totaldays = date('t', strtotime('+2 months'));
            }else if ($type == 3) {
                 $month      = date('m', strtotime(' first day of +3 months'));
                $year      = date('Y', strtotime(' first day of +3 months'));
                $date      = date('Y-m-d', strtotime(' first day of +3 months'));
                  $db_data =   Calendar::whereYear('date', '=', $year)
              ->whereMonth('date', '=', $month)
              ->get();
                $totaldays = date('t', strtotime('+3 months'));
            }else if ($type == 4) {
                 $month      = date('m', strtotime(' first day of +4 months'));
                $year      = date('Y', strtotime(' first day of +4 months'));
                $date      = date('Y-m-d', strtotime(' first day of +4 months'));
                  $db_data =   Calendar::whereYear('date', '=', $year)
              ->whereMonth('date', '=', $month)
              ->get();
                $totaldays = cal_days_in_month(CAL_GREGORIAN,$month, $year);
            }else if ($type == 5) {
                $month      = date('m', strtotime(' first day of +5 months'));
                $year      = date('Y', strtotime(' first day of +5 months'));
                $date      = date('Y-m-d', strtotime(' first day of +5 months'));
                $db_data =   Calendar::whereYear('date', '=', $year)
              ->whereMonth('date', '=', $month)
              ->get();
                $totaldays = cal_days_in_month(CAL_GREGORIAN,$month, $year);
               
            }
        }

         catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        return view('admin.room.add_calendar', [
            'totaldays' => $totaldays,
            'date'      => $date,
            'type'      => $type,
            'room_id'   => $room_id,
            'saved_data'   => $db_data,
            'hotel_id'   => $hotel->hotel_id,
            'room_id'   => $hotel->room_id,
             'month'  =>  $month 
        ]);

    }

}
