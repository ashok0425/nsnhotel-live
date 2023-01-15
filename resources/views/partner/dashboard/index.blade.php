@extends('partner.layouts.template')
<style>

    a,
a:active,
a:focus {
  color: #6f6f6f;
  text-decoration: none;
  transition-timing-function: ease-in-out;
  -ms-transition-timing-function: ease-in-out;
  -moz-transition-timing-function: ease-in-out;
  -webkit-transition-timing-function: ease-in-out;
  -o-transition-timing-function: ease-in-out;
  transition-duration: 0.2s;
  -ms-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -webkit-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
}
.fancy-title-view1 {
  float: left;
  width: 100%;
  margin-bottom: 70px;
  text-align: center;
}
.fancy-title-view1 h2 {
  margin-bottom: 8px;
  font-size: 40px;
  font-weight: 700;
  display: block;
}
.fancy-title-view1 p {
  margin-bottom: 0px;
  display: inline-block;
  width: 65%;
}
.fancy-title-view1 i {
  font-size: 22px;
}
.fancy-title-view1-color h2,
.fancy-title-view1-color p {
  color: #ffffff;
}

.light-transparent {
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  opacity: 0.65;
  /*background-color: #000;*/
}
.categories-view1-full {
  padding: 80px 0px 80px 0px;
  margin-top: 0;
  margin-bottom: 0;
  background: url(https://mcdn.wallpapersafari.com/medium/71/52/Ltfo2w.jpg);
  background-attachment: fixed;
  position: relative;
  min-height: 100vh;
}
.categories,
.categories-view1-wrap {
  float: left;
  width: 100%;
}
.categories ul li {
  list-style: none;
}
.categories > ul > li {
  float: none;
  display: inline-block;
  margin: 0px 0px 30px 0px;
  vertical-align: top;
}
.categories-view1-wrap {
  box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.08);
  padding: 30px 50px 30px 95px;
  border-radius: 10px;
  position: relative;
  background-color: #ffffff;
}
.categories-view1 i {
  position: absolute;
  left: 0px;
  top: 50%;
  font-size: 30px;
  color: #fb236a;
  width: 70px;
  height: 70px;
  border-radius: 0 100% 100% 0;
  text-align: center;
  padding-top: 18px;
  margin-top: -36px;
  background-color: #ffffff;
  border: 1px solid #eee;
  border-left: none;
  -webkit-transition: all 0.4s ease-in-out;
  -moz-transition: all 0.4s ease-in-out;
  -ms-transition: all 0.4s ease-in-out;
  -o-transition: all 0.4s ease-in-out;
  transition: all 0.4s ease-in-out;
}
.categories-view1 li:hover i {
  color: #ffffff;
  background-color: #274160;
}
.categories-view1 a {
  display: block;
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 0px;
}
.categories-view1 small {
  font-size: 13px;
  color: #666;
}
.categories-view1 span {
  position: absolute;
  right: 5px;
  top: 8px;
  font-size: 90px;
  font-weight: 500;
  color: #999;
  opacity: 0.07;
  line-height: 1;
}
.main-load-btn {
  float: left;
  width: 100%;
  text-align: center;
  margin: 30px 0px;
}
.main-load-btn a {
  display: inline-block;
  line-height: 1;
  padding: 18px 45px;
  color: #ffffff;
  border-radius: 40px;
  font-size: 16px;
  font-weight: 600;
  -webkit-transition: all 0.4s ease-in-out;
  -moz-transition: all 0.4s ease-in-out;
  -ms-transition: all 0.4s ease-in-out;
  -o-transition: all 0.4s ease-in-out;
  transition: all 0.4s ease-in-out;
  background-color: #fb236a;
}
.main-load-btn a:hover {
  background-color: #274160;
}
.more-spacer {
  float: left;
  width: 100%;
  margin: 10px 0px;
}

</style>
@section('main')
    <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="#">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!-- start widget -->
                    <div class="state-overview">
                        <div class="row">
                            <div class="col-md-6 order-2 order-md-2">
                              <div class="row">
                                 
                            <!-- /.col -->
                            <div class="col-xl-6 col-md-6 col-12 ">
                                <div class="info-box bg-orange">
                                    <span class="info-box-icon push-bottom"><i
                                            class="material-icons">card_travel</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Booking</span>
                                        <span class="info-box-number">{{$count_bookings}}</span>
                                        <div class="progress">
                                            <div class="progress-bar width-40"></div>
                                        </div>
                                       
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-xl-6 col-md-6 col-12 order-3 order-md-1">
                                <div class="info-box bg-purple">
                                    <span class="info-box-icon push-bottom"><i
                                            class="material-icons">phone_in_talk</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Hotels</span>
                                        <span class="info-box-number">{{$count_places}}</span>
                                        <div class="progress">
                                            <div class="progress-bar width-80"></div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                           
                                </div>
                                @php
                                $place=DB::table('places')->where('user_id',Auth::user()->id)->first();
                            @endphp
                            <div class="col-md-12">
                              <img class="place_list_thumb" src="{{getImageUrl($place->thumb)}}" alt="page thumb" style="width:100%;object-fit: cover;height:320px">
                            </div>
                            </div>

                                <div class="col-md-6 order-1 order-md-3">
                            <div class="col-md-12 ">
												<div class="card">
													<div class="m-b-20">
														<div class="doctor-profile">
															<div class="profile-header bg-b-orange">
																<div class="user-name">Premium Member</div>
																	@if(Auth::user()->payment_status != 1)
																<div class="name-center">Unlock lots of services</div>
																@endif
															</div>
															<img src="https://previews.123rf.com/images/dinozzz/dinozzz1210/dinozzz121000049/15791143-golden-premium-label-vector-illustration.jpg" class="user-img" alt="">
															<p style ="color:black;">
															    	@if(Auth::user()->payment_status != 1)
															Onboarding for the premium Member:-
