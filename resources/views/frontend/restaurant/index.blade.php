@extends('frontend.restaurant.layouts.main')

@section('content')
{{-- <!-- search popup area start -->
<div class="body-overlay" id="body-overlay"></div>
<div class="td-search-popup" id="td-search-popup">
    <form action="index.html" class="search-form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- //. search Popup --> --}}

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
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <i class="ri-user-settings-line"></i>
                          <span>Profile</span>   
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
                    <label><img src="{{ asset('customer/assets/img/icon/search.svg') }}" alt="img"></label>
                    <input type="text" class="form-control" placeholder="Search restaurants" data-bs-toggle="modal" data-bs-target="#searchModal">
                </div>
                <button type="button" class="btn btn-border" data-bs-toggle="modal" data-bs-target="#categoryyyyyModal">
                    <img src="{{ asset('customer/assets/img/icon/filter.svg') }}" alt="img">
                </button>
            </div>
        </div>   
    </div>
</div>
{{-- <div class="banner-slider-wrap">
    <div class="banner-slider owl-carousel">
        <div class="item">
            <img src="{{ asset('customer/assets/img/banner/1.png') }}" alt="img">
        </div>
        <div class="item">
            <img src="{{ asset('customer/assets/img/banner/2.png') }}" alt="img">
        </div>
        <div class="item">
            <img src="{{ asset('customer/assets/img/banner/3.png') }}" alt="img">
        </div>
    </div> 
</div>  --}}

<div class="container">
    <div class="main-home-area pt-0">
         {{--Categories  --}}
        @include('frontend.restaurant._category')
        <h5 class="section-title">Promotions</h5>
        @include('frontend.restaurant._nearby')    
        {{-- <h5 class="section-title">Popular Restaurant</h5>
        @include('frontend.restaurant._popular') --}}
        <h5 class="section-title">All Restaurant</h5>  
        <div class="container">
            <div class="row">
                @foreach ($vendors as $restaurant)
                    <div class="col-sm-12 col-md-6">
                        <div class="single-product-wrap">
                            <div class="thumb">
                                {{-- <span class="tag">15% Off</span> --}}
                                <a href="{{ route('restaurants.show',$restaurant->id) }}">
                                    <img src="{{ url(env('CLOUD_BASE_URL').$restaurant->kitchen_banner_image) }}" alt="img">
                                </a>
                                <a class="fav-btn" href="#"><i class="fa fa-heart"></i></a>
                            </div>
                            <div class="details">
                                <h6><a href="{{ route('restaurants.show',$restaurant->id) }}">{{ $restaurant->business_name }}</a> <span></span></h6>
                                <div class="ratting">
                                    <i class="ri-star-fill ps-0"></i>5
                                    <span>(0)</span>
                                    <span>{{ $restaurant->preparation_time }} - {{ $restaurant->preparation_time + 10 }} Min <span class="ms-3"><i class="fa fa-motorcycle"></i> ₦{{ $restaurant->delivery_fee }}</span></span>    
                                </div>    
                            </div>
                        </div> 
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div> 

<!-- Modals-->
@include('frontend.restaurant._filter-popup')
@include('frontend.restaurant._address-popup')
@include('frontend.restaurant._category-modal')
@include('frontend.restaurant._search-modal')
@livewire('view-cart')

@endsection