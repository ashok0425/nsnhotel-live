@extends('admin.layouts.template')

@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Location</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="{{route('admin_dashboard')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="{{route('admin_city_list')}}">Location</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                         <form method = "get">
                            <table>
                                <tr>
                            <th><input type = "text" name = "name" class ="form-control"></th>
                            <td><input type = submit Value = "search"></td></tr>
                            </table>
                        </form>
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Location</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                     <div class="pull-right">
                                        <a href ="{{route('admin_add_location')}}" class="btn btn-primary" id="btn_add_city" type="button">+ Add Location</a>
                                    </div>
        
                                     <div class="table">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                     <th width="3%">id</th></th>
                                                <th width="10%">city</th></th>
                                                <th width="10%">Lat</th></th>
                                                <th width="10%">Long</th></th>

                                                <th width="40%">Url</th>
                                                <th width="40%">Location Name</th>
                                                <th>Action</th>
                                             
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tbody>
                                                 @foreach($faq as $city)
                                                    <tr>
                                                        <td>{{$city->id}}</td>
                                                        <td>{{$city->city->name}}</td>
                                                        <td>{{$city->lat_n}}</td>
                                                        <td>{{$city->long_e}}</td>
                                                        <td>{{$city->url}}</td>
                                                        <td>{{$city->location_name}}</td>
                                                        <td>
                                                             <form class="d-inline" action="{{route('admin_location_delete',$city->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger city_delete">Delete</button>
                                                            </form>
                                                             <a href ="{{route('admin_add_location',['faq'=>$city->id])}}" class="btn btn-primary" id="btn_add_city" type="button">+ Edit Location</a>
                                                        </td>
                                                        <tr>
                                                      
                                                @endforeach
                                                  </tbody>
                                                        </table>
                                                     </div>
                    </div>
                </div>
            </div>
                                                 @stop