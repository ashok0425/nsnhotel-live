<!DOCTYPE html>
<html lang="en">
<head>
	 @include('partner.layouts.head')
	 <style>
		.btn_wallet{
			border-radius: 20px;
			background: rgb(230, 153, 11);
			margin: 13px 13px 0!important;
			float: left;
			padding: 5px 2rem;
			box-shadow: 0 0 5px rgb(197, 195, 195);
		}
	 </style>
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
					<a href="{{ route('partner_dashboard')}}">
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
				@if(isset($wallet))
					<span href="#" class="btn_wallet d-flex align-items-center">
				<a href="https://nsnhotels.com/partnercp/partner-wallet"><i class="material-icons">card_travel</i> Wallet : {{$wallet}}.00</a>
					</span>
					@endif
					
					
				<!-- end mobile menu -->
				<!-- start header menu -->
				 @include('partner.layouts.top_nav')
			</div>
		</div>
		<!-- end header -->
		<!-- start page container -->
		<div class="page-container">
			<!-- start sidebar menu -->
		
			 @include('partner.layouts.sidebar_menu')
			<!-- end sidebar menu -->
			<!-- start page content -->
			 @yield('main')
			<!-- end page content -->
		</div>
		<!-- end page container -->

	@include('partner.layouts.footer')
</body>
</html>