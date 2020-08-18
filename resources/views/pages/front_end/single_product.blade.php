@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left show-desktop">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/') }}/{{ $product->category->url }}" class="white-text">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="header-content single-product-header shop-seller show-mobile">
        <div class="content-title text-center pb2 clearfix">
            <figure>
                <img src="{{ url('/') }}/files/shop.png" class="img-responsive img-thumbnail img-circle">
            </figure>
            <div class="shop-info-container">
                <h2 class="page-title">Shop Name</h2>
                <h6 class="strapline show-desktop">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
                <div class="pull-right vshop">
                    <a href="{{ url('/') }}/view-shop/{{ $product->shop['name'] }}" class="btn btn-default btn-sm">VIEW SHOP</a>
                </div>
            </div>
        </div>
    </section>

    <div class="main-content mt2">
        <div class="post-wrapper">
            <section class="pb3">
                <div class="row">
                    <div class="col-md-8">
                        <div class="prSli-wra">
                            @php
                                $images = json_decode($product->images, true);
                            @endphp
                            <div class="slida-wrappa clearfix">
                                <nav class="prThumbnail show-desktop">
                                    <ul id="bx-pager">
                                        @foreach ( $images as $index => $image )
                                            <li>
                                                <a data-slide-index="{{ $index }}" href="#/" class="{{ ($index == 0) ? "active" : "" }}">
                                                    <img src="{{ url('/') }}/{{ $image['path'] }}" class="img-thumbnail">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                                <div class="prGal">
                                    <div class="product--slider product--list">
                                        @foreach ( $images as $index => $image )
                                            <div class="product--item">
                                                <img src="{{ url('/') }}/{{ $image['path'] }}" class="img-responsive">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="prRating text-center show-desktop">
                                <div class="stars">
                                    <star-rating 
                                        :increment="0.1" 
                                        :rating="productData.total_rating" 
                                        :read-only="true"
                                        :star-size="25"
                                        :show-rating="false"
                                        active-color="#31708f">
                                    </star-rating>
                                </div>
                                <div class="rate-num">
                                    <strong>@{{ productData.total_rating }}</strong> out of 5
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="post-details">
                            <div class="text-center mb2">
                                <div class="post-meta post-shop-name show-desktop">
                                    <label for="shop-name" class="text-uppercase"><h4><strong>{{ $product->shop['name'] }}</strong></h4></label>
                                </div>
                                <div class="post-meta post-title">
                                    <label for="title" class=""><h3>{{ $product->name }}</h3></label>
                                </div>
                                <div class="post-meta post-price clearfix">
                                    <label for="price"><span class="fa">&#8369;</span> {{ $product->price }}</label>
                                    <div class="pull-right show-mobile">
                                        <star-rating 
                                            :increment="0.1" 
                                            :rating="productData.total_rating" 
                                            :read-only="true"
                                            :star-size="17"
                                            :show-rating="false"
                                            active-color="#31708f">
                                        </star-rating>
                                    </div>
                                </div>
                            </div>
                            <div class="cont-seller mb2 show-mobile">
                                <button class="btn btn-primary btn-block text-uppercase">Contact Seller</button>
                            </div>
                            <div class="post-meta post-excerpt">
                                <div class="desc mb1 show-mobile">
                                    <h5 class="text-muted text-uppercase">* Description</h5>
                                </div>
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="post-more-info pt3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="hide-and-seek show-desktop">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#post-details" data-toggle="tab"><strong>Details</strong></a></li>
                                <li><a href="#post-reviews" data-toggle="tab" ><strong>Reviews</strong></a></li>
                                <li><a href="{{ url('/view-shop') }}/{{ $product->shop['shop_url'] }}?id={{ base64_encode($product->shop['id']) }}"><strong>View Shop</strong></a></li>
                                @guest
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#loginModal">
                                            <span class="fa fa-circle fa-sm text-online online-indicator"></span>
                                            <strong>Chat Seller!</strong>
                                        </a>
                                    </li>
                                @else
                                    @if ($product->shop['user_id'] != Auth::user()->id)
                                        <li>
                                            <a href="{{ url('chat-seller/' .$product->url. '/' .$product->id. '?ref=' ) }}{{ (empty($chat->ref_id)) ? str_random(16) : $chat->ref_id }}" class="">
                                                <span class="fa fa-circle fa-sm text-online online-indicator"></span>
                                                <strong>Chat Seller!</strong>
                                            </a>
                                        </li>
                                    @endif
                                @endguest
                            </ul>
                        </div>
                        <div class="has-content tab-content">
                            <div class="tab-pane active" id="post-details">
                                <div id="more-info-wrapper">
                                    <div class="post-content">
                                        <div class="mb1 show-mobile">
                                            <h5 class="text-muted text-uppercase">* Details</h5>
                                        </div>
                                        <p>{!! $product->details !!}</p>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane" id="post-reviews">
                                <div id="more-info-wrapper">
                                    <div v-if="!reviews.data.length">
                                        <span class="text-danger">No reviews</span>
                                    </div>
                                    <div v-else>
                                        <div class="header-reviews">
                                            <div class="mb2 show-mobile">
                                                <div class="clearfix mb1">
                                                    <div class="pull-left">
                                                        <h5 class="text-muted text-uppercase">* Product Reviews</h5>
                                                    </div>
                                                    <div class="pull-right">
                                                        <a href="#" class="text-info text-underline">see all (15)</a>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="rRate-star">
                                                        <div class="mt1 mb1" style="font-size:15px;"><strong style="font-size:18px;">@{{ productData.total_rating }}</strong> out of 5</div>
                                                        <star-rating 
                                                            :increment="0.1" 
                                                            :rating="productData.total_rating" 
                                                            :read-only="true"
                                                            :star-size="18"
                                                            :show-rating="false"
                                                            active-color="#31708f">
                                                        </star-rating>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews" :data-index="key" :data-id="review.id" :key="review.id" v-for="(review, key) in reviews.data">
                                            <div class="row horizon-line">
                                                <div class="col-md-2 cus-col no-pr">
                                                    <div class="bR text-danger" v-if="review.reported.length" data-toggle="tooltip" :title="review.reported.length + ' reports'">
                                                        <span class="fa fa-flag"></span>
                                                        <span v-text="review.reported.length"></span>
                                                    </div>
                                                    <div class="user-icon">
                                                        <img :src="'{{ asset('/') }}'+review.user.img_path" class="img-circle img-thumbnail" width="45px" height="45px" v-if="review.user.img_path">
                                                        <img src="{{ asset('/files/default_user.jpg') }}" class="img-circle img-thumbnail" width="45px" height="45px" v-else>
                                                    </div>
                                                    <div class="userFLname show-mobile">
                                                        <h5>@{{ review.user.f_name }} @{{ review.user.l_name[0] }}.</h5>
                                                    </div>
                                                    <div class="review-option show-mobile">
                                                        <a href="#" class="report-dis fa fa-ellipsis-v fa-2x text-muted"></a>
                                                        <div class="tglDrDn" style="display:none">
                                                            <a class="cursor text-danger" @click="report(review.id, review.reported)"><i class="fa fa-warning"></i> Report Abuse</a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-md-10 cus-col no-pl">
                                                    <div class="user-review mb1 clearfix">
                                                        <div class="show-mobile clearfix date-rete">
                                                            <div class="review-rating pull-left mr1">
                                                                <star-rating 
                                                                    :increment="0.1" 
                                                                    :rating="parseInt(review.rating)" 
                                                                    :read-only="true"
                                                                    :star-size="13"
                                                                    :show-rating="false"
                                                                    active-color="#31708f">
                                                                </star-rating>
                                                            </div>
                                                            <div class="review-meta-data pull-left">
                                                                <span v-cloak class="date">@{{ review.created_at | moment("from", "now") }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="userFLname clearfix show-desktop">
                                                            <h5 class="pull-left">@{{ review.user.f_name }} @{{ review.user.l_name[0] }}.</h5>

                                                            <div class="review-option pull-right show-desktop">
                                                                <a href="#" class="report-dis fa fa-ellipsis-v text-muted"></a>
                                                                <div class="tglDrDn" style="display:none">
                                                                    <a class="cursor text-danger" @click="report(review.id, review.reported)"><i class="fa fa-warning"></i> Report Abuse</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="comment">
                                                            <p v-html="$options.filters.renderEmoji(review.comment)"></p>
                                                        </div>
                                                        <div class="usr-attach" v-if="review.attachments">
                                                            <div v-for="(attachment, index) in review.attachments" :style="'background-image:url({{ asset('/') }}'+attachment.path+')'"></div>
                                                        </div>
                                                        <div class="show-desktop">
                                                            <div class="review-meta-data pull-left">
                                                                <span class="date">@{{ review.created_at | moment("from", "now") }}</span>
                                                                @auth
                                                                    <button class="btn btn-vrep" @click="replyTo(review, review.user.f_name, review.user.l_name)" v-if="authId == review.product.my_shop_id">Reply</button>
                                                                @endauth
                                                            </div>
                                                            <div class="review-rating pull-right">
                                                                <star-rating 
                                                                    :increment="0.1" 
                                                                    :rating="parseInt(review.rating)" 
                                                                    :read-only="true"
                                                                    :star-size="14"
                                                                    :show-rating="false"
                                                                    active-color="#31708f">
                                                                </star-rating>
                                                            </div>
                                                        </div>
                                                        <div class="view-replies show-mobile">
                                                            {{-- <button class="btn btn-vrep es" data-target="#rpliees">
                                                                <span class="fa fa-reply"></span> {View 112 replies}
                                                            </button> --}}
                                                            @auth
                                                                <button class="btn btn-vrep" @click="replyTo(review, review.user.f_name, review.user.l_name)" v-if="authId == review.product.my_shop_id">Reply</button>
                                                            @endauth
                                                        </div>
                                                    </div>
                                                        
                                                    <section class="reply rpliees" :class="(reply.user_id == review.product.my_shop_id) ? 'seller-reply' : ''" id="rpliees" v-for="(reply, index) in review.reply" :data-reply-id="reply.id" :data-reply-index="index">
                                                        <div class="row no-m">
                                                            <label for="response" class="fr-store" v-if="reply.user_id == review.product.my_shop_id">
                                                                <small class="label label-info"><i>Reply from seller</i></small>
                                                            </label>
                                                            <div class="col-md-2 cus-col no-pr">
                                                                <div class="user-icon">
                                                                    <div v-if="reply.user_id == review.product.my_shop_id">
                                                                        <img :src="'{{ asset('/files') }}/'+review.product.shop.shop_img" class="img-circle img-thumbnail" width="45px" height="45px" v-if="review.product.shop.shop_img">
                                                                        <img src="{{ asset('/files/default_user.jpg') }}" class="img-circle img-thumbnail" width="45px" v-else>
                                                                    </div>
                                                                    <div v-else>
                                                                        <img :src="'{{ asset('/files') }}/'+reply.user.img_path" class="img-circle img-thumbnail" width="45px" height="45px" v-if="reply.user.img_path">
                                                                        <img src="{{ asset('/files/default_user.jpg') }}" class="img-circle img-thumbnail" width="45px" v-else>
                                                                    </div>
                                                                </div>
                                                                <div class="userFLname show-mobile">
                                                                    <h5 v-text="reply.user.f_name + ' ' + reply.user.l_name[0] + '.'"></h5>
                                                                </div>
                                                                {{-- <div class="review-option show-mobile">
                                                                    <a href="#" class="report-dis">
                                                                        <span class="fa fa-ellipsis-v fa-2x text-muted"></span>
                                                                    </a>
                                                                    <div class="tglDrDn" style="display:none">
                                                                        <span>Report Abuse</span>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="col-md-10 cus-col no-pl">
                                                                <div class="user-review mb1">
                                                                    <div class="show-mobile mt1 mb1">
                                                                        <div class="review-meta-data pull-left">
                                                                            <span v-cloak class="date">@{{ reply.created_at | moment("from", "now") }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="comment-reply" v-html="$options.filters.renderEmoji(reply.reply)"></p>
                                                                    <div class="show-desktop">
                                                                        <div class="review-meta-data pull-left">
                                                                            <span v-cloak class="date">@{{ reply.created_at | moment("from", "now") }}</span>
                                                                        </div>
                                                                        {{-- no ratings basta owner ang mo comment --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="line"></div> --}}
                                                        {{-- more reply --}}
                                                    </section>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Pagination --}}
                                        <pagination :data="reviews" @pagination-change-page="getReviews"></pagination>
                                        
                                    </div>
                                    @auth
                                        <div class="input-container clearfix" >
                                            <div class="inputtts">
                                                <div class="replying-to" v-if="showReply">
                                                    <div><span style="color:#111">Replying to <strong v-text="replyToUser"></strong></span></div>
                                                    <div><i style="color:#777" v-text="replyContent"></i></div>
                                                    <button class="pull-right btn btn-default btn-sm" @click="removeReply">&times;</button>
                                                </div>
                                                <div class="review-attachements" v-if="review.attachments.length">
                                                    <ul>
                                                        <li v-for="(photo, index) in review.attachments" :key="`thumb-${index}`">
                                                            <div :style="{ 'background-image': `url(${photo.preview})` }" class="preview-images"></div>
                                                            <button @click="deletePhoto(index)" class="btn btn-danger remove-preview" type="button">&times;</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <label for="input-review" class="show-desktop" @click="submitReview">Write a review</label>
                                                <div class="input-group" id="commentary" tabindex="-1">
                                                    <label for="review-imgs" class="cursor show-mobile upload-photos-mbl"><span class="fa fa-camera"></span></label>
                                                    <textarea name="review_comment" id="input-review" placeholder="Write a review..."></textarea>
                                                    <div class="input-options">
                                                        <div class="input-imgs">
                                                            <input type="file" name="review-imgs" ref="attachments" class="d-none hidden" @change="handleAttachments" id="review-imgs" multiple>
                                                            <label for="review-imgs" class="cursor show-desktop"><span class="fa fa-camera"></span></label>
                                                        </div>
                                                        <div class="input-emots">
                                                            <button class="review-emots" @click="openEmoji">
                                                                <span class="fa fa-smile-o"></span>
                                                            </button>
                                                        </div>
                                                        <div class="input-ratings">
                                                            <div v-show="showRating">
                                                                <select v-model="review.rating" class="fa cursor selectpicker-ratings selectpicker show-tick" data-none-selected-text="" data-width="100%">
                                                                    <option value="5" style="color:#31708f">
                                                                        <span>5</span> &#xF005 &#xF005 &#xF005 &#xF005 &#xF005
                                                                    </option>
                                                                    <option value="4" style="color:#31708f">
                                                                        <span>4</span> &#xF005 &#xF005 &#xF005 &#xF005
                                                                    </option>
                                                                    <option value="3" style="color:#31708f">
                                                                        <span>3</span> &#xF005 &#xF005 &#xF005
                                                                    </option>
                                                                    <option value="2" style="color:#31708f">
                                                                        <span>2</span> &#xF005 &#xF005
                                                                    </option>
                                                                    <option value="1" style="color:#31708f">
                                                                        <span>1</span> &#xF005
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-submit">
                                                            <button v-if="showReply" class="btn-send-reply re" @click="submitReply"><i class="fa fa-paper-plane"></i></button>
                                                            <button v-else class="btn-send-reply se" @click="submitReview"><i class="fa fa-paper-plane"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('extraJS')
<script>
    $(function() {
        const app = new Vue({
            el: '#app',
            data: {
                @auth
                    authId: '{{ (Auth::user()->id) ? Auth::user()->id : null }}',
                    url: '{{ url('/') }}/{{ strtolower(Auth::user()->role) }}',
                    review: {
                        user_id: '{{ Auth::user()->id }}',
                        product_id: '{{ $request->id }}',
                        attachments: [],
                        reply: [],
                        rating: 5,
                        reported: [],
                    },
                    reply: {
                        user_id: '{{ Auth::user()->id }}',
                        review_id: '',
                        reply: '',
                    },
                    showReply: false,
                    showRating: true,
                    replyContent: '',
                    replyToUser: '',

                    // Header
                    unreadNotification: {!! json_encode($unreadNotification) !!},
                    showMessages: false,
                    loading: false,
                    allMessages: [],

                @endauth
                productData: {!! json_encode($product) !!},
                reviews: {!! json_encode($reviews) !!},
            },
            mounted() {
                $('[data-toggle="tooltip"]').tooltip();
                $('#input-review').emojioneArea({
                    recentEmojis: false,
                    inline: true,
                });
                Echo.channel('get-product-reviews').listen('.get-product-reviews', () => {
                    this.getReviews();
                })
                Echo.channel('get-message-notifications').listen('.get-message-notifications', (data) => {
                    if (data.user == this.authId) {
                         console.log(this.loading);

                        this.allMessages = data.message;
                    }
                })
                Echo.channel('get-unread-notifications').listen('.get-unread-notifications', (data) => {
                    if (data.user.id == this.authId)
                        this.unreadNotification = data.unread
                })
            },
            methods: {
                handleAttachments(e) {
                    Array.from(e.target.files).forEach(file => {
                        const reader = new FileReader()
                        
                        if (!/\.(jpe?g|png)$/i.test(file.name)) {
                            swal('Invalid File Upload', 'File must be in: JPG, JPEG, PNG.', 'warning')
                            return false;
                        }
                        reader.onload = () => {
                            this.review.attachments.push({
                                preview: reader.result,
                                file
                            })
                        }
                        reader.readAsDataURL(file)
                    })
                },
                deletePhoto(index) {
                    this.review.attachments.splice(index, 1)
                },
                submitReview() {
                    let comment = $('textarea[name="review_comment"]').val();

                    if (comment === '') {
                        swal('Oops!', 'Please write your review.', 'warning');
                        return false;
                    }
                    if (this.authId == this.productData.shop.user_id) {
                        swal('Oops!', 'You cannot post your own review', 'warning');
                        return false;
                    }
                    let formData = new FormData();
                        formData.append('user_id', this.review.user_id);
                        formData.append('product_id', this.review.product_id);
                        formData.append('comment', comment);
                        formData.append('rating', this.review.rating);

                    this.review.attachments.forEach((photo, index) => {
                        formData.append('attachments[' + index + ']', photo.file);
                    })

                    axios.post( this.url + '/store-user-review', formData ).then( response => {
                        this.resetInputs();
                        swal('Thank You!', 'Your review has been submitted.', 'success');
                    })
                    .catch( error => {
                        swal('Invalid File Upload', 'File must be in: JPG, JPEG, PNG and not more than 2MB.', 'error')
                    })
                },
                getReviews(page = 1) {
                    axios.get('{{ url('/get-reviews') }}/' + this.review.product_id + '?page=' + page).then( response => {
                        this.reviews = response.data;
                    })
                },
                replyTo(reviewData, firstname, lastname) {
                    this.showReply = true;
                    this.showRating = false;
                    $('#commentary').focus();

                    let to = firstname + ' ' + lastname[0] + '.';
                    this.reply.review_id = reviewData.id;
                    this.replyContent = reviewData.comment;
                    this.replyToUser = to;
                },
                removeReply() {
                    this.showReply = false;
                    this.showRating = true;
                },
                submitReply() {
                    let reply = $('textarea[name="review_comment"]').val();

                    if (reply === '') {
                        swal('Oops!', 'Please write your review.', 'error');
                        return false;
                    }
                    
                    let formData = new FormData();
                        formData.append('user_id', this.reply.user_id);
                        formData.append('review_id', this.reply.review_id);
                        formData.append('reply', reply);

                    axios.post( '{{ url('/store-reply-review') }}', formData ).then( response => {
                        this.showReply = false;
                        this.resetInputs();
                        swal('Thank You!', 'Your reply has been posted.', 'success');
                    })
                    .catch( error => {
                        swal('Invalid File Upload', 'File must be in: JPG, JPEG, PNG and not more than 2MB.', 'error')
                    })
                },
                openEmoji() {
                    $('.emojionearea-button').trigger('click');
                },
                resetInputs() {
                    var el = $('#input-review').emojioneArea();
                        el[0].emojioneArea.setText('');
                        this.review.attachments = [];
                },
                showLoading() {
                    $('#wait').show();
                },
                removeloading() {
                    $('#wait').hide();
                }, 
                report(id, reporterId) {
                    if (this.authId == null) {
                        $('#loginModal').modal('show');
                        return false;
                    }
                    for (var i = 0; i < reporterId.length; i++) {
                        var id = reporterId[i].user_id;
                        if (id == this.authId) {
                            swal('Oops!', 'You already reported this review.', 'warning');
                            return false;
                        }
                    }
                    swal({
                        title: "Are you sure you want to report this review?",
                        text: "",
                        icon: "warning",
                        buttons: ["No", "Yes"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            let formData = new FormData();
                                formData.append('user_id', this.authId);
                                formData.append('product_review_id', id);

                            this.showLoading();
                            axios.post( this.url + '/report-review', formData ).then( response => {

                                this.removeloading();
                                swal({
                                    title: 'Success!',
                                    text: 'Review has been reported!',
                                    icon: 'success',
                                    timer: 1500,
                                    buttons: false,
                                })
                            })
                            .catch(() => {
                                this.removeloading();
                                swal('Oops!', 'Can\'t report this review, please try again later.', 'warning');
                            })
                        }
                    });
                },

                @auth
                    // Header
                    getMessages() {
                        axios.get( this.url + '/get-messages', { params: { id: this.authId }} ).then( response => {
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
            filters: {
                renderEmoji(value) {
                    if (!value) return ''
                    return emojione.toImage(value)
                }
            }
        });
        var bx = $('.product--slider').bxSlider({
            slideWidth: sliderWidth(),
            mode: sliderMode(),
            auto: false,
            onSliderLoad: function() {
                $('.slida-wrappa').css('visibility', 'visible');
            }
        });
        $('#bx-pager').bxSlider({
            slideWidth: 80,
            slideMargin: 10,
            minSlides: 5,
            mode: 'vertical',
            pager: false,
            infiniteLoop: false,
            controls: false,
            onSliderLoad: function() {
                $('.slida-wrappa').css('visibility', 'visible');
            }
        });

        function sliderWidth() {
            var wd = 500;

            if ( $(window).width() < 768 ) {
                wd = 600;
            }
            return wd;
        }
        function sliderMode() {
            var mode = 'fade';

            if ( $(window).width() < 768 ) {
                mode = 'horizontal';
            }

            return mode;
        }

        $('#bx-pager').on('mouseover', 'a', function() {
            bx.goToSlide($(this).data('slide-index'));
        });
        $('.report-dis').on('click', function(e) {
            $(this).next().toggle('400');
            e.preventDefault();
            e.stopPropagation();
        });

        $(document).on('click', function() {
            $('.tglDrDn').hide();
        })
        $('.toggle--replies').on('click', function() {
            $(this).parents('.user-review').next('.reply').toggle('400');
            $(this).parents('.user-review').next('.reply').addClass('active');
        });
        var ii = $(".selectpicker-ratings > option").map(function() { 
            return $(this).text(); 
        });
    });
</script>
@endsection
