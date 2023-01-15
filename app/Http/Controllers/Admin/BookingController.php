<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\City;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class BookingController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            # code...
      if(auth()->user()->isAgent()){
         $bookings = Booking::query()
            ->with('user')
            ->with('place')
            ->leftjoin('places','bookings.place_id','places.id')
            ->where('booked_by',FacadesAuth::user()->id)
            ->orderBy('bookings.created_at', 'desc')->select('bookings.*');
      }
      else{
        $bookings = Booking::query()
            ->with('user')
            ->leftjoin('places','bookings.place_id','places.id')
            ->with('place')
            ->orderBy('bookings.created_at', 'desc')->select('bookings.*');;
      }

      if ($request->keyword) {
        $bookings=$bookings->where('bookings.name','LIKE',"%$request->keyword%")->orwhere('places.slug','LIKE',"%$request->keyword%")->orwhere('bookings.phone_number','LIKE',"%$request->keyword%")->orwhere('bookings.email','LIKE',"%$request->keyword%");
         
        }

        if ($request->from && $request->to) {
          $bookings=$bookings->whereBetween('bookings.created_at',[$request->from,$request->to]);
          }

      

      return FacadesDataTables::of($bookings)
      ->addColumn('name',function($row){
        $html=$row['user']?$row['user']['name']:'';
        return $html;
       
      })
      ->addColumn('phone',function($row){
     
        $html= $row['user']? $row['user']['phone_number']:'';
        return $html;
      
      })

      ->addColumn('email',function($row){
        
        $html= $row['user']? $row['user']['email']:'';
        return $html;
      })

      ->addColumn('hotel',function($row){
        if(isset($row['place'])){
            $html='<a href="'.route('place_detail', $row['place']['slug']).'" target="_blank">'.$row['place']['name'].'</a></td>';
        }else{
        $html='  <><i>Place deleted</i>';  
    }
    return $html;                                          

      })

      
      ->addColumn('payment',function($row){
        $html='';
        if(isset($row->amount)){
        $html.='Amount: '.number_format($row->amount,0);
    }   
if(isset($row->payment_type)){
    $html.=' <br>
     ' .$row->payment_type=='online'?' Mode: '. $row->payment_type:' Mode: Pay at hotel';
}
$html.=' <br>
On: '. Carbon::parse($row->created_at)->format('d/m/Y');
$html.=' <br>
Booking Type: '. $row->booking_type;
$html.=' <br>
Channel: '. $row->booking_from;


        return $html;                                          
    
      })
      ->addColumn('status',function($row){
        $html='';

        if($row->status === \App\Models\Booking::STATUS_PENDING){
        $html='<span class="status-pending">Pending</span>';
      }elseif($row->status === \App\Models\Booking::STATUS_ACTIVE){
        $html='<span class="status-approved">check in</span>';
      }elseif($row->status == 3){
        $html='<span class="status-approved">Check out</span>';
     } else{
        $html=' <span class="status-cancel">Cancel</span>';
      }
      return $html;                                          

      })
      ->addColumn('booking_detail',function($row){
       
        $html='In:'.$row->booking_start.
        '<br> Out:'.$row->booking_end .'<br>
         Room:'.$row->number_of_room .' | Room  Type:'.$row->room_type .' |
         Adult:'.$row->numbber_of_adult.' |
           Child:'.$row->numbber_of_children;
                    

                   
        return $html;                                          

      })
      ->addColumn('action',function($booking){
        if(isset($booking_email)){
       $booking_email = $booking_email;
       
       }
       else{
        $booking_email = "not@mail.com";
       }
        if(isset($booking_phone)){
       $booking_phone = $booking_phone;
       
       }
       else{
        $booking_phone = "0000000000";
       }
       
         if(isset($booking->name)||isset($booking['user']['name'])){
       $booking_name = $booking->name||$booking['user']['name'];
       
       }
       else{
       }

        if(isset($booking['place'])){
            $html='<button type="button" class="btn  btn-xs  btn-sm btn-primary booking_detail"
                    data-id="'.$booking->booking_id.'"
                    data-name="'.$booking['user']['name'].'"
                    data-email="'.$booking_email.'"
                    data-phone="'.$booking_phone.'"
                    data-place="'.$booking['place']['name'].'"
                    data-booking-start=" '.formatDate($booking->booking_start, 'd/m/Y').'"
                    data-booking-end=" '.formatDate($booking->booking_end, 'd/m/Y').'"
                    data-bookingat="'.formatDate($booking->created_at, 'H:i d/m/Y').'"
                    data-status="'.STATUS[$booking->status].'"
                    data-message="'.$booking->message.'"
                    data-adult="'.$booking->numbber_of_adult.'"
                    data-children="'.$booking->numbber_of_children.'"
                    data-type="'.$booking->type.'"
                      data-amount="'.$booking->amount.'"
                    data-room = "'.$booking->number_of_room.'"
                    data-address = "'.$booking['place']['address'].'"
            >Detail
            </button>';
            if($booking->status === \App\Models\Booking::STATUS_PENDING || $booking->status === \App\Models\Booking::STATUS_DEACTIVE){
                $html.='<form class="d-inline" action="'.route('admin_booking_update_status').'" method="GET">
                    
                    <input type="hidden" name="booking_id" value="'.$booking->id.'">
                    <input type="hidden" name="status" value="'.\App\Models\Booking::STATUS_ACTIVE.'">
                    <button type="button" class="btn  btn-xs  btn-sm btn-success booking_approve" data-id="'.$booking->id.'">Checked-in</button>
                </form>';
            }
            if($booking->status === \App\Models\Booking::STATUS_ACTIVE ){
              $html.='<form class="d-inline" action="'.route('admin_booking_update_status').'" method="GET">
                  
                  <input type="hidden" name="booking_id" value="'.$booking->id.'">
                  <input type="hidden" name="status" value="3">
                  <button type="button" class="btn  btn-xs  btn-sm btn-primary booking_approve" data-id="'.$booking->id.'">Checked-out</button>
              </form>';
          }
            if($booking->status === \App\Models\Booking::STATUS_PENDING || $booking->status === \App\Models\Booking::STATUS_ACTIVE){
                $html.='<form class="d-inline" action="'.route('admin_booking_update_status').'" method="GET">
                    <input type="hidden" name="booking_id" value="'.$booking->id.'">
                    <input type="hidden" name="status" value="'.\App\Models\Booking::STATUS_DEACTIVE.'">
                    <button type="button" class="btn  btn-xs  btn-sm btn-danger booking_cancel">Cancel</button>
                </form>';
             }
        
        // $html.='<a class="btn  btn-xs  btn-sm btn-warning " href="'.route('admin_place_book_rooms',$booking->id).'">Edit</a>
        $html.=' <a class="btn  btn-xs  btn-sm btn-warning " href="https://nsnhotels.com/recipt/'.$booking->id.'">Recipt</a>';
      return $html;                                          

        }
        else{
          return '<i class="btn  btn-xs  btn-sm btn-danger ">Place deleted</i>';
          }
        

      })
      ->rawColumns(['customer','hotel','booking_detail','action','status','payment'])
      ->make(true);

    }
      

        return view('admin.booking.booking_list');
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $mm = Booking::find($request->booking_id);
        $mm->fill($data)->save();
if ($request->status==3) {
$this->whatsapp_review('977'.$mm->phone_number, $mm->name);
$this->whatsapp_review('91'.$mm->phone_number, $mm->name);

}
if ($request->status==1) {
  $this->whatsapp_checkin('977'.$mm->phone_number);
  $this->whatsapp_checkin('91'.$mm->phone_number,);
  
  }
if ($request->status==0) {
$this->whatsapp_cancel('977'.$mm->phone_number, $mm->name);
$this->whatsapp_cancel('91'.$mm->phone_number, $mm->name);

  $this->whatsapp_cancel('919958277997', $mm->name);
}
        return back()->with('success', 'Update status success!');
    }


    public function destroy($id)
    {
        Booking::destroy($id);
        return back()->with('success', 'Delete Booking success!');
    }
}