Price-Rs 1500/-+GST
For the Onboard with the portal 
@else
<strong>Thanks for being a Premium Member of NSN Hotels as a Business Partner.  Our team will will get in touch with you Shortly</strong>
@endif
															</p>
															<div>
																<p style ="color:black;">
																

1.	Free Booking Link
2.	Free-10+ Toiletries Kit
3.	Free Display Board outside Property
4.	Free Digital Professional Photography
5.	Free PMS property link for the update of property price for next 6 months
6.  	Free Hotel Promotion in Google
7.	Free Hotel promotion in Social Media
8. 	Free Google Setup of the property  (Optional)
																</p>
															</div>
														
															<div class="profile-userbuttons">
															    	@if(Auth::user()->payment_status != 1)
															    <form method = "get">
															        <input type ="submit" name ="pay" class="btn btn-circle deepPink-bgcolor btn-sm" value ="Click Here to buy">
															    </form>
																@else
																<button class="btn btn-circle deepPink-bgcolor btn-sm" >You are prime member</button>
																@endif
															</div>
														</div>
													</div>
												</div>
											</div>
                            <!-- /.col -->

 
                        </div>
                      </div>







                             

                            <!-- /.col -->
                        </div>
                        <div class="main-section categories-view1-full">
                <span class="light-transparent"></span>
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            
                            <!-- FancyTitle -->
                            <div class="fancy-title-view1 fancy-title-view1-color">
                                <h2>Our Other Services</h2>
                                <p>We also provide lots of services for increase your revenue.</p>
                                <p><strong>In case you need any services you may please connect at 8595857277 or mail at amit@nsnhotels.com</strong></p>
                            </div>
                            <!-- FancyTitle -->

                            <!-- Categories List -->
                            <div class="categories categories-view1">
                                <ul class="row">
                                    <li class="col-md-4" >
                                        <div class="categories-view1-wrap" style ="background-image:url('https://www.martechsystems.net/images/resource/s2.jpg')">
                                            <i class="fas fa-biohazard"></i>
                                            <a href="#">Man Power Supply</a>
                                            <small >Service Option
Housekeeping Manpower
Room Service Manpower
Technical Services Manpower
Laundry Service
 <ul class="nav ">
		<li class="nav-item tab-all"><a class="nav-link show active" href="https://nsnhotels.com/partnercp/detail?page=manpower" >Click here</a></li>   </ul>   
</small>
                                            <span>01</span>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <div class="categories-view1-wrap" >
                                            <i class="fas fa-broadcast-tower"></i>
                                            <a href="#">Hotel Managment Software</a>
                                            <small>Hotel Software


One-stop inventory distribution system
Revenue Management

Manage your F&B business 
                                             <ul class="nav ">
		<li class="nav-item tab-all"><a class="nav-link show active" href="https://nsnhotels.com/partnercp/detail?page=software" >Click here</a></li>   </ul>   
                                            </small>
                                            <span>02</span>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <div class="categories-view1-wrap">
                                            <i class="far fa-chart-bar"></i>
                                            <a href="#">Hotel website</a>
                                            <small>Automate your hotel operations
Booking Engine
Direct bookings from your hotel website
Basic seo
email, sms marketing
 <ul class="nav ">
		<li class="nav-item tab-all"><a class="nav-link show active" href="https://nsnhotels.com/partnercp/detail?page=website" >Click here</a></li>   </ul>   
</small>
                                            <span>03</span>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <div class="categories-view1-wrap">
                                            <i class="fab fa-codepen"></i>
                                            <a href="#">Toiletries Kit</a>
                                            <small>Shampoo, 
                                            Conditioner, 
                                            & Bodywash,
                                            Conditioner
                                            We are selling these essentials these  essential should be there in your  hotel
        <ul class="nav ">
		<li class="nav-item tab-all"><a class="nav-link show active" href="https://nsnhotels.com/partnercp/detail?page=Toiletries" >Click here</a></li>   </ul>                                 
</small>

                                            <span>04</span>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <div class="categories-view1-wrap">
                                            <i class="fas fa-dna"></i>
                                            <a href="#">Increase revenue course</a>
                                            <small>top Hotel Management courses hosted by professionals and experts
                                            A lot of valuable material 
                                             <ul class="nav ">
		<li class="nav-item tab-all"><a class="nav-link show active" href="https://nsnhotels.com/partnercp/detail?page=revenue" >Click here</a></li>   </ul>   
                                            <!--Each course is divided into easy lessons for easier distribution of knowledge-->
                                            </small>
                                            <span>05</span>
                                        </div>
                                    </li>
                                    <li class="col-md-4">
                                        <div class="categories-view1-wrap">
                                            <i class="fas fa-layer-group"></i>
                                            <a href="#">Marketing and digital marketing</a>
                                            <small>Facebook ads 
                                            Youtube ads
                                            instagram ads 
                                            google marketing  and different website 
                                             <ul class="nav ">
		<li class="nav-item tab-all"><a class="nav-link show active" href="https://nsnhotels.com/partnercp/detail?page=ads" >Click here</a></li>   </ul>   
                                            </small>
                                            <span>06</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Categories List -->

                            <div class="more-spacer"></div>
                            <!--<div class="main-load-btn"> <a href="#">Browse All Categories</a> </div>-->

                        </div>

                    </div>
                </div>
            </div>
                    </div>
                    <!-- end widget --> 
                </div>
    </div>
@stop
