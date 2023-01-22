	<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll">
					 
						<ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true"
							data-slide-speed="200">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							   @if( auth()->user()->isAgent()){
					    <li class="nav-item">
								<a href="{{route('admin_booking_list')}}" class="nav-link nav-toggle">
									<i class="fa fa-calendar"></i>
									<span class="title">Booking</span>
								</a>
							</li>
							<li class="nav-item">
			                    <a href="#" class="nav-link nav-toggle"><i class="fa fa-building-o"></i><span class="title">Hotels</span>
									<span class="arrow"></span></a>
			                    <ul class="sub-menu">
			                    	<li class="nav-item"><a href="{{route('admin_place_list')}}" class="nav-link "><i class="fa fa-map-marker"></i><span class="title">All Hotels</span></a></li>
			                        
			                    </ul>
			                </li>
							 
					    }
					    @else{
							<li class="nav-item start active">
								<a href="{{route('admin_dashboard')}}" class="nav-link">
									<i class="material-icons">dashboard</i>
									<span class="title">Dashboard</span>
									<span class="selected"></span>
								</a>
							</li>
							 <li class="nav-item">
			                    <a href="#" class="nav-link nav-toggle"><i class="fa fa-building-o"></i><span class="title">Hotels</span>
									<span class="arrow"></span></a>
			                    <ul class="sub-menu">
			                    	<li class="nav-item"><a href="{{route('admin_place_list')}}" class="nav-link "><i class="fa fa-map-marker"></i><span class="title">All Hotels</span></a></li>
			                        <li class="nav-item"><a href="{{route('admin_place_type_list')}}" class="nav-link "><i class="fa fa-tags"></i> Hotel Type</a></li>
			                        <li class="nav-item"><a href="{{route('admin_category_list', \App\Models\Category::TYPE_PLACE)}}" class="nav-link "><i class="fa fa-list"></i> Categories</a></li>
			                        <li class="nav-item"><a href="{{route('admin_amenities_list')}}" class="nav-link "><i class="fa fa-wifi"></i> Amenities</a></li>
			                        <li class="nav-item"><a href="{{route('admin_city_list')}}" class="nav-link "><i class="fa fa-building"></i> Cities</a></li>
			                        <li class="nav-item"><a href="{{route('admin_state_list')}}" class="nav-link "><i class="fa fa-globe"></i> States</a></li>
			                            <li class="nav-item"><a href="{{route('admin_faq')}}" class="nav-link "><i class="fa fa-globe"></i> Faq</a></li>
			                             <li class="nav-item"><a href="{{route('admin_location')}}" class="nav-link "><i class="fa fa-globe"></i> Location</a></li>
			                    </ul>
			                </li>
			                
                            <li class="nav-item">
                            	<a href="#" class="nav-link nav-toggle"><i class="fa fa-building-o"></i><span class="title">Manage Meals</span>
									<span class="arrow"></span></a>
                            	<ul class="sub-menu">
							<li class="nav-item"><a href="{{route('admin_meal_TypeList')}}" class="nav-link "><i class="fa fa-map-marker"></i><span class="title">Add Meals Type</span></a></li>
							<li class="nav-item"><a href="{{route('admin_meal_index')}}" class="nav-link "><i class="fa fa-map-marker"></i><span class="title">Meals list</span></a></li>
								 </ul>
							</li>
							<li class="nav-item">
								<a href="{{route('admin_booking_list')}}" class="nav-link nav-toggle">
									<i class="fa fa-calendar"></i>
									<span class="title">Booking</span>
								</a>
							</li>


							<li class="nav-item">
								<a href="{{route('admin_user_list',['latest'=>1])}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Active Users</span>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{route('admin_user_list')}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Users</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('admin_bq_user_list')}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Banquate leads</span>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{route('admin_offer')}}" class="nav-link">
									<i class="fa fa-briefcase"></i>
									<span class="title">Offer</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link nav-toggle">
									<i class="fa fa-newspaper-o"></i>
									<span class="title">Blog</span>
									<span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="{{route('admin_post_list_blog')}}" class="nav-link ">
											<span class="title">All Posts</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('admin_category_list', \App\Models\Category::TYPE_POST)}}" class="nav-link ">
											<span class="title">Categories</span>
										</a>
									</li>
								</ul>
							</li>
							
								<li class="nav-item">
								<a href="{{route('admin_user_sms')}}" class="nav-link">
									<i class="fa fa-clone"></i>
									<span class="title">Message/Communication</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('admin_post_list_page')}}" class="nav-link">
									<i class="fa fa-clone"></i>
									<span class="title">Pages</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('admin_review_list')}}" class="nav-link">
									<i class="fa fa-star-half-o"></i>
									<span class="title"> Reviews</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('admin_testimonial_list')}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Testimonials</span>
								</a>
							</li>
								<li class="nav-item">
								<a href="{{route('admin_corporate_list')}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Corporate</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('admin_refer_index')}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Manage Refer & Earn</span>
								</a>
							</li>
								<li class="nav-item">
								<a href="{{route('admin_tax_list')}}" class="nav-link">
									<i class="fa fa-users"></i>
									<span class="title">Manage Tax</span>
								</a>
							</li>



							<li class="nav-item">
								<a href="" class="nav-link nav-toggle">
									<i class="fa fa-cog"></i>
									<span class="title">Settings</span>
									<span class="arrow"></span>

								</a>
								<ul class="sub-menu">
			                        <li class="nav-item"><a href="{{route('admin_settings')}}" class="nav-link"><i class="fa fa-cogs"></i> General Settings</a></li>
			                        {{--<li class="nav-item"><a href="{{route('admin_settings_language')}}" class="nav-link"><i class="fa fa-language"></i> Languages</a></li>--}}
			                    </ul>
							</li>


							<li class="nav-item">
								<a href="" class="nav-link nav-toggle">
									<i class="fa fa-briefcase"></i>
									<span class="title">miscellaneous</span>
									<span class="arrow"></span>

								</a>
								<ul class="sub-menu">
			                        <li class="nav-item"><a href="{{route('admin_other',['id'=>1])}}" class="nav-link"><i class="fa fa-cogs"></i> Subscriber</a></li>
									<li class="nav-item"><a href="{{route('admin_other',['id'=>3])}}" class="nav-link"><i class="fa fa-cogs"></i> Banquet Contact</a></li>  <li class="nav-item"><a href="{{route('admin_other',['id'=>2])}}" class="nav-link"><i class="fa fa-cogs"></i> Contact List</a></li>
			                    </ul>
							</li>

							@endif
						</ul>
					</div>
				</div>
			</div>