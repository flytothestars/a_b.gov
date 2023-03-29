<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Auth::user())
    {{--        <meta name="auth-token" content="{{ \Illuminate\Support\Facades\Session::get('access_token')[0] }}">--}}
    @endif
    <link rel="icon" href="{{asset('/images/favicon.ico')}}">
    <title>
        @yield('title')
    </title>

    @include('client.layouts.meta')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('venders/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/client.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
    @yield('css')
</head>

<body>
    @if (!in_array(Route::currentRouteName(), ['profile.info',
    'password.change.index','appeals.index','appeals.create','appeals.show','appeals.edit']))
    <div id="app" class="wrapper">
        @include('client.layouts.header')
        @yield('content')
        @include('client.layouts.footer')
    </div>
    @else
    <div id="app" class="profile__wrapper overflow-auto">
        <div class="d-lg-block d-none">
            @include('client.layouts.sideMenu')
        </div>
        <div class="d-lg-none d-block">
            @include('client.layouts.mobileSideMenu')
        </div>
        <div class="p-md-4 px-2 pt-3 w-100 main-content">
            <div class="profile__card ">
                @yield('content')
            </div>
        </div>
    </div>
    @endif

    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js"></script>
    <div id="recaptchaContainer"></div>
    <script defer src="{{ asset('venders/owl-carousel/owl.carousel.min.js') }}"></script>
    <script defer src="{{ asset('venders/jquery-inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script defer src="{{ asset('venders/fontawesome-free-5.15.3/all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('venders/MultiFile/jquery.MultiFile.min.js') }}" type="text/javascript" language="javascript">
    </script>
    <script src="{{ asset('js/kalkan.js') }}" type="text/javascript" language="javascript"></script>
    <script src="{{ asset('js/index.js') }}" type="text/javascript" language="javascript"></script>




    <script>
    $(document).ready(function() {
        var isAuthPasswordShowed = false
        var isRegisterPasswordShowed = false
        var isRegisterPasswordConfirmationShowed = false

        $('#authEyeIcon').click(function() {
            if (isAuthPasswordShowed) {
                $('#authEyeIcon').attr('src', '{{asset(' / images / closed - eye.svg ')}}');
                $('#authPasswordInput').prop('type', 'password');
                isAuthPasswordShowed = false
            } else {
                $('#authEyeIcon').attr('src', '{{asset(' / images / eye.svg ')}}');
                $('#authPasswordInput').prop('type', 'text');
                isAuthPasswordShowed = true
            }
        });

        $('#registerEyeIcon').click(function() {
            if (isRegisterPasswordShowed) {
                $('#registerEyeIcon').attr('src', '{{asset(' / images / closed - eye.svg ')}}');
                $('#registerPasswordInput').prop('type', 'password');
                isRegisterPasswordShowed = false
            } else {
                $('#registerEyeIcon').attr('src', '{{asset(' / images / eye.svg ')}}');
                $('#registerPasswordInput').prop('type', 'text');
                isRegisterPasswordShowed = true
            }
        });

        $('#registerConfirmationEyeIcon').click(function() {
            if (isRegisterPasswordConfirmationShowed) {
                $('#registerConfirmationEyeIcon').attr('src', '{{asset(' / images / closed - eye
                    .svg ')}}');
                $('#registerPasswordConfirmationInput').prop('type', 'password');
                isRegisterPasswordConfirmationShowed = false
            } else {
                $('#registerConfirmationEyeIcon').attr('src', '{{asset(' / images / eye.svg ')}}');
                $('#registerPasswordConfirmationInput').prop('type', 'text');
                isRegisterPasswordConfirmationShowed = true
            }
        });

        $('.phone-mask').inputmask('+7 999 999 99 99', {
            autoUnmask: true,
        });

        $('.form_contains-phone').submit(function() {
            $('.phone-mask').inputmask("+79999999999")
        })

        $('#hamburger').click(function() {
            $('#sidebar').toggleClass('active');
            // $('.side-menu__logo').toggleClass('active');
            var icon = $('#toogle_arrow');
            var icon_fa_icon = icon.attr('data-icon');

            if (icon_fa_icon === "arrow-left") {
                icon.attr('data-icon', 'arrow-right');
                $('.side-menu__logo').attr('src', '{{asset(' / images / logo - mini.png ')}}');
            } else {
                icon.attr('data-icon', 'arrow-left');
                $('.side-menu__logo').attr('src', '{{asset(' / images / light - logo.svg ')}}');
            }

        });

    });

    function showRegisterForm() {
        $('#loginForm').addClass('d-none')
        $('#registerForm').removeClass('d-none')
    }

    function showLoginForm() {
        $('#loginForm').removeClass('d-none')
        $('#registerForm').addClass('d-none')
    }

    $('#mobile-btn').on('click', function(e) {
        $(this).toggleClass('active');
        $('.side-menu__wrapper').toggleClass('active');
    });
    </script>
    @yield('js')
</body>

</html>