
@extends('layouts.frontend_layout')
@section('extraCSS')
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
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

                    <vue-croppie
                        ref="cover_photo_file"
                        :enable-orientation="true"
                        :enable-resize="false"
                        :boundary="{ width: 900, height: 170 }"
                        :viewport="{ width: 900, height: 170 }"
                        v-if="hasCoverPhoto">
                    </vue-croppie>
                    <div v-else>
                        <img :src="'{{ asset('files') }}/'+myShopData.cover_photo" class="img-responsive" alt="Cover Photo" v-if="myShopData.cover_photo">
                        <img src="{{ asset('/files/shop_img/shop-bg.jpg') }}" class="img-responsive" alt="Cover Photo" v-else>
                    </div>
                @auth
                    @if ( (Auth::user()->id == intval($shop->user_id)) )
                        <label v-if="hasCoverPhoto" class="drag-move"><span class="fa fa-arrows"></span> Drag to Move Cover Photo</label>
                        <label v-else class="update-cp">
                            <span class="fa fa-camera fa-lg"></span>
                            <span class="show-on-hover">Update Cover Photo</span>
                            <input type="file" class="hide-input-file" @change="changeCoverPhoto">
                        </label>
                        <label v-if="hasCoverPhoto" class="save-cp">
                            <span class="fa fa-check fa-lg"></span>
                            <span class="text-white" @click="updateCoverPhoto">Save Changes</span>
                        </label>
                    @endif
                @endauth
                
            </div>
            <div class="shop-profile">
                
                @auth
                    @if ( Auth::user()->id == $shop->user_id )
                        <a href="#" class="cursor shop-logo-link" @auth @click="editShopLogo(myShopData)" @endauth>
                    @else
                        <a href="#" class="cursor shop-logo-link">
                    @endif
                @else
                    <a href="#" class="cursor shop-logo-link">
                @endauth
                
                    <img :src="'{{ asset('files') }}/'+myShopData.shop_img" class="img-responsive img-thumbnail img-circle" v-if="myShopData.shop_img">
                    <img src="{{ asset('files/shop.png') }}" class="img-responsive img-thumbnail img-circle" v-else>
                    @auth
                        @if ( Auth::user()->id == $shop->user_id )
                            <div class="edit--option update-logo">
                                <span>Update</span>
                            </div>
                        @endif
                    @endauth
                </a>
                <div class="shop-info-container">
                    <h2 class="page-title shop-name" v-cloak>@{{ myShopData.name }}</h2>
                    <div class="tagline">
                        <h6 class="strapline" v-cloak>@{{ myShopData.description }}
                            @auth
                                @if ( Auth::user()->id == $shop->user_id )
                                    <span class="cursor btn btn-info btn-xs" @click="updateShopDesc(myShopData)" style="font-size:10px;">
                                        <span v-if="myShopData.description">Edit</span>
                                        <span v-else>Add shop description</span>
                                    </span>
                                @endif
                            @endauth
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="main-content shop-seller mt2">
        @auth
            @if ( Auth::user()->id == $shop->user_id )
                <div class="products--wrapper text-right mt2 mb2">
                    <div class="product--actions">
                        <button class="btn btn-default add--product" @click="openProductModal()">Add</button>
                        <button class="btn btn-danger delete--product" v-if="selectedProduct.length" @click="deleteSelectedProduct(selectedProduct)">Delete</button>
                        {{-- <button class="btn btn-default unpublish--product" disabled>Unpublish</button> --}}
                    </div>
                </div>
            @endif
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
                                @if ( Auth::user()->id == $shop->user_id )
                                    <div class="product-options">
                                        <div class="btn-group-vertical">
                                            <button class="btn btn-info btn-xs edit--product" @click="editProduct(product)"><span class="fa fa-pencil"></span></button>
                                            <label class="btn btn-danger btn-xs check-to-delete">
                                                <input type="checkbox" v-model="selectedProduct" :value="product.id">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                            <a class="item-link" :href="`{{ url('/product') }}/${product.url}/${product.id}`">
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
                                                <star-rating 
                                                    :increment="0.1" 
                                                    :rating="parseInt(product.total_rating)" 
                                                    :read-only="true"
                                                    :star-size="13"
                                                    :show-rating="false"
                                                    active-color="#31708f">
                                                </star-rating>
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
    {{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}
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
                        preview_images: [],
                        remove_images_id: [],

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

                        // Image Croppie
                        imgCropper: false,
                        current_shop_logo: null,
                        editorOption: {
                            modules: {
                                toolbar: [
                                    [{ header: [1, 2, false] }],
                                    ['bold', 'italic', 'underline'],
                                ]
                            },
                            placeholder: 'Product description...',
                            theme: 'snow'
                        },

                        // Header
                        unreadNotification: {!! json_encode($unreadNotification) !!},
                        showMessages: false,
                        loading: false,
                        allMessages: [],
                        userId: {{ Auth::user()->id }},
                    @endauth
                    hasCoverPhoto: false,
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
                        // $('#productModal').find('.submit').prop('disabled', true);

                        Echo.channel('get-message-notifications').listen('.get-message-notifications', (data) => {
                            if (data.user == this.userId)
                                this.allMessages = data.message;
                        })
                        Echo.channel('get-unread-notifications').listen('.get-unread-notifications', (data) => {
                            if (data.user.id == this.userId)
                                this.unreadNotification = data.unread
                        })
                    },
                    methods: {
                        getShop() {
                            axios.post( this.url + '/get-my-shop/' + this.myShopData.id)
                                .then((response) => {
                                    this.myShopData = response.data;
                                })
                        },
                        getProducts() {
                            axios.get( '{{ url('/get-products') }}', { params: { id: this.myShopData.id }} ).then( response => {
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
                            this.preview_images = [];
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
                        handleProductImgs(e) {
                            Array.from(e.target.files).forEach(file => {
                                const reader = new FileReader()
                                if (!/\.(jpe?g|png)$/i.test(file.name)) {
                                    swal('Invalid File Upload', 'File must be in: JPG, JPEG, PNG.', 'warning');
                                    $('#productModal').find('.submit').prop('disabled', true);
                                    return false;
                                }
                                var id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                                reader.onload = () => {
                                    this.preview_images.push({
                                        preview: reader.result,
                                        uid: id,
                                        file
                                    })
                                }
                                reader.readAsDataURL(file)
                            })
                        },
                        deleteImage(index, id) {
                            this.remove_images_id.push(id);
                            this.preview_images.splice(index, 1)
                        },
                        submitProduct() {
                            this.showLoading();
                            // let images = this.$refs.product_images.getAcceptedFiles();
                            let formData = new FormData();
                                formData.append('category', this.product.category);
                                formData.append('subcategory', this.product.subcategory);
                                formData.append('name', this.product.name);
                                formData.append('price', this.product.price);
                                formData.append('description', this.product.description);
                                formData.append('details', this.product.details);
                                formData.append('tags[]', this.product.selectedTags);
                                formData.append('my_shop_id', this.myShopData.id);

                            this.preview_images.forEach((image, index) => {
                                formData.append('images[' + index + ']', image.file);
                            })

                            // if edit
                            if (this.product.id)
                                formData.append('id', this.product.id);

                            // if delete
                            if (this.remove_images_id)
                                formData.append('removeImages', this.remove_images_id);


                            axios.post( this.url + '/store-product', formData).then( response => {
                                this.removeLoading();
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
                                this.preview_images = []
                            })
                            .catch( error => {
                                this.removeLoading();

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
                            this.preview_images = [];
                            var tags = data.tags.split(',');

                            data.images.forEach((image, index) => {
                                this.preview_images.push({ 
                                    preview: '{{ asset('/') }}' + image.path,
                                    uid: image.id
                                });
                            })
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
                                    this.showLoading();
                                    axios.post( this.url + '/delete-selected-products', { ids:selectedProducts }).then( response => {

                                        this.removeLoading();
                                        swal({
                                            title: 'Success!',
                                            text: 'Product has been deleted!',
                                            icon: 'success',
                                            timer: 1500,
                                            buttons: false,
                                        })
                                    })
                                    .catch(() => {
                                        this.removeLoading();
                                        swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                    })
                                }
                            });  
                        },
                        // replaceWhiteSpace(string) {
                        //     return string.replace(/\s+/g, '_');
                        // },
                        // viewProduct(data) {
                        //     window.location.href = `{{ url('/product') }}/${ this.replaceWhiteSpace(data.name) }/${ btoa(data.id) }`;
                        // },
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

                                this.showLoading();
                                axios.post( this.url + '/upload-shop-img', formData).then( response => {

                                    this.removeLoading();
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
                                    this.removeLoading();
                                    swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                })
                            });
                        },
                        changeCoverPhoto(e) {
                            this.hasCoverPhoto = true;

                            var files = e.target.files || e.dataTransfer.files;

                            if (!files.length) return;

                            var reader = new FileReader();
                            reader.onload = e => {
                                this.$refs.cover_photo_file.bind({
                                    url: e.target.result
                                })
                            }
                            reader.readAsDataURL(files[0]);
                        },
                        updateCoverPhoto() {
                            let options = {
                                type: 'base64',
                                size: 'viewport',
                                format: 'png'
                            };

                            this.$refs.cover_photo_file.result(options, output => {
                                let formData = new FormData();
                                    formData.append('id', this.myShopData.id);
                                    formData.append('cover_photo', output);

                                this.showLoading();
                                axios.post( this.url + '/update-cover-photo', formData).then(() => {
                                    // $('.cover-photo').find('.loading').remove();
                                    this.removeLoading();
                                    swal({
                                        title: 'Nice!',
                                        text: 'Cover photo has been updated.',
                                        icon: 'success',
                                        timer: 1500,
                                        buttons: false,
                                    })
                                    this.hasCoverPhoto = false;
                                })
                                .catch(() => {
                                    this.removeLoading();
                                    swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                })
                            });
                        },
                        updateShopCoverPhoto(data) {
                            let cover_photo_file = this.$refs.cover_photo_file.files[0];

                            let formData = new FormData();
                                formData.append('id', this.myShopData.id);
                                formData.append('cover_photo', cover_photo_file);

                            // $('.cover-photo').prepend('<div class="loading" style="position:absolute;top:0;left:0;right:0;bottom:0;z-index:999;display:flex;background-color:rgba(0, 0, 0, .3);"><img style="display:block;width:25px;margin:auto;" src="/files/pleasewait.gif"></div>')
                            
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
                            this.showLoading();
                            axios.post( this.url + '/update-shop-desc', this.shopDescData)
                                .then(() => {
                                    this.removeLoading();
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
                                    this.removeLoading();
                                    swal('Oops!', 'Something wen\'t wrong, please try again later.', 'warning');
                                })
                        },
                        showLoading() {
                            $('#wait').show();
                        },
                        removeLoading() {
                            $('#wait').hide();
                        }, 

                        // Header
                        getMessages() {
                            axios.get( this.url + '/get-messages', { params: { id: this.userId }} ).then( response => {
                                this.loading = false
                            })
                        },
                        openMessages() {
                            this.loading = true
                            this.showMessages = !this.showMessages;
                            this.unreadNotification = 0;
                            this.getMessages()
                        },
                        readMessage(data) {
                            axios.post( this.url + '/read-message', data );
                        },
                    }
                @endauth
            });
        });
    </script>
@endsection

