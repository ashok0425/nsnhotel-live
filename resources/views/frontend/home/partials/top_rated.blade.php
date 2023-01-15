<div class="custom-bg-gradient">
	<div class="  container my-4  my-md-0 p-1 p-md-4  custom-bg-white">

		<div id="nsnrecentlyaddedslider" class="owl-carousel mt-5 mt-md-0 ">
			@foreach($trending_places as $place)
			@include('frontend.partials.card1',$place)
		   
		   @endforeach
	   </div>
	</div>
</div>