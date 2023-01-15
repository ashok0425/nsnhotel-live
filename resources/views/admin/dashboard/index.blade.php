@extends('admin.layouts.template')

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
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!-- start widget -->
                    <div class="state-overview" @if( auth()->user()->isAgent()) style = "display:none" ;@endif>
                        <div class="row">
                           <div class="col-md-3 col-sm-12 col-12">
							<div class="card bg-info">
								<div class="text-white py-3 px-4">
									<h6 class="card-title text-white mb-0">Website Unique Visitor</h6>
									<p>{{$visitor}}</p>
									<div id="sparkline26"><canvas width="265" height="45" style="display: inline-block; width: 265.438px; height: 45px; vertical-align: top;"></canvas></div>
									<small class="text-white">View Details</small>
								</div>
							</div>
							<!--<div class="card bg-success">-->
							<!--	<div class="text-white py-3 px-4">-->
							<!--		<h6 class="card-title text-white mb-0">Earning</h6>-->
							<!--		<p>3669.25</p>-->
							<!--		<div id="sparkline27"><canvas width="265" height="45" style="display: inline-block; width: 265.438px; height: 45px; vertical-align: top;"></canvas></div>-->
							<!--		<small class="text-white">View Details</small>-->
							<!--	</div>-->
							<!--</div>-->
						</div>
                            <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
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
                            <div class="col-xl-3 col-md-6 col-12">
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
                             <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-purple">
                                    <span class="info-box-icon push-bottom"><i
                                            class="material-icons">phone_in_talk</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rooms</span>
                                        <span class="info-box-number">{{$count_rooms}}</span>
                                        <div class="progress">
                                            <div class="progress-bar width-80"></div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <!--<div class="col-xl-3 col-md-6 col-12">-->
                            <!--    <div class="info-box bg-success">-->
                            <!--        <span class="info-box-icon push-bottom"><i-->
                            <!--                class="material-icons">monetization_on</i></span>-->
                            <!--        <div class="info-box-content">-->
                            <!--            <span class="info-box-text">Reviews</span>-->
                            <!--            <span class="info-box-number">{{$count_reviews}}</span>-->
                            <!--            <div class="progress">-->
                            <!--                <div class="progress-bar width-60"></div>-->
                            <!--            </div>-->
                                        
                            <!--        </div>-->
                                    <!-- /.info-box-content -->
                            <!--    </div>-->
                                <!-- /.info-box -->
                            <!--</div>-->
                            <!-- /.col -->
                             <!-- /.col -->
                            <!--<div class="col-xl-3 col-md-6 col-12">-->
                            <!--    <div class="info-box bg-success">-->
                            <!--        <span class="info-box-icon push-bottom"><i-->
                            <!--                class="material-icons">monetization_on</i></span>-->
                            <!--        <div class="info-box-content">-->
                            <!--            <span class="info-box-text">Users</span>-->
                            <!--            <span class="info-box-number">{{$count_users}}</span>-->
                            <!--            <div class="progress">-->
                            <!--                <div class="progress-bar width-60"></div>-->
                            <!--            </div>-->
                                        
                            <!--        </div>-->
                                    <!-- /.info-box-content -->
                            <!--    </div>-->
                                <!-- /.info-box -->
                            <!--</div>-->
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- end widget -->
                    <div class="row">
						<div class="col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Income/Expense Report</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body no-padding height-9">
									<div class="row">
										<canvas id="bar-chart"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Income/Expense Report</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body no-padding height-9">
									<div class="row">
										<canvas id="myChart"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
                   <div class="row">
						<div class="col-lg-8 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Recently Added Hotels</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive tblHeightSet">
											<table class="table display product-overview mb-30" id="support_table">
												<thead>
													<tr>
														<!--<th>#</th>-->
														<th>Name</th>
														<th>Address</th>
														<th>email</th>
														<th>status</th>
													</tr>
												</thead>
												<tbody>
												    @foreach($place as $places)
													<tr>
														<!--<td></td>-->
														<td>{{$places->user?$places->user->name:''}}</td>
														<td>{{$places->user?$places->user->phone_numbe:''}}</td>
														<td>{{$places->email}}</td>
														<td>
															<span class="label label-sm label-success">Available</span>
														</td>
													</tr>
													@endforeach
												
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Recent Users</header>
								</div>
								<div class="card-body ">
									<div class="row">
										<ul class="empListWindow small-slimscroll-style">
										    @foreach($users  as $user)
											<li>
												<div class="prog-avatar">
													<img src="https://graphitehe.com/site_img/about/desk.png" alt="" width="40" height="40">
												</div>
												<div class="details">
													<div class="title">
														<a href="#">{{$user->name}}</a>
													</div>
													<div>
														<span class="clsAvailable">{{$user->created_at}}</span>
													</div>
												</div>
											</li>
											@endforeach
										</ul>
										<div class="full-width text-center p-t-10">
											<a href="#" class="btn purple btn-outline btn-circle margin-0">View All</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Sales</header>
								</div>
								<div class="card-body ">
									<div class="row">
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Week</span>
											<h5 class="m-b-0">5,286</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+28%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Month</span>
											<h5 class="m-b-0">421</h5>
											<span><i class="material-icons text-danger">trending_down</i>
												-9%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">Average</span>
											<h5 class="m-b-0">1081</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+7%</span>
										</div>
									</div>
									<div id="sparkline28"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Earning</header>
								</div>
								<div class="card-body ">
									<div class="row">
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Week</span>
											<h5 class="m-b-0">1,389</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+21%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Month</span>
											<h5 class="m-b-0">591</h5>
											<span><i class="material-icons text-danger">trending_down</i>
												-6.3%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">Average</span>
											<h5 class="m-b-0">781</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+6%</span>
										</div>
									</div>
									<div id="sparkline29"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
							<div class="card  card-box">
								<div class="card-head">
									<header>Booking Details</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview mb-30" id="support_table5">
												<thead>
													<tr>
														<th>No</th>
														<th>Name</th>
														<th>Check In</th>
														<th>Check Out</th>
														<th>Status</th>
														<th>Phone</th>
														<th>Room Type</th>
														<th>Edit</th>
													</tr>
												</thead>
												<tbody>
												       @foreach($bookings as $booking)
													<tr>
													 
														<td>1</td>
														<td>@if(isset($booking->user->name)){{$booking->user->name}} @endif</td>
														<td>{{$booking->booking_start}}</td>
														<td>{{$booking->booking_end}}</td>
														<td>
															<span class="label label-sm label-success">{{$booking->payment_type}}</span>
														</td>
														<td>123456789</td>
														<td>Single</td>
														<td>
															<a href="{{route('admin_place_book_rooms',$booking->id)}}" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<a href="https://nsnhotels.com/recipt/{{$booking->id}}" class="btn icon-share-alt">
																<i class="fa fa-file-pdf-o"></i>
															</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
                </div>
                
    </div>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
     <script src="https://nsnhotels.com/admin/assets/plugins/chart-js/Chart.bundle.js"></script>
	<script src="https://nsnhotels.com/admin/assets/plugins/chart-js/utils.js"></script>
	<script src="https://nsnhotels.com/admin/assets/js/pages/chart/chartjs/home-data2.js"></script>
	<!-- sparkline -->
	<script src="https://nsnhotels.com/admin/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
	<script src="https://nsnhotels.com/admin/assets/js/pages/sparkline/sparkline-data.js"></script>
@stop
