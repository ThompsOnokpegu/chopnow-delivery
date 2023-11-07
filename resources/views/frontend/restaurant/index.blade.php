@extends('frontend.restaurant.layouts.main')

@section('content')
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
            <div class="media">
                <img src="{{ asset('customer/assets/img/icon/map-marker.svg') }}" alt="img">
                <div class="media-body">
                    <span>Delivery to</span>
                    <select class="single-select">
                        <option>San Francisco, US</option>
                        <option value="asc">Dhaka, Bangladesh</option>
                    </select>
                </div>
            </div>
            {{-- <a class="notification-btn" href="#"><img src="{{ asset('customer/assets/img/icon/notification.svg') }}" alt="icon">
            
            </a> --}}
            <div class="notification-btn media">
                <img src="{{ asset('customer/assets/img/icon/map-marker.svg') }}" alt="img">
                <div class="media-body">
                    @if(Auth::check())
                        <span>{{ Auth::user()->name }}</span>   
                    @else
                        <span>Guest</span>   
                    @endif
                </div>
            </div>
        </div>
        <div class="home-search-wrap">
            <div class="default-form-wrap">
                <div class="single-input-wrap">
                    <label><img src="{{ asset('customer/assets/img/icon/search.svg') }}" alt="img"></label>
                    <input type="text" class="form-control" placeholder="Search for food">
                </div>
                <button type="button" class="btn btn-border" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        @foreach ($vendors as $restaurant)  
            <div class="single-product-wrap">
                <div class="thumb">
                    <span class="tag">15% Off</span>
                    <a href="{{ route('restaurants.show',$restaurant->id) }}">
                        <img src="{{ asset('vendor/assets/img/brands/'.$restaurant->kitchen_banner_image) }}" alt="img">
                    </a>
                    <a class="fav-btn" href="#"><i class="fa fa-heart"></i></a>
                </div>
                <div class="details">
                    <h6><a href="{{ route('restaurants.show',$restaurant->id) }}">{{ $restaurant->business_name }}</a> <span></span></h6>
                    <div class="ratting">
                        <i class="ri-star-fill ps-0"></i>4.9
                        <span>(6k)</span>
                        <span>20-25 Min <span class="ms-3"><i class="fa fa-motorcycle"></i> ₦500.00</span></span>
                        
                    </div>
                    
                </div>
            </div> 
        @endforeach

    </div>
</div> 

<!-- Modal -->
@include('frontend.restaurant._filter')

@endsection