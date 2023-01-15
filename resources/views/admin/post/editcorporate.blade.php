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
                                <div class="page-title">Corporate</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Corporates</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Corporate</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                  
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="example1" class="display full-width ">
                                         <form method = "get">
                                                <tr>
                                                     <th width="25%">Contact Person Name</th>
                                                     <td><input type ="text" name ="name" value ="{{$corporate->name}}" class= "form-control"></td>
                                                      </tr>
                                                         <tr>
                                                    <th width="15%">Company name</th>
                                                     <td><input type ="text" name ="company_name" value ="{{$corporate->company_name}}" class= "form-control"></td>
                                                    </tr>
                                                    
                                                     <tr>
                                                    <th width="15%">Address</th>
                                                     <td><input type ="text" name ="address" value ="{{$corporate->address}}" class= "form-control"></td>
                                                    </tr>
                                                      <tr>
                                                    <th width="15%"> Login Phone Number</th>
                                                     <td><input type ="text" name ="phone" value ="{{$corporate->user->phone_number}}" class= "form-control"></td>
                                                    </tr>
                                                    <tr>
                                                    <th width="15%">Email</th>
                                                     <td><input type ="text" name ="email" value ="{{$corporate->user->email}}" class= "form-control"></td>
                                                    </tr>
                                                <th width="15%">GST No</th>
                                                     <td><input type ="text" name ="gst_no" value ="{{$corporate->gst_no}}" class= "form-control"></td>
                                                     <input type ="hidden" value ="{{$corporate->id}}" name ="id">
                                                    </tr>
                                                       <tr>
<th width="15%">Approx Annual Booking</th>
                                                     <td><input type ="text" name ="year_book_day" value ="{{$corporate->year_book_day}}" class= "form-control"></td>
                                                    </tr>
                                                 <tr>
                               <th width="15%">Approx Monthly Booking</th>
                                                     <td><input type ="text" name ="month_book_day" value ="{{$corporate->month_book_day}}" class= "form-control"></td>
                                                    </tr>
                                                    <tr>
                                                       <th width="15%">Note (Useful Information)</th>
                                                     <td><input type ="text" name ="extra_space" value ="{{$corporate->extra_space}}" class= "form-control"></td>
                                                    </tr>
                                                     <tr>
                                                       <th width="15%">Discount Percentage</th>
                                                     <td><input type ="text" name ="discount"  value ="{{$corporate->user->discount}}" class= "form-control"></td>
                                                    </tr>
                                                     <tr>
                                                       <th width="15%">Status</th>
                                                       
                                                     <td><select name = "is_corporate">
                                                         
                                                           <option value ="0" @if($corporate->user->is_corporate == 0)  selected   @endif>Inactive</option>  
                                                           <option value ="1" @if($corporate->user->is_corporate == 1)  selected  @endif  >Active</option>  
                                                       </select></td>
                                                    </tr>
                                                                                                         <tr>
                                                       <th width="15%"></th>
                                                       
                                                     <td><input type ="submit" value ="Update Corporate "></td>
                                                    </tr>
                                                    </form>
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
    <script src="{{asset('admin/assets/js/page_post.js')}}"></script>
@endpush

