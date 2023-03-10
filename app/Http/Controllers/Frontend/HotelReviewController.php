<?php

namespace App\Http\Controllers\Frontend;


use App\Commons\APICode;
use App\Commons\Response;
use App\HotelReview;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Support\Facades\DB;

class HotelReviewController extends Controller
{

    
public function store(Request $request){

try {
    if($request->ajax()){

    
        $review=[];
        $review['user_id']=Auth::user()->id;
        $review['product_id']=$request->product_id;
        $review['rating']=$request->star;
        $review['feedback']=$request->comment;
        // if ($request->hasFile('file')) {
        //     $thumb = $request->file('file');
        //     $thumb_file = $this->uploadImage($thumb, 'review');
        //     $review['image'] = $thumb_file;
        // }

       DB::table('hotel_reviews')->insert($review);
       $avg=HotelReview::where('product_id',$request->product_id)->avg('rating');
       Place::where('id',$request->product_id)->update(['rating'=>$avg]);

return response('success');
    }

} catch (\Throwable $th) {
    // return back()->with('error', 'Something went wrong.Please try again later!');
    return response('failed');

     

}
}


// storing replied comment 
public function replystore(Request $request){
    try {
        if($request->ajax()){

    
            $review=[];
            $review['user_id']=Auth::user()->id;
            $review['comment_id']=$request->comment_id;
            $review['comment']=$request->comment;
           
    
           DB::table('replies')->insert($review);
    
    return response('success');
        }
    } catch (\Throwable $th) {
        return response('failed');

    }
    }

public function loadreview($id){
    return view('frontend.place.review-partial',compact('id'));
}
}