@extends('admin.layouts.template')
@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit TAX</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Edit</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Edit</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="{{route('admin_tax_update')}}" enctype="multipart/form-data" method="post">
                                           <input type="hidden" value="{{$tax->id}}" name="id">
                                            @csrf
                                            <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                
<input type="hidden" name="tax_id" value="{{$tax->id}}">
                                                <div class="x_panel">
                                                   
                                                    <div class="x_content">
                                                       
                                                        <div class="form-group">
                                                            <label for="seo_description">Minimun Price</label>
                                                            <input type="text" class="form-control" id="price_min" name="price_min" value="{{$tax->price_min}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seo_description">Maximum Price:</label>
                                                            <input type="text" class="form-control" id="price_max" name="price_max"  required value="{{$tax->price_max}}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="seo_description">Tax percent :</label>
                                                            <input type="number" class="form-control" id="percentage" name="percentage" value="{{$tax->percentage}}" required>
                                                        </div>

                                                        
                                                   

                                                
                                                        <button type="submit" class="btn btn-success">
                                                           
                                                                Submit
                                                        </button>
                                                    </div>
                                                </div>

                                               

                                                

                                            </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    
@stop

@push('scripts')
   
@endpush