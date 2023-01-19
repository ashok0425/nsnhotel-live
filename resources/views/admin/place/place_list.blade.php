@extends('admin.layouts.template')
   <style>
     .dataTables_filter {
     display: none!important;   
    }
   </style>
@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Hotels</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="index">Hotels</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="#">Hotels</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                 <div class="row">
                                          <div class="col-md-3">        
                             <select class = "form-control js-example-basic-multiple"  name ="city_id" id = "cities">
                                <option value = "">Cities</option>

                                 @foreach($cities as $cit)
                                         <option value = "{{$cit->id}}">{{$cit->name}}</option>
                                       @endforeach
                                 </select></div>
                            
                                 <div class="col-md-3">
                                    <input type="search" value="" id="keyword" placeholder="Enter hotel" class="form-control">
                                 </div>
                        
                            </div>
                    <div class="row">
                     
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Hotels</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-primary" href="{{route('admin_place_create_view')}}">+ Add Hotel</a>
                                    </div>
                                      
                                </div> 
                              
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table id="placeTable" class="table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%">Thumb</th>
                                                    <th width="20%"> Hotel</th>
                                                    <th width="20%"> Address</th>
                                                    <th width="20%"> City</th>
                                                    <th >Name </th>
                                                    <th >Phone </th>
                                                    <th >Email </th>


                                                    <th width="9%">Price </th>

                                                    <th width="9%">Url</th>
                                                    <th width="7%">Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    
                                            </tbody>
                                             
                                        </table>
                                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                    </div>
                                  
                                </div>
                       
                            </div>
                              
                        </div>
                    </div>
                </div>
            </div>

            

            
                    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{route('admin_store_review')}}" method="POST" action="">
            @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="product_id" id="product_id">
          <div class="form-group">
            <label >Rating</label>
            <select name="rating" id="" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>

            </select>
          </div>

          <div class="form-group">
            <label >Comment</label>
            <textarea name="comment" id="" class="form-control" rows="3" required>

            </textarea>
          </div>

          <div class="form-group">
            <label >Avg Rating</label>
                 <input type="text" name="avg_rev" class="form-control">
          </div>

          <div class="form-group">
            <label >Total Review</label>
            <input type="text" name="total_rev" class="form-control">

          </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
      </div>
    </div>
@stop

@push('scripts')

<script>
  
    const span = document.querySelector("span");
    
    function copy(that){
    var inp =document.createElement('input');
    document.body.appendChild(inp)
    inp.value =that.getAttribute('url');
    inp.select();
    document.execCommand('copy',false);
    inp.remove();
    alert('Copy Done')
    }
    </script>
<script>
    $(document).ready(function() {
        placeTables =$('#placeTable').DataTable({
            processing: true,
            dom:'Bfrtip',
            bDestroy:"true",

            lengthMenu: [
                        [10, 25, 50, 100,500,1000,-1],
                        ['10 row', '25 row', '50 row','100 row','500 rows','1000 rows', 'All Rows']
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
                url:'{{route('admin_place_list')}}',
                "data": function(d){
                 d.city=$('#cities').val(),
                 d.keyword=$('#keyword').val()

                }
    
            },
          


            columns: [
                { data: 'thumb', name: 'thumb' },
                { data: 'hotel', name: 'hotel' },
                { data: 'address', name: 'address' },
                { data: 'city', name: 'city' },
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'price', name: 'price' },
                { data: 'url', name: 'url' },    
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
    
          
            ]
        });

        $(document).on('change','#cities',function(){
            placeTables.ajax.reload()
        })

        $(document).on('keyup','#keyword',function(){
            placeTables.ajax.reload()
        })
    });

        </script> 
            <script src="{{asset('admin/assets/js/page_place.js')}}"></script>


<script>
$(document).on('click','#add_review',function(){
    let id=$(this).data('id');
$('#product_id').val(id)

})

</script>
@endpush