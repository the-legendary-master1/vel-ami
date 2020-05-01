@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left pb2">
        <nav class="navbar navbar-expand-md navbar-dark primary-color mb-5 no-content">
            <div class="mr-auto text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#!">Home</a></li>
                        <li class="breadcrumb-item active">Library</li>
                    </ol>
                </nav>
            </div>
        </nav>
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
                                <li><a href="#post-reviews" data-toggle="tab"><strong>Reviews</strong></a></li>
                                <li><a href="#post-shop" data-toggle="tab"><strong>View Shop</strong></a></li>
                                <li>
                                    <a href="#chat-seller" data-toggle="tab">
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
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="post-shop">CCC</div>
                            <div class="tab-pane" id="chat-seller">DDD</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
