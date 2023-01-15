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
                                <div class="page-title">Rooms</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index">Rooms</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Rooms</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Rooms</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-primary" href="{{route('admin_room_create_view',$hotel_id)}}">+ Add rooms</a>
                                    </div>

        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                <th width="3%">ID</th>
                                                <th width="5%">Thumb</th>
                                                <th>Room name</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th width="15%">{{ __('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  @foreach($rooms as $room)
                                                    <tr>
                                                        <td>{{$room->id}}</td>
                                                        <td><img class="place_list_thumb" src="{{getImageUrl($room->thumb)}}" alt="page thumb"></td>
                                                        <td>{{$room->name}}</td>
                                                        <td>{{$room->onepersonprice}}</td>
                                                        <td>
                                                            @if($room->status === \App\Models\Place::STATUS_PENDING)
                                                                {{STATUS[$room->status]}}
                                                            @else
                                                                <input type="checkbox" class="js-switch place_status" name="status" data-id="{{$room->id}}" {{isChecked(1, $room->status)}} />
                                                            @endif
                                                        </td>
                                                        <td class="nsn-flex">
                                                            <a class="btn btn-warning place_edit" href="{{route('admin_room_edit_view',$room->id)}}">Edit</a>
                                                            <form action="{{route('admin_room_delete',$room->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger room_delete">Delete</button>
                                                            </form>
                                                            @if($room->status === \App\Models\Place::STATUS_PENDING)
                                                                <button type="button" class="btn btn-success place_approve" data-id="{{$room->id}}">Approve</button>
                                                            @endif
                                                             <a class="btn btn-primary place_edit" href="{{route('admin_add_calendar',['type' =>0 ,'room_id' =>$room->id])}}"> {{ date('F')}}</a>
                                                             <a class="btn btn-secondary place_edit" href="{{route('admin_add_calendar',['type'=> 1 ,'room_id' =>$room->id])}}"> {{ date('F',strtotime('first day of +1 month'))}}</a>
                                                             <a class="btn btn-success place_edit" href="{{route('admin_add_calendar',['type' => 2 ,'room_id' =>$room->id] )}}"> {{ date('F',strtotime('first day of +2 month'))}}</a><br>

                                                             <a class="btn btn-danger place_edit" href="{{route('admin_add_calendar',['type' => 3 ,'room_id' =>$room->id] )}}"> {{ date('F',strtotime('first day of +3 month'))}}</a><br>

                                                             <a class="btn btn-info place_edit" href="{{route('admin_add_calendar',['type' => 4 ,'room_id' =>$room->id] )}}"> {{ date('F',strtotime('first day of +4 month'))}}</a>
                                                             <a class="btn btn-light place_edit" href="{{route('admin_add_calendar',['type' => 5 ,'room_id' =>$room->id] )}}"> {{ date('F',strtotime('first day of +5 month'))}}</a>
                                                        </td>
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
     <script src="{{asset('admin/assets/js/page_room.js')}}"></script>
@endpush