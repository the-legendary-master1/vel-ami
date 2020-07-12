
@extends('layouts.frontend_layout')
@section('extraCSS')
    <link rel="stylesheet" href="https://foliotek.github.io/Croppie/croppie.css">
@endsection
@section('content')
    <div class="content-title text-left show-desktop">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" v-cloak>@{{ myShopData.name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <section class="header-content sticky-header-shop shop-seller">
        <div class="content-title text-center pb2 clearfix single-shop">
            <div class="cover-photo">
                    <img :src="'{{ asset('files') }}/'+myShopData.cover_photo" class="img-responsive" alt="Cover Photo" v-if="myShopData.cover_photo">
                    <img src="{{ asset('/files/shop_img/shop-bg.jpg') }}" class="img-responsive" alt="Cover Photo" v-else>
                @auth
                    <label>
                        <span class="fa fa-camera fa-lg"></span>
                        <span class="show-on-hover">Update Cover Photo</span>
                        <input type="file" ref="cover_photo_file" class="hide-input-file" @change="updateShopCoverPhoto(myShopData)">
                    </label>
                @endauth
            </div>
            <div class="shop-profile">
                <a href="#" class="cursor shop-logo-link" @auth @click="editShopLogo(myShopData)" @endauth>

                    <img :src="'{{ asset('files') }}/'+myShopData.shop_img" class="img-responsive img-thumbnail img-circle" v-if="myShopData.shop_img">
                    <img src="{{ asset('files/shop.png') }}" class="img-responsive img-thumbnail img-circle" v-else>
                    @auth
                        <div class="edit--option update-logo">
                            {{-- <label> --}}
                                <span>Update</span>
                                {{-- <input type="file" ref="shop_logo" name="shop_logo" @change="shop_logo" style="position:absolute;z-index: -1;opacity: 0;"> --}}
                            {{-- </label> --}}
                        </div>
                    @endauth
                </a>
                <div class="shop-info-container">
                    <h2 class="page-title shop-name" v-cloak>@{{ myShopData.name }}</h2>
                    <div class="tagline">
                        <h6 class="strapline" v-cloak>@{{ myShopData.description }}
                            @auth
                                <span class="cursor btn btn-info btn-xs" @click="updateShopDesc(myShopData)" style="font-size:10px;">
                                    <span v-if="myShopData.description">Edit</span>
                                    <span v-else>Add shop description</span>
                                </span>
                            @endauth
                        </h6>
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
                            <a class="item-link" @click="viewProduct(product)">
                                <div class="text-center item--product item--hover">
                                    <div class="item-img mb-3">
                                        <img v-for="(image, index) in product.images" v-if="index == 0" :src="'{{ url('/') }}/' + image.path" :alt="product.name" class="img-responsive">
                                    </div>
                                    <div class="item-details">
                                        <h6 class="shop-name text-uppercase mb1 font-weight-bold show-desktop">@{{ myShopData.name }}</h6>
                                        <h5 class="item-name mb2 font-weight-bold">@{{ product.name }}</h5>

                                        <div class="prRa clearfix ">
                                            <span class="price">₱ @{{ product.price.toLocaleString() }} </span>
                                            <div class="pull-right show-mobile">
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
    @auth
        @include('pages.front_end.modals.update_brand_logo')
        @include('pages.front_end.modals.product')
        @include('pages.front_end.modals.shop_desc')
    @endauth
