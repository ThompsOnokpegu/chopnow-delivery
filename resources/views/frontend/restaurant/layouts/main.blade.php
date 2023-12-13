<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChopNow - Food Ordering and Delivery</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('/customer/assets/img/fevicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/animate.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/customer/assets/css/bootstrap.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/slick-slide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/customer/assets/css/responsive.css') }}">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}


</head>
<body class='sc5 bg-white'>
    <!-- preloader area start -->
    {{-- <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div id="wave1">
            </div>
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div> --}}
    <!-- preloader area end -->
    
    <div class="single-restuarent-area">
        @php
            //$url = Str::beforeLast(str_replace(url('/'),'',url()->current()),'/');
        @endphp
        @if(url()->current() == url('/') || url()->current() == url('/vouchers'))
        <div class="container">
            <div class="main-home-area pb-0 mt-5">
                <div class="location-area">
                    <a style="padding-left:15px;" class="navbar-brand" href="{{ route('restaurants.index') }}">
                        <img src="{{ asset('customer/assets/img/fevicon.png') }}" alt="img" style="height: 32px;width:auto;">
                    </a>
                    @livewire('view-address')
                    @auth
                        {{-- // The user is authenticated... --}}
                        
                        <div class="navbar-brand dropdown"> 
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-user-line" style="color:#000000"></i>
                            </a> 
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                            <a class="dropdown-item" href="#">
                                <span style="font-size:14px;">{{ Auth::user()->name }}({{ Auth::user()->email }})</span>   
                            </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="{{ route('user.account') }}">
                                    <i class="ri-user-settings-line"></i>
                                <span>Account</span>   
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('user.logout') }}">
                                    @csrf
                                <a class="dropdown-item" href="{{ route('user.logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    <i class="ri-logout-circle-line" style="vertical-align: middle;"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                                </form>
                            </li>
                            
                        </ul>
                        </div>
                    @endauth
                    
                    @guest
                        {{-- // The user is not authenticated... --}}
                        <a class="navbar-brand" href="{{ route('user.register') }}">
                            <img src="{{ asset('customer/assets/img/icon/user.png') }}" alt="img" style="height: 30px;width:auto;">
                        </a> 
                    @endguest
                    
                    
                </div>
                <div class="home-search-wrap">
                    <div class="default-form-wrap">
                        <div class="single-input-wrap">
                            <label style="z-index: -1"><img src="{{ asset('customer/assets/img/icon/search.svg') }}" alt="img"></label>
                            <input type="text" class="form-control" placeholder="Search restaurants" data-bs-toggle="modal" data-bs-target="#searchModal">
                        </div>
                        <button type="button" class="btn btn-border" data-bs-toggle="modal" data-bs-target="#categoryyyyyModal">
                            <img src="{{ asset('customer/assets/img/icon/filter.svg') }}" alt="img">
                        </button>
                    </div>
                </div>   
            </div>
        </div>
        @endif
        @yield('content')
        <!-- Modals-->
        @include('frontend.restaurant._filter-popup')
        {{-- @include('frontend.restaurant._address-popup') --}}
        @include('frontend.restaurant._category-modal')
        @include('frontend.restaurant._search-modal')
        @livewire('view-cart')
        @if(Str::beforeLast(str_replace(url('/'),'',url()->current()),'/') != '/my-chops')
        <div class="main-footer-bottom d-block text-center">
            <ul>
                <li>
                    <a href="{{ route('restaurants.index') }}">
                        <img src="{{ asset('/customer/assets/img/icon/svg/home.svg') }}" alt="icon">
                    </a>
                </li>
                <li>
                    <a data-bs-toggle="modal" data-bs-target="#searchModal"class="menu-bar">
                        <img src="{{ asset('/customer/assets/img/icon/svg/search.svg') }}" alt="img">
                    </a>
                </li>
                <li class="shop-btn">
                    <a data-bs-toggle="modal" data-bs-target="#cartModal"class="menu-bar">
                        <img src="{{ asset('/customer/assets/img/icon/svg/bag.svg') }}" alt="img">
                    </a>
                </li>
                <li>
                    <a href="{{ route('restaurants.offers') }}">
                        <img src="{{ asset('/customer/assets/img/icon/svg/discount.svg') }}" alt="img">
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.account') }}">
                        <img src="{{ asset('/customer/assets/img/icon/svg/profile.svg') }}" alt="img">
                    </a>
                </li>
            </ul>
        </div>
        @endif
    </div>
    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>
    @yield('modal')
    

    <!-- all plugins here -->
    <script src="{{ asset('/customer/assets/js/jquery.3.6.min.js') }}"></script>
    {{-- <script src="{{ asset('/customer/assets/js/bootstrap.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/customer/assets/js/imageloded.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/counterup.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/magnific.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/owl.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/slick-slider.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/customer/assets/js/tweenmax.min.js') }}"></script>
    <!-- main js  -->
    <script src="{{ asset('/customer/assets/js/main.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script> --}}
</body>
</html>