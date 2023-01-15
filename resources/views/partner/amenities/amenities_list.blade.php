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
                                <div class="page-title">Amenities</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index">Places</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Amenities</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Amenities</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_amenities" type="button">+ Add amenities</button>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable d-none d-md-block">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th width="5%">Icon</th>
                                                    <th>Amenities Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($amenities as $item)
                                                    <tr>
                                                        <td>{{$item->id}}</td>
                                                        <td><img class="amenities_icon" src="{{getImageUrl($item->icon)}}" alt="Amenities icon"></td>
                                                        <td>{{$item->name}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning amenities_edit"
                                                                    data-id="{{$item->id}}"
                                                                    data-name="{{$item->name}}"
                                                                    data-icon="{{$item->icon}}"
                                                                    data-translations="{{$item->translations}}"
                                                            >Edit
                                                            </button>
                                                            <form class="d-inline" action="{{route('partner_amenities_delete',$item->id)}}" method="POST">
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


                                    <div class="d-md-none d-block">

                                    @foreach($amenities as $item)

                                    <div class="card p-2 shadow my-2">
                                        <table  class="w-100 table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <td>{{$item->id}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Icon</th>
                                                    <td><img class="amenities_icon" src="{{getImageUrl($item->icon)}}" alt="Amenities icon"></td>
                                                </tr>
                                                <tr>
                                                    <th>Amenities Name</th>
                                                    <td>{{$item->name}}</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-warning amenities_edit"
                                                                data-id="{{$item->id}}"
                                                                data-name="{{$item->name}}"
                                                                data-icon="{{$item->icon}}"
                                                                data-translations="{{$item->translations}}"
                                                        >Edit
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <form class="d-inline" action="{{route('partner_amenities_delete',$item->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-danger amenities_delete">Delete</button>
                                                        </form>
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
            </div>
@stop

 @include('partner.amenities.modal_add_amenities')

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_amenities.js')}}"></script>
@endpush
