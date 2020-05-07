@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#!">Home</a></li>
                    <li class="breadcrumb-item active">Library</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="main-content mt2">
        <div class="post-wrapper">
            <section class="pb3">
                <div class="row">
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <div class="post-details">
                            <div class="text-center mb2">
                                <div class="post-meta post-shop-name">
                                    <label for="shop-name" class="text-uppercase"><h4><strong>SHOP NAME</strong></h4></label>
                                </div>
                                <div class="post-meta post-title">
                                    <label for="title" class="text-uppercase"><h3>Product Name</h3></label>
                                </div>
                                <div class="post-meta post-price">
                                    <label for="price">P 100.00</label>
                                </div>
                            </div>
                            <div class="post-meta post-excerpt">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                    Dolor sed viverra ipsum nunc aliquet bibendum
                                    enim.
                                    In massa tempor nec feugiat. Nunc aliquet
                                    bibendum enim facilisis gravida. Nisl nunc mi
                                    ipsum faucibus vitae aliquet nec ullamcorper. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="post-more-info pt3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="hide-and-seek">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#post-details" data-toggle="tab"><strong>Details</strong></a></li>
                                <li><a href="#post-reviews" data-toggle="tab" ><strong>Reviews</strong></a></li>
                                <li><a href="{{ url('/') }}/view-shop"><strong>View Shop</strong></a></li>
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
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane" id="post-reviews">
                                <div id="more-info-wrapper">
                                    <div class="reviews">
                                        <div class="row">
                                            <div class="col-md-2 cus-col no-pr">
                                                <div class="user-icon">
                                                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                </div>
                                            </div>
                                            <div class="col-md-10 cus-col no-pl">
                                                <div class="user-review mb1 clearfix">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>

                                                    <div class="review-meta-data pull-left">
                                                        <span class="date">08.40 AM, Wednesday</span>
                                                    </div>
                                                    <div class="review-rating pull-right">
                                                        <span class="text-info fa fa-star"></span>
                                                        <span class="text-info fa fa-star"></span>
                                                        <span class="text-info fa fa-star"></span>
                                                        <span class="text-info fa fa-star-o"></span>
                                                        <span class="text-info fa fa-star-o"></span>
                                                    </div>
                                                </div>
    
                                                {{-- REPLY --}}
                                                <section class="reply">
                                                    <div class="row no-m">
                                                        <label for="response" class="fr-store">
                                                            <small class="label label-info"><i>Reply from store</i></small>
                                                        </label>
                                                        <div class="col-md-2 cus-col no-pr">
                                                            <div class="user-icon">
                                                                <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 cus-col no-pl">
                                                            <div class="user-review">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>

                                                                <div class="review-meta-data pull-left">
                                                                    <span class="date">08.40 AM, Wednesday</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="line"></div>
                                                    <div class="row no-m">
                                                        <div class="col-md-2 cus-col no-pr">
                                                            <div class="user-icon">
                                                                <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 cus-col no-pl">
                                                            <div class="user-review">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                                <div class="review-meta-data pull-left">
                                                                    <span class="date">1 min ago</span>
                                                                </div>
                                                                <div class="review-rating pull-right">
                                                                    <span class="text-info fa fa-star"></span>
                                                                    <span class="text-info fa fa-star"></span>
                                                                    <span class="text-info fa fa-star"></span>
                                                                    <span class="text-info fa fa-star-o"></span>
                                                                    <span class="text-info fa fa-star-o"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reviews">
                                        <div class="row">
                                            <div class="col-md-2 cus-col no-pr">
                                                <div class="user-icon">
                                                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                </div>
                                            </div>
                                            <div class="col-md-10 cus-col no-pl">
                                                <div class="user-review mb1 clearfix">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>

                                                    <div class="review-meta-data pull-left">
                                                        <span class="date">08.40 AM, Wednesday</span>
                                                    </div>
                                                    <div class="review-rating pull-right">
                                                        <span class="text-info fa fa-star"></span>
                                                        <span class="text-info fa fa-star"></span>
                                                        <span class="text-info fa fa-star"></span>
                                                        <span class="text-info fa fa-star-o"></span>
                                                        <span class="text-info fa fa-star-o"></span>
                                                    </div>
                                                </div>
    
                                                {{-- REPLY --}}
                                                <section class="reply">
                                                    <div class="row no-m">
                                                        <label for="response" class="fr-store">
                                                            <small class="label label-info"><i>Reply from store</i></small>
                                                            <span> - </span>
                                                            <small class="date">8 mins ago</small>
                                                        </label>
                                                        <div class="col-md-2 cus-col no-pr">
                                                            <div class="user-icon">
                                                                <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 cus-col no-pl">
                                                            <div class="user-review">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- input review --}}
                                    <div class="input-container clearfix">
                                        <div class="inputtts">
                                            <label for="input-review">Write a review</label>
                                            <div class="input-group">
                                                <textarea name="review" id="input-review"></textarea>
                                                <div class="input-options">
                                                    <div class="input-imgs">
                                                        <input type="file" name="review-imgs" class="d-none hidden" id="review-imgs">
                                                        <label for="review-imgs" class="cursor"><span class="fa fa-picture-o"></span></label>
                                                    </div>
                                                    <div class="input-emots">
                                                        <button class="review-emots">
                                                            <span class="fa fa-smile-o"></span>
                                                        </button>
                                                    </div>
                                                    <div class="input-ratings">
                                                        <select name="review-ratings" class="fa cursor">
                                                            <option value="5">5.0 &#xF005</option>
                                                            <option value="4">4.0 &#xF005</option>
                                                            <option value="3">3.0 &#xF005</option>
                                                            <option value="2">2.0 &#xF005</option>
                                                            <option value="1">1.0 &#xF005</option>
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
