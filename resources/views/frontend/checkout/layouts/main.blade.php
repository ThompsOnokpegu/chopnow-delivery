<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChopNow - Food Ordering and Delivery</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('customer/assets/img/fevicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{'/customer/assets/css/animate.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/magnific.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/jquery-ui.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/nice-select.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/owl.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/slick-slide.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/fontawesome.min.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/remixicon/remixicon.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/style.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/custom-styles.css'}}">
    <link rel="stylesheet" href="{{'/customer/assets/css/responsive.css'}}">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .alert-warning {
            color: #ffffff;
            background-color: #ce2829;
            border-color: #ce2829;
        }
        body {
            margin: 0;
            color: var(--paragraph-color);
            font-family: var(--body-font);
            line-height: var(--line-height30);
            font-size: var(--body-font-size);
            background-color: #F9FAFC;
        }
    </style>

</head>
<body class='sc5-2'>
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

    <!-- search popup area start -->
    <div class="body-overlay" id="body-overlay"></div>
    <div class="td-search-popup" id="td-search-popup">
        <form action="index.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- //. search Popup -->


    <div class="container">
        <div class="main-home-area pb-0 mt-5">
            <div class="location-area">
                <a style="padding-left:15px;" class="navbar-brand" href="{{ route('restaurants.index') }}">
                    <img src="{{ asset('customer/assets/img/fevicon.png') }}" alt="img" style="height: 36px;width:auto;">
                </a>
                {{-- @livewire('view-address') --}}
                {{-- <a class="navbar-brand" href="{{ route('restaurants.index') }}">
                    <img src="{{ asset('customer/assets/img/icon/user.png') }}" alt="img" style="height: 30px;width:auto;">
                </a>  --}}
            </div>
             
        </div>
    </div>
    @yield('content')

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>
    @include('frontend.restaurant._address-popup')
    

    <!-- all plugins here -->
    <script src="{{'/customer/assets/js/jquery.3.6.min.js'}}"></script>
    <script src="{{'/customer/assets/js/bootstrap.min.js'}}"></script>
    <script src="{{'/customer/assets/js/imageloded.min.js'}}"></script>
    <script src="{{'/customer/assets/js/counterup.js'}}"></script>
    <script src="{{'/customer/assets/js/waypoint.js'}}"></script>
    <script src="{{'/customer/assets/js/magnific.min.js'}}"></script>
    <script src="{{'/customer/assets/js/isotope.pkgd.min.js'}}"></script>
    <script src="{{'/customer/assets/js/jquery-ui.min.js'}}"></script>
    <script src="{{'/customer/assets/js/nice-select.min.js'}}"></script>
    <script src="{{'/customer/assets/js/fontawesome.min.js'}}"></script>
    <script src="{{'/customer/assets/js/owl.min.js'}}"></script>
    <script src="{{'/customer/assets/js/slick-slider.min.js'}}"></script>
    <script src="{{'/customer/assets/js/wow.min.js'}}"></script>
    <script src="{{'/customer/assets/js/tweenmax.min.js'}}"></script>
    <!-- main js  -->
    <script src="{{'/customer/assets/js/main.js'}}"></script>
</body>
</html>