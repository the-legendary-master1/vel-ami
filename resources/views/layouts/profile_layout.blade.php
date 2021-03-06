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
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        VEL-AMI
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
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
                                        <a href="{{ url('/') }}/profile/1"><i class="fa fa-user"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#setupShopModal"><i class="fa fa-shopping-cart"></i> My Shop</a>
                                    </li>
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
        </nav>
        <main>
            <div class="row">
                <div class="col-md-3 col-lg-3 mt12">
                    <div class="sidebar-wrapper">
                        <div class="profile-wrapper text-center">
                            <figure>
                                <img src="{{ asset('files/default_user.jpg') }}" class="img-circle img-thumbnail img-responsive">
                            </figure>
                            <span>Lastname, Firstname</span>
                        </div>
                        <div class="ads-wrapper">
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
                <div class="col-md-7 col-lg-7 bordered">
                    @yield('content')
                </div>
                <div class="col-md-2 mt12">
                    <div class="ads-wrapper">
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
        </main>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('.navbar-menu--click').on('click', function() {
            $(this).next().toggle('400');
            $(this).toggleClass('active');
        });
    </script>
</body>
</html>
