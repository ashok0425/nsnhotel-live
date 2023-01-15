
   <div class=" d-block d-md-none custom-bg-white">
    <h2 class="container font-weight-bold text-dark custom-fs-20 custom-fw-600 py-3">Explore your next destination</h2>
    @php
    use App\Models\city;
        $cities=City::whereIn('id', [57,151,154,125,39,95,124,123,139,144,104,65])->get();
    @endphp
        <div class="product__slider splide">
          <div class="splide__track">
              <ul class="splide__list gallery" id="productSlider">
               
             
                  @foreach($cities as $city)
              
                  <a href="{{getImageUrl($city->thumb)}}" class="splide__slide shadow-sm location_tab w-25" data-id="{{$city->id}}" data-toggle="modal" data-target="#location_modal">
                 
                      <img src="{{getImageUrl($city->thumb)}}" class="img-fluid radius_50 " alt="{{$city->name}}" >
                      <p class="text-center mt-1 text-dark font-weight-bold">{{$city->name}}</p>
                  </a>
                  @endforeach
             
              </ul>
          </div>
      </div>
   </div>

<!-- Modal -->
<div class="modal fade" id="location_modal" tabindex="-1" role="dialog" aria-labelledby="location_modalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="d-flex justify-content-around">
        <a href="#" type="button" data-dismiss="modal" class="font_20">⬅</a>
        <input type="search" class="from-control py-3 w-75 search_class" placeholder="Search city or location">
      </div>
      <div class="modal-body all_location">
        
      </div>
   
    </div>
  </div>
</div>


@push('scripts')
    
<script src="{{asset('splide.min.js')}}"></script>
<script>
  new Splide('.product__slider.splide', {
   type: 'loop',
   autoWidth: true,
   autoHeight: true,
   perPage: 2,
   focus: 'center',
   gap: 5,
   pagination: false,
}).mount();

let id;
$(document).on('click','.location_tab',function(){
 id=$(this).data('id')
 $('.search_class').val('')
  loadcity(id)
})

$(document).on('keyup','.search_class',function(){
let keyword=$(this).val()
  loadcity(id,keyword)
})


function loadcity($id,$keyword=''){
  $.ajax({
    url:'{{url('load-subcity')}}',
    data:{id:$id,search:$keyword},
    success:function(res){
      console.log(res);
      $('.all_location').html(res)
    }
  })
}
</script>
@endpush