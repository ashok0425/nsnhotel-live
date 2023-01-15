@extends('partner.layouts.template')
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
                                    <form action="" enctype="multipart/form-data" method="post">
                                       @method('POST')
                                            @csrf
                                            @php
                                           $date_all_month =   $date;
                                            if($type == 0){
                                            $i = 0;
                                            }else{
                                            $i = 1;
                                            }

                                            @endphp
                                             <div class="row">
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <input type="text" class="form-control digitsOnly bg-warning" value="Price Pattern" disabled="">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <input type="text" class="form-control digitsOnly valueEnter1 bg-warning" value="">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <input type="text" class="form-control digitsOnly valueEnter2 bg-warning" value="">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <input type="text" class="form-control digitsOnly valueEnter3 bg-warning" value="">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <input type="text" class="form-control digitsOnly valueEnter4 bg-warning" value="">
                                                </div>
                                            </div>
                                                @for($i; $i <= $totaldays; $i++)

                                                 @php
                                                $time= strtotime($date_all_month);
                                                $months=date('Y-m-d',strtotime($date_all_month));
                                                  $result = getCalender($months,$hotel_id);
                                                   $day=date('D',strtotime($date_all_month));
                                                    if($day == 'Sat' || $day == 'Sun') {
                                                     $cls = 'text-light bg-info';
                                                    } else {
                                                      $cls ='';
                                                    }

                                                @endphp

                                                <div class="row">
                                                <div class="col-md-2 col-sm-2 col-xs-4">
                                                <label>Date</label>
                                                <input type="text" name="date[]" value="{{$date_all_month}}" class="form-control {{$cls}}">
                                                </div>
                                                
                                                 <div class="col-md-2 col-sm-2 col-xs-2">
                                                <label>Price One Person</label>
<input type="text" name="price_one_person[]" class="form-control digitsOnly valueEnter12 {{$cls}}" value="@if(isset($result) && ($result->date == $date_all_month) ){{trim($result->price_one_person)}}  @endif
                                                " min="1" max="10000">
                                                </div>
                                                 <div class="col-md-2 col-sm-2 col-xs-4">
                                                <label>Price Two Person</label>
<input type="text" name="price_two_person[]" class="form-control digitsOnly valueEnter21 {{$cls}}" value="@if(isset($result) && ($result->date == $date_all_month) ){{trim($result->price_two_person)}}  @endif
                                                " min="1" max="10000">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-4">
                                                <label>Price Three Person</label>
<input type="text" name="price_three_person[]" class="form-control digitsOnly valueEnter31 {{$cls}}" value="@if(isset($result) && ($result->date == $date_all_month) ){{$result->price_three_person}}  @endif
                                                " min="1" max="10000">
                                                </div>
                                                 <div class="col-md-2 col-sm-2 col-xs-4">
                                                <label>Discount Percentage</label>
<input type="text" name="discount_percentage[]" class="form-control digitsOnly valueEnter41 {{$cls}}"  value="@if(isset($result) && ($result->date == $date_all_month) ){{$result->discount_percentage}}  @endif
                                                " min="1" max="10000">
                                                </div>
                                                @if(isset($result))
                                                <input type="hidden" name="calender_id[]" value="{{$result->id}}">
                                                @endif
                                                <input type="hidden" name="hotel_id" value="{{$hotel_id}}">
                                                <input type="hidden" name="room_id" value="{{$room_id}}">
                                            </div>
                                            @php
                                            $date_all_month = date('Y-m-d', strtotime("+1 day", strtotime($date_all_month)));
                                            @endphp
                                            @endfor
                                            <div class="m-2 text-right">
                                             <input type="submit" value="Submit" class="btn btn-danger">
                                             <div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
  jQuery('.digitsOnly').keypress(function(event){
  if(event.which !=8 && isNaN(String.fromCharCode(event.which))){
    event.preventDefault();
  }
});

$(".valueEnter1").keyup(function () {
     $(this).val($(this).val().replace(/ +?/g, ''));
    $('.valueEnter12').not(this).val($(this).val().replace(/ +?/g, ''));
 });

$(".valueEnter2").keyup(function () {
    $(this).val($(this).val().replace(/ +?/g, ''));
    $('.valueEnter21').not(this).val($(this).val().replace(/ +?/g, ''));
 });

$(".valueEnter3").keyup(function () {
    $(this).val($(this).val().replace(/ +?/g, ''));
    $('.valueEnter31').not(this).val($(this).val().replace(/ +?/g, ''));
 });
$(".valueEnter4").keyup(function () {
    $(this).val($(this).val().replace(/ +?/g, ''));
    $('.valueEnter41').not(this).val($(this).val().replace(/ +?/g, ''));
 });

});


            </script>
@stop
