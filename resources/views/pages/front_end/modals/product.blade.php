 <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 v-if="store" class="modal-title">Add New Product</h5>
                <h5 v-else="update" class="modal-title">Edit Product</h5>
            </div>
            <div class="modal-body product-form">
                <div class="form-group">
                    <select class="form-control" id="category" v-model="product.category">
                        <option value="" disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span v-if="errCategory" class="invalid-feedback">
                        <strong>Please select category</strong>
                    </span>
                </div>
                <div class="form-group">
                    <select class="form-control " id="subcategory" v-model="product.subcategory">
                        <option value="" disabled>Select Sub-Category</option>
                        <option value="1">Dummy Dummy</option>
                        <option value="12">Dummy Dummy</option>
                    </select>
                    <span v-if="errSubcategory" class="invalid-feedback">
                        <strong>Please select sub-category</strong>
                    </span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="name" placeholder="Product Name" v-model="product.name">
                    <span v-if="errProductName" class="invalid-feedback">
                        <strong>Please enter a product name</strong>
                    </span>
                </div>
                <div class="modal-form-icon">
                    <div class="form-group">
                        <span class="fa">&#8369;</span>
                        <input type="text" class="form-control" id="price" placeholder="000.00" v-model="product.price">
                        <span v-if="errPrice" class="invalid-feedback">
                            <strong>Please enter the price</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="2" id="description" placeholder="Product Description" v-model="product.description"></textarea>
                    <span v-if="errDescription" class="invalid-feedback">
                        <strong>Please enter the product description</strong>
                    </span>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="4" id="details" placeholder="Product Details" v-model="product.details"></textarea>
                    <span v-if="errDetails" class="invalid-feedback">
                        <strong>Please enter the product details</strong>
                    </span>
                </div>
                <div class="form-group">
                    <input type="file" class="product--dropify" id="product_thumbnail" @change="changeProductImages" ref="product_thumbnail" data-allowed-file-extensions="jpeg jpg png">
                </div>
                <div class="form-group">
                    <div class="tags-control form-control" tabindex="0">
                        <label>
                            <span v-for="(tag, index) in product.selectedTags" :key="index" @click="removeTags(index)" class="btn btn-info btn-xs text-white">
                                @{{ tag }}
                                <span>&times;</span>
                            </span>
                            <input type="text" class="tag-input__text" id="tags" placeholder="Add Tags" @click="searchTags" @keyup="searchTags" v-model="product.tags" data-role="tagsinput">
                        </label>
                    </div>
                    <div class="tags-list" v-if="tagsList.length">
                        <ul class="tags-wrap">
                            <li v-for="tag in tagsList" :key="tag.id" class="tags-item" style="display:inline-block;margin:3px;">
                                <a class="btn btn-primary btn-xs" @click.prevent="selectTags(tag.name)">
                                    <span v-text="tag.name"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tags-list" v-else>
                        {{-- <span v-if="!selectedTags.length">Select at least one tag.</span> --}}
                        <div class="tags-wrap" v-if="notags"><i>No tags we're found!</i></div>
                    </div>
                    {{-- <ul v-if="displayTags" id="show-tags" class="tags-list"></ul> --}}
                    <span v-if="errTags" class="invalid-feedback">
                        <strong>Please select at least one tag</strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="submitProduct()">
                    <span v-if="store">Submit</span>
                    <span v-else="update">Update</span>
                </button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>