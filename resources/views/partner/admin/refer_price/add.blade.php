<div class="modal fade" id="modal_add_category" tabindex="-1" role="dialog" aria-labelledby="modal_add_category" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="{{route('admin_refer_add')}}" method="post">
                <input type="hidden" id="add_category_method" name="_method" value="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="seo_title">Share Price:</label>
                                        <input type="text" class="form-control" id="share_price" name="share_price" value="{{$referl_price->share_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="seo_description">Join Price:</label>
                                        <input type="text" class="form-control" id="join_price" name="join_price"
                                        value="{{$referl_price->join_price}}">
                                    </div>
                                     <div class="form-group">
                                        <label for="seo_description">Referral Content:</label>
                                        <textarea type="text" class="form-control" id="refer_content" name="refer_content" value="">{{$referl_price->refer_content}}</textarea> 
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="category_type" name="type" value="">
                    <button type="submit" class="btn btn-primary" id="submit_add_refer">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
