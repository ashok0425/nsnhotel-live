<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\MealHotel;
use App\Models\Meal;
use App\Models\Place;
use Auth;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = MealHotel::all();
        $meal = Meal::where(['status' => Meal::STATUS_ACTIVE]) ->orderBy('created_at', 'desc')
            ->get();
      
        $places = Place::where(['user_id' =>Auth::user()->id ]) ->orderBy('created_at', 'desc')->get();
        return view('partner.meal.meal_list', [
            'model' => $model,
            'meal' =>$meal,
            'places' => $places
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rule_factory = RuleFactory::make([
            'hotel_id' => 'required',
            'type'     => 'required',
            'price'    => 'required',
        ]);
        $data  = $this->validate($request, $rule_factory);
         if (! empty($request->meal_id)) {
            $model = MealHotel::findOrFail($request->meal_id);
            $model->fill($data)->save();
            return back()->with('success' , 'Updated Meals successfully!!');
          }else{
          $model = new MealHotel();   
          $model->status = Meal::STATUS_ACTIVE; 
          $model->fill($data)->save();
           return back()->with('success' , 'Added Meals successfully!!');
         }
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);
        $model = MealHotel::find($request->meal_id);
        $model->fill($data);
        if ($model->save()) {
            return  Redirect::back()->with('success' , 'Update Meal status success!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MealHotel::destroy($id);
        return back()->with('success', 'Delete meal type success!');
    }
}
