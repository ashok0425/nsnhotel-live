<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meal;
use App\Models\MealHotel;
use App\Models\Tax;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;

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
        $places = Place::orderBy('created_at', 'desc')->get();
         $meal = Meal::where(['status' => Meal::STATUS_ACTIVE]) ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.meal.meal_list', ['model' => $model , 'places' => $places , 'meal' => $meal]);
    }

    public function mealTypeList()
    {
        $model = Meal::all();
        return view('admin.meal.meal_type_list', ['model' => $model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $rule_factory = RuleFactory::make([
                'type' => 'required',
                'status' => ''
        ]);
        $request->status = Meal::STATUS_ACTIVE;
        $data = $this->validate($request ,$rule_factory);
        if (! empty($request->meal_id)) {
            $model = Meal::findOrFail($request->meal_id);
            $model->fill($data)->save();
            return back()->with('success' , 'Updated Meals type successfully!!');
        }else{
          $model = new Meal();    
          $model->fill($data)->save();
           return back()->with('success' , 'Added Meals type successfully!!');
        }
        
    }

     public function createMeal(Request $request)
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

    /**
     * Meals update status
     */
    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);
        $model = Meal::find($request->meal_id);
        $model->fill($data);
        if ($model->save()) {
            return  Redirect::back()->with('success' , 'Update category status success!');
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function taxList()
    {
        $model =  Tax::all();
        return view('admin.meal.tax_list', ['model' => $model]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function taxCreate(Request $request)
    {
         $rule_factory = RuleFactory::make([
                'price_min' => 'required',
                'price_max' => '',
                'percentage' => '',
        ]);
        $data = $this->validate($request ,$rule_factory);
        if (! empty($request->tax_id)) {
            $model = Tax::findOrFail($request->tax_id);
            $model->fill($data)->save();
            return back()->with('success' , 'Updated Tax successfully!!');
        }else{
          $model = new Tax();    
          $model->fill($data)->save();
           return back()->with('success' , 'Added Tax successfully!!');
        }
    }

     public function taxDestroy($id)
    {
        Tax::destroy($id);
        return back()->with('success', 'Delete Tax success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meal::destroy($id);
        return back()->with('success', 'Delete meal type success!');
    }
}
