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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/extra_css/emoji.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/css/bootstrap-select.min.css">
    @yield('extraCSS')
</head>
<style>
    #sign_up_alert{
        display: none;
    }
</style>
<body class="sp">
    <div id="app">
        <nav class="navbar navbar-default @auth @else not-authen @endauth">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <div class="navbar-sp-categ pull-left show-mobile" data-target="#categories">
                            <a href="#"><span class="fa fa-bars"></span></a>
                        </div>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="{{ url('/') }}">VEL-AMI</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        {{-- @auth --}}
                            {{-- @if (Auth::user()->role != 'Super-Admin') --}}
                                <div class="search-operation @auth authen @endauth">
                                    <span>
                                        <i class="fa fa-map-marker show-desktop"></i>
                                        <i class="fa fa-arrow-left show-mobile"></i>
                                    </span>
                                    <input type="text" class="form-control velami_header_search text-center" placeholder="What are you looking for?">
                                    <span><span class="fa fa-search"></span></span>
                                </div>
                            {{-- @endif --}}
                        {{-- @endauth --}}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-9">
                        <div class="navbar-sp-menu show-mobile pull-right">
                            <ul>
                                <li><a href="#" class="click--search" data-target=".search-operation"><span class="fa fa-search"></span></a></li>
                                @auth
                                    <li>
                                        <a href="#" class="click--ellipsis" data-target="#navbar-menu">
                                            <img src="{{ asset('files/default_user.jpg') }}" width="25px" class="img-circle img-responsive">
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="#" class="click--ellipsis" data-target="#navbar-menu">
                                            <span class="fa fa-ellipsis-v"></span>
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                        <div id="navbar-menu" class="navbar-options">
                            <ul class="nav navbar-nav navbar-right navbar-logregs">
                                @guest
                                    <li class="reg"><a href="#" class="hover-nav-link" data-toggle="modal" data-target="#sign_up_modal">Sign Up</a></li>
                                    <li class="log"><a href="#" class="hover-nav-link" data-toggle="modal" data-target="#loginModal">Login</a></li>
                                @else
                                    <li class="show-desktop">
                                        <div class="navbar-menu--click navbar-menu--hover cursor clearfix">
                                            <figure>
                                                <img src="{{ asset('files/telegram.png') }}" class="img-circle img-responsive img-thumbnail">
                                            </figure>
                                            <div class="ctr-notif">
                                                <span class="label label-danger">5</span>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu" id="item-list">
                                            <li>
                                                @for ($i = 0; $i < 3; $i++)
                                                    <a href="#">
                                                        <div class="item">
                                                            <div class="item-img">
                                                                <img src="{{ asset('files/shop.png') }}" class="img-circle img-responsive img-thumbnail" width="45px">
                                                            </div>
                                                            <div class="qty">
                                                                <span class="label label-qty">{{ $i + 99 }}</span>
                                                            </div>
                                                            <div class="item-name-price">
                                                                <div class="i-name">
                                                                    <span>Mechanical Red Dragon Keyboard RGB</span>
                                                                </div>
                                                                <div class="i-price">
                                                                    <span>P 750.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endfor
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="show-desktop">
                                        <div class="navbar-menu--click navbar-menu--hover cursor clearfix">
                                            <figure>
                                                <img src="{{ asset('files/bell.png') }}" class="img-circle img-responsive img-thumbnail">
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
                                                    <img src="{{ asset('files/default_user.jpg') }}" class="img-circle img-responsive img-thumbnail">
                                                </figure>
                                                <div class="profile-option">
                                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                                    <span class="fa fa-caret-down valami_header_caret"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu">
                                            @if (Auth::user()->role == 'Super-Admin')
                                                <li>
                                                    <a href="{{ url('super-admin/dashboard') }}"><span class="fa fa-dashboard"></span> Dashboard</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ url('profile') }}/{{ Auth::user()->id }}"><span class="fa fa-user-circle-o"></span> Profile</a>
                                            </li>
                                            <li class="show-mobile">
                                                <a href="#" class="msgs" data-toggle="modal" data-target="#msgsModal">
                                                    <span class="fa fa-telegram"></span>
                                                    Messages
                                                    <span class="label label-danger">5</span>
                                                </a>
                                            </li>
                                            @if (Auth::user()->role == 'User-Premium')
                                                @if (Auth::user()->my_shop)
                                                    <li>
                                                        <a href="{{ url('shop/' .strtolower(Auth::user()->my_shop['name'])). '/' .base64_encode(Auth::user()->my_shop['id']) }}"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#setup_shop_modal"><i class="fa fa-shopping-cart"></i> My Shop</a>
                                                    </li>
                                                @endif
                                            @endif
                                            @if (Auth::user()->role == 'User')
                                                <li>
                                                    @if(Auth::user()->for_upgrade == 0)
                                                        <a href="#" class="need_upgrade"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                                    @elseif(Auth::user()->for_upgrade == 1)
                                                        <a href="#" class="need_upgrade_sent"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                                    @endif
                                                </li>
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
                    <div class="col-md-3 cus-col sticky-sidebar show-desktop no-padding col-sidebar col-sidebar-left" id="categories">
                        <div class="sidebar-wrapper">
                            <div class="menus">
                                <h5 class="title text-uppercase text-center">Categories</h5>
                                <ul>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-car"></i> Automotives & Motorcylcles</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-university"></i> Babies & Kids</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-car"></i> Construction & Industrial</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-car"></i> Electronics</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-car"></i> Fashion Accessories</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-male"></i> Men’s Fashion</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-female"></i> Women’s Fashion</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-apple"></i> Food & Beverages</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-car"></i> Groceries</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-medkit"></i> Health & Personal Care</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-home"></i> Home & Living</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-h-square"></i> Hobbies & Stationaries</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-paw"></i> Pet Care</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-car"></i> Sports & Travel</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#"><i class="fa fa-gamepad"></i> Toys, Games & Collectibles</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-xs-12 cus-col col-content">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-xs-12 bordered col-content">
                                @yield('content')
                            </div>
                            <div class="col-lg-3 col-md-3 show-desktop no-padding col-sidebar col-sidebar-right">
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
                </div>
            </div>
        </main>
    </div>

    @include('pages.front_end.modals.forgot_password')
    @include('pages.front_end.modals.login')
    @include('pages.back_end.modals.user_premium.setup_shop')
    @include('pages.front_end.modals.sign_up')
    @include('pages.front_end.modals.messages_modal')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/extra_js/emoji.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/js/bootstrap-select.min.js"></script>
    @yield('extraJS')
    <script>
        $(function() {

            $('.navbar-menu--click').on('click', function(e) {
                var nxt = $(this).next();
                
                $('#navbar-menu').find('.dropdown-menu').removeClass('show');
                nxt.toggleClass('show');
                $(this).toggleClass('active');

                e.stopPropagation();
                $(document).click(function() {
                    nxt.removeClass('show'); 
                });
            });

            $('.navbar-sp-categ, .click--ellipsis, .click--search').on('click', function(e) {
                var target = $(this).data('target');

                $(target).toggle();
                $(target).toggleClass('active');

                $(target).find('a').click(function(e) {
                    e.preventDefault();

                    $(this).parents(target).hide();
                });

                e.stopPropagation();
                
                $('.search-operation input').click(function(e) {
                    e.stopPropagation();
                });

                // if (target != ".search-operation") {
                     $(document).click(function(){
                        $(target).hide(); 
                    });
                // }
            });

            $('#authenticate').on('submit', function(e) {
                axios.post('{{ url('login') }}', $(this).serialize())
                    .then(function(response) {
                        window.location.reload();
                    })
                    .catch(function(error) {
                        var errors = error.response;

                                console.log(errors);

                        if (errors.statusText === 'Unprocessable Entity' || errors.status === 422) {
                            if (errors.data) {
                                console.log(errors.data.errors.email);
                                if (errors.data.errors.email) {
                                    $('input[type="email"]').parents('.form-group').addClass('has-error');
                                    $('input[type="email"]').next().show();
                                    $('input[type="email"]').next().find('strong').text(errors.data.errors.email);
                                }
                                if (errors.data.errors.password) {
                                    $('input[type="password"]').parents('.form-group').addClass('has-error');
                                    $('input[type="password"]').next().show();
                                    $('input[type="password"]').next().find('strong').text(errors.data.errors.password);
                                }
                            }
                        }
                    })
                e.preventDefault();
                return false;
            })
            $('#resetPassword').on('submit', function(e) {

                axios.post('{{ url('password/email') }}', $(this).serialize())
                    .then(function(response) {
                        console.log(response);
                        // window.location.reload();
                    })
                    .catch(function(error) {
                        var errors = error.response;
                        console.log(errors);
                    })
                e.preventDefault();
                return false;
            });
        });
    </script>

    <script>
        $('#submit_signup').submit(function(e) {
            e.preventDefault();

            axios.post('{{ url('sign-up') }}', $(this).serialize())
                .then(function(response) {
                    window.location.reload();
                })
                .catch(function(error) {
                    if(error.response.data.errors.length != '') {
                        $('#sign_up_alert').show();

                        setTimeout(function() {
                            $('#sign_up_errors').html('');

                            $.each(error.response.data.errors, function(index, val) {
                                $('#sign_up_errors').append('<li>'+val+'</li>');
                            })
                        })
                    } else {
                        $('#sign_up_alert').hide();
                    }

                    grecaptcha.reset();
                })
        })

        @auth
            $('body').on('click', '.need_upgrade', function() {
                swal({
                    title: "Upgrade Now!",
                    text: "To avail this feature need to account to upgrage.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete,) => {
                      if (willDelete) {
                          axios.post('{{ url('upgrade-account') }}', {id: {{ Auth::user()->id }}})
                            .then(() => {
                                swal('Request sent!', 'Please contact the admin and wait for approval!', 'success');

                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500)
                            })
                            .catch(() => {
                                swal('Oops!', 'Something Went Wrong!', 'warning');
                            })
                      }
                  });
            })

            $('body').on('click', '.need_upgrade_sent', function() {
                swal('Request sent!', 'Please contact the admin and wait for approval!', 'warning');
            })

            $('#submitMyShop').submit(function(e) {
                e.preventDefault();

                axios.post('{{ url('user-premium/create-shop') }}', $(this).serialize())
                    .then(function(response) {
                        window.location.replace('{{ url('view-shop') }}');
                    })
                    .catch(function(error) {
                        swal('Oops!', 'Something Went Wrong!', 'warning');
                    })
            })
        @endauth
    </script>
</body>
</html>