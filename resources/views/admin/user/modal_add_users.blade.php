<div class="modal fade" id="modal_add_users" tabindex="-1" role="dialog" aria-labelledby="modal_add_users" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Users</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{route('admincp.register')}}" method="post" enctype="multipart/form-data" data-parsley-validate id="user_form">
                <input type="hidden" id="add_users_method" name="_method" value="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="nav nav-tabs bar_tabs" role="tablist">
                                @foreach($languages as $index => $language)
                                    <li class="nav-item">
                                        <a class="nav-link {{$index !== 0 ?: "active"}}" id="home-tab" data-toggle="tab" href="#language_{{$language->code}}" role="tab" aria-controls="" aria-selected="">{{$language->name}}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                <!--@foreach($languages as $index => $language)-->
                                    <div class="tab-pane fade show {{$index !== 0 ?: "active"}}" id="language_{{$language->code}}" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="form-group">
                                            <label for="name"> name <small><!--({{$language->code}})--></small>: *</label>
                                            <input type="text" class="form-control" id="name" name="name" {{$index !== 0 ?: "required"}}>
                                        </div>
                                    </div>
                               <!-- @endforeach-->
                            </div>

                            <div class="form-group">
                                 <label for="name"> email:</label>
                                 <input type="text" class="form-control" id="partner_email" name="email" >
                            </div>
                            <div class="form-group">
                                 <label for="name"> phone no:</label>
                                 <input type="text" class="form-control" id="partner_phone_no" name="phone_number">
                            </div>
                            <div class="form-group">
                                 <label for="name"> password:</label>
                                 <input type="text" class="form-control" id="partner_password" name="password" >
                            </div>
                                                        <div class="form-group">
                                 <label for="name"> Select Role:</label>
                                 <select name = "role" class="form-control" id="role">
                                     <option value = "partner"> Partner</option> 
                                     <option value = "agent"> Agent</option> 
                                 </select>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Icon:</strong></p>
                                    <img id="preview_icon" src="https://via.placeholder.com/100x100?text=icon" alt="no image">
                                    <input type="file" class="form-control" id="users_icon" name="avatar">
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="users_id" name="users_id" value="1">
                    <button type="submit" class="btn btn-primary" id="submit_add_users">Add</button>
                    <button class="btn btn-primary" id="submit_edit_users">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
