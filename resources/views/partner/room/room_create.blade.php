@extends('partner.layouts.template')
@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Room create</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Room create</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Room create</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">

                                        <div class="col-lg-12 d-block d-md-none">
                                            <ul class="nav nav-tabs ">
                                                <li class=""><a href="#genaral" class="btn btn-sm btn-primary my-1 mx-1">Genaral</a></li>
                                                <li class=""><a href="#hightlight" class="btn btn-sm btn-primary my-1 mx-1">Hightlight</a></li>
                                                <li class=""><a href="#media" class="btn btn-sm btn-primary my-1 mx-1">Media</a></li>
                                                <li class=""><a href="#golo_seo" class="btn btn-sm btn-primary my-1 mx-1">Seo</a></li>
                                            </ul>
                                        </div>
                                    <div class="col-lg-3 d-none d-md-block">
                                        <ul class="nav nav-tabs tabs-left place_create_menu">
                                            <li class=""><a href="#genaral">Genaral</a></li>
                                            <li class=""><a href="#hightlight">Hightlight</a></li>
                                            <li class=""><a href="#media">Media</a></li>
                                            <li class=""><a href="#golo_seo">Seo</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-8 col-xs-12 place_create">
                                        @if($rooms)
                                            @include('partner.room.form_edit')
                                        @else
                                            @include('partner.room.form_create')
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
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="{{asset('admin/assets/js/page_room_create.js')}}"></script>
@endpush