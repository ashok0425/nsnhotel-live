
@extends('frontend.layouts.template-home')
@push('style')
<style>
 
	.location_title{
		font-weight: bold;
		font-size: 18px;
		line-height: 24px;
		-webkit-letter-spacing: -0.35px;
		-moz-letter-spacing: -0.35px;
		-ms-letter-spacing: -0.35px;
		letter-spacing: -0.35px;
		margin-bottom: 16px;
		margin-top: 0px;
	}
	.splide__list{
	  height: auto!important;
	}
	.modal{
	  z-index: 9999;
	}
	.font_20{
	  font-size: 20px;
	  color:#000;
	}
	.modal-content{
	  width: 100%;
	  padding: 5px;
	}
	.modal{
	  padding: 0px;
	}
	.modal-dialog{
	  margin: 0;
	}
	.cla{
	  text-decoration: none;
		width: calc(100% - 32px);
		font-weight: 600;
		font-size: 16px;
		color: rgb(33, 33, 33);
		line-height: 32px;
		opacity: 1;
		padding: 12px 16px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.search_class{
	  border:0px;
	  outline:none;
	border-radius: 5px;
	border: 1px solid gray;
	}
	.radius_50{
	  border-radius: 50%;
	  min-height: 70px!important;
	  width: 70px!important;
	}
	.nsnrecentstoriesboxcontent h2{
		    margin-top: 120px;
    background: rgba(0,0,0,.5);
    padding: 0.5rem;
    height: 80px;
	}
	.nsnrecentstoriesbox img{
		border-radius: 20px;
	}
	</style>
	
	<link rel="stylesheet" href="{{asset('splide.css')}}">
	
@endpush
@section('main')
@php
	if (session()->has('area_url')) {
	session()->forget('area_url');

}
@endphp

	<div class="nsnnavi bg-white mb-0 d-none d-md-block">
		<div class="container">
			<div id="bannerslider" class="owl-carousel">
				 @foreach($popular_cities as $city)
				<div class="nsnpopulabox mt-5 mt-md-0">
				    @php 
				    $url_city = 'city='.$city->id;
				    @endphp
					<a href="{{route('city-search',strtolower($city->name))}}" class="nav-link">
						<img data-src="{{getImageUrl($city->thumb)}}" alt="{{$city->name}}" class="lazy"  />
						<span>{{ $city->name }}</span>
					</a>
				</div>
				 @endforeach
			</div>
		</div>
	</div>
  <div class="nsnbannerbackground-2 custom-bg-primary pb-5 ">

    <div class="container-fluid mb-2">
		<div class="row">
			<div class="nsnbannerbackground ">
				<div class="nsnbannercontent mt-2 mt-md-0">
					<div class="col-12 mt-5 mt-md-0">
						<h1 class="nsnhttext ">India's Fastest Growing Hotel Chain</h1>
					</div>
				<div class="row mt-4">
					<div class="col-md-6">
						@include('frontend.home.partials.search')
					</div>

					<div class="col-md-6">
            <div class="row">
              <div class="col-md-12 order-md-1 order-2 d-none d-md-block">
                @include('frontend.home.partials.offer',['image2'=>$offer_image2->val,'image3'=>$offer_image3->val,'image4'=>$offer_image4->val])

              </div>
              <div class="col-md-12 order-md-2 order-1 mt-2">
						@include('frontend.home.partials.search_history')
                
              </div>
            </div>

					</div>
					</div>
				</div>
			</div>
		</div>
	</div>


  </div>
{{-- mobile loation  --}}
@include('frontend.home.mobile_location')
  {{-- top rated  --}}
@include('frontend.home.partials.top_rated',['trending_places'=>$trending_places])
  {{-- offer1  --}}
@include('frontend.partials.offer1')
	


@include('frontend.home.partials.nsn_bontique',['banquet_places'=>$banquet_places])

@include('frontend.partials.offer2')





@include('frontend.home.partials.downloadapp')

@include('frontend.home.partials.nsn_resort')

@include('frontend.partials.offer3')

<div id="popular_location" class="d-none d-md-block"></div>

@include('frontend.home.partials.blog')
@include('frontend.partials.offer4')

{{-- testimonial  --}}
@include('frontend.home.partials.testimonail',['testimonials'=>$testimonials])



@stop
@push('scripts')

<script>  
$(document).ready(function(){

  if ($(window).width()>900) {
  $(window).on('load',function(){
    $.ajax({
      url:'{{url('popular_location')}}',
      success:function(res){
        $('#popular_location').html(res);
      }
    })
  })
}

});


</script>

@endpush