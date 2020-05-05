<div id="shop_img_modal" class="modal fade my-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered velami_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload New Shop Image</h4>
            </div>

            <div class="modal-body">
                <input type="file" id="shop_img_file" ref="shop_img_file" class="dropify" data-show-remove="false" data-height="150" data-max-file-size="3M" data-allowed-file-extensions="jpeg jpg png">
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="submitShopIMG()">Submit</button>
            </div>
        </div>
    </div>
</div>