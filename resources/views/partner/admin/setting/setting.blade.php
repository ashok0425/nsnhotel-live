@extends('admin.layouts.template')
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
                                <li><a class="parent-item" href="#">Settings</a>&nbsp;
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Settings</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                  
                                  <form method="post" action="{{ route('admin_setting_create') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        @csrf

                                        @if(count(config('setting_fields', [])) )

                                            @foreach(config('setting_fields') as $section => $fields)

                                            <div class="row mb-2">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="dashboard_graph">
                                                        <div class="row x_title">
                                                            <div class="col-md-6">
                                                                <h4>
                                                                    <i class="{{ array_get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                                                    {{ $fields['title'] }}
                                                                    <span class="small">{{$fields['desc']}}</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-md-7  col-md-offset-2">
                                                                @foreach($fields['elements'] as $field)
                                                                    @includeIf('admin.setting.fields.' . $field['type'] )
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         @endforeach
                                        @endif
                                        <div class="row m-b-md">
                                            <div class="col-md-12">
                                                <button class="btn-primary btn">
                                                    Save Settings
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop
