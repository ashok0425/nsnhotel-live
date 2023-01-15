<div class="modal fade" id="modal_add_amenities" tabindex="-1" role="dialog" aria-labelledby="modal_add_meal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title Add">Add Meals</h4>
                   <h4 class="modal-title Update">Update Meals</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="{{route('partner_meal_create')}}" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="hotel_id">Select Hotel: *</label>
                                         <select class="form-control" id="hotel_id" name="hotel_id" required>
                                                @foreach($places as $place)
                                                    <option value="{{$place->id}}">{{$place->name}}</option>
                                                @endforeach
                                        </select>
                                            <label for="type">Meal Type: *</label>
                                         <select class="form-control" id="type" name="type" required>
                                                @foreach($meal as $meals)
                                                    <option value="{{$meals->id}}">{{$meals->type}}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                         <label for="price">price:</label>
                                          <input type="text" class="form-control" id="price" name="price" required>
                                    </div>
                                  
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="meal_id" name="meal_id" value="">
                    <button type="submit" class="btn btn-primary" id="submit_add_meal">Add</button>
                    <button class="btn btn-primary edit" id="submit_edit_meal">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
