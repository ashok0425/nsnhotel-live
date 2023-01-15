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
                                <div class="page-title">Reviews</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Reviews</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Reviews</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th width="15%">Reviewer</th>
                                                    <th width="15%">Place name</th>
                                                    <th>Comment</th>
                                                    <th width="10%">Star</th>
                                                    <th width="10%">Status</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($reviews as $review)
                                                    <tr>
                                                        <td>{{$review->id}}</td>
                                                        <td><a>{{$review['user']['name']}}</a></td>
                                                        <td>
                                                            @if(isset($review['place']['slug']))
                                                                <a href="{{route('place_detail', $review['place']['slug'])}}" target="_blank">{{$review['place']['name']}}</a>
                                                            @else
                                                                {{$review['place']['name']}}
                                                            @endif
                                                        </td>
                                                        <td>{{$review->comment}}</td>
                                                        <td>{{$review->score}}</td>
                                                        <td><input type="checkbox" class="js-switch review_status" name="status" data-id="{{$review->id}}" {{isChecked(1, $review->status)}} /></td>
                                                        <td>
                                                            <form class="d-inline" action="{{route('admin_review_delete')}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input type="hidden" name="review_id" value="{{$review->id}}">
                                                                <button type="button" class="btn btn-danger review_delete">Delete</button>
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
     <script src="{{asset('admin/js/page_review.js')}}"></script>
@endpush
