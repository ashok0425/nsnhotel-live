<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Faq;
use App\Models\Location;
use App\Models\Place;
use App\Models\Room;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $country;
    private $city;
    private $response;

    public function __construct(Country $country, City $city, Response $response)
    {
        $this->country = $country;
        $this->city = $city;
        $this->response = $response;
    }

    public function ListPopular($city,$status){
        $citi=City::find($city);
        $citi->popular=$status;
        $citi->save();
        return back()->with('success', 'Updated success!');

            }





    public function list(Request $request)
    {
        $param_country_id = $request->country_id;
        $countries = $this->country->getFullList();
        $name = $request->name;
        $cities = $this->city->getListByCountrys($param_country_id,$name);

//        return $cities;

        return view('admin.city.city_list', [
            'countries' => $countries,
            'cities' => $cities,
            'country_id' => (int)$param_country_id
        ]);
    }

 public function location(Request $request)
    {
        

 $faq = Location::get();

        return view('admin.city.location',['faq'=>$faq]);
    }

 public function faq(Request $request)
    {
        

 $faq = Faq::get();

        return view('admin.city.faq',['faq'=>$faq]);
    }
    
      public function alocation(Request $request)
    {
          $city = City::get();
        //   dd($request);
       if(isset($request->faq)){
           $faq = Location::find($request->faq);
       }
       else{
          $faq = ""; 
       }
        
    // dd($request);
        if(isset($request->location_name) && isset($request->city_id)){
            
            if(isset($request->location_id)){
                  $model = Location::find($request->location_id);
            }
            else{
                 $model = new Location(); 
            }
             
             
               if(isset($request->location_id)){
                $url = $request->url;
            }
            else{
                  $url = "https://www.nsnhotels.com/search-listing?location_search=&lat=".$request->lat."&lng=".$request->lng;
            }
             
            
               $model->url = $url;
                $model->location_name = $request->location_name;
                $model->long_e = $request->lng;
                $model->lat_n = $request->lat;
                 $model->city_id = $request->city_id;
                 $model->save();
                   if(isset($request->location_id)){
                  return back()->with('success', 'edit location success!');
            }
            else{
                  return back()->with('success', 'Add location success!');
            }
                  return back()->with('success', 'Add location success!');
        }
        return view('admin.city.location_add',['faq'=>$faq,'city'=>$city]);
    }
    
    public function add(Request $request)
    {
          $city = City::get();
        //   dd($request);
       if(isset($request->faq)){
           $faq = Faq::find($request->faq);
       }
       else{
          $faq = ""; 
       }
        
    // dd($request);
        if(isset($request->question)  && isset($request->answer) && isset($request->city_id)){
            
            if(isset($request->faq_id)){
                  $model = Faq::find($request->faq_id);
            }
            else{
                 $model = new Faq(); 
            }
             
               $model->question = $request->question;
                $model->city_id = $request->city_id;
                 $model->answer = $request->answer;
                 $model->save();
                   if(isset($request->faq_id)){
                  return back()->with('success', 'edit Faq success!');
            }
            else{
                  return back()->with('success', 'Add Faq success!');
            }
                  return back()->with('success', 'Add Faq success!');
        }
        return view('admin.city.add',['faq'=>$faq,'city'=>$city]);
    }
    public function create(Request $request)
    {
        $request['slug'] = getSlug($request, 'name');

        $rule_factory = RuleFactory::make([
            'country_id' => 'required',
            '%name%' => '',
            'slug' => 'required',
            '%intro%' => '',
            '%description%' => '',
            'currency' => '',
            'language' => '',
            'best_time_to_visit' => '',
            'lat' => '',
            'lng' => '',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'location' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif,webp|max:10000',
            'banner' => 'mimes:jpeg,jpg,png,gif,webp|max:10000'
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $banner_file = $this->uploadImage($banner, '');
            $data['banner'] = $banner_file;
        }

        $model = new City();
        $model->fill($data)->save();

        return back()->with('success', 'Add city success!');
    }

    public function update(Request $request)
    {
        $request['slug'] = getSlug($request, 'name');

        $rule_factory = RuleFactory::make([
            'country_id' => 'required',
            '%name%' => '',
            'slug' => 'required',
            '%intro%' => '',
            '%description%' => '',
            'currency' => '',
            'language' => '',
            'best_time_to_visit' => '',
            'lat' => '',
            'lng' => '',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
             'location' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif,webp|max:10000',
            'banner' => 'mimes:jpeg,jpg,png,gif,webp|max:10000'
        ]);
        $data = $this->validate($request, $rule_factory);

//        return $data;

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $banner_file = $this->uploadImage($banner, '');
            $data['banner'] = $banner_file;
        }

        $model = City::find($request->city_id);
        $model->fill($data);

        if ($model->save()) {
            return back()->with('success', 'Update city success!');
        }
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = City::find($request->city_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update city status success!');
        }
    }

    public function destroy(Request $request, $id)
    {
        City::destroy($id);
        return back()->with('success', 'Delete city success!');
    }
      public function delete(Request $request, $id)
    {
        Faq::destroy($id);
        return back()->with('success', 'Delete Faq success!');
    }
   public function remove(Request $request, $id)
    {
        Location::destroy($id);
        return back()->with('success', 'Delete Location success!');
    }
    public function getListByCountry($country_id)
    {
        $cities = City::query();
        if ($country_id) {
            $cities->where('country_id', $country_id);
        }
        $cities = $cities->orderBy('created_at', 'desc')->get();
        return $cities;
    }


public function ModifyPrice(Request $request){
    $places=Place::join('rooms','rooms.hotel_id','places.id')->where('city_id',$request->city_id)->select('rooms.*')->get();

    foreach ($places as $key => $value) {

        $place=Room::find($value->id);
        $onep=($place->onepersonprice*$request->percent)/100;
        $twop=($place->twopersonprice*$request->percent)/100;
        $threep=($place->threepersonprice*$request->percent)/100;
if ($request->type=='1') {

    $onepersonprice=$onep+$place->onepersonprice;

    $twopersonprice=$twop+$place->twopersonprice;
    $threepersonprice=$threep+$place->threepersonprice;
}else {
    $onepersonprice=$place->onepersonprice-$onep;
    $twopersonprice=$place->twopersonprice-$twop;
    $threepersonprice=$place->threepersonprice-$threep;
}
        $place->onepersonprice=$onepersonprice;
        $place->twopersonprice=$twopersonprice;
        $place->threepersonprice=$threepersonprice;
        $place->save();

    }

    return back()->with('success', 'Price Modify success!');


}


}