<div id="update_category_modal" class="modal fade my-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered velami_modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Category</h4>
            </div>

            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Type here . . ." v-model="updateCategoryData.name">
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="submitUpdateCategory()">Submit</button>
            </div>
        </div>
    </div>
</div>