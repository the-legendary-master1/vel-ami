
@extends('layouts.frontend_layout')

@section('content')
    <div class="content-title text-left">
        <div class="mr-auto text-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#!">Home</a></li>
                    <li class="breadcrumb-item active">Shop Name</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="header-content shop-seller">
        <div class="content-title text-center pb2 clearfix">
            <figure>
                <img src="{{ url('/') }}/files/shop.png" class="img-responsive img-thumbnail img-circle">
            </figure>
            <div class="shop-info-container">
                <h2 class="page-title">Shop Name</h2>
                <div class="line"></div>
                <h6 class="strapline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
            </div>
        </div>
    </section>
    <div class="main-content shop-seller mt2">
        @auth
            <div class="products--wrapper text-right mt2 mb2">
                <div class="product--actions">
                    <button class="btn btn-default add--product">Add</button>
                    <button class="btn btn-default delete--product" disabled>Delete</button>
                    <button class="btn btn-default unpublish--product" disabled>Unpublish</button>
                </div>
            </div>
        @endauth
        <div class="products mt2">
            <div class="row">
                @for ($i = 0; $i < 15; $i++)
                    <div class="col-md-4">
                        <div class="product--details">
                            @auth
                                <div class="product-options">
                                    <div class="btn-group-vertical">
                                        <button class="btn btn-info btn-xs edit--product" data-toggle="modal" data-target="#editProductModal"><span class="fa fa-pencil"></span></button>
                                        <label class="btn btn-danger btn-xs check-to-delete">
                                            <input type="checkbox" autocomplete="off">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                </div>
                            @endauth
                            <a href="{{ url('/') }}/product/1" class="item-link">
                                <div class="text-center item--product item--hover">
                                    <div class="item-img mb-3">
                                        <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="{product name - shop name}" class="img-thumbnail">
                                    </div>
                                    <div class="item-details">
                                        <h6 class="shop-name text-uppercase mb1 font-weight-bold">SHOP NAME</h6>
                                        <h5 class="item-name text-uppercase mb2 font-weight-bold">PRODUCT NAME</h5>
                                        <h6 class="price">₱ 100.00</h6>
                                    </div>
                                </div> 
                            </a>
                        </div>
                    </div>
                @endfor
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
        $('.product--dropify').dropify();
        $('.check-to-delete').on('change', function(e) {
            $(this).toggleClass('active');

            $(this).parents('.product-options').next().find('.item--product').toggleClass('ready-to-delete');
            $(this).parents('.product-options').next().find('.item--product').toggleClass('item--hover');
            $('.delete--product, .unpublish--product').prop('disabled', function( i, val ) {
                    return !val;
            });
            $('.delete--product').toggleClass('btn-default btn-danger');
            $('.unpublish--product').toggleClass('btn-default btn-outline-danger');
        });
    </script>
@endsection

