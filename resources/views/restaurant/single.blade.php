@extends('restaurant.layouts.main')

@section('title')
    ChopNow Food Delivery - {{ $vendor->business_name }}
@endsection

@section('content')
<div class="single-banner-area" style="background-image: url({{ asset('customer/assets/img/product/1.png') }});">
    <div class="container" style="position: relative;">
        <a class="btn back-page-btn" href="single-page.html"><i class="ri-arrow-left-s-line"></i></a>
        <div class="btn-area">
            <a class="btn back-page-btn" href="#"><i class="ri-heart-fill"></i></a>
            <a class="btn back-page-btn" href="#"><i class="ri-error-warning-fill"></i></a>
        </div>
        <div class="restuarent-details">
            <div class="media">
                <div class="thumb">
                    <img src="{{ asset('vendor/assets/img/brands/'.$vendor->kitchen_banner_image) }}" width="70" style="background-color: #fff;" class="rounded-2" alt="img">
                    <span>Open</span>
                </div>
                <div class="media-body">
                    <h3>{{ $vendor->business_name }}</h3>
                    <p>{{ $vendor->address }}</p>
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
        
        @livewire('product-list',['vendorId'=>$vendor->id])
    </div>
</div>

@livewire('view-cart')

@endsection
