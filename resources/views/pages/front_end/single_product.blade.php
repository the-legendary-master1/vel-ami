@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left show-desktop">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/') }}/{{ strtolower($product->category->name) }}" class="white-text">{{ $product->category->name }}</a></li>
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
                                    <span class="fa fa-star fa-1-5x text-info"></span>
                                    <span class="fa fa-star fa-1-5x text-info"></span>
                                    <span class="fa fa-star fa-1-5x text-info"></span>
                                    <span class="fa fa-star fa-1-5x text-info"></span>
                                    <span class="fa fa-star fa-1-5x text-info"></span>
                                </div>
                                <div class="rate-num">
                                    <span>4.2 out of 5</span>
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
                                        <span class="fa fa-star fa-1-5x text-info"></span>
                                        <span class="fa fa-star fa-1-5x text-info"></span>
                                        <span class="fa fa-star fa-1-5x text-info"></span>
                                        <span class="fa fa-star fa-1-5x text-info"></span>
                                        <span class="fa fa-star fa-1-5x text-info"></span>
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
                                <p>{{ $product->description }}</p>
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
                                <li>
                                    <a href="{{ url('/') }}/chat">
                                        <span class="fa fa-circle fa-sm text-online online-indicator"></span>
                                        <strong>Chat Seller!</strong>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="has-content tab-content">
                            <div class="tab-pane active" id="post-details">
                                <div id="more-info-wrapper">
                                    <div class="post-content">
                                        <div class="mb1 show-mobile">
                                            <h5 class="text-muted text-uppercase">* Details</h5>
                                        </div>
                                        <p>{{ $product->details }}</p>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane" id="post-reviews">
                                <div id="more-info-wrapper">

                                    <div v-if="!reviews.length">
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
                                                        <h4 class="font-weight-bold mt1 mb1">5.0</h4>
                                                        <span class="fa fa-star fa-1-5x text-primary"></span>
                                                        <span class="fa fa-star fa-1-5x text-primary"></span>
                                                        <span class="fa fa-star fa-1-5x text-primary"></span>
                                                        <span class="fa fa-star fa-1-5x text-primary"></span>
                                                        <span class="fa fa-star fa-1-5x text-primary"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews" :data-index="key" v-for="review, key in reviews">
                                            <div class="row">
                                                <div class="col-md-2 cus-col no-pr">
                                                    <div class="user-icon">
                                                        <img :src="'{{ asset('files') }}/'+review.img_path" class="img-circle img-thumbnail" width="45px" height="45px" v-if="review.img_path">
                                                        <img src="{{ asset('/files/default_user.jpg') }}" class="img-circle img-thumbnail" width="45px" height="45px" v-else>
                                                    </div>
                                                    <div class="userFLname show-mobile">
                                                        <h5>@{{ review.user.f_name }} @{{ review.user.l_name[0] }}.</h5>
                                                    </div>
                                                    <div class="review-option show-mobile">
                                                        <a href="#" class="report-dis fa fa-ellipsis-v fa-2x text-muted"></a>
                                                        <div class="tglDrDn" style="display:none">
                                                            <span>Report Abuse</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-md-10 cus-col no-pl">
                                                    <div class="user-review mb1 clearfix">
                                                        <div class="show-mobile clearfix date-rete">
                                                            <div class="review-rating pull-left mr1">
                                                                <span class="text-info fa fa-star" v-for="n in parseInt(review.rating)"></span>
                                                                <span class="text-info fa fa-star-o" v-for="n in parseInt(5 - review.rating)"></span>
                                                            </div>
                                                            <div class="review-meta-data pull-left">
                                                                <span v-cloak class="date">@{{ review.created_at | moment("from", "now") }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="comment">
                                                            <p v-cloak>@{{ review.comment }}</p>
                                                        </div>
                                                        <div class="show-desktop">
                                                            <div class="review-meta-data pull-left">
                                                                <span class="date">@{{ review.created_at | moment("from", "now") }}</span>
                                                            </div>
                                                            <div class="review-rating pull-right">
                                                                <span class="text-info fa fa-star" v-for="n in parseInt(review.rating)"></span>
                                                                <span class="text-info fa fa-star-o" v-for="n in parseInt(5 - review.rating)"></span>
                                                            </div>
                                                        </div>
                                                        <div class="view-replies show-mobile">
                                                            <button class="btn btn-vrep toggle--replies" data-target="#rpliees">
                                                                <span class="fa fa-reply"></span> View 112 replies
                                                            </button>
                                                            <button class="btn btn-vrep">
                                                                Reply
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-container clearfix">
                                        <div class="inputtts">
                                            <label for="input-review" class="show-desktop" @click="submitReview">Write a review</label>
                                            <div class="input-group">
                                                <label for="review-imgs" class="cursor show-mobile upload-photos-mbl"><span class="fa fa-camera"></span></label>
                                                <textarea v-model="review.comment" name="review_comment" id="input-review" placeholder="Write a review..."></textarea>
                                                <div class="input-options">
                                                    <div class="input-imgs">
                                                        <input type="file" name="review-imgs" class="d-none hidden" id="review-imgs">
                                                        <label for="review-imgs" class="cursor show-desktop"><span class="fa fa-camera"></span></label>
                                                    </div>
                                                    <div class="input-emots">
                                                        <button class="review-emots">
                                                            <span class="fa fa-smile-o"></span>
                                                        </button>
                                                    </div>
                                                    <div class="input-ratings">
                                                        <select name="review-ratings" class="fa cursor selectpicker-ratings selectpicker show-tick" data-none-selected-text="" data-width="100%">
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
                                            </div>
                                        </div>
                                    </div>
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
                    url: '{{ url('/') }}/{{ strtolower(Auth::user()->role) }}',
                    review: {
                        user_id: '{{ Auth::user()->id }}',
                        product_id: '{{ $request->id }}',
                        comment: '',
                        attachments: [],
                        rating: '',
                    },
                @endauth
                reviews: {!! json_encode($reviews) !!},
            },
            mounted() {
                $.each($('#post-reviews .reviews'), function(index, val) {
                    let userReviewRaw = $(this).find('.comment').text();
                    let userReview = emojione.toImage(userReviewRaw);
                        
                    $(this).find('.comment').html(userReview);
                });
            },
            methods: {
                submitReview() {
                    let comment = $('textarea[name="review_comment"]').val();

                    let formData = new FormData();
                        formData.append('user_id', this.review.user_id);
                        formData.append('product_id', this.review.product_id);
                        formData.append('comment', comment);

                    axios.post( this.url + '/store-user-review', formData ).then( response => {
                        $.each(response.data.review, function(index, val) {
                            console.log(index,val);
                            if (index == "comments") {
                                var text = emojione.toImage(val);
                                $('#post-reviews h6').html(text);
                            }
                        });
                    })
                }
            },
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
        });
        $('.toggle--replies').on('click', function() {
            $(this).parents('.user-review').next('.reply').toggle('400');
            $(this).parents('.user-review').next('.reply').addClass('active');
        });
        $('#input-review').emojioneArea({
            recentEmojis: false,
            inline: true,
        });
        // var emojiVal = $('#post-reviews .fr-emoji').text();
        // var test = emojione.toImage(emojiVal);
        // $('#post-reviews .fr-emoji').html(test);


        $('.review-emots').on('click', function() {
            $('.emojionearea-button').trigger('click');
        });
        var ii = $(".selectpicker-ratings > option").map(function() { 
            return $(this).text(); 
        });

        $.each(ii, function(index, val) {
            // console.log(index, val);
        });
    });
</script>
@endsection
