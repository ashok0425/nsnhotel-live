@extends('admin.layouts.template')

@section('main')
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">City</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="{{route('admin_dashboard')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="{{route('admin_city_list')}}">City</a>&nbsp;</i>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                         <form method = "get">
                            <table>
                                <tr>
                            <th><input type = "text" name = "name" class ="form-control"></th>
                            <td><input type = submit Value = "search"></td></tr>
                            </table>
                        </form>
                        <div class="col-md-12"> 
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>City</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <button class="btn btn-primary" id="btn_add_city" type="button">+ Add City</button>
                                    </div>
        
                                </div>
                                <div class="card-body ">

                                   <!--  <div class="x_title">
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label>Select Country:</label>
                                                <form>
                                                    <select class="form-control" id="select_country_id" name="country_id" onchange="this.form.submit()">
                                                        <option value="">--- Select country ---</option>
                                                        @foreach($countries as $country)
                                                            @if($country_id)
                                                                <option value="{{$country->id}}" {{isSelected($country->id, $country_id)}}>{{$country->name}}</option>
                                                            @else
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> -->
                                    <div class="table">
                                        <table id="example1" class="display full-width table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                <th width="3%">ID</th>
                                                <th width="5%">Thumb</th>
                                                <th width="15%">City Name</th>
                                                <th>Description</th>
                                                <th>Priority</th>
                                                <th>slug</th>
                                                <th width="3%">Status</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($cities as $city)
                                                    <tr>
                                                        <td>{{$city->id}}</td>
                                                        <td><img class="city_list_img" src="{{getImageUrl($city->thumb)}}" alt="city thumb"></td>
                                                        <td>{{$city->name}}                                  </td>
                                                        <td>{{$city->description}}</td>
                                                        <td>{{$city->priority}}</td>
                                                         <td>
                                                       <a href =" https://nsnhotels.com/city/.{{$city->slug}}" > https://nsnhotels.com/city/.{{$city->slug}}</a>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="js-switch city_status" data-id="{{$city->id}}" {{isChecked($city->status, 1)}}/>
                                                            <br>
                                                            <br>
                                                            @if ($city->popular==1)
                                                            

                                                            <a href="{{route('admin_list-as-popular',['city'=>$city->id,'status'=>0])}}" class="btn btn-xs btn-success">Popular</a>
                                                            @else 
                                                            <a href="{{route('admin_list-as-popular',['city'=>$city->id,'status'=>1])}}" class="btn btn-xs btn-danger">Popular</a>
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning city_edit"
                                                                    data-id="{{$city->id}}"
                                                                    data-countryid="{{$city->country_id}}"
                                                                    data-name="{{$city->name}}"
                                                                    data-slug="{{$city->slug}}"
                                                                    data-intro="{{$city->intro}}"
                                                                    data-description="{{$city->description}}"
                                                                    data-thumb="{{$city->thumb}}"
                                                                    data-banner="{{$city->banner}}"
                                                                    data-besttimetovisit="{{$city->best_time_to_visit}}"
                                                                    data-currency="{{$city->currency}}"
                                                                      data-location="{{$city->location}}"
                                                                    data-language="{{$city->language}}"
                                                                    data-lat="{{$city->lat}}"
                                                                    data-lng="{{$city->lng}}"
                                                                    data-priority="{{$city->priority}}"
                                                                    data-translations="{{$city->translations}}"
                                                                    data-seotitle="{{$city->seo_title}}"
                                                                    data-seodescription="{{$city->seo_description}}"
                                                                    data-seo_keywords="{{$city->seo_keywords}}"
                                                                    data-popular="{{$city->popular}}"
                                                            >Edit
                                                            </button>
                                                            <form class="d-inline" action="{{route('admin_city_delete',$city->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-danger city_delete">Delete</button>
                                                            </form>

                                                            <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#pricechangemodal"
                                                            id="price_modify"
                                                            data-id="{{$city->id}}">
                                                                Modify price
                                                              </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                 <div class="ml-auto">
                               {{ $cities->links() }}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            @include('admin.city.modal_add_city')


            <div class="modal fade" id="pricechangemodal" tabindex="-1" role="dialog" aria-labelledby="pricechangemodalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="pricechangemodalLabel">Modify Price</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('admin_modify_price')}}">
                        <input type="hidden" id="city_ids" name="city_id">
                       <div class="form-group">
                        <label for="">Enter percent need to Increase or Decrease</label>
                        <input type="number" name="percent" placeholder="Enter percent" class="form-control" required>
                       </div>
                       <div class="form-group">
  <label for="b">Increase or Decrease</label>
  <select name="type" id="" class="form-control" required>
   <option value="">--Select Any--</option>
   <option value="1">Increase</option>
   <option value="2">Decrease</option>

  </select>
                       </div>
                        <button class="btn btn-primary">Apply</button>
                      </form>
                    </div>
                  
                  </div>
                </div>
              </div>
            
@stop
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
@push('scripts')

     <script src="{{asset('admin/assets/js/page_city.js')}}"></script>

     <script>
        $(document).on('click','#price_modify',function(){
            let city_id=$(this).data('id')
            $('#city_ids').val(city_id);
    })
     </script>
@endpush

