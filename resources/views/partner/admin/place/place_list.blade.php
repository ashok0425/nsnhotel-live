@extends('admin.layouts.template')
@push('styles')
     <link href="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Hotels</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="#">Hotels</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Hotels</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Hotels</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-primary" href="{{route('admin_place_create_view')}}">+ Add Hotel</a>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="10%">ID</th>
                                                    <th width="5%">Thumb</th>
                                                    <th>Hotel name</th>
                                                    <th>City</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                                @foreach($places as $place)
                                                    <tr>
                                                        <td>{{$place->id}}</td>
                                                        <td><img class="place_list_thumb" src="{{getImageUrl($place->thumb)}}" alt="page thumb"></td>
                                                        <td>{{$place->name}}</td>
                                                        <td>{{$place['city']['name']}}</td>
                                                        <td>
                                                            @foreach($place->categories as $cat)
                                                                <span class="category_name">{{$cat->name}}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if($place->status === \App\Models\Place::STATUS_PENDING)
                                                                {{STATUS[$place->status]}}
                                                            @else
                                                                <input type="checkbox" class="js-switch place_status" name="status" data-id="{{$place->id}}" {{isChecked(1, $place->status)}} />
                                                            @endif
                                                        </td>
                                                         <td class="nsn-flex">
                                                            <a class="btn btn-warning place_edit" href="{{route('admin_place_edit_view', $place->id)}}">Edit</a>
                                                            <a class="btn btn-primary place_edit" href="{{route('admin_room_list',['hotel_id'=>$place->id])}}">{{__("Manage Rooms")}}</a>
                                                            
                                                            @if($place->status === \App\Models\Place::STATUS_PENDING)
                                                                <button type="button" class="btn btn-success place_approve" data-id="{{$place->id}}">Approve</button>
                                                            @endif
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
@stop
@push('scripts')
    <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_place.js')}}"></script>
@endpush