<form action="{{route('admin_room_create',$rooms->id)}}" enctype="multipart/form-data" method="post">
    @method('put')
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
                                    <input type="text" class="form-control" name="{{$language->code}}[name]" value="{{$rooms['name']}}" placeholder="What the name of place" autocomplete="off" {{$index !== 0 ?: "required"}}>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
     

        <div id="hightlight">
            <p class="lead">Amenities</p>
            <div class="checkbox row">
                @foreach($amenities as $item)
                    <div class="col-md-3 mb-10">
                        <label class="p-0"><input type="checkbox" class="flat" name="amenities[]" value="{{$item->id}}" {{isChecked($item->id, $rooms->amenities)}}> {{$item->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>


        <div id="media">
            <p class="lead">Media</p>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Thumbnail image:</strong></p>
                    <img id="preview_thumb" src="{{getImageUrl($rooms->thumb)}}" alt="">
                    <input type="file" class="form-control" id="thumb" name="thumb" accept="image/*">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 gallery">
                    <p><strong>Gallery images:</strong></p>
                    <div id="place_gallery_thumbs">
                         @if($rooms->gallery)
                            @foreach($rooms->gallery as $image)
                                <div class="col-sm-2 media-thumb-wrap">
                                    <figure class="media-thumb">
                                        <img src="{{getImageUrl($image)}}">
                                        <div class="media-item-actions">
                                            <a class="icon icon-delete" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16">
                                                    <g fill="#5D5D5D" fill-rule="nonzero">
                                                        <path d="M14.964 2.32h-4.036V0H4.105v2.32H.07v1.387h1.37l.924 12.25H12.67l.925-12.25h1.369V2.319zm-9.471-.933H9.54v.932H5.493v-.932zm5.89 13.183H3.65L2.83 3.707h9.374l-.82 10.863z"></path>
                                                        <path d="M6.961 6.076h1.11v6.126h-1.11zM4.834 6.076h1.11v6.126h-1.11zM9.089 6.076h1.11v6.126h-1.11z"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                            <input type="hidden" name="gallery[]" value="{{$image}}">
                                            <span class="icon icon-loader d-none"><i class="fa fa-spinner fa-spin"></i></span>
                                        </div>
                                    </figure>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control" id="gallery" accept="image/*">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Number of room <span class="text-danger">*</span></label>
                    <input type="number" required="" value="{{$rooms->number}}" min="1" max="100" placeholder="Number" name="number" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Hourly Price </label>
                    <input type="number" value="{{$rooms->hourlyprice}}" placeholder="Hourly Price" name="hourlyprice" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>One Person Price <span class="text-danger">*</span></label>
                     <input type="number" value="{{$rooms->onepersonprice}}" placeholder="One Person Price" name="onepersonprice" class="form-control" required="">
                   
                </div>
            </div> 
        </div>
        <div class="row">
             <div class="col-md-4">
                <div class="form-group">
                    <label>Two person Price </label>
                     <input type="number" value="{{$rooms->twopersonprice}}"  placeholder="Two person Price" name="twopersonprice" class="form-control">
                   
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>Three Person Price </label>
                     <input type="number" value="{{$rooms->fourpersonprice}}"  placeholder="Number" name="fourpersonprice" class="form-control">
                   
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>Four Person Price </label>
                     <input type="number" value="{{$rooms->fourpersonprice}}"  placeholder="Number" name="fourpersonprice" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Number of beds </label>
                        <input type="number" value="{{$rooms->beds}}" min="1" max="10" placeholder="Number" name="beds" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Room Size </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="size" value="{{$rooms->size}}" placeholder="Room size">
                            <div class="input-group-append">
                            <span class="input-group-text"> m<sup>2</sup></span>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Max Adults </label>
                    <input type="number" min="1" value="{{$rooms->adults}}" name="adults" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Max Children </label>
                    <input type="number" min="0" value="{{$rooms->children}}" name="children" class="form-control">
                </div>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-20">Update</button>
</form>
