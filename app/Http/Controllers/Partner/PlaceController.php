<?php

namespace App\Http\Controllers\Partner;


use App\Commons\Response;
use App\HotelReview;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Amenities;
use App\Models\Place;
use App\Models\User;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    private $place;
    private $country;
    private $city;
    private $category;
    private $amenities;
    private $response;

    public function __construct(
        Place $place,
        Country $country,
        City $city,
        Category $category,
        Amenities $amenities,
        Response $response
    )
    {
        $this->place = $place;
        $this->country = $country;
        $this->city = $city;
        $this->category = $category;
        $this->amenities = $amenities;
        $this->response = $response;
    }

    public function list(Request $request)
    {
        $param_country_id = $request->country_id;
        $param_city_id = $request->city_id;
        $param_cat_id = $request->category_id;
        $user_id = Auth::user()->id;
        
        $places = $this->place->listByUserId($param_country_id, $param_city_id, $param_cat_id, $user_id);
        $countries = $this->country->getFullList();
        $cities = $this->city->getListByCountry($param_country_id);
        $categories = $this->category->getListAll(Category::TYPE_PLACE);

        return view('partner.place.place_list', [
            'places' => $places,
            'countries' => $countries,
            'country_id' => (int)$param_country_id,
            'cities' => $cities,
            'city_id' => (int)$param_city_id,
            'categories' => $categories,
            'cat_id' => (int)$param_cat_id,
        ]);
    }

    public function createView(Request $request)
    {
        $place = Place::find($request->id);
        $country_id = $place ? $place->country_id : false;

        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        $cities = $this->city->getListByCountry($country_id);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();

        return view('partner.place.place_create', compact('countries', 'cities', 'categories', 'place_types', 'amenities', 'place'));
    }

    public function create(Request $request)
    {
        $request['user_id'] = Auth::id();
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif,webp|max:10000',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'railway_station' => '',
            'bus_stop' => '',
            'airport' => '',
            'other_place' => '',
            'metro_station' => '',
            'shopping_complex' => ''
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = new Place();
        $model->fill($data);

        if ($model->save()) {
            $rev=new HotelReview();
            $rev->product_id=$model->id;
            $rev->user_id=8;
            $rev->rating=5;
            $rev->feedback='';
           $rev->save();
           $avg=HotelReview::where('product_id',$model->id)->avg('rating');
           Place::where('id',$model->id)->update(['rating'=>$avg]);
            return redirect(route('partner_place_list'))->with('success', 'Create place success!');
        }

    }

    public function update(Request $request)
    {
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif,webp|max:10000',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'railway_station' => '',
            'bus_stop' => '',
            'airport' => '',
            'other_place' => '',
            'metro_station' => '',
             'o_u_s_to'  => '',
              'o_u_s_from'   => '',
            'shopping_complex' => ''
        ]);
        $data = $this->validate($request, $rule_factory);
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = Place::find($request->place_id);
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('partner_place_list'))->with('success', 'Update Hotel success!');
        }
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Place::find($request->place_id);
        $model->fill($data)->save();

        return $this->response->formatResponse(200, $model, 'Update Hotel status success!');
    }

    public function destroy($id)
    {
        Place::destroy($id);
        return back()->with('success', 'Delete Hotel success!');
    }
}