<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FoodKapp - Food Ordering, Delivery Mobile Template</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('customer/assets/img/fevicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('customer/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/slick-slide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/responsive.css') }}">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">


</head>
<body class='sc5'>
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
    
    <div class="single-restuarent-area">
        <div class="single-banner-area" style="background-image: url(customer/assets/img/product/1.png);">
            <div class="container" style="position: relative;">
                <a class="btn back-page-btn" href="single-page.html"><i class="ri-arrow-left-s-line"></i></a>
                <div class="btn-area">
                    <a class="btn back-page-btn" href="#"><i class="ri-heart-fill"></i></a>
                    <a class="btn back-page-btn" href="#"><i class="ri-error-warning-fill"></i></a>
                </div>
                <div class="restuarent-details">
                    <div class="media">
                        <div class="thumb">
                            <img src="{{ asset('customer/assets/img/restaurant/1.png') }}" alt="img">
                            <span>Open</span>
                        </div>
                        <div class="media-body">
                            <h3>Pizza Hut</h3>
                            <p>Birch Street El Paso</p>
                        </div>
                    </div>
                    <div class="rating">
                        <span>
                            <i class="ri ri-star-fill"></i>
                            4.9 <span>(6k)</span>
                        </span>
                        <p> <img src="{{ asset('customer/assets/img/icon/timer.png') }}" alt="img">  20-25 Min</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-page-details">
            <div class="container">
                <a class="btn btn-discount w-100" href="#"><img src="{{ asset('customer/assets/img/icon/svg/discount.svg') }}" alt="img"> Get  $50 off on total dish use #COMBO</a>
                <div>
                    <h5>Main Meals</h5>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="single-item-wrap">
                            <div class="thumb">
                                <img src="{{ asset('customer/assets/img/item/1.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h6><a href="product-details.html">Dodo Cheese Pan</a></h6>
                                <p>Mounds of golden melting cheese on a rich bed </p>
                                <span class="price">₦2,400.00</span>
                            </div>
                            <a class="btn back-page-btn" href="product-details.html"><i class="ri-add-line"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-footer-bottom d-block text-center">
            <ul>
                <li>
                    <a href="main-home.html">
                        <img src="{{ asset('customer/assets/img/icon/svg/home.svg') }}" alt="icon">
                    </a>
                </li>
                <li>
                    <a href="search.html">
                        <img src="{{ asset('customer/assets/img/icon/svg/search.svg') }}" alt="img">
                    </a>
                </li>
                <li class="shop-btn">
                    <a class="menu-bar" href="cart-page.html">
                        <img src="{{ asset('customer/assets/img/icon/svg/bag.svg') }}" alt="img">
                    </a>
                </li>
                <li>
                    <a href="vouchers.html">
                        <img src="{{ asset('customer/assets/img/icon/svg/discount.svg') }}" alt="img">
                    </a>
                </li>
                <li>
                    <a href="profile.html">
                        <img src="{{ asset('customer/assets/img/icon/svg/profile.svg') }}" alt="img">
                    </a>
                </li>
            </ul>
        </div>
    </div>  
    

    <!-- all plugins here -->
    <script src="{{ asset('customer/assets/js/jquery.3.6.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/imageloded.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/counterup.js') }}"></script>
    <script src="{{ asset('customer/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('customer/assets/js/magnific.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/owl.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/slick-slider.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('customer/assets/js/tweenmax.min.js') }}"></script>
    <!-- main js  -->
    <script src="{{ asset('customer/assets/js/main.js') }}"></script>
</body>
</html>