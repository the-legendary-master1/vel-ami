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
    @yield('extraCSS')
</head>
<body>
    <div id="app">
        <div id="vilami_top">
            <div class="row">
                <div class="col-sm-3 vcenter text-left valami_brand">
                    <a href="{{ url('/') }}"><span>VEL</span> ami</a>
                </div>  

                <div class="col-sm-6 vcenter text-center">
                    @auth
                        @if (Auth::user()->role != 'Super-Admin')
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-marker fa-2x"></span></span>
                              <input type="text" class="form-control velami_header_search text-center" placeholder="What are you looking for?">
                            </div>
                        @endif
                    @endauth
                </div>

                <div class="col-sm-3 vcenter text-right">
                    @auth
                        <div class="velami_header_user">
                            <img src="{{ asset('files/default_user.jpg') }}" class="valami_header_user_img" height="40px" alt="">
                            {{ Auth::user()->name }}
                            <span class="fa fa-caret-down valami_header_caret"></span>
                            
                            <div class="user_dropdown_options">
                                <a href="{{ url('super-admin/dashboard') }}"><span class="fa fa-dashboard"></span> Dashboard</a>
                                <a href="{{ url('/') }}/{{ Auth::user()->url_name }}"><span class="fa fa-user-circle-o"></span> Profile</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fa fa-sign-out"></span> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest
                        <div class="velami_header_guest">
                            <a href="{{ url('login') }}">Login</a> |
                            <a href="#" data-toggle="modal" data-target="#sign_up_modal">Register</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        @auth
            <div id="vilami_left">
                <div class="valami_left_content">
                    @if (Auth::user()->role == 'Super-Admin')
                        @if (request()->is(Auth::user()->url_name))
                            <div class="user_profile_img_wrapper">
                                <img :src="'{{ asset('files') }}/'+thisUser.img_path" class="profile_img_holder" height="190" width="190" alt="" v-if="thisUser.img_path">
                                <img src="{{ asset('files/default_user.jpg') }}" class="profile_img_holder" height="190" width="190" alt="" v-else>
                                <div class="user_profile_button" data-toggle="modal" data-target="#profile_img_modal">
                                    <div><span class="fa fa-camera"></span></div>
                                    Update
                                </div>
                                <h4>@{{ thisUser.name }}</h4>
                            </div>
                        @else
                            <h3 class="text-center valami_left_content_sidebar_title">Main Menu</h3>
                            <div class="valami_left_content_sidebar_item_wrapper">
                                <a href="{{ url('super-admin/dashboard') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/dashboard')) ? 'active' : '' }}">
                                    <span class="fa fa-dashboard"></span> Dashboard
                                </a>
                                <a href="{{ url('super-admin/users') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/users')) ? 'active' : '' }}">
                                    <span class="fa fa-users"></span> Users
                                </a>
                                <a href="{{ url('super-admin/shops') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/shops')) ? 'active' : '' }}">
                                    <span class="fa fa-shopping-cart"></span> Shops
                                </a>
                                <a href="{{ url('super-admin/categories') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/categories')) ? 'active' : '' }}">
                                    <span class="fa fa-th"></span> Categories
                                </a>
                                <a href="{{ url('super-admin/tags') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/tags')) ? 'active' : '' }}">
                                    <span class="fa fa-tags"></span> Tags
                                </a>
                            </div>
                        @endif
                    @else
                        @if (request()->is(Auth::user()->url_name))
                            <div class="user_profile_img_wrapper">
                                <img :src="'{{ asset('files') }}/'+thisUser.img_path" class="profile_img_holder" height="190" width="190" alt="" v-if="thisUser.img_path">
                                <img src="{{ asset('files/default_user.jpg') }}" class="profile_img_holder" height="190" width="190" alt="" v-else>
                                <div class="user_profile_button" data-toggle="modal" data-target="#profile_img_modal">
                                    <div><span class="fa fa-camera"></span></div>
                                    Update
                                </div>
                                <h4>@{{ thisUser.name }}</h4>
                            </div>
                        @endif
                    @endif

                </div>
            </div>
        @endauth

        <div id="vilami_center">
            @yield('content')
        </div>
    </div>

    @include('pages.front_end.modals.sign_up')
    @include('pages.back_end.modals.user_premium.setup_shop')

    @yield('extraJS')
</body>
</html>
