@extends('restaurant.layouts.main')

@section('title')
 {{ $menu->name }}
@endsection
@section('content')
<div class="container">
    <div class="product-details-area">
        <a class="btn back-page-btn" href="main-home.html"><i class="ri-arrow-left-s-line"></i></a>
        <div class="btn-area">
            <a class="btn back-page-btn" href="#"><i class="ri-more-2-fill"></i>
            </a>
        </div>
        <div class="product-details-wrap text-center">
           
            {{-- <p>Mixed Pizza with Cheese</p> --}}
            <img src="{{ asset('product-images/'.$menu->product_image) }}" width="200" class="rounded-2 mt-3 mb-3" alt="img">
            <h5>{{ $menu->name }}</h5>
        </div>
        <div class="wrap-details text-center">
            <p>{{ $menu->description }}</p>
        </div>
       
        {{-- <div class="wrap-details text-center">
            <h6>Special instructions</h6>
            <p>Please let us know if you are allergic to anything or if we need to avoid anything.</p>
        </div>
        <div class="single-textarea-wrap">
            <textarea rows="4" placeholder="e.g. no mayo"></textarea>
        </div> --}}
        {{-- <div class="sent-to-cart-btn">
            <div class="media-left">
                <span>Add {{ $quantity }} for</span>
                <h5>₦{{ $menu->regular_price }}</h5>
            </div>
            <a href="cart-page.html"><img src="{{ asset('customer/assets/img/icon/svg/bag.svg') }}" alt="img"></a>
        </div> --}}
    </div>
</div>  
@endsection

