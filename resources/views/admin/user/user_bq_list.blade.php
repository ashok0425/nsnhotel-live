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
                                <div class="page-title">Users</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">BQ User List</a>&nbsp;</i>
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
                                    <header>Users Information</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="15%">ID</th>
                                                    <th width="15%">Name</th>
                                                    <th width="15%">Number</th>
                                                    <th width="15%">Email</th>
                                                    <th width="15%">Event Type</th>
                                                    <th width="15%">PAX</th>
                                                    <th width="15%">Location</th>
                                                    <th width="15%">Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->event_type}}</td>
                                                    <td>{{$user->pax}}</td>
                                                    <td>{{$user->location}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                    
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

@include('admin.user.modal_add_users')

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
     <script src="{{asset('admin/assets/js/page_user.js')}}"></script>
@endpush