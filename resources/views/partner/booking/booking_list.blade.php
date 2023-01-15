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
                                <div class="page-title">Booking</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Booking</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Booking</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable d-none d-md-block">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Place</th>
                                                    <th>Booking at</th>
                                                    <th>Status</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($bookings as $booking)
                                                    <tr>
                                                        <td>{{$booking->id}}</td>
                                                        @if($booking->type === \App\Models\Booking::TYPE_BOOKING_FORM)
                                                            @php
                                                                $booking_name = $booking['user']['name'];
                                                                $booking_email = $booking['user']['email'];
                                                                $booking_phone = $booking['user']['phone_number'];
                                                            @endphp
                                                            <td>{{$booking_name}}
                                                                <small>(UID: {{$booking['user']['id']}})</small>
                                                            </td>
                                                        @else
                                                            @php
                                                                $booking_name = $booking->name;
                                                                $booking_email = $booking->email;
                                                                $booking_phone = $booking->phone_number;
                                                            @endphp
                                                            <td>{{$booking_name}}</td>
                                                        @endif

                                                        @if(isset($booking['place']))
                                                            <td><a href="{{route('place_detail', $booking['place']['slug'])}}" target="_blank">{{$booking['place']['name']}}</a></td>
                                                        @else
                                                            <td><i>Place deleted</i></td>
                                                        @endif
                                                        <td>{{formatDate($booking->created_at, 'H:i d/m/Y')}}</td>
                                                        <td>
                                                            @if($booking->status === \App\Models\Booking::STATUS_PENDING)
                                                                <span class="status-pending">Pending</span>
                                                            @elseif($booking->status === \App\Models\Booking::STATUS_ACTIVE)
                                                                <span class="status-approved">Approved</span>
                                                            @else
                                                                <span class="status-cancel">Cancel</span>
                                                            @endif
                                                        </td>
                                                        <td class="nsn-flex action">
                                                            @if(isset($booking['place']))
                                                                <button type="button" class="btn btn-primary booking_detail"
                                                                        data-id="{{$booking->id}}"
                                                                        data-name="{{$booking_name}}"
                                                                        data-email="{{$booking_email}}"
                                                                        data-phone="{{$booking_phone}}"
                                                                        data-place="{{$booking['place']['name']}}"
                                                                        data-bookingdatetime="{{$booking->time}} {{formatDate($booking->date, 'd/m/Y')}}"
                                                                        data-bookingat="{{formatDate($booking->created_at, 'H:i d/m/Y')}}"
                                                                        data-status="{{STATUS[$booking->status]}}"
                                                                        data-message="{{$booking->message}}"
                                                                        data-adult="{{$booking->numbber_of_adult}}"
                                                                        data-children="{{$booking->numbber_of_children}}"
                                                                        data-type="{{$booking->type}}"
                                                                >Detail
                                                                </button>
                                                                @if($booking->status === \App\Models\Booking::STATUS_PENDING || $booking->status === \App\Models\Booking::STATUS_DEACTIVE)
                                                                    <form class="d-inline" action="{{route('partner_booking_update_status')}}" method="POST">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                                                        <input type="hidden" name="status" value="{{\App\Models\Booking::STATUS_ACTIVE}}">
                                                                        <button type="button" class="btn btn-success booking_approve" data-id="{{$booking->id}}">Approve</button>
                                                                    </form>
                                                                @endif
                                                                @if($booking->status === \App\Models\Booking::STATUS_PENDING || $booking->status === \App\Models\Booking::STATUS_ACTIVE)
                                                                    <form class="d-inline" action="{{route('partner_booking_update_status')}}" method="POST">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                                                        <input type="hidden" name="status" value="{{\App\Models\Booking::STATUS_DEACTIVE}}">
                                                                        <button type="button" class="btn btn-danger booking_cancel">Cancel</button>
                                                                    </form>
                                                                @endif
                                                            @else
                                                                <i>Place deleted</i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                               
                                            </tbody>
                                        </table>
                                    </div>



