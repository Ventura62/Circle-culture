<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tab4Six</title>
    <meta name="description" content="Join Weekly Dinners">
    <meta name="author" content="RunWebRun">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    {{--<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- START: Styles -->
    <!-- Swiper -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/swiper/dist/css/swiper.min.css') }}" />
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/fancybox/dist/jquery.fancybox.min.css') }}" />
    <!-- Themebau -->
    <link rel="stylesheet" href="{{ asset('frontend/css/themebau.min.css') }}">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <!-- END: Styles -->
    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery/dist/jquery.min.js') }}"></script>

    <style>

        :root {
            color-scheme: only light;
        }
        /* Firefox */
        @media (prefers-color-scheme: dark) {
            :root {
                color-scheme: light;
            }
        }

        /* Chrome */
        @media (forced-colors: active) {
            :root {
                color-scheme: light;
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
        }

        .fa-solid, .fas  ,i{
            font-family: "Font Awesome 6 Free" !important;
        }


        .logo-img{
            width: 75px;
        }

        .theme-button {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all  0.9s;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .theme-button:hover {
            background-color: white;
            color: black;
            transform: translateY(-2px);
        }

        .theme-button-dark{
            background-color:black;
            border: 1px solid rgba(47, 47, 47, 0.3);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all  0.3s;
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        .theme-button-dark:hover {
            background-color: white;
            color: black;
            transform: translateY(-2px);
        }

        .navbar-mobile .navbar-body>.navbar-nav {
            font-size: 17px;
        }

        .navbar-dark .navbar-nav .nav-link, .navbar-dark .navbar-nav .nav-link.active {
            color: rgba(255, 255, 255, 0.44);
        }


        @media (max-width: 768px) {
            .logo-img{

                width: 60px;
            }

            #logoutBtn{

                display: none;
            }
        }



    </style>

    @yield('styles')

</head>
<body>
<header class="navbar navbar-top navbar-expand-lg navbar-dark @if(request()->segment(1) != '') bg-dark @endif navbar-fixed">
    <div class="container justify-content-between">
        <a class="navbar-brand order-1" href="{{ url('/') }}">
            <img class="logo-img" src="{{ asset('logo.png') }}" alt="">

        </a>
        <a class="navbar-toggle order-4" href="#navbar-mobile-style-2" data-fancybox data-base-class="fancybox-navbar" data-keyboard="false" data-auto-focus="false" data-touch="false" data-close-existing="true" data-small-btn="false" data-toolbar="false">
            <span></span>
            <span></span>
            <span></span>
        </a>
        <ul class="nav navbar-nav order-2">
            @auth()
                @if(auth()->user()->has_submitted)
                <li class="nav-item navbar-dropdown">
                    <a href="{{ url('/') }}" class="nav-link">
                        {{--<span class="nav-link-name">Home</span>--}}
                        <span class="nav-link-name"><i class="fa fa-home"></i></span>

                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>

                    {{--<li class="nav-item navbar-dropdown">--}}
                        {{--<a href="{{ route('notifications') }}" class="nav-link">--}}
                            {{--<span class="nav-link-name"><i class="fa fa-bell"></i></span>--}}
                            {{--<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                                {{--<path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
                            {{--</svg>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                <li class="nav-item navbar-dropdown">
                    <a href="{{ route('chat') }}" class="nav-link">
                        <span class="nav-link-name"><i class="fa fa-comments"></i></span>
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>

                    <li class="nav-item navbar-dropdown">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <span class="nav-link-name"><i class="fa fa-user"></i></span>
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>

                    {{--@if(auth()->user()->subscribed())--}}
                    {{--<li class="nav-item navbar-dropdown">--}}
                        {{--<a href="{{ route('subscription') }}" class="nav-link">--}}
                            {{--<span class="nav-link-name"><i class="fa fa-mail-bulk"></i></span>--}}
                            {{--<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                                {{--<path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
                            {{--</svg>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                @endif
            @else
                @if(request()->segment(1) != "start")
                    <li class="nav-item navbar-dropdown navbar-dropdown-mega">
                        <a href="{{ route('about') }}" class="nav-link">
                            <span class="nav-link-name">About</span>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>

                    <li class="nav-item navbar-dropdown navbar-dropdown-mega">
                        <a href="#faqSection" class="nav-link">
                            <span class="nav-link-name">FAQ</span>
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item navbar-dropdown">
                        <a href="{{ route('start') }}" class="nav-link">
                            <span class="nav-link-name">Get Started</span>
                        </a>
                    </li>
                @endif
            @endauth
        </ul>

        @if(request()->segment(1) != "start")
            @auth()

                <a href="{{ route('notifications') }}" class="theme-button d-sm-inline-block btn btn-white ms-auto me-40 ms-lg-60 me-lg-0 order-2 order-lg-3"
                        style="position: relative; padding: 7px 26px; font-size: 15px;background: black; border-color: black">

                    <i class="fa fa-bell"></i>

                    @if(auth()->user()->notifications->count() > 0)
                    <!-- Notification bubble -->
                    <span style="position: absolute;top: 0; right: 8px; background: red;color: white;border-radius: 50%; font-size: 10px;min-width: 16px;min-height: 16px;text-align: center; line-height: 16px;padding: 0 4px;
       " > {{ auth()->user()->notifications->count() }} </span>
                        @endif
                </a>


                <a style="padding: 7px 26px;font-size: 15px"  id="logoutBtn" href="#"   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" class="theme-button d-sm-inline-block btn btn-white  ms-auto me-40 ms-lg-60 me-lg-0 order-2 order-lg-3"> Logout </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a style="padding: 7px 26px;font-size: 15px" class="theme-button d-sm-inline-block   ms-auto me-40 ms-lg-60 me-lg-0 order-2 order-lg-3" href="{{ route('login') }}"> Login </a>
            @endauth
        @endif
    </div>
</header>
<!-- style 2 -->
<div class="navbar navbar-mobile navbar-mobile-style-2 navbar-dark" id="navbar-mobile-style-2">
    <div class="shape justify-content-end">
        <svg data-rellax-speed="0" width="544" height="362" viewBox="0 0 544 362" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="320.5" cy="41.5" r="320.5" fill=" #202020" />
        </svg>
    </div>
    <div class="navbar-head">
        <div class="container justify-content-between">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img width="48" src="{{ asset('logo.png') }}" alt="">
            </a>
            <a class="navbar-toggle" href="#" data-fancybox-close>
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row gh-1 justify-content-center">
            <div class="col-12 col-md-7 col-lg-5 col-xl-4">
                <div class="navbar-body">
                    <ul class="nav navbar-nav navbar-nav-collapse">
                        <li class="nav-item navbar-collapse">
                            <a href="{{ url('/') }}" class="nav-link " style="display: block;text-align: center;" role="button">
                                <span class="nav-link-name">Home</span>
                                {{--<span class="nav-link-name"><i class="fa fa-home"></i></span>--}}

                                <svg class="collapse-icon" width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>



                        @auth()
                            @if(auth()->user()->has_submitted)
                                {{--<li class="nav-item navbar-collapse">--}}
                                    {{--<a href="{{ route('group') }}" class="nav-link" style="display: block;text-align: center;">--}}
                                        {{--<span class="nav-link-name">My Group</span>--}}
                                        {{--<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                                            {{--<path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
                                        {{--</svg>--}}
                                    {{--</a>--}}
                                {{--</li>--}}

                                <li class="nav-item navbar-collapse">
                                    <a href="{{ route('chat') }}" class="nav-link" style="display: block;text-align: center;">
                                        <span class="nav-link-name">Chat</span>
                                        {{--<span class="nav-link-name"><i class="fa fa-comments"></i></span>--}}

                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </li>

                                {{--<li class="nav-item navbar-collapse">--}}
                                    {{--<a href="{{ route('notifications') }}" class="nav-link" style="display: block;text-align: center;">--}}
                                        {{--<span class="nav-link-name">Notifications</span>--}}
                                        {{--<span class="nav-link-name"><i class="fa fa-bell"></i></span>--}}

                                        {{--<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                                            {{--<path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
                                        {{--</svg>--}}
                                    {{--</a>--}}
                                {{--</li>--}}

                                <li class="nav-item navbar-collapse">
                                    <a href="{{ route('profile') }}" class="nav-link" style="display: block;text-align: center;">
                                        <span class="nav-link-name">Profile</span>
                                        {{--<span class="nav-link-name"><i class="fa fa-user"></i></span>--}}

                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </li>

                                <li class="nav-item navbar-collapse">
                                    <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link" style="display: block;text-align: center;">
                                        <span class="nav-link-name">Logout</span>
                                        {{--<span class="nav-link-name"><i class="fa fa-sign-out-alt"></i></span>--}}

                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        @else
                            <li class="nav-item navbar-collapse">
                                <a href="{{ route('about') }}" class="nav-link" style="display: block;text-align: center;" role="button">
                                    <span class="nav-link-name">About</span>
                                    <svg class="collapse-icon" width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item navbar-collapse">
                                <a href="#faqSection" class="nav-link" style="display: block;text-align: center;" role="button">
                                    <span class="nav-link-name">FAQ</span>
                                    <svg class="collapse-icon" width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item navbar-collapse">
                                <a href="{{ route('start') }}" class="nav-link" style="display: block;text-align: center;">
                                    <span class="nav-link-name">Get Started</span>
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                        @endauth


                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="content-wrap">

    @yield('content')


</div>
<!-- START: Scripts -->
<!-- Object Fit Polyfill -->
<script src="{{ asset('frontend/vendor/object-fit-images/dist/ofi.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('frontend/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- ImagesLoaded -->
<script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<!-- Swiper -->
<script src="{{ asset('frontend/vendor/swiper/dist/js/swiper.min.js') }}"></script>
<!-- Animejs -->
<script src="{{ asset('frontend/vendor/animejs/lib/anime.min.js') }}"></script>
<!-- Rellax -->
<script src="{{ asset('frontend/vendor/rellax/rellax.min.js') }}"></script>
<!-- Countdown -->
<script src="{{ asset('frontend/vendor/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>
<!-- Moment.js -->
<script src="{{ asset('frontend/vendor/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('frontend/vendor/moment-timezone/builds/moment-timezone-with-data.min.js') }}"></script>
<!-- Isotope -->
<script src="{{ asset('frontend/vendor/isotope-layout/dist/isotope.pkgd.min.js') }}"></script>

<script src="{{ asset('frontend/vendor/isotope-packery/packery-mode.pkgd.min.js') }}"></script>
<!-- Jarallax -->
<script src="{{ asset('frontend/vendor/jarallax/dist/jarallax.min.js') }}"></script>

<script src="{{ asset('frontend/vendor/jarallax/dist/jarallax-video.min.js') }}"></script>
<!-- Fancybox -->
<script src="{{ asset('frontend/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>
<!-- Themebau -->
<script src="{{ asset('frontend/js/themebau.min.js') }}"></script>

@yield('scripts')
<!-- END: Scripts -->
<script>
    // Prevent double-tap to zoom
    let lastTouchEnd = 0;
    document.addEventListener('touchend', function (event) {
        const now = (new Date()).getTime();
        if (now - lastTouchEnd <= 100) {
            event.preventDefault();
        }
        lastTouchEnd = now;
    }, false);
</script>
</body>
</html>