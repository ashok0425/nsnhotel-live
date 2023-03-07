<?php

namespace App\Http\Controllers\Frontend;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Place;
use App\User;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function bookingPage(Request $request){
        if(!Auth::check()){
            return redirect()->route('user_login');
        }
        $hotel=Place::find($request->place_id);
        return view('frontend.booking_page',compact("request",'hotel'));
    }

     public function cancelBooking($id) {
         $model = Booking::findOrfail($id);
         $mm = Booking::where('id',$id)->first();
        //  dd($mm);
        $email = $mm->email;
        $name = $mm->name;
        $message =  "Your hotel booking  Cancel successfully";
        //              Mail::send('frontend.mail.cancal_booking', [
        //         'name' => $mm->name,
        //         'email' =>  $mm->email,
        //         'phone' => $mm->phone_number,
        //         'booking_at' => $mm->created_at
        //     ], function ($message) use ($mm) {
        //           $email = $mm->email;
        // $name = $mm->name;
        //         $message->to($email, "{$name}")->subject('Booking from ' . $name);
        //     });
         $model->status = '0';
         $model->save();

       return  $this->whatsapp_cancel('977'.$mm->phone_number, $mm->name?$mm->name:"Customer");
         $this->whatsapp_cancel('919958277997', $mm->name);
         return back()->with('success', 'Hotel Cancel successfully!');
     }


    public function loadDetail($id){
        $booking = Booking::query()
        ->with('user')
        ->with('place')
        ->where('user_id', Auth::id())
        ->where('id',$id)
        ->orderBy('created_at', 'desc')
        ->first();

        return view('frontend.user.bookingdetail',compact('booking'));
    }




    public function recipt(Request $request)
    {
            $Bookings = Booking::with('user','place')->where('id',$request->id)->first();
            if(!$Bookings){
abort(404);
            }
        return view('frontend.place.modal_booking_detail', compact('Bookings'));
    }
}