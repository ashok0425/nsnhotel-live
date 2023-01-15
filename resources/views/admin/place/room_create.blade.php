@extends('admin.layouts.template')
@section('main')
@php  
 $segment = Request::segment(3);
 if($segment == 'book'){
 $book =Request::segment(4);
 }

@endphp
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Booking</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Add Booking</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-md-6"> 
                        <table>
                            <tr>
                            <th class ="btn btn-primary">Room Price 1 person :<span style = color:black;>@if(isset($room->onepersonprice)) {{$room->onepersonprice}} @endif</span></th>  
                           
                            <th class ="btn btn-warning">Room Price 2 person :<span style = color:black;>@if(isset($room->twopersonprice)) {{$room->twopersonprice}}  @endif</span></th>  </tr>
                        </table>
                         <form method = "get" action="">
                               @if($segment != 'book')
                         <div class="form-group">
                    <label for="place_name">Name : *</label>
                <input type="text" class="form-control" name="name" value="" placeholder=" Name of Person" autocomplete="off" required="">
                                </div>
                                  <div class="form-group">
                    <label for="place_name">Phone : *</label>
                <input type="number" class="form-control" name="phone" value="" placeholder="Phone" autocomplete="off" required="">
                                </div>
                                @endif
                          <div class="form-group">
                    <label for="place_name">Numbers of Rooms : *</label>
                <input type="text" class="form-control" name="rooms"  value="@if(isset($Bookings->number_of_room)){{$Bookings->number_of_room}} @endif" placeholder="Numbers Of Rooms" autocomplete="off" required="">
                                </div>
                                
 <div class="form-group">
                    <label for="place_name">Check In Date : *</label>
<input type="date" class="form-control" name="check_in" value="@if(isset($Bookings->booking_start)){{ date("Y-m-d", strtotime($Bookings->booking_start))}}@endif" placeholder="Numbers Of Rooms"  required=""></div> 
                               
                                <div class="form-group">
                    <label for="place_name">Check out Date : *</label>
<input type="date" class="form-control" name="check_out" value="@if(isset($Bookings->booking_end)){{$Bookings->booking_end}}@endif" placeholder="Numbers Of Rooms"  required="">
                                </div>  
                                  <div class="form-group">
                                    <label for="place_name">Number of adult : *</label>
        <input type="text" class="form-control" name="adult" value="@if(isset($Bookings->numbber_of_adult)){{$Bookings->numbber_of_adult}}@endif" placeholder="Number of adult" autocomplete="off" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="place_name">Number Of Children : *</label>
                                    <input type="text" class="form-control" name="children" value="@if(isset($Bookings->numbber_of_children)){{$Bookings->numbber_of_children}}@endif" placeholder="Number Of Children" autocomplete="off" required="">
                                </div>
                            <div class="form-group">
                                    <label for="place_name">Price : *</label>
                                    <input type="text" class="form-control" name="price" value="@if(isset($Bookings->amount)){{trim($Bookings->amount)}}@endif" placeholder="Price" autocomplete="off" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="place_name">Payment Type : *</label>
                                  <select  name = "payment_type">
                                      <option value = "online">Online</option>
                                                                            <option value = "offline">Offline</option>
                                  </Select>   
                                </div>
                            
                               @if($segment != 'book')
                            
                           <input type="hidden" name="place_id" value="{{$place->id}}">
                              @endif
                            @if($segment == 'book')
                            
                           <input type="hidden" name="book" value="{{$book}}">
                              @endif
                            <div class="form-group">
                                   
                                    <input type="submit" class="btn btn-info" name="submit" value="Add Booking" >
                                </div>
                        </div>
                          
                        </form>
                    </div>
                </div>
            </div>
@stop

@push('scripts')
    <script src="{{asset('admin/assets/js/page_place_create.js')}}"></script>
@endpush