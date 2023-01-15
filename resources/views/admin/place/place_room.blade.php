@extends('admin.layouts.template')
@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Place create</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home{{ request()->book }}</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Place create</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Place create</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">

                                    <div class="col-lg-3">
                                        <ul class="nav nav-tabs tabs-left place_create_menu">
                                            <li class=""><a href="#genaral">Genaral</a></li>
                                            <li class=""><a href="#hightlight">Hightlight</a></li>
                                            <li class=""><a href="#location">Location</a></li>
                                            <li class=""><a href="#contact_info">Contact info</a></li>
                                            <li class=""><a href="#social_network">Social network</a></li>
                                            <li class=""><a href="#opening_hours">Open hourses</a></li>
                                            <li class=""><a href="#media">Media</a></li>
                                            <li class=""><a href="#link_affiliate">Booking link</a></li>
                                            <li class=""><a href="#golo_seo">SEO</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-8 col-xs-12 place_create">
                                        
                                        @if($place)
                                            @include('admin.place.form_edit')
                                        @else
                                            @include('admin.place.form_create')
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop

@push('scripts')
    <script src="{{asset('admin/assets/js/page_place_create.js')}}"></script>
@endpush