<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function list()
    {
        
        $user_id = Auth::user()->id;

        $place_id = Place::where('user_id', '=', $user_id)->pluck('id')->toarray();
  
        $bookings = Booking::query()
            ->with('user')
            ->with('place')
            ->whereIn('place_id', $place_id)
            ->orderBy('created_at', 'desc')
            ->get();

//        return $bookings;

        return view('partner.booking.booking_list', [
            'bookings' => $bookings
        ]);
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Booking::find($request->booking_id);
        $model->fill($data)->save();

        return back()->with('success', 'Update status success!');
    }
}