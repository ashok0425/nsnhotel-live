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
                                <div class="page-title">Meals</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index">Manage</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Meals List</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Meals</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_mealHotel" type="button">Add Meals</button>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th width="5%">Hotel Name</th>
                                                    <th>Type</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($model as $item)
                                                    <tr>
                                                        <td>{{$item->id}}</td>
                                                        <td>{{isset($item->place) ? $item->place->name : '' }}</td>
                                                         <td>{{$item->meal->type}}</td>
                                                          <td>{{$item->price}}</td>
                                                           <td>
                                                            <input type="checkbox" class="js-switch" name="status" data-id="{{$item->id}}" {{isChecked(1, $item->status)}} />
                                                        </td>
                                                        <td>
                                                        <button type="button" class="btn btn-warning mealHotel_edit_admin"
                                                        data-id="{{$item->id}}"
                                                        data-name="{{$item->name}}"
                                                        data-type="{{$item->type}}"
                                                        data-price="{{$item->price}}"
                                                        data-hotel_id="{{$item->hotel_id}}"
                                                        >Edit
                                                        </button>
                                                            <form class="d-inline" action="{{route('admin_amenities_delete',$item->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger amenities_delete">Delete</button>
                                                            </form>
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

@include('admin.meal.modal_add_mealhotel')

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_amenities.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_meal.js')}}"></script>
@endpush
