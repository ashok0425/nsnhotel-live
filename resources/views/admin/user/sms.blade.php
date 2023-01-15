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
                                <div class="page-title">Communication/Campagin</div>
                            </div>
                             <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Sms</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Mail</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row card-body">
                           <form method = "get">
                            <table>
                                <tr>
                                    <th style ="width:170px;">User Type : </th>
                                    
                            <th style ="width:50px;"><input type = "radio" name = "type" class ="form-control"  value = "user"> </th>     <td style ="width:90px;">User</td>
                            <th style ="width:50px;"><input type ="radio"  name = "type"  value ="partner" class ="form-control" ></th>   <td style ="width:90px;">Partner</td>
                               <th style ="width:50px;"><input type = "radio" name = "type" class ="form-control"  value = "corporate"></th>   <td style ="width:90px;">Corporate</td>
                            
                            </tr>
                           
                            </table>
                           
                                <label>Campign Name:</label>
                                <input name ="campaign_name"  class ="form-control"  style ="width:250px;">
                                
                           
                        </form>
                            
                            
                            
                            </div></div></div></div>

@stop