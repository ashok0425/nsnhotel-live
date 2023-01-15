<div class="modal fade" id="modal_add_tax" tabindex="-1" role="dialog" aria-labelledby="modal_add_meal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title Add">Add Taxes</h4>
                <h4 class="modal-title Update">Update Taxes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="{{route('admin_tax_create')}}" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="seo_title">Price Min:</label>
                                        <input type="text" class="form-control" id="price_min" name="price_min" required>
                                        <label for="seo_title">Price Max:</label>
                                        <input type="text" class="form-control" id="price_max" name="price_max" required>
                                        <label for="seo_title">Percentage:</label>
                                        <input type="text" class="form-control" id="percentage" name="percentage" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="tax_id" name="tax_id" value="">
                    <button type="submit" class="btn btn-primary" id="submit_add_tax">Add</button>
                    <button class="btn btn-primary" id="submit_edit_tax">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
