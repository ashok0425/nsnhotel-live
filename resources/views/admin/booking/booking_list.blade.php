@extends('admin.layouts.template')
@push('styles')
     <link href="{{asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
     <style>
        .dataTables_filter {
        display: none!important;   
       }
      </style>
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
                                        href="">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Booking</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                      
          
               <div class="col-md-6">
                <label for="">Enter Hotel name or customer Name/Email/Phone</label>
                  <input type="search" value=""  placeholder="Enter hotel" class="keyword form-control">
               </div>

               

             <div class="col-md-3">
<label for="">Booked From</label>
                <input type="date" value="" id="from" placeholder="Enter hotel" class="form-control">
             </div>

             <div class="col-md-3">
                <label for="">Booked To</label>
                                <input type="date" value="" id="to" placeholder="Enter hotel" class="form-control">
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
                                    <div class="">
                                        <table id="bookingTable" class="table border" border="1px solid gray">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Hotel</th>

                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>

                                                    <th width="22%">Booking Detail </th>
                                                       <th width="22%">Payment</th>
                                                       <th>Status</th>
                                                    <th class="action" width="18%">Action</th>
                                                </tr>
                                            </thead>
                                          
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.booking.modal_booking_detail')
@stop

@push('scripts')

     <script src="{{asset('admin/assets/js/page_booking.js')}}"></script>


     <script>
        $(document).ready(function() {
            bookingTable =$('#bookingTable').DataTable({
                processing: true,
                dom:'Bfrtip',
            bDestroy:"true",

                lengthMenu: [
                            [10, 25, 50, 100,-1],
                            ['10 row', '25 row', '50 row','100 row', 'All Rows']
                        ],
                 buttons: [{
                                extend: 'print',
                                exportOptions: {
                                    stripHtml: true,
                                    columns: ':visible:not(:last-child)'
                                }
                            },
                            
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    stripHtml: true,
                                    columns: ':visible:not(:last-child)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    stripHtml: true,
                                    columns: ':visible:not(:last-child)'
                                }
                            },
        
                            {
                                extend: 'colvis',
        
                            },
                            'pageLength',
                        ],
                serverSide: true,
                ajax: {
                    url:'{{route('admin_booking_list')}}',
                    "data": function(d){
                     d.from=$('#from').val(),
                     d.to=$('#to').val(),
                     d.keyword=$('.keyword').val()
    
                    }
        
                },
                columns: [
                    { data: 'id', name: 'booking_id' },
                    { data: 'hotel', name: 'hotel' },

                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'phone' },
                    { data: 'phone', name: 'phone' },


                    { data: 'booking_detail', name: 'booking_detail' },
                    { data: 'payment', name: 'payment' },    
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
        
              
                ]
            });
    
            $(document).on('change','#from,#to',function(){
                bookingTable.ajax.reload()
            })
    
            $(document).on('keyup','.keyword',function(){
                bookingTable.ajax.reload()
            })
        });
    
            </script> 
               
    
    
    <script>
@endpush
