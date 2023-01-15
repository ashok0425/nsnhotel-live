<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\City;
use App\Models\Place;
use App\Models\PartnerWallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->pay)){
            $razorpay = new RazorpayController;
          return $razorpay->payWithRazorpays($request);
          
        }
       
        $count_places = Place::query()
            ->where('user_id', Auth::id())
            ->where('status', City::STATUS_ACTIVE)
            ->count();

        $user_id = Auth::user()->id;
        

        $place_id = Place::where('user_id', '=', $user_id)->pluck('id')->toarray();
           $wallet = PartnerWallet::where('user_id', '=', $user_id)->sum('amount');
          
          

        $count_bookings = Booking::query()
            ->whereIn('place_id', $place_id)
            ->orderBy('created_at', 'desc')
            ->count();

        return view('partner.dashboard.index', [
            'count_places' => $count_places,
            'count_bookings' => $count_bookings,
            'wallet' => $wallet,
        ]);
    }
     public function detail(Request $request)
     
    {
     
     if($request->page == "manpower"){
          return view('partner.dashboard.detail'); 
     }  
      if($request->page == "software"){
          return view('partner.dashboard.software'); 
     } 
      if($request->page == "ads"){
          return view('partner.dashboard.ads'); 
     } 
      if($request->page == "website"){
          return view('partner.dashboard.website'); 
     } 
     
     if($request->page == "revenue"){
          return view('partner.dashboard.revenue'); 
     } 
     if($request->page == "Toiletries"){
          return view('partner.dashboard.toiletries'); 
     } 
       

      
    }
    
      public function wallet(Request $request)
    {
       if(isset($request->amount)){
            $razorpay = new RazorpayController;
          return $razorpay->payWithRazorpayss($request);
          
        }
         $wallet = PartnerWallet::where('user_id', '=', Auth::user()->id)->sum('amount');
$wallets = PartnerWallet::get();
        return view('partner.dashboard.wallet',['wallets' => $wallets,'wallet' => $wallet]);
    }
}