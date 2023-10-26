@extends('restaurant.layouts.main')

@section('title')

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
            <p>Mixed Pizza with Cheese</p>
            <img src="{{ asset('customer/assets/img/item/single-product.png') }}" alt="img">
        </div>
        <div class="wrap-details">
            <h6>Product details</h6>
            <p>The Original Pan pizza and the iconic Stuffed Crust pizza. A layer of toasted parmesan is baked into the crust of the Original Pan pizza.</p>
        </div>
        <div class="product-size">
            {{-- <ul class="size">
                <li><a href="#">S</a></li>
                <li><a href="#">M</a></li>
                <li><a href="#">L</a></li>
            </ul> --}}
            <form>
                <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus">
                    <input type="number" class="input-text qty text" step="1" min="1" max="10000" name="quantity" value="1">
                    <input type="button" value="+" class="plus">
                </div>
            </form>
        </div>
        <div class="wrap-details">
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

