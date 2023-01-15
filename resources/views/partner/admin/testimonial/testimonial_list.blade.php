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
                                <div class="page-title">Testimonials</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Testimonials</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Testimonials</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                         <a class="btn btn-primary" href="{{route('admin_testimonial_page_add')}}">+ Add new</a>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th>Avatar</th>
                                                    <th>Name</th>
                                                    <th>Job title</th>
                                                    <th>Content</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach($testimonials as $testimonial)
                                                <tr class="even pointer">
                                                    <td>
                                                        {{$testimonial['id']}}
                                                    </td>
                                                    <td>
                                                        @if($testimonial['avatar'])
                                                            <img src="{{getImageUrl($testimonial['avatar'])}}" alt="no avt" style="width: 50px;height: 50px; border-radius: 50%">
                                                        @else
                                                            <img src="https://via.placeholder.com/50x50?text=no avt" alt="no avt" style="width: 50px;height: 50px; border-radius: 50%">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:" class="edit_cb"
                                                           data-id="{{$testimonial['id']}}"
                                                           data-name="{{$testimonial['name']}}"
                                                        >
                                                            <strong>{{$testimonial['name']}}</strong>
                                                        </a>
                                                    </td>
                                                    <td>{{$testimonial['job_title']}}</td>
                                                    <td>{{$testimonial['content']}}</td>
                                                    <td>
                                                        <a href="{{route('admin_testimonial_page_edit', $testimonial['id'])}}" class="btn btn-warning  city_edit">Edit</a>
                                                        <form class="d-inline" action="" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-danger city_delete">Delete</button>
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
@endpush

@push('scripts')
    <script>
        $('#add_cb').click(function () {
            $('#submit_customerfeedback').show();
            $('#edit_customerfeedback').hide();
        });

        $('.edit_cb').click(function () {
            let customer_feedback_id = $(this).attr('data-id');
            let customer_name = $(this).attr('data-name');
            let customer_address = $(this).attr('data-address');
            let customer_avatar = $(this).attr('data-avatar');
            let customer_feedback = $(this).attr('data-feedback');

            $('#customer_name').val(customer_name);
            $('#customer_address').val(customer_address);
            $('#customer_feedback').val(customer_feedback);
            $('#thumbnail').val(customer_avatar);
            $('#cb_thumb').attr('src', customer_avatar);

            $('#submit_customerfeedback').hide();
            $('#edit_customerfeedback').show().attr('data-id', customer_feedback_id);
            $('#modal_add_customerfeedback').modal('show');
        });
    </script>
@endpush

@push('style')
    <style>
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
@endpush

