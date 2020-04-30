@extends('layouts.frontend_layout')

@section('content')
    <div class="main-content mt2">
        <div class="content-title text-center pb2">
            <h2 class="page-title">Featured Products</h2>
            <div class="line"></div>
            <h6 class="strapline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua </h6>
        </div>

        <div class="products mt2">
            <div class="row">
                @for ($i = 0; $i < 5; $i++)
                    <div class="col-md-4">
                        <a href="{{ url('/') }}/product/1" class="item-link">
                            <div class="text-center">
                                <div class="item-img mb-3">
                                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_171b23d41c8%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_171b23d41c8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="{product name - shop name}" class="img-thumbnail">
                                </div>
                                <div class="item-details">
                                    <h6 class="shop-name text-uppercase mb-1 font-weight-bold">SHOP NAME</h6>
                                    <h6 class="item-name text-uppercase mb-3 font-weight-bold">PRODUCT NAME</h6>
                                    <h6 class="price">₱ 100.00</h6>
                                </div>
                            </div> 
                        </a>
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
