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
                                <div class="page-title">
                                    @if ($data==1)
                                        Subscriber list
                                    @endif

                                    @if ($data==3)
                                        Banquest Request list
                                    @endif

                                    @if ($data==2)
                                    Contact List
                                @endif
                                </div>
                            </div>
                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header></header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_tax" type="button">Add</button>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>
                                                        @if ($data==1)
                                                            Event
                                                            @else 
                                                            Message
                                                        @endif
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                 @foreach($other as $item)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                         <td>{{$item->name}}</td>
                                                         <td>{{$item->email}}</td>
                                                         <td>{{$item->phone}}</td>
                                                        <td>
                                                        @if ($data==1)

                                                            {{$item->event}}
                                                            @else
                                                            {{$item->message}}

                                                            @endif
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


{{-- @include('admin.meal.tax_add') --}}
@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_meal.js')}}"></script>
@endpush
