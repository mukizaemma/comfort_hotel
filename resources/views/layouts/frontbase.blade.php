<!DOCTYPE html>
<html lang="zxx">
<base href='/public'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="{{$setting->company ?? ''}}">
    <meta name="keywords" content="{{$setting->keywords ?? ''}}">
    <meta name="robots" content="index, follow">
    <!-- for open graph social media -->
    <meta property="og:title" content="{{$setting->company ?? ''}}">
    <meta property="og:description" content="{{$setting->company ?? ''}}">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$setting->company ?? ''}}">
    <meta name="twitter:description" content="{{$setting->company ?? ''}}">
    <!-- favicon -->
    <link rel="icon" href="{{ asset('storage/images') . $setting->logo }}" type="image/x-icon">
    <!-- title -->
    <title>{{$setting->company ?? ''}}</title>

    <!-- google fonts - Uniform, readable fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- icon font from flaticon -->
    <link rel="stylesheet" href="assets/fonts/flaticon_bokinn.css">
    <!-- all plugin css -->
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <!-- main style custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Uniform font styling */
        body {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            line-height: 1.3;
        }
        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .footer__social__link {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        /* Center icons inside footer social circles */
        .footer__social__link .social-icon {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0;
        }
        .footer__social__link .social-icon i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            font-size: 1.125rem;
        }
        /* Optical centering: Facebook and LinkedIn glyphs sit slightly left in FA */
        .footer__social__link .social-icon .fa-facebook-f {
            transform: translateX(1px);
        }
        .footer__social__link .social-icon .fa-linkedin-in {
            transform: translateX(1px);
        }
        .copyright__wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        /* Pagination: single row, normal-sized arrows, no overlap */
        .gallery-pagination-wrapper .pagination {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 2px;
            align-items: center;
        }
        .gallery-pagination-wrapper .page-item .page-link {
            font-size: 0.875rem;
            padding: 0.35rem 0.65rem;
            min-width: auto;
            text-align: center;
        }
        .gallery-pagination-wrapper .page-item.disabled .page-link,
        .gallery-pagination-wrapper .page-item.active .page-link {
            cursor: default;
        }
        /* Custom preloader: logo + animation (overrides template default) */
        .loader-wrapper {
            background: linear-gradient(145deg, #f8f9fa 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .loader-wrapper .loader-section.section-left,
        .loader-wrapper .loader-section.section-right {
            display: none;
        }
        .loader-wrapper .loader {
            width: auto;
            height: auto;
            top: auto;
            left: auto;
            transform: none;
            position: relative;
            border: none;
        }
        .loader-wrapper .loader:after {
            display: none;
        }
        .preloader-inner {
            text-align: center;
            position: relative;
            z-index: 1001;
        }
        .preloader-logo-wrap {
            position: relative;
            display: inline-block;
        }
        .preloader-logo-wrap:before {
            content: '';
            position: absolute;
            inset: -12px;
            border: 2px solid rgba(33, 118, 175, 0.2);
            border-radius: 50%;
            animation: preloader-ring 1.8s ease-in-out infinite;
        }
        .preloader-logo {
            max-width: 160px;
            width: 160px;
            height: auto;
            display: block;
            animation: preloader-logo-in 1s ease-out forwards, preloader-logo-pulse 2.2s ease-in-out 1s infinite;
            opacity: 0;
        }
        @keyframes preloader-logo-in {
            0% { opacity: 0; transform: scale(0.88); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes preloader-logo-pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.04); opacity: 0.95; }
        }
        @keyframes preloader-ring {
            0%, 100% { transform: scale(0.95); opacity: 0.4; }
            50% { transform: scale(1.08); opacity: 0.15; }
        }
        .loaded .loader-wrapper {
            opacity: 0;
            visibility: hidden;
            transform: none;
            transition: opacity 0.5s ease-out 0.15s, visibility 0.5s 0.15s;
        }
    </style>

</head>

<body>

        @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#25D366'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33'
                });
            });
        </script>
    @endif

    <!-- header area -->
    <div class="header__top">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6">
                    <div class="social__links">
                        <a class="link__item gap-10" href="callto:{{$setting->phone ?? ''}}"><i class="flaticon-phone-flip"></i> {{$setting->phone ?? ''}}</a>
                        <a class="link__item gap-10" href="mailto:{{$setting->email ?? ''}}"><i class="flaticon-envelope"></i> {{$setting->email?? ''}}</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="location">
                        <a class="link__item gap-10" href="https://maps.app.goo.gl/HHpJhzWDsh4JCiVCA" target="_blank"><i class="flaticon-marker"></i>{{$setting->address?? ''}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="main__header header__function">
        <div class="container">
            <div class="row">
                <div class="main__header__wrapper">
                    <div class="main__logo">
                        <a href="{{route('home')}}"><img class="logo__class" src="{{ asset('storage/images') . $setting->logo }}" alt="moonlit" width="90px"></a>
                    </div>
                    <div class="main__nav">
                        <div class="navigation d-none d-lg-block">
                            <nav class="navigation__menu" id="main__menu">
                                <ul class="list-unstyled">
                                    <li class="navigation__menu--item">
                                        <a href="{{route('home')}}" class="navigation__menu--item__link">Home</a>
                                    </li>

                                    <li class="navigation__menu--item has-child">
                                        <a href="{{route('about')}}" class="navigation__menu--item__link">About</a>
                                        <ul class="submenu sub__style" role="menu">
                                            <li role="menuitem"><a href="{{route('about')}}#background">Background</a></li>
                                            <li role="menuitem"><a href="{{route('terms')}}">Terms & Conditions</a></li>
                                            <li role="menuitem"><a href="{{route('contact')}}">Contacts</a></li>
                                            <li role="menuitem"><a href="{{route('updates')}}">Updates</a></li>
                                        </ul>
                                    </li>

                                    <li class="navigation__menu--item">
                                        <a href="{{route('rooms')}}" class="navigation__menu--item__link">Rooms</a>
                                    </li>

                                    <li class="navigation__menu--item">
                                        <a href="{{route('facilities')}}" class="navigation__menu--item__link">Facilities</a>
                                    </li>

                                    <li class="navigation__menu--item">
                                        <a href="{{route('activities')}}" class="navigation__menu--item__link">Activities</a>
                                    </li>

                                    <li class="navigation__menu--item">
                                        <a href="{{route('gallery')}}" class="navigation__menu--item__link">Gallery</a>
                                    </li>

                                    <li class="navigation__menu--item">
                                        <a href="{{route('contact')}}" class="navigation__menu--item__link">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>

                    <div class="main__right">
                        <a href="{{ route('connect') }}" class="theme-btn btn-style sm-btn fill" style="font-size: 16px; font-weight: 600; padding: 12px 30px;">
                            <span>Book Now</span>
                        </a>
                        <button class="theme-btn btn-style sm-btn fill menu__btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <span><img src="assets/images/icon/menu-icon.svg" alt=""></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->


    <div class="container-fluid">
        {{-- @show --}}
        @yield('content')
    </div>


    <div class="modal similar__modal fade " id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Login To Moonlit</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="candidate-dashboard.html" method="post" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="email-popup" class="text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="email-popup" id="email-popup" placeholder="Enter your email" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-dark mb-3">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" placeholder="Enter your password" required>

                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center ">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label mb-0" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="forgot__password text-para" data-bs-toggle="modal" data-bs-target="#forgotModal">Forgot Password?</a>
                        </div>
                        <div class="form-group my-3">
                            <button class="theme-btn btn-style sm-btn fill w-100"><span>Login</span></button>
                        </div>
                    </form>
                    <div class="d-block has__line text-center">
                        <p>Or</p>
                    </div>
                    <div class="d-flex gap-4 flex-wrap justify-content-center mt-20 mb-20">
                        <div class="is__social google">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Google</span></button>
                        </div>
                        <div class="is__social facebook">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Facebook</span></button>
                        </div>
                    </div>
                    <span class="d-block text-center ">Don`t have an account? <a href="#" data-bs-target="#signupModal" data-bs-toggle="modal" class="text-primary">Sign Up</a> </span>
                </div>
            </div>
        </div>
    </div>

    <!-- signup form -->
    <div class="modal similar__modal fade " id="signupModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Create A Free Account</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <form action="#" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="sname" class=" text-dark mb-3">Your Name</label>
                            <div class="position-relative">
                                <input type="text" name="sname" id="sname" placeholder="Candidate" required>
                                <i class="fa-light fa-user icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="signemail" class=" text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="signemail" id="signemail" placeholder="Enter your email" required>
                                <i class="fa-sharp fa-light fa-envelope icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="spassword" class=" text-dark mb-3">Password</label>
                            <div class="position-relative">
                                <input type="password" name="spassword" id="spassword" placeholder="Enter your password" required>
                                <i class="fa-light fa-lock icon"></i>
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <button class="theme-btn btn-style sm-btn fill w-100"><span>Register</span></button>
                        </div>
                    </form>
                    <div class="d-block has__line text-center">
                        <p>Or</p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-4 mt-20 mb-20">
                        <div class="is__social google">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Google</span></button>
                        </div>
                        <div class="is__social facebook">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Facebook</span></button>
                        </div>
                    </div>
                    <span class="d-block text-center ">Have an account? <a href="#" data-bs-target="#loginModal" data-bs-toggle="modal" class="text-primary">Login</a> </span>
                </div>
            </div>
        </div>
    </div>

    <!-- forgot password form -->
    <div class="modal similar__modal fade " id="forgotModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Forgot Password</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="#" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="fmail" class=" text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="email" id="fmail" placeholder="Enter your email" required>
                                <i class="fa-sharp fa-light fa-envelope icon"></i>
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <button class="theme-btn btn-style sm-btn fill w-100"><span>Reset Password</span></button>
                        </div>
                    </form>

                    <span class="d-block text-center ">Remember Your Password? 
                <a href="#" data-bs-target="#loginModal" data-bs-toggle="modal" class="text-primary">Login</a> </span>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvase menu -->
    <div class="offcanvas offcanvas-start" id="offcanvasRight">
        <div class="rts__btstrp__offcanvase">
            <div class="offcanvase__wrapper">
                <div class="left__side mobile__menu">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    <div class="offcanvase__top">
                        <div class="offcanvase__logo">
                            <a href="{{route('home')}}">
                                <img src="{{ asset('storage/images') . $setting->logo }}" alt="logo" height="90px">
                            </a>
                        </div>
                        <p class="description">
                            
                        </p>
                    </div>
                    <div class="offcanvase__mobile__menu">
                        <div class="mobile__menu__active"></div>
                    </div>
                    {{-- <div class="offcanvase__bottom">
                        <div class="offcanvase__address">

                            <div class="item">
                                <span class="h6">Phone</span>
                                <a href="tel:+1234567890"><i class="flaticon-phone-flip"></i> +1234567890</a>
                            </div>
                            <div class="item">
                                <span class="h6">Email</span>
                                <a href="mailto:info@hostie.com"><i class="flaticon-envelope"></i>info@hostie.com</a>
                            </div>
                            <div class="item">
                                <span class="h6">Address</span>
                                <a href="#"><i class="flaticon-marker"></i> {{$setting->address?? ''}}</a>
                            </div>

                        </div>
                    </div> --}}
                </div>
                <div class="right__side desktop__menu">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    <div class="rts__desktop__menu">
                        <nav class="desktop__menu offcanvas__menu">
                            <ul class="list-unstyled">
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="{{ route('home') }}">Home
                                        <span class="toggle"></span>
                                    </a>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="{{ route('about') }}">About us
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                        <li><a href="{{ route('about') }}#background">Background</a></li>
                                        <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                                        <li><a href="{{ route('updates') }}">Updates</a></li>
                                    </ul>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="{{ route('rooms') }}">Rooms
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                      @foreach ($rooms as $room)
                                        <li><a href="{{ route('room',['slug'=>$room->slug]) }}">{{ $room->title }}</a></li>
                                      @endforeach
                                        
                                    </ul>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="{{ route('facilities') }}">Facilities
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                      @foreach ($facilities as $facility)
                                        <li><a href="{{ route('facility',['slug'=>$facility->slug]) }}">{{ $facility->title }}</a></li>
                                      @endforeach
                                        
                                    </ul>
                                </li>
                                <li class="slide">
                                    <a class="slide__menu__item" href="{{ route('activities') }}">Tour Activities
                                    </a>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="{{ route('gallery') }}">Gallery
                                        <span class="toggle"></span>
                                    </a>
                                </li>
                                <li class="slide">
                                    <a class="slide__menu__item" href="{{ route('contact') }}">Contact
                                    </a>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="{{ route('connect') }}">Contact Us
                                    </a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvase menu end -->
    <!-- footer style one -->
    <footer class="rts__section rts__footer is__common__footer footer__background has__shape">
        <div class="section__shape">
            {{-- <div class="shape__1">
                <img src="assets/images/footer/shape-1.svg" alt="">
            </div> --}}
            {{-- <div class="shape__2">
                <img src="assets/images/footer/shape-2.svg" alt="">
            </div> --}}
            <div class="shape__3">
                <img src="assets/images/footer/shape-3.svg" alt="">
            </div>
        </div>
        <div class="container">
            {{-- <div class="row">
                <div class="footer__newsletter">
                    <span class="h2">Join Our Newsletter</span>
                    <div class="rts__form">
                        <form action="#" method="post">
                            <input type="email" name="email" id="subscription" placeholder="Enter your mail" required>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="footer__widget__wrapper">
                    <div class="rts__widget">
                        <a href="{{route('home')}}"><img class="footer__logo" src="{{ asset('storage/images') . $setting->logo }}" alt="footer logo" width="120px"></a>
                        <p class="font-sm max-290 mt-20">
                            {{ $about->mission }}
                        </p>
                    </div>
                    <div class="rts__widget">
                        <span class="widget__title">Hotel Facilities</span>
                        <ul>
                           @foreach ($facilities as $facility)
                              <li><a href="{{ route('facility',['slug'=>$facility->slug]) }}" aria-label="footer__link">{{ $facility->title }}</a></li>
                           @endforeach
                        </ul>
                    </div>
                    <div class="rts__widget">
                        <span class="widget__title">Our General Amenities</span>
                        <ul>
                            <li>24/7 Security</li>
                            <li>Free Parking</li>
                            <li>Free Wi-Fi</li>
                            <li>Transport Facility</li>
                            <li>Conference & Meeting Rooms</li>
                        </ul>
                    </div>
                    <div class="rts__widget">
                        <span class="widget__title">Contact Us</span>
                        <ul>
                            <li><a aria-label="footer__contact" href="tel:{{$setting->phone ?? ''}}"><i class="flaticon-phone-flip"></i> {{$setting->phone ?? ''}}</a></li>
                            <li><a aria-label="footer__contact" href="mailto:{{$setting->email ?? ''}}"><i class="flaticon-envelope"></i>{{$setting->email?? ''}}</a></li>
                            <li><a aria-label="footer__contact" href="https://maps.app.goo.gl/HHpJhzWDsh4JCiVCA" target="_blank"><i class="flaticon-marker"></i>{{$setting->address ?? ''}}</a></li>
                        </ul>

                        <div class="book mt-5">
                            <a href="{{ route('connect') }}" class="theme-btn btn-style sm-btn fill"><span>Book Now</span></a>
                            <button class="theme-btn btn-style sm-btn fill menu__btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <span><img src="assets/images/icon/menu-icon.svg" alt=""></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright__text">
            <div class="container">
                <div class="row">
                    <div class="copyright__wrapper" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <p class="mb-0">© <span id="year"></span> {{ $setting->company }}. All rights reserved. delivered by <a href="https://iremetech.com" target="_blank">Ireme Technologies</a> </p>
                        @php
                            $socialLinks = [];
                            if (!empty($setting->facebook)) {
                                $socialLinks[] = [
                                    'url' => $setting->facebook,
                                    'icon' => 'fab fa-facebook-f',
                                    'label' => 'Facebook',
                                    'color' => '#1877F2'
                                ];
                            }
                            if (!empty($setting->twitter)) {
                                $socialLinks[] = [
                                    'url' => $setting->twitter,
                                    'icon' => 'fab fa-twitter',
                                    'label' => 'Twitter',
                                    'color' => '#1DA1F2'
                                ];
                            }
                            if (!empty($setting->instagram)) {
                                $socialLinks[] = [
                                    'url' => $setting->instagram,
                                    'icon' => 'fab fa-instagram',
                                    'label' => 'Instagram',
                                    'color' => 'linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%)'
                                ];
                            }
                            if (!empty($setting->youtube)) {
                                $socialLinks[] = [
                                    'url' => $setting->youtube,
                                    'icon' => 'fab fa-youtube',
                                    'label' => 'YouTube',
                                    'color' => '#FF0000'
                                ];
                            }
                            if (!empty($setting->linkedin)) {
                                $socialLinks[] = [
                                    'url' => $setting->linkedin,
                                    'icon' => 'fab fa-linkedin-in',
                                    'label' => 'LinkedIn',
                                    'color' => '#0077B5'
                                ];
                            }
                        @endphp
                        @if(count($socialLinks) > 0)
                        <div class="footer__social__link" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 10px; margin-top: 15px;">
                            @foreach($socialLinks as $social)
                            <a href="{{ $social['url'] }}" aria-label="{{ $social['label'] }}" class="link__item social-icon" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; background: {{ $social['color'] }}; color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                            @endforeach
                        </div>
                        @endif
                        <div class="mt-3">
                            @php $reviewCount = \App\Models\Review::approved()->count(); @endphp
                            <a href="{{ route('reviews') }}" class="link__item" style="color: #ffffff; text-decoration: none;">
                                <strong>{{ $reviewCount }} </strong>  Reviews | <span style="text-decoration: underline;">View All Reviews</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer style one end -->
    <!-- back to top -->
    <button type="button" class="rts__back__top" id="rts-back-to-top">
        <svg width="20" height="20" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.30201 1.51317L7.29917 21.3422C7.29912 21.7057 6.97211 21.9993 6.5674 21.9993C6.16269 21.9992 5.83577 21.7055 5.83582 21.342L5.83844 3.10055L1.39753 7.08842C1.11169 7.34511 0.647535 7.34506 0.361762 7.0883C0.0759894 6.83155 0.0760493 6.41464 0.361896 6.15795L6.05367 1.04682C6.26405 0.857899 6.5773 0.802482 6.85167 0.905201C7.12374 1.00792 7.30205 1.24823 7.30201 1.51317Z" fill="#FFF" />
            <path d="M12.9991 6.6318C12.9991 6.80021 12.9282 6.96861 12.7841 7.09592C12.4983 7.35261 12.0341 7.35256 11.7483 7.0958L6.05118 1.97719C5.76541 1.72043 5.76547 1.30352 6.05131 1.04684C6.33716 0.790152 6.80131 0.790206 7.08709 1.04696L12.7842 6.16557C12.9283 6.29498 12.9991 6.46339 12.9991 6.6318Z" fill="#FFF" />
        </svg>

    </button>
    <!-- back to top end -->


    <!-- Custom preloader: animated logo -->
    <div class="loader-wrapper" id="site-preloader">
        <div class="loader">
            <div class="preloader-inner">
                <div class="preloader-logo-wrap">
                    <img src="{{ asset('storage/images') . $setting->logo }}" alt="{{ $setting->company ?? 'Hotel' }}" class="preloader-logo">
                </div>
            </div>
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- Preloader end -->


    <!-- plugin js -->
    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/gdpr.js"></script>
    <!-- custom js -->
    <script src="assets/js/main.js"></script>
    <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('application-form').addEventListener('submit', function(e) {

    e.preventDefault();

    var recaptchaResponse = grecaptcha.getResponse();

    if (!recaptchaResponse) {
        alert("Please confirm you are not a robot.");
        return false;
    }

    this.submit();
});

    flatpickr("#check__in", {
        minDate: "today",
        dateFormat: "d M Y"
    });

    flatpickr("#check__out", {
        minDate: "today",
        dateFormat: "d M Y"
    });

</script>


</body>

</html>