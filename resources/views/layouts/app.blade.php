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
    </style>
    @yield('extraCSS')
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
                                <a href="{{ url('dashboard') }}"><span class="fa fa-dashboard"></span> Dashboard</a>
                                <a href="{{ url('/') }}/{{ Auth::user()->url_name }}"><span class="fa fa-user-circle-o"></span> Profile</a>
                                
                                @if (Auth::user()->role == 'User-Premium')
                                    @if (Auth::user()->my_shop)
                                        <a href="{{ url('user-premium') }}/{{ Auth::user()->url_name }}/{{ Auth::user()->my_shop->shop_url }}"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                    @else
                                        <a href="#" data-toggle="modal" data-target="#setupShopModal"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                    @endif
                                @elseif(Auth::user()->role == 'User')
                                    <a href="#" class="need_upgrade"><span class="fa fa-shopping-cart"></span> My Shop</a>
                                @endif

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
                        <h3 class="text-center valami_left_content_sidebar_title">Main Menu</h3>
                        <div class="valami_left_content_sidebar_item_wrapper">
                            <a href="{{ url('dashboard') }}" class="valami_left_content_sidebar_item {{ (request()->is('dashboard')) ? 'active' : '' }}"><span class="fa fa-dashboard"></span> Dashboard</a>
                            <a href="{{ url('super-admin/users') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/users')) ? 'active' : '' }}"><span class="fa fa-users"></span> Users</a>
                            <a href="{{ url('super-admin/products') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/products')) ? 'active' : '' }}"><span class="fa fa-product-hunt"></span> Products</a>
                            <a href="{{ url('super-admin/shops') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/shops')) ? 'active' : '' }}"><span class="fa fa-shopping-cart"></span> Shops</a>
                            <a href="{{ url('super-admin/categories') }}" class="valami_left_content_sidebar_item {{ (request()->is('super-admin/categories')) ? 'active' : '' }}"><span class="fa fa-tags"></span> Categories</a>
                        </div>
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
        
        @auth
            <div id="vilami_right">
                <div class="valami_right_content">
                    test

                </div>
            </div>
        @endauth
    </div>

    @include('pages.front_end.modals.sign_up')
    @include('pages.back_end.modals.setup_shop')

    @yield('extraJS')

    <script>
        $('#submit_signup').submit(function(e) {
            e.preventDefault();

            axios.post('{{ url('sign-up') }}', $(this).serialize())
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
                            $('#setupShopModal').modal('show');
                        })
                        .catch(() => {
                            swal('Oops!', 'Something Went Wrong!', 'warning');
                        })
                  }
              });
        })

        $('#submitMyShop').submit(function(e) {
            e.preventDefault();

            axios.post('{{ url('user-premium/create-shop') }}', $(this).serialize())
                .then(function(response) {
                    window.location.replace('{{ url('user-premium') }}/'+response.data.url_name+'/'+response.data.url);
                })
                .catch(function(error) {
                    swal('Oops!', 'Something Went Wrong!', 'warning');
                })
        })
        @endauth
    </script>
</body>
</html>
