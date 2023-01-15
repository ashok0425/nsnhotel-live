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
                                <li><a class="parent-item" href="#">User List</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Users Information</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                     <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_user" type="button">+ Add Users</button>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th width="10%">Avatar</th>
                                                    <th width="15%">Name</th>
                                                    <th width="15%">Email</th>
                                                    <th width="15%">Status</th>
                                                    <th width="15%">Is Admin</th>
                                                    <th width="15%">Is Partner</th>
                                                    <th width="15%">Created at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        <input type="checkbox" class="js-switch user_status" data-id="{{$user->id}}" {{isChecked($user->status, \App\Models\User::STATUS_ACTIVE)}}/>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="js-switch user_admin" data-id="{{$user->id}}" {{isChecked($user->is_admin, \App\Models\User::USER_ADMIN)}}/>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="js-switch user_partner" data-id="{{$user->id}}" {{isChecked($user->is_partner, \App\Models\User::USER_PARTNER)}}/>
                                                    </td>
                                                    <td>{{formatDate($user->created_at, 'H:i d/m/Y')}}</td>
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