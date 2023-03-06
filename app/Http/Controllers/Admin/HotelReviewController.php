<?php

namespace App\Http\Controllers\Admin;

use App\HotelReview;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class HotelReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($from=null,$to=null,$istop_rated=null)
    {
        if ($istop_rated) {
            $hotels=Place::where('top_rated',1)->pluck('id');

        }elseif(isset($from)){
            $hotels=Place::whereBetween('id',[$from,$to])->pluck('id');

        }else{
            $hotels=Place::query()->pluck('id');

        }
        $feedback=[
            'Great Hotel ,Nice staff',
            'Nice hotel, nice staff. Safely stay',
            'great experience',
            'very nice hotel. Hygenic',
            'Amazing stay, Grromed staff, service quality very nice',
            'its fair to stay there',

        ];
        foreach ($hotels as $key => $value) {
           $rev=new HotelReview;
           $rev->product_id=$value;
           $rev->user_id=8;
           $rev->rating=5;
           $rev->feedback=$feedback[rand(0,5)];
          $rev->save();
       
          $avg=HotelReview::where('product_id',$value)->avg('rating');
          Place::where('id',$value)->update(['rating'=>$avg]);

        }
        return 'success';

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HotelReview  $hotelReview
     * @return \Illuminate\Http\Response
     */
    public function show(HotelReview $hotelReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HotelReview  $hotelReview
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelReview $hotelReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HotelReview  $hotelReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelReview $hotelReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HotelReview  $hotelReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelReview $hotelReview)
    {
        //
    }
}
