<div class="card shadow-sm mt-3 border-0 custom-border-radius-10">
    <div class="card-body">

        @php
        $city_locations=[];
        $city_locations2=[]           
        @endphp
@if (isset($_GET['city']))

        @php
$city=$_GET['city'];
        
        $city_locations=DB::table('city_location')->where('city_id',$city)->limit(3)->get();
        $city_locations2=DB::table('city_location')->where('city_id',$city)->skip(5)->take(20)->get();

    @endphp
@endif


@if ((Request::segment(2)||isset($_GET['city']) &&  !isset($_GET['lat'])))
<div class="">

        @php
        if (isset($_GET['city'])) {
            $city_name=DB::table('cities')->orwhere('id',$_GET['city'])->first();
        }else{
            $city_name=DB::table('cities')->where('slug',Request::segment(2))->first();
        }

    
        $city_locations=DB::table('city_location')->where('city_id',$city_name->id)->limit(3)->get();
        $city_locations2=DB::table('city_location')->where('city_id',$city_name->id)->skip(5)->take(20)->get();

    @endphp
    <p class=" custom-fs-22 border-bottom custom-fw-800 py-2">Where in {{Str::ucfirst( $city_name->slug)}}</p>

    @foreach ($city_locations as $item)
    <p class="my-1">
        <a href="{{$item->url}}" target="_blank" class="custom-text-gray-2 custom-fw-800">
            {{$item->location_name}}

       </a>

    </p>
    @endforeach

    <div class="more_content d-none">
        @foreach ($city_locations2 as $item)
        <p class="my-1">
            <a href="{{$item->url}}" target="_blank" class="custom-text-gray-2 ">
                {{$item->location_name}}

           </a>
        </p>

                            @endforeach
    </div>

    @if (count($city_locations2)>0)
        
    <div style="text-align: center;font-weight:700">

<a href="#" id="load_more" class="text-white"  ><i class="fa fa-plus"></i> Load More</a>
<br>
</div>


@endif
</div>

@endif

<p class=" custom-fs-24 border-bottom custom-fw-800 py-2">Filters </p>

{{-- filter by property type --}}
<div class="type_filter border-bottom py-2">
    <p class=" custom-fs-18 custom-fw-800 mb-1">Property Type</p>
<div class="filter_wrapper">
    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="49" class="place_type_filter">&nbsp; Hotel</label>

    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="42" class="place_type_filter">&nbsp; Banquet</label>

    </div>


    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="41" class="place_type_filter">&nbsp; Resort</label>

    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="43" class="place_type_filter">&nbsp; Homestay</label>

    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="40" class="place_type_filter">&nbsp; Lodge</label>

    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="35" class="place_type_filter">&nbsp; Luxury</label>

    </div>

</div>
</div>
{{-- filter by property type End --}}
		




{{-- filter by Price range type --}}
<div class="type_filter border-bottom py-2">
    <p class=" custom-fs-18  custom-fw-800 mb-1">Price Range</p>
<div class="filter_wrapper">
    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="0,2000" class="price_filter">&nbsp; upto &nbsp; @price_formatter(2000)</label>

    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="2001,5000" class="price_filter">&nbsp;&nbsp; @price_formatter(2001) -  &nbsp; @price_formatter(5000)</label>

    </div>


    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="5001,8000" class="price_filter">&nbsp;&nbsp; @price_formatter(5001) -  &nbsp; @price_formatter(8000)</label>

    </div>


    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="8001,12000" class="price_filter">&nbsp;&nbsp; @price_formatter(8001) -  &nbsp; @price_formatter(12000)</label>

    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" value="12000,50000" class="price_filter">&nbsp;&nbsp; @price_formatter(12000)+</label>

    </div>
</div>
</div>
{{-- filter by property Price range End --}}






{{-- filter by Star rating type --}}
<div class="type_filter border-bottom py-2">
    <p class=" custom-fs-18  custom-fw-800 mb-1">Star Rating</p>
<div class="filter_wrapper">
    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" name="" value="5" class="star_rating">&nbsp; 
        @for ($i =0 ;  $i<5 ; $i++)
        <i class="fas fa-star text-warning"></i>
           
        @endfor
        </label>
    </div>

    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" name="" value="4" class="star_rating">&nbsp; 
        @for ($i =0 ;  $i<4 ; $i++)
        <i class="fas fa-star text-warning"></i>
           
        @endfor
        </label>
    </div>


    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" name="" value="3" class="star_rating">&nbsp; 
        @for ($i =0 ;  $i<3 ; $i++)
        <i class="fas fa-star text-warning"></i>
           
        @endfor
        </label>
    </div>


    <div class="my-1">
        <label  class="text-uppercase custom-fs-14 custom-fw-800 d-flex align-items-center"><input type="checkbox" name="" value="2" class="star_rating">&nbsp; Less then 3 Star
        </label>
    </div>
</div>
</div>
{{-- filter by star rating End --}}



    </div>
</div>
