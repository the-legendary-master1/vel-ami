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
    @yield('extraCSS')
<body>
    <div id="app">
{{--         <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <strong>Vel</strong> ami
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#sign_up_modal">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
        </nav> --}}

        <div id="vilami_top">
            <div class="row align-items-center">
                <div class="col-sm-3  vcenter text-left valami_brand">
                    <span>VEL</span> ami
                </div>  

                <div class="col-sm-6 vcenter text-center">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"><span class="fa fa-map-marker fa-2x"></span></span>
                      <input type="text" class="form-control velami_header_search">
                    </div>
                </div>

                <div class="col-sm-3 vcenter text-right">
                    <span class="velami_header_user">
                        <img src="{{ asset('files/default_user.jpg') }}" class="valami_header_user_img" height="40px" alt="">
                        <span class="velami_header_user_option">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="fa fa-caret-down valami_header_caret"></span>
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div id="vilami_left">
            <div class="valami_left_content">
                test
            </div>
        </div>

        <div id="vilami_center">
            @yield('content')
        </div>

        <div id="vilami_right">
            <div class="valami_right_content">
                test
            </div>
        </div>
    </div>

    @include('pages.front_end.modals.sign_up')

    @yield('extraJS')

    <script>
        $('#submit_signup').submit(function(e) {
            e.preventDefault();

            axios.post('{{ url('/sign-up') }}', $(this).serialize())
                .then(function(response) {
                    $('#sign_up_modal').modal('hide');
                    swal({
                        title: "Good job!",
                        text: "Successfully Updated",
                        icon: "success",
                        timer: 1500,
                        buttons: false,
                    })

                    setTimeout(function() {
                        location.reload();
                    }, 1000)
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
