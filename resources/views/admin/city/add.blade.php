@extends('admin.layouts.template')

@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">FAQ</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="{{route('admin_dashboard')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="{{route('admin_city_list')}}">FAQ</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                          <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" id="add_city_method" name="_method" value="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 city_create">

                       

                            <div class="form-group">
                                <label for="password">city: *</label>
                                <select class="form-control" id="city_id" name="city_id" required>
                                    @if(isset($city))
                                    @foreach($city as $cities)
                                        <option value="{{$cities->id}}">{{$cities->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                         </div>

                           <!--</div>-->

                            <!--<div class="row">-->
                            <!--    <div class="col-md-12">-->
                                   
                                    <!--<div class="form-group">-->
                                        <label for="seo_description">Question</label>
                                        <textarea class="form-control" id="question" name="question" row ="50"> @if(isset($faq->question)) {{ $faq->question }} @endif</textarea>
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <label for="seo_keywords">Answer:</label>
                                        <textarea class="form-control" id="answer" name="answer">@if(isset($faq->answer)) {{ $faq->answer }} @endif</textarea>
                                    <!--</div>-->
                            <!--    </div>-->
                            <!--</div>-->

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    @if(isset($faq->id))
                        <input type="hidden" id="faq_id" name="faq_id" value="{{$faq->id}}">
                    
                    @endif
                    <!--<input type="hidden" id="city_id" name="city_id" value="">-->
                    <button type ="submit" class="btn btn-primary" id="submit_add_city">Add</button>
                    <button class="btn btn-primary" id="submit_edit_city">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
            
            
            
            </div>    </div>    </div>    </div>
            @stop