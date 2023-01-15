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
                                <li><a class="parent-item" href="#">Language</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Language</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <form action="{{route('admin_settings_language_status', \App\Models\Language::STATUS_ACTIVE)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <select class="form-control" name="language_id">
                                                        @foreach($language_deactive as $language)
                                                            <option value="{{$language->id}}">{{$language->name}} ({{$language->code}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success"  onclick="return confirm('Are you sure?');">Active language</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            <div class="table-scrollable">
                                        <table id="example1" class="display full-width">
                                            <thead>
                                                <tr>
                                                    <th>Flag</th>
                                                    <th>Name</th>
                                                    <th>Default</th>
                                                    <th>Action</th>
                                                    <th>Translation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($language_active as $language)
                                                    <tr>
                                                        <th scope="row">
                                                            <img src="{{flagImageUrl($language->code)}}" style="width: 32px" alt="flag">
                                                        </th>
                                                        <td>{{$language->name}}</td>
                                                        <td>
                                                            <input type="checkbox" class="js-switch language_default" name="is_default" data-id="{{$language->id}}" {{isChecked(\App\Models\Language::IS_DEFAULT, $language->is_default)}} {{isDisabled(\App\Models\Language::IS_DEFAULT, $language->is_default)}}/>
                                                        </td>
                                                        <td>
                                                            <form action="{{route('admin_settings_language_status', \App\Models\Language::STATUS_DEACTIVE)}}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="language_id" value="{{$language->id}}">
                                                                <button type="submit" class="btn btn-warning btn-sm language_deactive" onclick="return confirm('Are you sure?');" {{isDisabled(\App\Models\Language::IS_DEFAULT, $language->is_default)}}>Deactive</button>
                                                            </form>
                                                        </td>
                                                        <td><a class="btn btn-info btn-sm" href="{{url('admincp/translations/view/_json')}}">Translation</a></td>
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
                </div>
            </div>




@stop

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
     <script src="{{asset('admin/js/page_setting_language.js')}}"></script>
@endpush