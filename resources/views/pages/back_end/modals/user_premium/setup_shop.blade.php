 <div class="modal fade" id="setup_shop_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Setup Your Shop</h5>
            </div>

            <form method="POST" id="submitMyShop">
                {{ csrf_field() }}

                <div class="modal-body modal-form-icon">
                    <div class="form-group">
                        <i class="fa fa-shopping-cart"></i>
                        <input type="text" class="form-control" name="shop_name" placeholder="Enter a shop name" data-toggle="tooltip" title="You cannot change the shop name after setting it up. This is for branding purposes so make sure there is no mistake.">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Setup</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal" >Close</button>
                </div>
            </form>
        </div>
    </div>
</div>