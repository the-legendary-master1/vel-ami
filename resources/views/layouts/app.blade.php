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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>
    <style>
        #sign_up_alert{
            display: none;
        }
        #sign_up_modal .modal-header{
            background-color: #ede7f1;
        }
        #sign_up_modal .modal-body{
            max-width: 335px;
            margin: 20px auto;
        }
        #sign_up_modal .modal-content{
            width: 400px;
            margin: 0 auto;
        }
        .sign_up_btn{
            font-size: 16px;
            background-color: #ede7f1;
            padding: 5px 25px;
            color: #000000;
        }
    </style>
    @yield('extraCSS')
<body>
    <div id="app">
        <div id="vilami_top">
            <div class="row">
                <div class="col-sm-3 vcenter text-left valami_brand">
                    <span>VEL</span> ami
                </div>  

                <div class="col-sm-6 vcenter text-center">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-marker fa-2x"></span></span>
                      <input type="text" class="form-control velami_header_search text-center" placeholder="What are you looking for?">
                    </div>
                </div>

                <div class="col-sm-3 vcenter text-right">
                    @auth
                        <div class="velami_header_user">
                            <img src="{{ asset('files/default_user.jpg') }}" class="valami_header_user_img" height="40px" alt="">
                            {{ Auth::user()->name }}
                            <span class="fa fa-caret-down valami_header_caret"></span>
                            
                            <div class="user_dropdown_options">
                                <a href="{{ url('/') }}/{{ Auth::user()->url_name }}"><span class="fa fa-user-circle-o"></span> Profile</a>
                                <a href="#"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fa fa-sign-out"></span> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest
                        <a href="#" data-toggle="modal" data-target="#sign_up_modal">Register</a>
                    @endguest
                </div>
            </div>
        </div>

        @auth
            <div id="vilami_left">
                <div class="valami_left_content">
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
            </div>
        @endauth

        <div id="vilami_center">
            @yield('content')
        </div>
        
        @auth
            <div id="vilami_right">
                <div class="valami_right_content">
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
        @endauth
    </div>

    @include('pages.front_end.modals.sign_up')

    @yield('extraJS')

    <script>
        $('#submit_signup').submit(function(e) {
            e.preventDefault();

            axios.post('{{ url('/sign-up') }}', $(this).serialize())
                .then(function(response) {
                    window.location.replace('{{ url('dashbaord') }}');
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
    </script>
</body>
</html>
