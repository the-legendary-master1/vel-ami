 <div class="modal fade" id="updateBrandLogoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Update Your Logo</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" id="shop_img_file" ref="shop_img_file" class="dropify" data-show-remove="false" data-height="150" data-max-file-size="2M" data-allowed-file-extensions="jpeg jpg png">
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="updateShopLogo()">Update</button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>