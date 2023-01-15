			<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- start manage user dropdown -->
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
								data-close-others="true">
								<img alt="{{Auth::user()->name}}" class="img-circle " src="{{getUserAvatar(user()->avatar)}}" />
								<span class="username username-hide-on-mobile">{{Auth::user()->name}} </span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default animated jello">
								
								<li class="divider"> </li>
								
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										<i class="icon-logout"></i> Log Out </a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					                        @csrf
					                    </form>
								</li>
							</ul>
						</li>
						<!-- end manage user dropdown -->
					</ul>
				</div>