
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
            <div class="row text-center">
                @if ( count($products) )
                    @foreach ($products as $product)
                        <div class="col-md-4 pi cus-pad">
                            <div class="product--details">
                                <a href="{{ url('/product') }}/{{ preg_replace('/\s+/', '_', $product->name) }}/{{ base64_encode($product->id)}}" class="item-link">
                                    <div class="text-center item--product item--hover">
                                        <div class="item-img mb-3">
                                            <img src="{{ url('/') }}/{{ $product->thumbnail }}" alt="{{ $product->name }}" class="img-responsive">
                                        </div>
                                        <div class="item-details">
                                            <h6 class="shop-name text-uppercase mb1 font-weight-bold show-desktop">{{ $product->shop['name'] }}</h6>
                                            <h5 class="item-name mb2 font-weight-bold">{{ $product->name }}</h5>

                                            <div class="prRa clearfix">
                                                <span class="price">₱ {{ $product->price }}</span>
                                                <div class="pull-right show-mobile">
                                                    <span class="fa fa-star fa-1x text-info"></span>
                                                    <span class="fa fa-star fa-1x text-info"></span>
                                                    <span class="fa fa-star fa-1x text-info"></span>
                                                    <span class="fa fa-star fa-1x text-info"></span>
                                                    <span class="fa fa-star fa-1x text-info"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h1><i>No products available...</i></h1>
                @endif
                    
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
@endsection


