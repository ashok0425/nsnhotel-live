@extends('partner.layouts.template')
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
                                        href="index">Hotels</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                                        <a class="btn btn-primary" href="{{route('partner_place_create_view')}}">+ Add place</a>
                                    </div>
        
                                </div>
                                <div class="card-body">
                                

        @foreach($places as $place)
        <div class="card p-2 shadow">
            <table class=" table-striped">
                    <tr>
                        <th>ID</th>
                        <td>{{$place->id}}</td>

                    </tr>
                    <tr>
                                                <th> Thumb</th>
                                                <td><img class="place_list_thumb" src="{{getImageUrl($place->thumb)}}" alt="page thumb"></td>
                    </tr>
                    <tr>
                        <th>Place name</th>
                        <td>{{$place->name}}</td>

                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{$place['city']['name']}}</td>

                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>
                            @foreach($place->categories as $cat)
                                <span class="category_name">{{$cat->name}}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($place->status === \App\Models\Place::STATUS_PENDING)
                                {{STATUS[$place->status]}}
                            @else
                                <input type="checkbox" class="js-switch place_status" name="status" data-id="{{$place->id}}" {{isChecked(1, $place->status)}} />
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="nsn-flex">
                            <a class="btn btn-warning place_edit" href="{{route('partner_place_edit_view', $place->id)}}">Edit</a>
                            <a class="btn btn-primary place_edit" href="{{route('partner_room_list',['hotel_id'=>$place->id])}}">{{__("Manage Rooms")}}</a>
                           
                        </td>
                    </tr>
                </table>
            </div>
                    @endforeach
   
   
                                   
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