<div class="nsnhotelspeoplessays mt-3 mt-md-0">

	<div class="container">
		<h2 class="pl-0 pl-md-3 font-weight-bold text-dark custom-fs-20 custom-fw-600  mb-3">People Talking About Us</h2>

		<div id="nsnhotelspeoplessays" class="owl-carousel">
			@foreach($testimonials as $item)
			<div class="nsnhotelspeoplessaysbox">
				<div class="nsnhotelsclientname d-flex"><div>
					<div class="user_icon">
						<i class="fas fa-user ">	
						</i>
					</div>
				
			
			</div> 
				<div class="ml-2">
					<p class="mb-0">{{$item->name}}</p>
					"{{$item->content}}"</div>
				</div>
				
			</div>
			@endforeach
		</div>
	</div>
</div>