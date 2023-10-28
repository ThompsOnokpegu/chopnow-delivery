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
            <h5>{{ $menu->name }}</h5>
            {{-- <p>Mixed Pizza with Cheese</p> --}}
            <img src="{{ asset('product-images/'.$menu->product_image) }}" width="200" class="rounded-2 mt-3 mb-3" alt="img">
        </div>
        <div class="wrap-details text-center">
            <h6>Product Description</h6>
            <p>{{ $menu->description }}</p>
        </div>
        <div class="product-siz text-center mb-5">
            <form class="mt-5 mb-4">
                <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus">
                    <input type="number" class="input-text qty text" step="1" min="1" max="10000" name="quantity" value="1">
                    <input type="button" value="+" class="plus">
                </div>
                <button style="border:1px solid#CE2829; " class="btn btn-bas w-20 text-center" href="#"><i class="ri-add-line"></i> Add to Cart</button>
            </form>
        </div>
        <div class="wrap-details text-center">
            <h6>Special instructions</h6>
            <p>Please let us know if you are allergic to anything or if we need to avoid anything.</p>
        </div>
        <div class="single-textarea-wrap">
            <textarea rows="4" placeholder="e.g. no mayo"></textarea>
        </div>
        <div class="sent-to-cart-btn">
            <div class="media-left">
                <span>Together to pay</span>
                <h5>$29.36</h5>
            </div>
            <a href="cart-page.html"><img src="{{ asset('customer/assets/img/icon/svg/bag.svg') }}" alt="img"></a>
        </div>
    </div>
</div>  
@endsection

