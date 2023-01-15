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
                    <div class="state-overview">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-blue">
                                    <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Cities</span>
                                        <span class="info-box-number">{{$count_cities}}</span>
                                        <div class="progress">
                                            <div class="progress-bar width-60"></div>
                                        </div>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
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
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon push-bottom"><i
                                            class="material-icons">monetization_on</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Reviews</span>
                                        <span class="info-box-number">{{$count_reviews}}</span>
                                        <div class="progress">
                                            <div class="progress-bar width-60"></div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                             <!-- /.col -->
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon push-bottom"><i
                                            class="material-icons">monetization_on</i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Users</span>
                                        <span class="info-box-number">{{$count_users}}</span>
                                        <div class="progress">
                                            <div class="progress-bar width-60"></div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- end widget -->
                   
                </div>
    </div>
@stop
