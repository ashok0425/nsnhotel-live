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
                                <div class="page-title">Categories</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Categories</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Categories</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_category" type="button">+ Add category</button>
                                    </div>
        
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable d-none d-md-block">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    @if($type === \App\Models\Category::TYPE_PLACE)
                                                        <th>Priority</th>
                                                        <th>Is feature</th>
                                                    @endif
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($categories as $category)
                                                    <tr>
                                                        <td>{{$category->id}}</td>
                                                        <td>{{$category->name}}</td>
                                                        @if($type === \App\Models\Category::TYPE_PLACE)
                                                        <td>{{$category->priority}}</td>
                                                        <td>
                                                            <input type="checkbox" class="js-switch category_is_feature" name="is_feature" data-id="{{$category->id}}" {{isChecked(1, $category->is_feature)}} />
                                                        </td>
                                                        @endif
                                                        <td>
                                                            <input type="checkbox" class="js-switch category_status" name="status" data-id="{{$category->id}}" {{isChecked(1, $category->status)}} />
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-xs category_edit"
                                                                    data-id="{{$category->id}}"
                                                                    data-name="{{$category->name}}"
                                                                    data-slug="{{$category->slug}}"
                                                                    data-priority="{{$category->priority}}"
                                                                    data-isfeature="{{$category->is_feature}}"
                                                                    data-featuretitle="{{$category->feature_title}}"
                                                                    data-colorcode="{{$category->color_code}}"
                                                                    data-icon="{{$category->icon_map_marker}}"
                                                                    data-translations="{{$category->translations}}"

                                                                    data-seotitle="{{$category->seo_title}}"
                                                                    data-seodescription="{{$category->seo_description}}"
                                                            >Edit
                                                            </button>
                                                            <form class="d-inline" action="{{route('partner_category_delete',$category->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger btn-xs category_delete">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                               
                                            </tbody>
                                        </table>
                                    </div>





                                    <div class="d-md-none d-block">
                                        @foreach($categories as $category)
                                        <div class="d-md-none d-block p-2 shadow my-2 card">
                                        <table  class="w-100 table-striped">
                                                <tr>
                                                    <th>ID</th>
                                                    <td>{{$category->id}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <td>{{$category->name}}</td>

                                                </tr>
                                                <tr>
                                                    @if($type === \App\Models\Category::TYPE_PLACE)
                                                    <th>Priority</th>
                                                @endif

                                                @if($type === \App\Models\Category::TYPE_PLACE)
                                                <td>{{$category->priority}}</td>
                                            
                                                @endif
                                                </tr>


                                                <tr>
                                                    @if($type === \App\Models\Category::TYPE_PLACE)
                                                    <th>Is feature</th>
                                                @endif

                                                @if($type === \App\Models\Category::TYPE_PLACE)
                                                <td>
                                                    <input type="checkbox" class="js-switch category_is_feature" name="is_feature" data-id="{{$category->id}}" {{isChecked(1, $category->is_feature)}} />
                                                </td>
                                                @endif
                                                </tr>
                                                  
                                                <tr>
                                                    <th>Status</th>
 
                                                    <td>
                                                        <input type="checkbox" class="js-switch category_status" name="status" data-id="{{$category->id}}" {{isChecked(1, $category->status)}} />
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-xs category_edit"
                                                                data-id="{{$category->id}}"
                                                                data-name="{{$category->name}}"
                                                                data-slug="{{$category->slug}}"
                                                                data-priority="{{$category->priority}}"
                                                                data-isfeature="{{$category->is_feature}}"
                                                                data-featuretitle="{{$category->feature_title}}"
                                                                data-colorcode="{{$category->color_code}}"
                                                                data-icon="{{$category->icon_map_marker}}"
                                                                data-translations="{{$category->translations}}"

                                                                data-seotitle="{{$category->seo_title}}"
                                                                data-seodescription="{{$category->seo_description}}"
                                                        >Edit
                                                        </button>
                                                        <form class="d-inline" action="{{route('partner_category_delete',$category->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-danger btn-xs category_delete">Delete</button>
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
@include('partner.category.modal_add_category')

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
    <script src="{{asset('admin/assets/js/page_category.js')}}"></script>
@endpush


