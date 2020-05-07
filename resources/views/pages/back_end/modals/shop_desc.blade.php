<div id="shop_desc_modal" class="modal fade my-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered velami_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Shop Description</h4>
            </div>

            <div class="modal-body">
                <textarea class="form-control" rows="5" placeholder="Type here . . ." v-model="shopDescData.desc"></textarea>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="submitShopDesc()">Submit</button>
            </div>
        </div>
    </div>
</div>