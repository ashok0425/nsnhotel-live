
                <!--Special drop down menu start-->
                <div class="dropdownspmenu">
                    <div class="navbarsp row mx-0 px-5">
                        	@php  $i = 1; @endphp 
                             @foreach($popular_cities as $city)
                             @if($i < 9)
  <div class="dropdown col">
    <button class="dropbtn">{{ $city->name }} 
      <i class="fa fa-caret-down"></i>
    </button>

      @if($city->locations)
	  @php
		$j=0;
	@endphp
    <div class="dropdown-content">
         @foreach($city->locations  as $loc)
		 @php
		$j++;
	@endphp
		@if ($j<=10)
			
      <a href="{{$loc->url}}">{{$loc->location_name}}</a>
	  @endif

      @endforeach
        <a href="{{route('city-search',strtolower($city->name))}}" class="color_primary"> All Of {{$city->name}}</a>
    </div>
    @endif
  </div> 
  @endif
   @php  $i++; @endphp 
@endforeach
  <!--<a href="#">All cities</a>-->
</div>
                </div>
                <!--Special drop down menu end-->