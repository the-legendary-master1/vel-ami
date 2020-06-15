@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left show-desktop">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#!">Home</a></li>
                    <li class="breadcrumb-item active">Library</li>
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
                    <a href="{{ url('/') }}/view-shop" class="btn btn-default btn-sm">VIEW SHOP</a>
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
                            <div class="slida-wrappa">
                                <nav class="prThumbnail show-desktop">
                                    <ul id="bx-pager">
                                        <li>
                                            <a data-slide-index="0" href="#/" class="active">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-slide-index="1" href="#/">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-slide-index="2" href="#/">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-slide-index="3" href="#/">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-slide-index="4" href="#/">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-slide-index="5" href="#/">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-slide-index="6" href="#/">
                                                <img src="{{ url('/') }}/files/products/shopname/categories/test.png" class="img-thumbnail">
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="prGal">
                                    <div class="product--slider product--list">
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/6.jpg" class="img-responsive">
                                        </div>
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/2.jpg" class="img-responsive">
                                        </div>
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/3.jpg" class="img-responsive">
                                        </div>
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/4.jpg" class="img-responsive">
                                        </div>
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/5.jpg" class="img-responsive">
                                        </div>
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/6.jpg" class="img-responsive">
                                        </div>
                                        <div class="product--item">
                                            <img src="{{ url('/') }}/files/products/shopname/categories/7.jpg" class="img-responsive">
                                        </div>
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
                                    <label for="shop-name" class="text-uppercase"><h4><strong>SHOP NAME</strong></h4></label>
                                </div>
                                <div class="post-meta post-title">
                                    <label for="title" class="text-uppercase"><h3>Product Name</h3></label>
                                </div>
                                <div class="post-meta post-price clearfix">
                                    <label for="price">P 100.00</label>
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
                        <div class="hide-and-seek show-desktop">
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
                                        <div class="mb1 show-mobile">
                                            <h5 class="text-muted text-uppercase">* Details</h5>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane" id="post-reviews">
                                <div id="more-info-wrapper">
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
                                    <div class="reviews">
                                        <div class="row">
                                            <div class="col-md-2 cus-col no-pr">
                                                <div class="user-icon">
                                                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                </div>
                                                <div class="userFLname show-mobile">
                                                    <h5>Firstname Lastname</h5>
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
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star-o"></span>
                                                            <span class="text-info fa fa-star-o"></span>
                                                        </div>
                                                        <div class="review-meta-data pull-left">
                                                            <span class="date">08.40 AM, Wednesday</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                    <div class="show-desktop">
                                                        <div class="review-meta-data pull-left">
                                                            <span class="date">2 min ago</span>
                                                        </div>
                                                        <div class="review-rating pull-right">
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star-o"></span>
                                                            <span class="text-info fa fa-star-o"></span>
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
    
                                                {{-- REPLY --}}
                                                <section class="reply" id="rpliees">
                                                    <div class="row no-m">
                                                        <label for="response" class="fr-store">
                                                            <small class="label label-info"><i>Reply from store</i></small>
                                                        </label>
                                                        <div class="col-md-2 cus-col no-pr">
                                                            <div class="user-icon">
                                                                <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                            </div>
                                                            <div class="userFLname show-mobile">
                                                                <h5>Firstname Lastname</h5>
                                                            </div>
                                                            <div class="review-option show-mobile">
                                                                <a href="#" class="report-dis">
                                                                    <span class="fa fa-ellipsis-v fa-2x text-muted"></span>
                                                                </a>
                                                                <div class="tglDrDn" style="display:none">
                                                                    <span>Report Abuse</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="col-md-10 cus-col no-pl">
                                                            <div class="user-review mb1">
                                                                <div class="show-mobile mt1 mb1">
                                                                    <div class="review-rating pull-left mr1">
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star-o"></span>
                                                                        <span class="text-info fa fa-star-o"></span>
                                                                    </div>
                                                                    <div class="review-meta-data pull-left">
                                                                        <span class="date">08.40 AM, Wednesday</span>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                                <div class="show-desktop">
                                                                    <div class="review-meta-data pull-left">
                                                                        <span class="date">1 min ago</span>
                                                                    </div>
                                                                    {{-- no ratings basta owner ang mo comment --}}
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
                                                            <div class="userFLname show-mobile">
                                                                <h5>Firstname Lastname</h5>
                                                            </div>
                                                            <div class="review-option show-mobile">
                                                                <a href="#" class="report-dis">
                                                                    <span class="fa fa-ellipsis-v fa-2x text-muted"></span>
                                                                </a>
                                                                <div class="tglDrDn" style="display:none">
                                                                    <span>Report Abuse</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="col-md-10 cus-col no-pl">
                                                            <div class="user-review mb1">
                                                                <div class="show-mobile mt1 mb1">
                                                                    <div class="review-rating pull-left mr1">
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star-o"></span>
                                                                        <span class="text-info fa fa-star-o"></span>
                                                                    </div>
                                                                    <div class="review-meta-data pull-left">
                                                                        <span class="date">08.40 AM, Wednesday</span>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                                <div class="show-desktop">
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
                                                <div class="userFLname show-mobile">
                                                    <h5>Firstname Lastname</h5>
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
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star"></span>
                                                            <span class="text-info fa fa-star-o"></span>
                                                            <span class="text-info fa fa-star-o"></span>
                                                        </div>
                                                        <div class="review-meta-data pull-left">
                                                            <span class="date">08.40 AM, Wednesday</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                    <div class="show-desktop">
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
                                                    <div class="view-replies show-mobile">
                                                        <button class="btn btn-vrep toggle--replies" data-target="#rpliees">
                                                            <span class="fa fa-reply"></span> View 112 replies
                                                        </button>
                                                        <button class="btn btn-vrep">
                                                            Reply
                                                        </button>
                                                    </div>
                                                </div>
    
                                                {{-- REPLY --}}
                                                <section class="reply" id="rpliees">
                                                    <div class="row no-m">
                                                        <label for="response" class="fr-store">
                                                            <small class="label label-info"><i>Reply from store</i></small>
                                                        </label>
                                                        <div class="col-md-2 cus-col no-pr">
                                                            <div class="user-icon">
                                                                <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" width="45px" height="45px">
                                                            </div>
                                                            <div class="userFLname show-mobile">
                                                                <h5>Firstname Lastname</h5>
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
                                                            <div class="user-review mb1">
                                                                <div class="show-mobile mt1 mb1">
                                                                    <div class="review-rating pull-left mr1">
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star"></span>
                                                                        <span class="text-info fa fa-star-o"></span>
                                                                        <span class="text-info fa fa-star-o"></span>
                                                                    </div>
                                                                    <div class="review-meta-data pull-left">
                                                                        <span class="date">08.40 AM, Wednesday</span>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                Dolor sed viverra ipsum nunc aliquet bibendum enim. </p>
                                                                <div class="show-desktop">
                                                                    <div class="review-meta-data pull-left">
                                                                        <span class="date">1 min ago</span>
                                                                    </div>
                                                                    {{-- no ratings basta owner ang mo comment --}}
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
                                                                <div class="show-desktop">
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
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- input review --}}
                                    <div class="input-container clearfix">
                                        <div class="inputtts">
                                            <label for="input-review" class="show-desktop">Write a review</label>
                                            <div class="input-group">
                                                <label for="review-imgs" class="cursor show-mobile upload-photos-mbl"><span class="fa fa-camera"></span></label>
                                                <textarea name="review" id="input-review" placeholder="Write a review..."></textarea>
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
        $('.review-emots').on('click', function() {
            $('.emojionearea-button').trigger('click');
        });
        var ii = $(".selectpicker-ratings > option").map(function() { 
            return $(this).text(); 
            // console.log($(this).text());
        });

        $.each(ii, function(index, val) {
            console.log(index, val);
        });
    });
</script>
@endsection
