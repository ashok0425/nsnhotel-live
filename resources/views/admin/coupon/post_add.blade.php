@extends('admin.layouts.template')
@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add new</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Add new</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Add new</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="{{route('admin_offer_store')}}" enctype="multipart/form-data" method="post">
                                            @if(isRoute('admin_offer_edit'))
                                                @method('put')
                                            @endif
                                            @csrf
                                            <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                

                                                <div class="x_panel">
                                                   
                                                    <div class="x_content">
                                                        <div class="form-group">
                                                            <label for="seo_title">Offer/Coupon Code :</label>
                                                            <input type="text" class="form-control" id="coupon_name" name="coupon_name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seo_description">Link:</label>
                                                            <input type="text" class="form-control" id="link" name="link" value="" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seo_description">Discount percent:</label>
                                                            <input type="number" class="form-control" id="coupon_percent" name="coupon_percent" value="" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="seo_description">Minimum Value :</label>
                                                            <input type="number" class="form-control" id="coupon_min" name="coupon_min" value="" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="seo_description">Status :</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="x_content">
                                                    <label class="post_thumb" for="post_thumb">
                                                        <img id="preview_thumb" src="" alt="post thumb">
                                                        <input type="file" class="form-control" id="post_thumb" name="thumb" accept="image/*">
                                                    </label>
                                                </div>
                                                        <button type="submit" class="btn btn-success">
                                                            @if(isRoute('admin_post_edit'))
                                                                Update
                                                            @else
                                                                Submit
                                                            @endif
                                                        </button>
                                                    </div>
                                                </div>

                                               

                                                

                                            </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                    
@stop

@push('scripts')
   
@endpush