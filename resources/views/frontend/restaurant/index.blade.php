@extends('frontend.restaurant.layouts.main')

@section('content')
<div class="container">
    <div class="main-home-area pt-0">
         {{--Categories  --}}
        @include('frontend.restaurant._category')
        @if($vendors->count()>0)<h5 class="section-title">Promotions</h5>@endif
        @include('frontend.restaurant._nearby')    
        {{-- <h5 class="section-title">Popular Restaurant</h5>
        @include('frontend.restaurant._popular') --}}
        @if($vendors->count()>0)<h5 class="section-title">All Restaurant</h5>@endif  
        <div class="container"> 
            <div class="row">
                @forelse ($vendors as $restaurant)
                    <div class="col-sm-12 col-md-6">
                        <div class="single-product-wrap">
                            <div class="thumb">
                                {{-- <span class="tag">15% Off</span> --}}
                                <a href="{{ route('restaurants.show',$restaurant->id) }}">
                                    <img src="{{ url($restaurant->kitchen_banner_image) }}" alt="img">
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
                @empty
                    <div>We are registering new restaurants!</div>
                @endforelse
            </div>
        </div>
    </div>
</div> 
@endsection