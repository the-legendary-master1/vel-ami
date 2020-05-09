<div id="new_product_modal" class="modal fade my-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered velami_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Product</h4>
            </div>

            <div class="modal-body">
                    <div class="form-group">
                        <label>Students</label>
                        <select id="student_list" class="form-control" title="Select here . . ." data-show-subtext="true" data-live-search="true">
                            <option v-for="item,key in allCategories" :value="item.id">@{{ item.name }}</option>
                        </select>
                    </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="submitNewProduct()">PUBLISH</button>
            </div>
        </div>
    </div>
</div>