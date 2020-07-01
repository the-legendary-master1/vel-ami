
@extends('layouts.frontend_layout')
@section('content')
    <div class="content-title text-left show-desktop">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#!">Home</a></li>
                    <li class="breadcrumb-item active">{{ Auth::user()->my_shop['name'] }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="header-content sticky-header-shop shop-seller">
        <div class="content-title text-center pb2 clearfix single-shop">
            <div class="cover-photo">
                <img src="{{ url('/files/shop_img/shop-bg.jpg') }}" alt="shop cover photo" class="img-responsive">
            </div>
            <div class="shop-profile">
                <a href="#" class="cursor shop-logo-link" data-toggle="modal" data-target="#updateBrandLogoModal">
                    <img src="{{ url('/') }}/files/dog-shop.png" class="img-responsive img-thumbnail img-circle">
                    @auth
                        <div class="edit--option update-logo"><span>Update</span></div>
                    @endauth
                </a>
                <div class="shop-info-container">
                    <h2 class="page-title shop-name">{{ Auth::user()->my_shop['name'] }}</h2>
                    <div class="tagline">
                        <h6 class="strapline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
                        @auth
                            <div class="edit--option update-tagline">
                                <a href="#" class="text-info">edit</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="main-content shop-seller mt2">
        @auth
            <div class="products--wrapper text-right mt2 mb2">
                <div class="product--actions">
                    <button class="btn btn-default add--product" @click="openProductModal()">Add</button>
                    <button class="btn btn-danger delete--product" v-if="selectedProduct.length" @click="deleteSelectedProduct(selectedProduct)">Delete</button>
                    {{-- <button class="btn btn-default unpublish--product" disabled>Unpublish</button> --}}
                </div>
            </div>
        @endauth
        <div class="products mt2">
            <div class="row text-center">
                <div v-if="!products.length" class="col-md-12 col-xs-12">
                    <h1>No products available.</h1>
                </div>
                <div v-else>
                    <div v-for="(product, index) in products" class="col-md-4 pi cus-pad">
                        <div class="product--details">
                            @auth
                                <div class="product-options">
                                    <div class="btn-group-vertical">
                                        <button class="btn btn-info btn-xs edit--product" @click="editProduct(product)"><span class="fa fa-pencil"></span></button>
                                        <label class="btn btn-danger btn-xs check-to-delete">
                                            <input type="checkbox" v-model="selectedProduct" :value="product.id">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                </div>
                            @endauth
                            <a href="{{ url('/') }}/product/1" class="item-link">
                                <div class="text-center item--product item--hover">
                                    <div class="item-img mb-3">
                                        <img :src="'{{ url('/') }}/'+ product.thumbnail" :alt="product.name" class="img-responsive">
                                    </div>
                                    <div class="item-details">
                                        <h6 class="shop-name text-uppercase mb1 font-weight-bold show-desktop">@{{ product.shop }}</h6>
                                        <h5 class="item-name text-uppercase mb2 font-weight-bold">@{{ product.name }}</h5>

                                        <div class="prRa clearfix show-mobile">
                                            <span class="price pull-left">₱ @{{ product.price }} </span>
                                            <div class="pull-right">
                                                <span class="fa fa-star text-info"></span>
                                                <span class="fa fa-star text-info"></span>
                                                <span class="fa fa-star text-info"></span>
                                                <span class="fa fa-star text-info"></span>
                                                <span class="fa fa-star text-info"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pagination-container text-center">
                    <nav aria-label="paginate products">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('pages.front_end.modals.update_brand_logo')
    @include('pages.front_end.modals.product')
@endsection
@section('extraJS')
    <script>
        $(function() {
            const app = new Vue({
                el: '#app',
                data: {
                    url: '{{ url('/') }}/{{ strtolower(Auth::user()->role) }}',
                    shopId: '{{ Auth::user()->my_shop['id'] }}',
                    products: {!! json_encode($products) !!},
                    product: {
                        id: '',
                        category: '',
                        subcategory: '',
                        name: '',
                        price: '',
                        description: '',
                        details: '',
                        tags: '',
                        selectedTags: [],
                        thumbnail: '',
                    },

                    errCategory: false,
                    errSubcategory: false,
                    errProductName: false,
                    errPrice: false,
                    errDescription: false,
                    errDetails: false,
                    errTags: false,
                    store: false,
                    update: false,
                    notags: false,

                    // Search Tags
                    tagsList: [],
                    removedTags: [],
                    selectedRemoved: [],


                    selectedProduct: [],
                },
                mounted() {
                    $('.selectpicker').select();

                    $('.product--dropify, .dropify').dropify();
                    $('.check-to-delete').on('change', function(e) {
                        e.stopPropagation();
                        $(this).toggleClass('active');

                        $(this).parents('.product-options').next().find('.item--product').toggleClass('ready-to-delete');
                        // $(this).parents('.product-options').next().find('.item--product').toggleClass('item--hover');
                        // $('.delete--product, .unpublish--product').prop('disabled', function( i, val ) {
                        //     return !val;
                        // });
                        // $('.delete--product').toggleClass('btn-default btn-danger');
                        // $('.unpublish--product').toggleClass('btn-default btn-outline-danger');
                    });
                    $(document).on('click', function() {
                        // unchecked all check to delete
                    });

                    Echo.channel('get-products').listen('.get-products', () => {
                        console.log(123);
                        this.getProducts();
                    })

                },
                methods: {
                    getProducts() {
                        axios.get( this.url + '/get-products', { params: { id: this.shopId }} ).then( response => {
                            this.products = response.data;
                        })
                    },
                    openProductModal() {
                        this.store = true;
                        $('#productModal').modal('show');
                    },
                    fetchTags(search = '') {
                        axios.get( this.url + '/search-tags', { params: { search: search, selected: this.product.selectedTags }} )
                        .then( response => {
                            var tags = response.data;
                            this.tagsList = tags;

                            if ( tags.length == 0 ) {
                                this.notags = true;
                            }
                        })
                    },
                    searchTags() {
                        this.fetchTags( this.product.tags );
                        this.product.selectedTags = this.product.selectedTags;
                    },
                    selectTags(name) {
                        console.log(this.product.selectedTags);
                        this.product.selectedTags.push(name);
                        this.tagsList = [];
                        this.product.tags = '';
                    },
                    removeTags(index) {
                        this.product.selectedTags.splice(index, 1);
                        this.tagsList = [];
                    },
                    submitProduct() {
                        let formData = new FormData();
                            formData.append('category', this.product.category);
                            formData.append('subcategory', this.product.subcategory);
                            formData.append('name', this.product.name);
                            formData.append('price', this.product.price);
                            formData.append('description', this.product.description);
                            formData.append('details', this.product.details);
                            formData.append('thumbnail', this.product.thumbnail);
                            formData.append('tags[]', this.product.selectedTags);
                            formData.append('my_shop_id', this.shopId);
                        if (this.product.id)
                            formData.append('id', this.product.id);

                        // for (var pair of formData.entries()) {
                        //     console.log(pair[0]+ ', ' + pair[1]); 
                        // }; return false;

                        axios.post('{{ url('/user-premium/store-product') }}', formData).then( response => {
                            $('#productModal').modal('hide');
                            var txt = 'added.';

                            if (this.update) txt = 'updated.';

                            swal({
                                title: 'Success!',
                                text: 'Product has been' + txt,
                                icon: 'success',
                                timer: 1500,
                                buttons: false,
                            })
                        })
                        .catch( error => {
                            var errors = error.response.data.errors;
                            var form = $('.product-form');
                            var arrErrors = [];

                            form.find('.form-control').removeClass('is-invalid');
                            $.each(errors, function(index, val) {
                                console.log(index);
                                form.find('#' + index).addClass('is-invalid');
                                arrErrors.push(index);
                            });

                            if ($.inArray("category", arrErrors) !== -1)        this.errCategory = true;
                            if ($.inArray("name", arrErrors) !== -1)            this.errProductName = true;
                            if ($.inArray("price", arrErrors) !== -1)           this.errPrice = true;
                            if ($.inArray("errDescription", arrErrors) !== -1)  this.errDescription = true;
                            if ($.inArray("description", arrErrors) !== -1)     this.errDetails = true;
                        })
                    },
                    editProduct(data) {
                        this.update = true;
                        this.store = false;
                        var tags = data.tags.split(',');
                        
                        let result = {
                            id: data.id,
                            category: data.category,
                            description: data.description,
                            details: data.details,
                            name: data.name,
                            price: data.price,
                            shop_id: data.shop_id,
                            selectedTags: tags,
                        }
                        this.product = result;

                        var inputFile = $('#product_thumbnail[type="file"]');
                        var drEvent = inputFile.dropify();
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = '/' + data.thumbnail;
                            drEvent.destroy();
                            drEvent.init();   

                        inputFile.dropify({
                            defaultFile: '/' + data.thumbnail
                        });
                        
                        $('#productModal').modal('show');
                    },
                    changeProductImages(e) {
                        this.product.thumbnail = this.$refs.product_thumbnail.files[0];
                    },
                    deleteSelectedProduct(ids) {
                        let selectedProducts = ids;
                        swal({
                            title: "Are you sure you want to delete these products?",
                            text: "",
                            icon: "warning",
                            buttons: ["No", "Yes"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                axios.post('{{ url('/user-premium/delete-selected-products') }}', { ids:selectedProducts }).then( response => {
                                    swal("Success! Product has been deleted!", {
                                      icon: "success",
                                    });
                                })
                                .catch(() => {
                                    swal("Something wen\'t wrong, please try again later.", {
                                      icon: "error",
                                    });
                                })
                            }
                        });
                    },
                }
            });
        });
    </script>
@endsection

