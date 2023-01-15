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
							<li class="nav-item start active">
								<a href="{{route('partner_dashboard')}}" class="nav-link">
									<i class="material-icons">dashboard</i>
									<span class="title">Dashboard</span>
									<span class="selected"></span>
								</a>
							</li>
							 <li class="nav-item">
			                    <a href="#" class="nav-link nav-toggle"><i class="fa fa-building-o"></i><span class="title">Hotels</span>
									<span class="arrow"></span></a>
			                    <ul class="sub-menu">
			                    	<li class="nav-item"><a href="{{route('partner_place_list')}}" class="nav-link "><i class="fa fa-map-marker"></i><span class="title">All Hotels</span></a></li>
			                        <li class="nav-item"><a href="{{route('partner_place_type_list')}}" class="nav-link "><i class="fa fa-tags"></i> Hotel Type</a></li>
			                        <li class="nav-item"><a href="{{route('partner_category_list', \App\Models\Category::TYPE_PLACE)}}" class="nav-link "><i class="fa fa-list"></i> Categories</a></li>
			                        <li class="nav-item"><a href="{{route('partner_amenities_list')}}" class="nav-link "><i class="fa fa-wifi"></i> Amenities</a></li>
			            
			                    </ul>
			                </li>
			                <li class="nav-item">
								<a href="{{route('partner_meal_index')}}" class="nav-link nav-toggle">
									<i class="fa fa-calendar"></i>
									<span class="title">Manage Meals</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('partner_booking_list')}}" class="nav-link nav-toggle">
									<i class="fa fa-calendar"></i>
									<span class="title">Booking</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>