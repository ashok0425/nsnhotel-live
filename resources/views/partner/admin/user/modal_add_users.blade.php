<div class="modal fade" id="modal_add_users" tabindex="-1" role="dialog" aria-labelledby="modal_add_users" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Partners</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form id="register" action="{{route('admin_user_create')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                           
                            <div class="form-group">
                                <label for="name">Partner name: *</label>
                                <input type="text" class="form-control" id="register_name" name="name">
                            </div>
                            <div class="form-group">
                                 <label for="name">Partner email:</label>
                                 <input type="text" class="form-control" id="register_email" name="email"required>
                            </div>
                            <div class="form-group">
                                 <label for="name">Partner phone no:</label>
                                 <input type="text" class="form-control" id="register_phone_no" name="phone"required>
                            </div>
                            <div class="form-group">
                                 <label for="name">Partner Password:</label>
                                 <input type="text" class="form-control" id="register_password" name="password"required>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="submit_add_users"id="submit_register">Add</button>
                </div>

            </form>

        </div>
    </div>
</div>
