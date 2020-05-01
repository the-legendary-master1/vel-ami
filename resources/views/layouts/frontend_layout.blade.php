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
                                <a href="#"><span class="fa fa-telegram fa-md"></span></a>
                            </li>
                            <li>
                                <a href="#"><span class="fa fa-bell fa-md"></span></a>
                            </li>
                            <li><a href="#"><span class="fa fa-user-circle-o fa-md"></span></a></li>
                            <li>
                                <a href="#">{{ Auth::user()->name }} </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <span class="fa fa-caret-down fa-md"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
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
</body>
</html>
