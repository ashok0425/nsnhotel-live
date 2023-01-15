<?php

namespace App\Http\Controllers\Admin;

use App\HotelReview;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\City;
use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Room;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $count_cities = City::query()
            ->where('status', City::STATUS_ACTIVE)
            ->count();
 $visitor = Visitor::whereDate('created_at', Carbon::today())->count();
        $count_places = Place::query()
            ->count();

        $count_bookings = Booking::query()
            ->count();

        $count_reviews = HotelReview::query()
            ->count();

        $count_users = User::query()
            ->count();
            
        $count_rooms = Room::query()
            ->count();
$users = User::query()
            ->orderBy('id', 'desc')->where('is_partner',0)
            ->paginate(6);
              $place = Place::with('user')
            ->orderBy('id', 'desc')->groupby('user_id')
            ->paginate(5);
              $bookings = Booking::query()
            ->with('user')
            ->with('place')
            ->orderBy('created_at', 'desc')
           ->paginate(8); 
        return view('admin.dashboard.index', [
            'count_cities' => $count_cities,
            'count_places' => $count_places,
            'count_bookings' => $count_bookings,
            'count_reviews' => $count_reviews,
            'count_users' => $count_users,
            'count_rooms' => $count_rooms,
            'users'=>$users,
            'place'=>$place,
            'bookings'=>$bookings,
            'visitor'=>$visitor
        ]);
    }
}