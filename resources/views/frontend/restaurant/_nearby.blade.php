<div class="home-product-slider owl-carousel">
    <div class="container">
        <div class="row">
            @foreach ($nearby as $restaurant)
                <div class="col-sm-12 col-md-6">
                    <div class="single-product-wrap">
                        <div class="thumb">
                            {{-- <span class="tag">15% Off</span> --}}
                            <a href="{{ route('restaurants.show',$restaurant->id) }}">
                                <img src="{{ asset('vendor/assets/img/brands/'.$restaurant->kitchen_banner_image) }}" alt="img">
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