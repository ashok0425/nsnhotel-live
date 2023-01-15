<!DOCTYPE html>
<html lang="en">
<head>
	 @include('admin.layouts.head')
</head>
<!-- END HEAD -->

<body>
	<div class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
	<div class="page-wrapper">
		<!-- start header -->
		<div class="page-header navbar navbar-fixed-top">
			<div class="page-header-inner ">
				<!-- logo start -->
				<div class="page-logo">
					<a href="{{ route('admin_dashboard')}}">
						<img alt="" src="assets/img/logo.png">
						<span class="logo-default">NSN Hotels</span> </a>
				</div>
				<!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
				
				<!-- start mobile menu -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span></span>
				</a>
				<!-- end mobile menu -->
				<!-- start header menu -->
				 @include('admin.layouts.top_nav')
			</div>
		</div>
		<!-- end header -->
		<!-- start page container -->
		<div class="page-container">
			<!-- start sidebar menu -->
		
			 @include('admin.layouts.sidebar_menu')
			<!-- end sidebar menu -->
			<!-- start page content -->
			 @yield('main')
			<!-- end page content -->
		</div>
		<!-- end page container -->

	@include('admin.layouts.footer')
</body>
</html>