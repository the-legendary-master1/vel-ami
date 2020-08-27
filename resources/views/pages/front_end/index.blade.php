
@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="main-content mt2">
        <div class="content-title text-center pb2">
            <h2 class="page-title">Featured Products</h2>
            <div class="line"></div>
            <h6 class="strapline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
        </div>
        <div class="products mt2">
            <div class="row product-row text-center">
                <div v-if="!products.data.length">
                    <h1>No Products...</h1>
                </div>
                <div v-else class="col-md-4 pi cus-pad" v-for="(product, key) in products.data">
                    <div class="product--details" v-cloak>
                        <a :href="`{{ url('/product') }}/${product.url}/${product.id}`" class="item-link">
                            <div class="text-center item--product item--hover">
                                <div class="item-img mb-3">
                                    <img v-for="(image, index) in product.images" v-if="index == 0" :src="'{{ url('/') }}/' + image.path" :alt="product.name" class="img-responsive">
                                </div>
                                <div class="item-details">
                                    <h6 class="shop-name text-uppercase mb1 font-weight-bold show-desktop">@{{ product.shop.name }}</h6>
                                    <h5 class="item-name mb2 font-weight-bold">@{{ product.name }}</h5>

                                    <div class="prRa clearfix">
                                        <span class="price">₱ @{{ product.price }}</span>
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

@endsection
@section('extraJS')
    <script>
        $(function() {
            const app = new Vue({
                el: '#app',
                data: {
                    products: {!! json_encode($products) !!},

                    @auth
                        userId: '{{ Auth::user()->id }}',
                        url: '{{ url(strtolower(Auth::user()->role)) }}',
                        
                        // Header
                        unreadNotification: {!! json_encode($unreadNotification) !!},
                        showMessages: false,
                        loading: false,
                        allMessages: [],
                    @endauth
                },
                mounted() {
                    $('.navbar-menu--click').on('click', function(e) {
                        var nxt = $(this).next();
                        
                        $('#navbar-menu').find('.dropdown-menu').removeClass('show');
                        nxt.toggleClass('show');
                        $(this).toggleClass('active');

                        e.stopPropagation();
                        $(document).click(function() {
                            nxt.removeClass('show'); 
                        });
                    });
                    
                    Echo.channel('get-message-notifications').listen('.get-message-notifications', (data) => {
                        console.log(data);
                        if (data.user == this.userId)
                            this.allMessages = data.message;
                    })
                    Echo.channel('get-unread-notifications').listen('.get-unread-notifications', (data) => {
                        if (data.user.id == this.userId)
                            this.unreadNotification = data.unread
                    })
                },
                methods: {

                    @auth
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
                    @endauth
                },
            });
        })
    </script>
@endsection


