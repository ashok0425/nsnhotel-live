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
                                <div class="page-title">Offer/Coupon</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Offer</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Offer</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-primary" href="{{route('admin_offer_create')}}">+ Add new</a>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th width="5%">Thumb</th>
                                                    <th width="3%">Name</th>
                                                    <th>Link</th>
                                                    <th width="3%"> Percent</th>

                                                    <th>coupon_min</th>

                                                    <th width="15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($posts as $post)
                                                    <tr>
                                                        <td>{{$post->id}}</td>
                                                        <td><img class="place_list_thumb" src="{{getImageUrl($post->thumb)}}" alt="post thumb"></td>
                                                        <td>{{$post->coupon_name}}</a></td>
                                                        <td>{{$post->link}}</a></td>
                                                        <td>{{$post->coupon_percent}}</a></td>
                                                        <td>{{$post->coupon_min}}</td>
                                                        <td>
                                                            <a class="btn btn-warning place_edit" href="{{route('admin_offer_edit', $post->id)}}">Edit</a>
                                                            <form class="d-inline" action="{{route('admin_offer_delete', $post->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger  place_delete" onclick="if(confirm('Are you sure? The post that deleted can not restore!')) $(this).parent().submit();">Delete</button>
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

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_post.js')}}"></script>
@endpush

