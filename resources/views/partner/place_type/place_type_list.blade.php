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
                                <div class="page-title">Place types</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index">Places</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Place types</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Place types</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                       <button class="btn btn-primary" id="btn_add_place_type" type="button">+ Add place type</button>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable d-md-block d-none">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Place type name</th>
                                                    <th>Category name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($place_types as $place_type)
                                                    <tr>
                                                        <td>{{$place_type->id}}</td>
                                                        <td>{{$place_type->name}}</td>
                                                        <td>{{$place_type['category']['name']}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning  place_type_edit"
                                                                    data-id="{{$place_type->id}}"
                                                                    data-catid="{{$place_type->category_id}}"
                                                                    data-name="{{$place_type->name}}"
                                                                    data-translations="{{$place_type->translations}}"
                                                            >Edit
                                                            </button>
                                                            <form class="d-inline" action="{{route('admin_place_type_delete',$place_type->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger place_type_delete">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                               
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-md-none d-block">
                                            @foreach($place_types as $place_type)


                                            <div class="d-md-none d-block p-2 shadow my-2 card">
                                                <table  class=" table-striped w-100">
                                                <tr>
                                                    <th>ID</th>
                                                    <td>{{$place_type->id}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Place type name</th>
                                                    <td>{{$place_type->name}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Category name</th>
                                                    <td>{{$place_type['category']['name']}}</td>
                                                </tr>
                                              <tr>
                                                <td>
                                                    <button type="button" class="btn btn-warning  place_type_edit"
                                                            data-id="{{$place_type->id}}"
                                                            data-catid="{{$place_type->category_id}}"
                                                            data-name="{{$place_type->name}}"
                                                            data-translations="{{$place_type->translations}}"
                                                    >Edit
                                                    </button>
                                                    <form class="d-inline" action="{{route('admin_place_type_delete',$place_type->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="btn btn-danger place_type_delete">Delete</button>
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

 @include('partner.place_type.modal_add_place_type')

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_place_type.js')}}"></script>
@endpush
