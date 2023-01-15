                                               
                                               
                                               
                                               
                         @foreach($places as $place)
                         @php  $input = preg_replace("/[^a-zA-Z]+/", " ",  $place->slug);  @endphp
                          <tr>
                              <td>
                                
                                {{$place->id}}
                            
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" id="add_review" data-id="{{$place->id}}">
                                    Add review
                                  </button>
                            </td>
                              <td><img class="place_list_thumb" src="{{getImageUrl($place->thumb)}}" alt="page thumb"></td>
                             
                              <td>{{ucfirst($input)}}
                               <p class="text-danger">
                                {{count($place->reviews)}} Reveiws
                               </p>
                                
                              </td>
                              @if(isset($place['user']))
                                <td>{{$place['user']['created_at']}}</td>
                                <td><a href="tel:{{$place['user']['phone_number']}}">{{$place['user']['phone_number']}}</td>
                                  <td><a href="email:{{$place['user']['email']}}">{{$place['user']['email']}}</td>
                                  @endif

                                  @if(isset($place['rooms']['onepersonprice']))
                                      <td>
                                        @if ($place['rooms']['onepersonprice']<1000)
                                        {{$place['rooms']['onepersonprice']}}

                                            @elseif ($place['rooms']['onepersonprice']>1000
                                            &&$place['rooms']['onepersonprice']<2500)
@php
    $tax_amount=($place['rooms']['onepersonprice']*12)/100
@endphp
{{$place['rooms']['onepersonprice']+$tax_amount}}

                                            @else
                                            @php
                                            $tax_amount=($place['rooms']['onepersonprice']*18)/100
                                        @endphp
                                        {{$place['rooms']['onepersonprice']+$tax_amount}}
                                        @endif
                                      </td>
                                      @elseif (isset($place['rooms']['twopersonprice']))
                                      <td>
                                        @if ($place['rooms']['twopersonprice']<1000)
                                        {{$place['rooms']['twopersonprice']}}

                                            @elseif ($place['rooms']['twopersonprice']>1000
                                            &&$place['rooms']['twopersonprice']<2500)
@php
    $tax_amount=($place['rooms']['twopersonprice']*12)/100
@endphp
{{$place['rooms']['twopersonprice']+$tax_amount}}

                                            @else
                                            @php
                                            $tax_amount=($place['rooms']['twopersonprice']*18)/100
                                        @endphp
                                        {{$place['rooms']['twopersonprice']+$tax_amount}}
                                        @endif
                                      </td>

                                      @else
                                       <td>Pending</td>
                                       @endif
                              <td>
                                @if (isset($place['city']['name']))
                                {{$place['city']['name']}}
                                    
                                @endif
                              
                              </td>
                             
                              <td><span onclick="copy(this)">https://nsnhotels.com/hotels/{{$place->slug}}</span></td>
                             
                                  @if( auth()->user()->isAgent())
                                  <td>---</td>
                                  <td>
                                 <a class="btn btn-warning place_edit" href="{{route('admin_place_add_rooms', $place->id)}}">Add Booking</a><a class="btn btn-primary place_edit" href="{{route('admin_room_list',['hotel_id'=>$place->id])}}">{{__("Manage Rooms")}}</a></td>
                                  @else
                                   <td>
                                  @if($place->status === \App\Models\Place::STATUS_PENDING)
                                      {{STATUS[$place->status]}}
                                  @else
                                      <input type="checkbox" class="js-switch place_status" name="status" data-id="{{$place->id}}" {{isChecked(1, $place->status)}} />
                                  @endif
                                   </td>
                                           <td class="nsn-flex">
                                            
                                            <a class="btn btn-warning place_edit" href="{{route('admin_place_edit_view', $place->id)}}">Edit</a><a class="btn btn-warning place_edit" href="{{route('admin_place_add_rooms', $place->id)}}">Add Booking</a><a class="btn btn-primary place_edit" href="{{route('admin_room_list',['hotel_id'=>$place->id])}}">{{__("Manage Rooms")}}</a>
                              <form action="{{route('admin_place_delete',$place->id)}}" method="POST">@method('DELETE')@csrf<button type="button" class="btn btn-danger  place_delete">Delete</button>
                              </form>@if($place->status === \App\Models\Place::STATUS_PENDING)<button type="button" class="btn btn-success place_approve" data-id="{{$place->id}}">Approve</button>
                              @endif
                            
                            </td>
                              @endif
                             
                          </tr>
                      @endforeach
                      
                      <tr>
                     <td colspan="3" align="center">
                      {!! $places->links() !!}
                     </td>
                    </tr>
                    


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

<script>
$(document).on('click','#add_review',function(){
    let id=$(this).data('id');
$('#product_id').val(id)

})

</script>