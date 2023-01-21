<form action="{{route('admin_room_create',$hotel_id)}}" enctype="multipart/form-data" method="post">
    @csrf

    <div class="tab-content">

        <ul class="nav nav-tabs bar_tabs" role="tablist">
            @foreach($languages as $index => $language)
                <li class="nav-item">
                    <a class="nav-link {{$index !== 0 ?: "active"}}" id="home-tab" data-toggle="tab" href="#language_{{$language->code}}" role="tab" aria-controls="" aria-selected="">{{$language->name}}</a>
                </li>
            @endforeach
        </ul>

        <div id="genaral">
            <p class="lead">Genaral</p>

            <div class="form-group row">
                <div class="col-md-12">
                    <div class="tab-content">
                        @foreach($languages as $index => $language)
                            <div class="tab-pane fade show {{$index !== 0 ?: "active"}}" id="language_{{$language->code}}" role="tabpanel" aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label for="room_name">Room name
                                        <small>({{$language->code}})</small>
                                        : *</label>
                                    <input type="text" class="form-control" name="{{$language->code}}[name]" placeholder="What the name of room" autocomplete="off" {{$index !== 0 ?: "required"}}>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
     

        <!--<div id="hightlight">-->
        <!--    <p class="lead">Amenities</p>-->
        <!--    <div class="checkbox row">-->
        <!--        @foreach($amenities as $item)-->
        <!--            <div class="col-md-3 mb-10">-->
        <!--                <label class="p-0"><input type="checkbox" class="flat" name="amenities[]" value="{{$item->id}}"> {{$item->name}}</label>-->
        <!--            </div>-->
        <!--        @endforeach-->
        <!--    </div>-->
        <!--</div>-->


        <!--<div id="media">-->
        <!--    <p class="lead">Media</p>-->
        <!--    <div class="row">-->
        <!--        <div class="col-md-6">-->
        <!--            <p><strong>Thumbnail image:</strong></p>-->
        <!--            <img id="preview_thumb" src="https://via.placeholder.com/120x150?text=thumbnail">-->
        <!--            <input type="file" class="form-control" id="thumb" name="thumb" accept="image/*">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="row">-->
        <!--        <div class="col-md-12 gallery">-->
        <!--            <p><strong>Gallery images:</strong></p>-->
        <!--            <div id="place_gallery_thumbs"></div>-->
        <!--        </div>-->
        <!--        <div class="col-md-6">-->
        <!--            <input type="file" class="form-control" id="gallery" accept="image/*">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="row">
        
            <div class="col-md-4">
                <div class="form-group">
                    <label>Number of room <span class="text-danger">*</span></label>
                    <input type="number" required="" value="1" min="1" max="100" placeholder="Number" name="number" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Hourly Price </label>
                    <input type="number" value="" placeholder="Hourly Price" name="hourlyprice" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>One Person Price <span class="text-danger">*</span></label>
                     <input type="number" value="" placeholder="One Person Price" name="onepersonprice" class="form-control" required="">
                   
                </div>
            </div>
        </div>
         <div class="row">
             <div class="col-md-4">
                <div class="form-group">
                    <label>Two person Price </label>
                     <input type="number" value=""  placeholder="Two person Price" name="twopersonprice" class="form-control">
                   
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>Three Person Price </label>
                     <input type="number" value=""  placeholder="Number" name="threepersonprice" class="form-control">
                   
                </div>
            </div>
            <!-- <div class="col-md-4">-->
            <!--    <div class="form-group">-->
            <!--        <label>Four Person Price </label>-->
            <!--         <input type="number" value=""  placeholder="Number" name="fourpersonprice" class="form-control">-->
            <!--    </div>-->
            <!--</div>-->
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Number of beds </label>
                        <input type="number" value="1" min="1" max="10" placeholder="Number" name="beds" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Room Size </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="size" value="0" placeholder="Room size">
                            <div class="input-group-append">
                            <span class="input-group-text"> m<sup>2</sup></span>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Max Adults </label>
                    <input type="number" min="1" value="1" name="adults" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Max Children </label>
                    <input type="number" min="0" value="0" name="children" class="form-control">
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>Before Discount Price </label>
                    <input type="number" min="1" value="" name="before_discount_price" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>% Discount</label>
                    <input type="number" min="0" value="" name="discount_percent" class="form-control">
                </div>
            </div>

             <div class="col-md-6">
                <div class="col-md-12 gallery">
                    <p><strong>Gallery images:</strong></p>
                    <div id="place_gallery_thumbs"></div>
                </div>
                    <input type="file" class="form-control" id="gallery" accept="image/*" multiple>
            </div>
        </div>

       
        <div class="ln_solid"></div>

    </div>

    <button type="submit" class="btn btn-primary mt-20">Submit</button>
</form>