@endsection
@section('extraJS')
    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script>
        $(function() {
            const app = new Vue({
                el: '#app',
                data: {
                    myShopData: {!! json_encode($shop) !!},
                    products: {!! json_encode($products) !!},
                    @auth 
                        url: '{{ url('/') }}/{{ strtolower(Auth::user()->role) }}',
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
                        },

                        shopDescData: '',

                        errCategory: false,
                        errSubcategory: false,
                        errProductName: false,
                        errPrice: false,
                        errDescription: false,
                        errDetails: false,
                        errTags: false,
                        errImage: false,
                        store: false,
                        update: false,
                        notags: false,

                        // Search Tags
                        tagsList: [],
                        removedTags: [],
                        selectedRemoved: [],
                        selectedProduct: [],

                        // Dropzone
                        dropzoneOptions: {
                            url: 'https://httpbin.org/post',
                            uploadMultiple: true,
                            maxFilesize: 2, // MB
                            maxFiles: 5,
                            thumbnailWidth: 150,
                            thumbnailHeight: 150,
                            addRemoveLinks: true,
                            acceptedFiles: 'image/jpeg, image/jpg, image/png',
                            // complete: function(file) {
                            //     if (file.status == "success") {
                            //         var valid = true;

                            //         $('.dropzone').each(function() {
                            //             if ($(this).find('.dz-success').length === 0) {
                            //                 valid = false;
                            //             }
                            //         })

                            //         if (valid) 
                            //             $('#productModal').find('.submit').prop('disabled', false);
                            //         else
                            //             $('#productModal').find('.submit').prop('disabled', true);
                            //     }
                            // },
                        },

                        // Image Croppie
                        imgCropper: false,
                        current_shop_logo: null,
                    @endauth
                },
                @auth
                    mounted() {

                        $('.selectpicker').select();

                        $('.product--dropify, .dropify').dropify();
                        $('.check-to-delete').on('change', function(e) {
                            e.stopPropagation();
                            $(this).toggleClass('active');

                            $(this).parents('.product-options').next().find('.item--product').toggleClass('ready-to-delete');
                            $(this).parents('.product-options').next().find('.item--product').toggleClass('item--hover');
                        });
                        $(document).on('click', function() {
                            // unchecked all check to delete
                        });

                        Echo.channel('get-products').listen('.get-products', () => {
                            this.getProducts();
                        })

                        Echo.channel('get-shops').listen('.get-shops', () => {
                            this.getShop();
                        })

                        this.getProducts();
                        $('#productModal').find('.submit').prop('disabled', true);
                    },
                    methods: {
                        getShop() {
                            axios.post( this.url + '/get-my-shop/' + this.myShopData.id)
                                .then((response) => {
                                    this.myShopData = response.data;
                                })
                        },
                        getProducts() {
                            axios.get( this.url + '/get-products', { params: { id: this.myShopData.id }} ).then( response => {
                                console.log(response);
                                this.products = response.data;
                            })
                        },
                        openProductModal() {
                            this.store = true;
                            this.product.id = '';
                            this.product.category = '';
                            this.product.subcategory = '';
                            this.product.name = '';
                            this.product.price = '';
                            this.product.description = '';
                            this.product.details = '';
                            this.product.tags = '';
                            this.product.selectedTags = [];

                            this.$refs.product_images.removeAllFiles();
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
                            this.product.selectedTags.push(name);
                            this.tagsList = [];
                            this.product.tags = '';
                        },
                        removeTags(index) {
                            this.product.selectedTags.splice(index, 1);
                            this.tagsList = [];
                        },
                        afterComplete(response) {

                            if (response.length > 0) {
                                var valid = true;
                                if ( $('.dropzone').hasClass('dz-max-files-reached') ) {
                                    $('#productModal').find('.submit').prop('disabled', true);
                                }
                                else {
                                    $('.dropzone').each(function() {
                                        if ($(this).find('.dz-success').length === 0) {
                                            valid = false;
                                        }
                                    })
                                    if (valid) 
                                        $('#productModal').find('.submit').prop('disabled', false);
                                }
                            }
                        },
                        afterRemove(file) {
                            if (file.status == "success") {
                                var valid = false;

                                $('.dropzone').each(function() {
                                    if ($(this).find('.dz-success').length === 0) {
                                        valid = true;
                                    }
                                })
                                if (valid) 
                                    $('#productModal').find('.submit').prop('disabled', true);
                            }
                        },
                        maxFiles(files) {
                            let filesCount = files.length;
                            if (filesCount <= 5) {
                                $('#productModal').find('.submit').prop('disabled', false);
                            }
                            else {
                                $('#productModal').find('.submit').prop('disabled', true);
                            }
                        },
                        dzComplete(files, message, xhr) {
                            if (files[0].status == "error") {
                                swal("", "You cannot upload more than 5 images", "warning");
                                $('#productModal').find('.submit').prop('disabled', true);
                            }
                        },
                        submitProduct() {
                            this.loading();
                            let images = this.$refs.product_images.getAcceptedFiles();

                            let formData = new FormData();
                                formData.append('category', this.product.category);
                                formData.append('subcategory', this.product.subcategory);
                                formData.append('name', this.product.name);
                                formData.append('price', this.product.price);
                                formData.append('description', this.product.description);
                                formData.append('details', this.product.details);
                                formData.append('tags[]', this.product.selectedTags);
                                formData.append('my_shop_id', this.myShopData.id);

                            if ( images.length > 0 ) {
                                for ( var i = 0; i < images.length; i++ ) {
                                    let file = images[i];
                                    formData.append('images[' + i + ']', file);
                                }
                            }
                            else {
                                    formData.append('images[]', '');
                            }
                            if (this.product.id)
                                formData.append('id', this.product.id);

                            axios.post( this.url + '/store-product', formData).then( response => {
                                this.removeloading();
                                $('#productModal').modal('hide');
                                var txt = 'added.';

                                if (this.update) txt = 'updated.';

                                swal({
                                    title: 'Success!',
                                    text: 'Product has been ' + txt,
                                    icon: 'success',
                                    timer: 1500,
                                    buttons: false,
                                })

                                this.$refs.product_images.removeAllFiles();
                            })
                            .catch( error => {
                                this.removeloading();

                                swal({
                                    title: 'Oops!',
                                    text: 'There\'s wrong with your inputs, please double check.',
                                    icon: 'error',
                                    timer: 1500,
                                    buttons: false,
                                })

                                var errors = error.response.data.errors;
                                var form = $('.product-form');
                                var arrErrors = [];
                                form.find('.form-control').removeClass('is-invalid');
                                form.find('.dropzone').removeClass('is-invalid');
                                $.each(errors, function(index, val) {
                                    form.find('#' + index).addClass('is-invalid');
                                    form.find('#dropzone').addClass('is-invalid');
                                    arrErrors.push(index);
                                });

                                console.log(arrErrors);
                                if ($.inArray("category", arrErrors) !== -1)        this.errCategory = true;
                                if ($.inArray("name", arrErrors) !== -1)            this.errProductName = true;
                                if ($.inArray("price", arrErrors) !== -1)           this.errPrice = true;
                                if ($.inArray("description", arrErrors) !== -1)     this.errDescription = true;
                                if ($.inArray("details", arrErrors) !== -1)         this.errDetails = true;
                                if ($.inArray("tags.0", arrErrors) !== -1)          this.errTags = true;
                                if ($.inArray("images.0", arrErrors) !== -1)          this.errImage = true;
                            })
                        },
                        editProduct(data) {
                            this.update = true;
                            this.store = false;
                            var tags = data.tags.split(',');
                            this.$refs.product_images.removeAllFiles();
                            
                            let result = {
                                id: data.id,
                                category: data.category_id,
                                subcategory: data.sub_category_id,
                                description: data.description,
                                details: data.details,
                                name: data.name,
                                price: data.price,
                                shop_id: data.my_shop_id,
                                selectedTags: tags,
                            }
                            this.product = result;

                            for ( var i = 0; i < data.images.length; i++ ) {
                                let file = { size: data.images[i].size, name: data.images[i].name, type: data.images[i].type };
                                let url = '{{ url('/') }}/' + data.images[i].path;
                                this.$refs.product_images.manuallyAddFile(file, url);
                            }
                            
                            $('#productModal').modal('show');
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
                                    this.loading();
                                    axios.post( this.url + '/delete-selected-products', { ids:selectedProducts }).then( response => {

                                        this.removeloading();
                                        swal({
                                            title: 'Success!',
                                            text: 'Product has been deleted!',
                                            icon: 'success',
                                            timer: 1500,
                                            buttons: false,
                                        })
                                    })
                                    .catch(() => {
                                        this.removeloading();
                                        swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                    })
                                }
                            });
                        },
                        replaceWhiteSpace(string) {
                            return string.replace(/\s+/g, '_');
                        },
                        viewProduct(data) {
                            window.location.href = `{{ url('/product') }}/${ this.replaceWhiteSpace(data.name) }/${ btoa(data.id) }`;
                        },
                        changeShopLogo(e) {
                            this.imgCropper = true;
                            var files = e.target.files || e.dataTransfer.files;

                            if (!files.length) return;

                            var reader = new FileReader();
                            reader.onload = e => {
                                this.$refs.shop_logo.bind({
                                    url: e.target.result
                                })
                            }
                            reader.readAsDataURL(files[0]);
                        },
                        editShopLogo(data) {
                            $('#updateBrandLogoModal').modal('show');
                        },
                        updateShopLogo() {
                            let options = {
                                type: 'base64',
                                size: 'viewport',
                                format: 'png'
                            };

                            this.$refs.shop_logo.result(options, output => {
                                let formData = new FormData();
                                    formData.append('id', this.myShopData.id);
                                    formData.append('shop_img', output);

                                this.loading();
                                axios.post( this.url + '/upload-shop-img', formData).then( response => {

                                    this.removeloading();
                                    $('#updateBrandLogoModal').modal('hide');
                                    swal({
                                        title: 'Nice!',
                                        text: 'Your logo has been uploaded.',
                                        icon: 'success',
                                        timer: 1500,
                                        buttons: false,
                                    });

                                    this.imgCropper = false;
                                })
                                .catch(() => {
                                    this.removeloading();
                                    swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                })
                            });
                                
                        },
                        updateShopCoverPhoto(data) {
                            let cover_photo_file = this.$refs.cover_photo_file.files[0];

                            let formData = new FormData();
                                formData.append('id', this.myShopData.id);
                                formData.append('cover_photo', cover_photo_file);

                            $('.cover-photo').prepend('<div class="loading" style="position:absolute;top:0;left:0;right:0;bottom:0;z-index:999;display:flex;background-color:rgba(0, 0, 0, .3);"><img style="display:block;width:25px;margin:auto;" src="/files/pleasewait.gif"></div>')
                            
                            axios.post( this.url + '/update-cover-photo', formData).then(() => {
                                $('.cover-photo').find('.loading').remove();
                                swal({
                                    title: 'Nice!',
                                    text: 'Cover photo has been updated.',
                                    icon: 'success',
                                    timer: 1500,
                                    buttons: false,
                                })
                            })
                            .catch(() => {
                                swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                            })
                        },
                        updateShopDesc(data) {
                            let result = {
                                id: data.id,
                                desc: data.description,
                            }

                            this.shopDescData = result;
                            $('#shop_desc_modal').modal('show');
                        },
                        submitShopDesc() {
                            this.loading();
                            axios.post( this.url + '/update-shop-desc', this.shopDescData)
                                .then(() => {
                                    this.removeloading();
                                    $('#shop_desc_modal').modal('hide');

                                    swal({
                                        title: 'Nice!',
                                        text: 'Your shop description has been updated.',
                                        icon: 'success',
                                        timer: 1500,
                                        buttons: false,
                                    })
                                })
                                .catch(() => {
                                    this.removeloading();
                                    swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                })
                        },
                        loading() {
                            $('#wait').show();
                        },
                        removeloading() {
                            $('#wait').hide();
                        }, 
                    }
                @endauth
            });
        });
    </script>
@endsection

