 <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Add Product</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control">
                        <option value="" selected>Select Category</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control">
                        <option value="" selected>Select Sub Category</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Product Name">
                </div>
                <div class="modal-form-icon">
                    <div class="form-group">
                        <span class="fa">&#8369;</span>
                        <input type="text" class="form-control" placeholder="000.00">
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="2" placeholder="Product Description"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="4" placeholder="Product Details"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" class="product--dropify">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Add Tags">
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary">Publish</button>
                <button type="button" class="btn btn-outline-primary">Unpublish</button>
            </div>
        </div>
    </div>
</div>