<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                VEL-AMI
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        @auth
                            @if (Auth::user()->role != 'Super-Admin')
                                <div class="search-operation">
                                    <span><span class="fa fa-map-marker"></span></span>
                                    <input type="text" class="form-control velami_header_search text-center" placeholder="What are you looking for?">
                                    <span><span class="fa fa-search"></span></span>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right navbar-logregs">
                                @guest
                                    <li class="reg"><a href="#" class="hover-nav-link" data-toggle="modal" data-target="#sign_up_modal">Sign Up</a></li>
                                    <li class="log"><a href="#" class="hover-nav-link" data-toggle="modal" data-target="#loginModal">Login</a></li>
                                @else
                                    <li>
                                        <div class="navbar-menu--click navbar-menu--hover cursor clearfix">
                                            <figure>
                                                <img src="{{ asset('files/default_user.jpg') }}" class="img-circle img-responsive">
                                            </figure>
                                            <div class="ctr-notif">
                                                <span class="label label-danger">5</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="navbar-menu--click navbar-menu--hover cursor clearfix">
                                            <figure>
                                                <img src="{{ asset('files/default_user.jpg') }}" class="img-circle img-responsive">
                                            </figure>
                                            <div class="ctr-notif">
                                                <span class="label label-danger">5</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <div class="navbar-menu--click navbar-menu--hover cursor clearfix">
                                            <div class="nav-profile">
                                                <figure>
                                                    <img src="{{ asset('files/default_user.jpg') }}" class="img-circle img-responsive">
                                                </figure>
                                                <div class="profile-option">
                                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                                    <span class="fa fa-caret-down valami_header_caret"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ url('dashboard') }}"><span class="fa fa-dashboard"></span> Dashboard</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/') }}/{{ Auth::user()->url_name }}"><span class="fa fa-user-circle-o"></span> Profile</a>
                                            </li>
                                            @if (Auth::user()->role == 'User-Premium')
                                                @if (Auth::user()->my_shop)
                                                    <li>
                                                        <a href="{{ url('user-premium') }}/{{ Auth::user()->url_name }}/{{ Auth::user()->my_shop->shop_url }}"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#setupShopModal"><i class="fa fa-shopping-cart"></i> My Shop</a>
                                                    </li>
                                                @endif
                                            @else
                                                <a href="#" class="need_upgrade"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                            @endif

                                            <li>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i> Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
                    
                
            </div>
        </nav>
        <main>
            <div class="container-fluid">
                <div class="row main-cont d-flex">
                    <div class="col-md-3 col-lg-3 mt12 sticky-sidebar">
                        <div class="sidebar-wrapper">
                            <div class="menus">
                                <h5 class="title text-uppercase text-center">Categories</h5>
                                <ul>
                                    <li class="menu-item">
                                        <a href="#">Automotives & Motorcylcles</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Babies & Kids</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Construction & Industrial</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Electronics</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Fashion Accessories</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Men’s Fashion</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Women’s Fashion</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Food & Beverages</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Groceries</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Health & Personal Care</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Home & Living</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Hobbies & Stationaries</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Pet Care</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Sports & Travel</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Toys, Games & Collectibles</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 bordered">
                        @yield('content')
                    </div>
                    <div class="col-md-2 col-lg-2 mt12 sticky-sidebar">
                        <div class="sidebar-wrapper ads-wrapper">
                            @for ($i = 0; $i < 3; $i++)
                                <article class="mb-4">
                                    <figure>
                                        {{-- Ads img --}}
                                    </figure>
                                    <div class="ads-info">
                                        <h5 class="ads-title">Ad Title</h5>
                                        <a href="#" class="ads-link">www.ad-link.com</a>
                                        <div class="excerpt mt-2">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                                        </div>
                                    </div>
                                </article>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('pages.front_end.modals.forgot_password')
    @include('pages.front_end.modals.login')
<<<<<<< HEAD
    @include('pages.back_end.modals.user_premium.setup_shop')
=======
    @include('pages.front_end.modals.sign_up')
    @include('pages.back_end.modals.setup_shop')
>>>>>>> 88b7032e8147ce69388bf953bd563e4a580c0fa7
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extraJS')
    <script>
        $('.navbar-menu--click').on('click', function() {
            $(this).next().toggle('400');
            $(this).toggleClass('active');
        });
    </script>
</body>
</html>