<div class="d-md-none d-block">
                                    @foreach($bookings as $booking)
                                    <div class="card my-2 p-2 shadow">
                                        <table  class="w-100 table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <td>{{$booking->id}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Name</th>
                                                    @if($booking->type === \App\Models\Booking::TYPE_BOOKING_FORM)
                                                    @php
                                                        $booking_name = $booking['user']['name'];
                                                        $booking_email = $booking['user']['email'];
                                                        $booking_phone = $booking['user']['phone_number'];
                                                    @endphp
                                                    <td>{{$booking_name}}
                                                        <small>(UID: {{$booking['user']['id']}})</small>
                                                    </td>
                                                @else
                                                    @php
                                                        $booking_name = $booking->name;
                                                        $booking_email = $booking->email;
                                                        $booking_phone = $booking->phone_number;
                                                    @endphp
                                                    <td>{{$booking_name}}</td>
                                                @endif
                                                </tr>
                                                <tr>
                                                    <th>Place</th>
                                                    @if(isset($booking['place']))
                                                    <td><a href="{{route('place_detail', $booking['place']['slug'])}}" target="_blank">{{$booking['place']['name']}}</a></td>
                                                @else
                                                    <td><i>Place deleted</i></td>
                                                @endif
                                                </tr>

                                                <tr>
                                                    <th>Booking at</th>
                                                    <td>{{formatDate($booking->created_at, 'H:i d/m/Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        @if($booking->status === \App\Models\Booking::STATUS_PENDING)
                                                            <span class="status-pending">Pending</span>
                                                        @elseif($booking->status === \App\Models\Booking::STATUS_ACTIVE)
                                                            <span class="status-approved">Approved</span>
                                                        @else
                                                            <span class="status-cancel">Cancel</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                                                                        <td class="nsn-flex action">
                                                                                                            @if(isset($booking['place']))
                                                                                                                <button type="button" class="btn btn-primary booking_detail"
                                                                                                                        data-id="{{$booking->id}}"
                                                                                                                        data-name="{{$booking_name}}"
                                                                                                                        data-email="{{$booking_email}}"
                                                                                                                        data-phone="{{$booking_phone}}"
                                                                                                                        data-place="{{$booking['place']['name']}}"
                                                                                                                        data-bookingdatetime="{{$booking->time}} {{formatDate($booking->date, 'd/m/Y')}}"
                                                                                                                        data-bookingat="{{formatDate($booking->created_at, 'H:i d/m/Y')}}"
                                                                                                                        data-status="{{STATUS[$booking->status]}}"
                                                                                                                        data-message="{{$booking->message}}"
                                                                                                                        data-adult="{{$booking->numbber_of_adult}}"
                                                                                                                        data-children="{{$booking->numbber_of_children}}"
                                                                                                                        data-type="{{$booking->type}}"
                                                                                                                >Detail
                                                                                                                </button>
                                                                                                                @if($booking->status === \App\Models\Booking::STATUS_PENDING || $booking->status === \App\Models\Booking::STATUS_DEACTIVE)
                                                                                                                    <form class="d-inline" action="{{route('partner_booking_update_status')}}" method="POST">
                                                                                                                        @method('PUT')
                                                                                                                        @csrf
                                                                                                                        <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                                                                                                        <input type="hidden" name="status" value="{{\App\Models\Booking::STATUS_ACTIVE}}">
                                                                                                                        <button type="button" class="btn btn-success booking_approve" data-id="{{$booking->id}}">Approve</button>
                                                                                                                    </form>
                                                                                                                @endif
                                                                                                                @if($booking->status === \App\Models\Booking::STATUS_PENDING || $booking->status === \App\Models\Booking::STATUS_ACTIVE)
                                                                                                                    <form class="d-inline" action="{{route('partner_booking_update_status')}}" method="POST">
                                                                                                                        @method('PUT')
                                                                                                                        @csrf
                                                                                                                        <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                                                                                                        <input type="hidden" name="status" value="{{\App\Models\Booking::STATUS_DEACTIVE}}">
                                                                                                                        <button type="button" class="btn btn-danger booking_cancel">Cancel</button>
                                                                                                                    </form>
                                                                                                                @endif
                                                                                                            @else
                                                                                                                <i>Place deleted</i>
                                                                                                            @endif
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

            @include('partner.booking.modal_booking_detail')
@stop

@push('scripts')
     <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/pages/table/table_data.js')}}"></script>
     <script src="{{asset('admin/assets/js/page_booking.js')}}"></script>
@endpush
