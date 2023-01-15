@extends('frontend.layouts.template')
@section('main')
<div class="midarea">
			<div class="breadcrumarea contactusarea">
				<img src="https://dev.qtechsoftware.com/wp-content/uploads/2020/12/contact-opt-1.jpg" alt="" class="img-responsive" />
				<div class="mapview">
					<div class="httext">Contact Us</div>
					<ul>
						<li>Contact No: <span><a href="tel:+919958277997" class="active">(+91) 9958277997</a></span></li>
						<li>Mail: <span><a href="mailto:admin@nsnhotels.com">admin@nsnhotels.com</a></span></li>
						<li>Website: <span><a href="https://www.nsnhotels.com" target="_blank">www.nsnhotels.com</a></span></li>
					</ul>
				</div>
			</div>
			<div class="pageindicator">
				<div class="container">
					<ul>
						<li><a href="">Home</a></li>
						<li><a href="" class="active">Contact us</a></li>
					</ul>
				</div>
			</div>
			<div class="contactinner">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-4 col-md-4">
							<div class="contactleft">
								<div class="httext">Our Office</div>
								<img src="https://dev.qtechsoftware.com/wp-content/uploads/2020/12/contact-opt-1.jpg" alt="About Image" class="img-fluid" />
								<p>Nsnhotels provides online Hotel Bookings of hotels and resorts in India. Book budget, cheap and luxury hotels or resorts at cost effective prices. Now check latest offers on Online Hotel Booking at Nsnhotels.com</p>
							</div>
						</div>				
						<div class="col-12 col-sm-8 col-md-8 contactright">
							<div class="httext">Get in touch with us</div>
							<form class="contactform" action="{{route('page_contact_send')}}" method="post">
							    @method('post')
                                @csrf
								<div class="form-group firsticon icons">
									<input type="text" value="" name="" id="first_name" placeholder="First Name *" class="form-control" />
								</div>
								<div class="form-group lasticon icons">
									<input type="text" value="" name="" id="last_name" placeholder="Last Name *" class="form-control" />
								</div>
								<div class="form-group emailicon icons">
									<input type="email" value="" name="email" id="" placeholder="Email *" class="form-control" />
								</div>
								<div class="form-group emailicon icons">
									<input type="tel" value="" name="phone_number" id="" placeholder="Phone Number *" class="form-control" />
								</div>
								<div class="form-group messageicon icons">
									<textarea class="form-control textareainput" name="note" id="note" ></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn contactbtn" id="submit">Send Message</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
@stop