@extends('frontend.layouts.template-home')

@section('main')
@php
	if (session()->has('area_url')) {
	session()->forget('area_url');

}
@endphp

<link rel="stylesheet" href="{{asset('frontend/css/search/search.css')}}">
{{-- upper search start --}}
<div class="custom-bg-primary py-3">
<div class="container header-search mt-5 mt-md-0 ">
	
@include('frontend.partials.search_top_form')
</div>
</div>
{{-- upper search End --}}
@php
$city=null;
	if(isset($_GET['city']) && $_GET['city']!=null){
		$city=$_GET['city'];
	}
	if(request()->segment(1)=='city'){
		$city=DB::table('cities')->where('slug',request()->segment(2))->value('id');
	}
@endphp
<input type="hidden" value="{{$city}}" id="city_ids">
<div class="nsnsearchmidcontent">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-3 col-md-3">
				{{-- sidebar Filter  --}}
				<div class="sticky-top d-none d-md-block">
					@include('frontend.partials.search_filter')

					</div>
					{{-- sidebar filter End  --}}
				</div>


				<div class="col-12 col-sm-9 col-md-9 datas">
					{{-- <h1 class="nsnsearchhttext text-center py-2"></h1> --}}
					<div class="nsnhotelssorting ">
						<ul class="p-2 d-block custom-bg-white shadow-sm">
							<li class="cutom-fs-20 custom-fw-600 custom-text-primary d-flex align-items-center">
								<span class="custom-fs-24 custom-fw-800 custom-text-primary">{{$places->total()}} </span>
								&nbsp;&nbsp;&nbsp;	properties found  </li>
                {{-- {{$cityname? "in $cityname":''}} --}}
						</ul>
					</div>
					<div class="nsnhotelssearchdata ">
								@if($places->total() && count($places) > 0)
						@foreach($places as $place)
@include('frontend.partials.search_card',['place'=>$place])

							@endforeach    
						@endif
				</div>
				<!-- pagination-->
				{{$places->render('frontend.common.pagination')}}
				<!-- pagination end-->
				

				   @if(isset($faq) && count($faq) > 0 )
				   
	<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
      @php 
      $num_of_items = count($faq);
      $num_count = 0;
      @endphp
      @foreach($faq  as $faqs)
      {
    "@type": "Question",
    "name": "{{$faqs->question}}",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "{{$faqs->answer}}"
    }
  }
  <?php   $num_count = $num_count + 1; 
    if($num_count < $num_of_items)
      echo ","; ?>
  @endforeach
  ]
}
</script>
				   
				<hr>
				<div class=" mt-5">
                    <div class="row">
                        <div class="col">
				        <p class="lead">Frequently asked questions</p>
				        </div>
				        <div class="col text-right">
				        <p>Ask a question <i class="fa fa-pencil" aria-hidden="true"></i></p>
				        </div>
				    </div>
				 
				    @php $i = 1;@endphp
				    @foreach($faq  as $faqs)
				    <button type="button" class="collapsible border-none"><b>{{ $i }})  {{$faqs->question}}</b></button>
<div class="content formatedtxt">
<p class="mt-2" style="font-size: 80%;">@php echo $faqs->answer; @endphp</p>
</div>
  @php $i++;@endphp
@endforeach
@endif
		</div>
			</div>
		</div>
	</div>
</div>

@stop
@push('scripts')

<script>


  // whatsapp hide 
  $(".hideAssistance").hide();
       function Assistance(id){
            $(".hideAssistance").hide();
               var myClasses = document.querySelectorAll('.hideAssistance'),
   i = 0,
    l = myClasses.length;
for (i; i < l; i++) {
    myClasses[i].style.display = 'none';
 }
              $(".showAssistance"+id).show();
       }



	let place_type=$('.place_type_filter:checked').val();
    let star=$('.star_filter:checked').val();
	let price_filter=$('.price_filter:checked').val();
// place filter 
$('.place_type_filter').click(function(){
	place_type=$(this).val();
ajaxSeacrh();

})
$('.price_filter').click(function(){
	price_filter=$(this).val();
ajaxSeacrh();

})
$('.star_rating').click(function(){
	star_rating=$(this).val()
star=star_rating;
ajaxSeacrh();
})

let city=$('#city_ids').val()
function ajaxSeacrh(){
	console.log(city)
	$.ajax({
		url:'{{url('ajax-search')}}',
		dataType:"html",
		data:{star:star,place_type:place_type,price_filter:price_filter,city_id:city},
		success:function(res){
			$('.datas').html(res)
		}
	})
}
</script>
@endpush