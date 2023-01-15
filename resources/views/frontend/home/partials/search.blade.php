<style>
     input:checked span{
        background: #000!important;
    }
</style>
<div class="nsn-search">
        
           
                <div class="card border-0 p-3">
                    <div class="card-body py-0">
						<p class="text-secondary ">Let's Start to Find Your Best Stay</p>

                <form class="searchform" action="{{route('page_search_listing')}}" method="get" id="search-hotel">
                    <div class="row m-0">
                        <div class="col-12 col-sm-12 col-md-12 p-0">
                            <div class="form-group searchinput whereicon px-0 mx-0">
                                <span class="labeltext">Where are you going?</span>
                                <input class="form-control open-suggestion" id="location_search" name="location_search" type="text" placeholder="e.g. - Area, Landmark or Property Name" autocomplete="off">
                                <input type="hidden" id="city" name = "city">
                                <input type="hidden" id="city" name = "search_filter" value="1">

                                <input type="hidden" id="hotel_id"> 
                                <input type="hidden" id="lat" name="lat"> 
                                <input type="hidden" id="lng" name="lng"> 

                                <input type="hidden" id="total_room" name="total_room" value="1"> 
                                <input type="hidden" id="total_guest" name="total_guest" value="1"> 

                                <input type="hidden" id="token" value="{{csrf_token()}}"> 


                                    <input type="hidden" name="search" id="search">
                                <span class="fas fa-globe pt-2 gpsicon"><a href="#">Near me</a></span>
                            </div>
                            <div class="search-result search-suggestions"></div>  
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 p-0">
                            <div class="form-group searchinput datecontainer border pb-2">
                                <span class="labeltext"> Check in Check out</span>
                                <input type="text" class="form-control"  id="checkInOut" value="">
                                <input type="hidden" class="check-in-field" name="check_in_field" value="">
                                <input type="hidden" class="check-out-field" name="check_out_field"  value="">
                            </div>
                            
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 p-0">
                            <div class="form-group searchinput guestcontainer border pb-2">
                                <span class="labeltext">How many you are?</span>
                                <div class="panel-dropdown custom-bg-white">
                                    <div class="form-control guestspicker">
                                    <span id ="room">1</span> Room, <span class="gueststotal">1</span> Guest</div>
                                    <div class="panel-dropdown-content custom-bg-white">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left">
                                                <label class="custom-text-primary custom-fw-700 custom-fs-14">Room</label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <label class="custom-text-primary custom-fw-700 custom-fs-14">Guest</label>							
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row" id="room1">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left">
                                                <label>Room 1</label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <div class="guests-button">
                                                    <div class="minus" onclick="guest_room()"></div>
                                                    <input type="text" name="booking-Room" id="guest"class="booking-guests" value="1" onkeyup ="" max="3" min="0"
                                                     onKeyUp="if(this.value>3){this.value='3';}else if(this.value<1){this.value='1';}"/>
                                                    <div class="plus" onclick="guest_room()"></div>
                                                </div>													
                                            </div>
                                        </div>
                                        <div class="row" id="room2" class="d-none">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left">
                                                <label>Room 2</label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <div class="guests-button" >
                                                    <div class="minus" onclick="guest_room()"></div>
                                                    <input type="text" name="booking-Room" id="guest1"onfocusout="if(this.value.length==2) return false;"class="booking-guests" value="0" onkeyup ="" max="3" min="0"/>
                                                    <div class="plus" onclick="guest_room()"></div>
                                                </div>													
                                            </div>
                                        </div>
                                        <div class="row" id="room3" class="d-none">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left">
                                                <label>Room 3</label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <div class="guests-button">
                                                    <div class="minus" onclick="guest_room()"></div>
                                                    <input type="text" name="booking-Room" id="guest2"class="booking-guests" value="0" onkeyup ="" max="3" min="0"/>
                                                    <div class="plus" onclick="guest_room()"></div>
                                                </div>													
                                            </div>
                                        </div>
                                        <div class="row" id="room4" class="d-none">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left" >
                                                <label>Room 4</label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <div class="guests-button">
                                                    <div class="minus" onclick="guest_room()"></div>
                                                    <input type="text" name="booking-Room" id="guest3"class="booking-guests" value="0" onkeyup ="" max="3" min="0"/>
                                                    <div class="plus" onclick="guest_room()"></div>
                                                </div>													
                                            </div>
                                        </div>
                                        <div class="row" id="room5" class="d-none">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left">
                                                <label>Room 5</label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <div class="guests-button">
                                                    <div class="minus" onclick="guest_room()"></div>
                                                    <input type="text" name="booking-Room" id="guest4"class="booking-guests" value="0" onkeyup ="" max="3" min="0"/>
                                                    <div class="plus" onclick="guest_room()"></div>
                                                </div>													
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-sm-6 text-left">
                                                <label><span id="delete" onclick = "del_room()">Delete Room</span></label>
                                            </div>
                                            <div class="col-6 col-sm-6 col-sm-6 text-center">
                                                <label><span id="addroom" onclick = "add()">Add Room</span></label>							
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 p-0">
                            <label for="">Select Price Range</label>
                            <div class="d-flex justify-content-between">
                                <label class="cursor-pointer custom-bg-primary text-white custom-border-radius-5 px-1 p-2  custom-fs-14 select_budget"><input type="radio" name="budget" id="budget" value="0,1000"> upto @price_formatter(1000) </label>

                                <label class="cursor-pointer custom-bg-primary text-white custom-border-radius-5 px-1 p-2 custom-fs-14 select_budget"><input type="radio" name="budget" id="budget" value="1001,5000">  @price_formatter(1001) - 5000</label>


                                <label class="cursor-pointer custom-bg-primary text-white custom-border-radius-5 px-1 p-2 custom-fs-14 select_budget"><input type="radio" name="budget" id="budget" value="5001,12000"> @price_formatter(5001) -  12000</label>


                                <label class="cursor-pointer custom-bg-primary text-white custom-border-radius-5 px-1 p-2 custom-fs-14 select_budget"><input type="radio" name="budget" id="budget" value="12001,50000"> @price_formatter(12001)+</label>
                            </div>
                        </div>
                        <div class="col-12">
                            
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 p-0 mb-4">
                                <button type="button" id="serach_form_btn"  value="Search" class="commonbtn nsnbtn bluebtn custom-text-white custom-fw-800" >Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

   