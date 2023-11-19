@extends('frontend.restaurant.layouts.main')

@section('title')
 {{ $menu->name }}
@endsection
@section('content')
<div class="container">
    <div class="product-details-area">
        <a class="btn back-page-btn" href="#"><i class="ri-arrow-left-s-line"></i></a>
        <div class="btn-area">
            <a class="btn back-page-btn" href="#"><i class="ri-more-2-fill"></i>
            </a>
        </div>
        <div class="product-details-wrap text-center">
           
            {{-- <p>Mixed Pizza with Cheese</p> --}}
            <img src="{{ asset('storage/menu-images/'.$menu->product_image) }}" width="200" class="rounded-2 mt-3 mb-3" alt="img">
            <h5>{{ $menu->name }}</h5>
        </div>
        <div class="wrap-details text-center">
            <p>{{ $menu->description }}</p>
        </div>        
    </div>
</div>  
@endsection

