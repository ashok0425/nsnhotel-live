@extends('admin.layouts.template')
@push('styles')
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
                                <div class="page-title">Users</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">User List</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                      
          
                        <div class="col-md-3">
                         <label for=""> Name/Email/Phone</label>
                           <input type="search" value=""  placeholder="Enter hotel" class="keyword form-control">
                        </div>
         
                        
         
                      <div class="col-md-3">
         <label for="">Created From</label>
                         <input type="date" value="" id="from" placeholder="Enter hotel" class="form-control">
                      </div>
         
                      <div class="col-md-3">
                         <label for="">Created To</label>
                                         <input type="date" value="" id="to" placeholder="Enter hotel" class="form-control">
                                      </div>
         
                                      <div class="col-md-3">
                                        <label for="">Role</label>
                                                      <select name="roles" id="roles" class="form-control">
                                                        <option value="">--select--</option>
                                                        <option value="1">User</option>
                                                        <option value="2">Partner</option>
                                                        <option value="3">Agent</option>


                                                      </select>
                                                     </div>
                     
               
                   </div>
                    <div class="row">
                      
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Users Information</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                     <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_user" type="button">+ Add Users</button>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table id="userTable" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">ID</th>
                                                    <th width="5%">Avatar</th>
                                                    <th width="2%">Name</th>
                                                    <th width="5%">Phone</th>
                                                    <th width="10%">Email</th>


                                                    <th width="7%">Status</th>
                                                    <th width="7%">Is Admin</th>
                                                    <th width="7%">Is Partner</th>
                                                    <th width="10%">Created at</th>
                                                    <th width="15%">Action</th>
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
@include('admin.user.modal_add_users')

@stop


@push('scripts')
  
     <script src="{{asset('admin/assets/js/page_user.js')}}"></script>
     <script>
    
    $(document).ready(function() {
        userTables =$('#userTable').DataTable({
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
                url:'{{route('admin_user_list')}}',
                "data": function(d){
                 d.keyword=$('.keyword').val(),
                 d.from=$('#from').val()
                 d.to=$('#to').val()
                 d.role=$('#roles').val()



                }
    
            },
          
            columns: [
                { data: 'id', name: 'id' },
                { data: 'avatar', name: 'avatar' },
                { data: 'name', name: 'name' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'email', name: 'email' },

                { data: 'status', name: 'status' },

                { data: 'is_admin', name: 'is_admin' },
                { data: 'is_partner', name: 'is_partner' },
                { data: 'created_at', name: 'created_at' },    
                { data: 'action', name: 'action' },
    
          
            ]
        });
        $(document).on('change','#from,#to,#roles',function(){
            userTables.ajax.reload()
            })
    

        $(document).on('keyup','.keyword',function(){
            userTables.ajax.reload()
        })





        $(document).on('click','#edit_btn',function(e){
            $('#btn_add_user').click()
            let data=$(this);
           $('#name').val(data.data('name'))
           $('#partner_email').val(data.data('email'))
           $('#partner_phone_no').val(data.data('phone_number'))
           let src=$(this).data('scr')
           $('#preview_icon').attr('src',src);
           let action="{{route('admin_user_update')}}";
           $('#user_form').attr('action',action);
           $('#users_id').val(data.data('id'));
           $('#submit_add_users').html('update');
        })
  



    });

        </script> 


@endpush